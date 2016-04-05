<?php
/**
 * @desc 公告表操作类
 * @author Dengshaocong
 * @date 2015-12-11 
 */
class mediasetDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2015-12-11
	 * @param string $className
	 * @return mediasetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2015-12-11 
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'mediaset';
		$this->primaryKey = 'mediaid';
	}

	/**
	 * @desc  根据条件获取媒体资料
	 * @param array $condInfo 条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function getMediaByCond($condInfo){
		$select = "{$this->tableName}.mediaid,{$this->tableName}.mediatext,{$this->tableName}.type,{$this->tableName}.mtfl,{$this->tableName}.phone,
					{$this->tableName}.xh,{$this->tableName}.display";
		$where['express'] = "{$this->tableName}.mediaid != ''";
		$where['value'] = array();
		if(!empty($condInfo)){
			if(!empty($condInfo['type'])){
				$where['express'] .= " AND {$this->tableName}.type = :type";
				$where['value'][':type'] = $condInfo['type'];
			}
			if(!empty($condInfo['display'])){
				$where['express'] .= " AND {$this->tableName}.display = :display";
				$where['value'][':display'] = $condInfo['display'];
			}
			if(!empty($condInfo['mediatext'])){
				$where['express'] .= " AND {$this->tableName}.mediatext like :mediatext";
				$where['value'][':mediatext'] = "%".$condInfo['mediatext']."%";
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.mediaid DESC ");
		$result['info'] = $this->dbCommand->queryAll();						   
		return $result;
	}


	/**
	 * @desc  获取最后一个主键
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function getMaxMediaNumber(){
		$select = "{$this->tableName}.mediaid";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.mediaid ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc  根据部门获取媒体来源
	 * @param string $dept 部门名称
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getMediaByDept($dept){
		$select = "{$this->tableName}.mediatext,{$this->tableName}.mediaid";
		$where['express'] = "{$this->tableName}.mediaid != '' ";
		$where['value'] = array();
		if(!empty($dept)){
			$where['express'] .= ' and deptset.depttext = :dept ';
			$where['value']['dept'] = $dept;
		}
		$this->dbCommand->reset();
		$this->dbCommand->selectDistinct($select)
						->from($this->tableName)
						->leftjoin('khaa',"{$this->tableName}.mediatext = khaa.khaa22")
						->leftjoin('rylist','khaa.khaa32 = rylist.username')
						->leftjoin('deptset','rylist.department = deptset.depttext')
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.mediaid ".' DESC');
		$result = $this->dbCommand->queryAll();

		return $result;
	}


	/**
	 * @desc  获取当前媒体来源的客户
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getGgxgfxbbPeople($cond){
		$select = "count(khaa01) num";
		$where['express'] = "{$this->tableName}.mediatext = '".$cond['mediatext']."' ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'] .= "and khaa.khaa30 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate']; 
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= "and khaa.khaa30 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate']; 
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa',"{$this->tableName}.mediatext = khaa.khaa22")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array('num'=>0);
		}
		return $result[0];
	}

	/**
	 * @desc 获取广告效果分析报表——信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getGgxgfxbbByCond($cond,$type){
		$select = "count(xsaa.xsaa01) num , sum(xsaa.xsaa19) money";
		$where['express'] = "{$this->tableName}.mediatext = '".$cond['mediatext']."' and xsaa.xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'] .= ' and xsaa.xsaa61 >= :beginDate ';
			$where['value'][':beginDate'] = $cond['beginDate'];
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= ' and xsaa.xsaa61 <= :endDate ';
			$where['value'][':endDate'] = $cond['endDate'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa',"{$this->tableName}.mediatext = khaa.khaa22")
						->leftjoin('xsaa','xsaa.xsaa04 = khaa.khaa02')
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num'])){
			return array(
				'num'=>0,
				'money'=>0
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取所有媒体
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getAllMedia(){
		$select = "{$this->tableName}.mediaid,{$this->tableName}.mediatext";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName);
		$result = $this->dbCommand->queryAll();
		return $result;
	}
}
?>
<?php
/**
 * @desc 广告表操作类
 * @author Dengshaocong
 * @date 2015-12-11 
 */
class advertsetDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2015-12-11
	 * @param string $className
	 * @return advertsetDAO
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
		$this->tableName = 'advertset';
		$this->primaryKey = 'advertid';
	}

	/**
	 * @desc  获取最后一个主键
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getMaxAdvertNumber(){
		$select = "{$this->tableName}.advertid";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.advertid ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc  获取广告
	 * @param array $condInfo 查询条件
	 * @param int $page 页数
	 * @param int $psize 每页条数
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getAdvertByCond($condInfo,$page,$psize){
		$select = "{$this->tableName}.advertid,{$this->tableName}.adverttext,{$this->tableName}.advertdate,{$this->tableName}.adverttime,{$this->tableName}.duration,
					{$this->tableName}.cost,{$this->tableName}.adverttype,{$this->tableName}.setter,{$this->tableName}.submittime";
		$where['express'] = "{$this->tableName}.advertid != ''";
		$where['value'] = array();
		if(!empty($condInfo)){
			if(!empty($condInfo['adverttext'])){
				$where['express'] .= " AND {$this->tableName}.adverttext = :adverttext";
				$where['value'][':adverttext'] = $condInfo['adverttext'];
			}
			if(!empty($condInfo['begindate'])){
				$where['express'] .= " AND {$this->tableName}.advertdate >= :begindate";
				$where['value'][':begindate'] = $condInfo['begindate'];
			}
			if(!empty($condInfo['enddate'])){
				$where['express'] .= " AND {$this->tableName}.advertdate <= :enddate";
				$where['value'][':enddate'] = $condInfo['enddate'];
			}
			if(!empty($condInfo['subBegindate'])){
				$where['express'] .= " AND {$this->tableName}.submittime >= :subBegindate";
				$where['value'][':subBegindate'] = $condInfo['subBegindate'];
			}
			if(!empty($condInfo['subEnddate'])){
				$where['express'] .= " AND {$this->tableName}.submittime <= :subEnddate";
				$where['value'][':subEnddate'] = $condInfo['subEnddate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.advertid DESC ");
		$result['info'] = $this->dbCommand->queryAll();			
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();				   
		return $result;
	}

	/**
	 * @desc 获取广告效果分析报表——费用
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getGgxgfxbbFee($cond){
		$select= "sum(a.cost) fee";
		$where = " {$this->tableName}.adverttext = '". $cond['mediatext'] . "' ";
		if(!empty($cond['beginDate'])){
			$where .= " and {$this->tableName}.advertdate >= '" . $cond['beginDate']. "' ";
		}
		if(!empty($cond['endDate'])){
			$where .= " and {$this->tableName}.advertdate <= '" . $cond['endDate']. "' ";
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from("(select distinct cost from $this->tableName where $where ) a");
		$result = $this->dbCommand->queryAll();	
		if(empty($result[0]['fee'])){
			return array(
				'fee'=>0
				);
		}					   
		return $result[0];
	}
}
?>
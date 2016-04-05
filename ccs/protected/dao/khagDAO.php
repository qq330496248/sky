<?php
/**
 * @desc 内部短信操作类
 * @author huyan
 * @date 2015-11-24
 */
class khagDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-11-24
	 * @param string $className
	 * @return khagDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-11-24
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khag';
		$this->createtime = 'khag09';
		$this->primaryKey = true;
	}

	/**
	 * @desc 获取已发内部短信列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @author huyan
	 * @date 2015-11-11
	 */
	public function getSentMessages($page,$psize,$CondList,$JobNuber){
		$select = "{$this->tableName}.khag01,{$this->tableName}.khag02,{$this->tableName}.khag03,{$this->tableName}.khag05,{$this->tableName}.khag06,{$this->tableName}.khag07,{$this->tableName}.khag09";
	    $where['express'] = "{$this->tableName}.khag01 = :JobNuber";
		$where['value']['JobNuber'] = $JobNuber;

		if(!empty($CondList)){
			if(!empty($CondList['jsgh'])){
				$where['express'].=" AND {$this->tableName}.khag03 like :jsgh";
				$where['value'][':jsgh'] = '%'.$CondList['jsgh'].'%';
			}
			if(!empty($CondList['dxbt'])){
				$where['express'].=" AND {$this->tableName}.khag05 like :dxbt";
				$where['value'][':dxbt'] = '%'.$CondList['dxbt'].'%';
			}
			//根据时间段查询
		    if(!empty($CondList['fssjq'])&&!empty($CondList['fssjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khag07 >=:fssjq AND {$this->tableName}.khag07 <= :fssjz";
		    	$where['value'][':fssjq'] = $CondList['fssjq'];
		    	$where['value'][':fssjz'] = $CondList['fssjz'];
		    }
		    if (!empty($CondList['fssjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khag07 >=:fssjq";
		    	$where['value'][':fssjq'] = $CondList['fssjq'];
		    }
		    if (!empty($CondList['fssjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khag07 <=:fssjz";
		    	$where['value'][':fssjz'] = $CondList['fssjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
		 								   ->from($this->tableName)
		 								   ->where($where['express'],$where['value'])
		 								   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 获取已收内部短信列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @author huyan
	 * @date 2015-11-11
	 */
	public function getReceivedMessages($page,$psize,$CondList,$JobNuber){
		$select = "{$this->tableName}.khag01,{$this->tableName}.khag02,{$this->tableName}.khag03,{$this->tableName}.khag05,{$this->tableName}.khag06,{$this->tableName}.khag07,{$this->tableName}.khag09,{$this->tableName}.khag08";
	    $where['express'] = "{$this->tableName}.khag03 = :JobNuber";
		$where['value']['JobNuber'] = $JobNuber;
		 if(!empty($CondList)){
			if(!empty($CondList['jsgh'])){
				$where['express'].=" AND {$this->tableName}.khag01 like :jsgh";
				$where['value'][':jsgh'] = '%'.$CondList['jsgh'].'%';
			}
			if(!empty($CondList['dxbt'])){
				$where['express'].=" AND {$this->tableName}.khag05 like :dxbt";
				$where['value'][':dxbt'] = '%'.$CondList['dxbt'].'%';
			}
			//根据时间段查询
		    if(!empty($CondList['fssjq'])&&!empty($CondList['fssjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khag07 >=:fssjq AND {$this->tableName}.khag07 <= :fssjz";
		    	$where['value'][':fssjq'] = $CondList['fssjq'];
		    	$where['value'][':fssjz'] = $CondList['fssjz'];
		    }
		    if (!empty($CondList['fssjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khag07 >=:fssjq";
		    	$where['value'][':fssjq'] = $CondList['fssjq'];
		    }
		    if (!empty($CondList['fssjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khag07 <=:fssjz";
		    	$where['value'][':fssjz'] = $CondList['fssjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
		 								   ->from($this->tableName)
		 								   ->where($where['express'],$where['value'])
		 								   ->queryScalar();
		return $result;
	}


	/**
	 * @desc 获取内部未读短信
	 * @param string $username 员工ID
	 * @author DengShaocong
	 * @date 2016-03-25
	 */
	public function getNoReadMess($username){
		$select = "count({$this->tableName}.khag01) num";
	    $where['express'] = "{$this->tableName}.khag03 = '$username' and khag08 = '未读'";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num'])){
			return array(
				'num'=>0
				);
		}
		return $result[0];
	}
}
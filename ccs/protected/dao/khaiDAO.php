<?php
/**
 * @desc 黑名单表操作类
 * @author huyan
 * @date 2015-12-07 
 */
class khaiDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-12-07
	 * @param string $className
	 * @return khaiDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khai';
		$this->tableOrder = 'khaa';
		$this->primaryKey = 'khai01';
		//$this->primaryKey = khai01;
	}

	/**
	 * @desc 获取黑名单编号信息
	 * @return array $result 客户编号信息
	 * @author huyan
	 * @date 2015-11-02
	 */
	public function getMaxCustomerNumber(){	
		$select = "{$this->tableName}.khai02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.khai01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取黑名单列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 黑名单列表信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function getCustomerBlacklist($page,$psize,$phone){
		$where['express'] = "{$this->tableName}.khai01>0";
		$where['value'] = array();
		if(!empty($phone)){
	    	$where['express'].=" AND {$this->tableName}.khai03 like :phone";
		    $where['value'][':phone'] = '%'.$phone.'%';
	    }
		$select = "{$this->tableName}.khai01,{$this->tableName}.khai02,{$this->tableName}.khai03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khai01 ".' DESC')
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->order("{$this->tableName}.khai01 ".' DESC')
										   ->queryScalar();		   
		return $result;
	}

	/**
	 * 获取要修改的黑名单电话编号
	 * @return array $result 黑名单信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function getBlackListNumber($phone){	
		$where['express'] = "{$this->tableName}.khai03 = :phone";
		$where['value']['phone'] = $phone;
		
		$select = "{$this->tableName}.khai02,{$this->tableName}.khai03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryrow();
		return $result;
	}

	/**
	 * 点击编辑获取黑名单电话
	 * @return array $result 黑名单信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function getEditBlackList($orderNo){	
		$where['express'] = "{$this->tableName}.khai02 = :orderNo";
		$where['value']['orderNo'] = $orderNo;
		
		$select = "{$this->tableName}.khai02,{$this->tableName}.khai03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryrow();
		return $result;
	}
}
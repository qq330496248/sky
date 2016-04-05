<?php
/**
 * @desc 库存盘点表操作类
 * @author WuJunhua
 * @date 2015-12-01 
 */
class pdaaDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-12-01
	 * @param string $className
	 * @return pdaaDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'pdaa';
		$this->tableStock = 'pdab';
		$this->primaryKey = 'pdaa01';
	}

	/**
	 * @desc 获取最新的盘点单号
	 * @return array $result 盘点单号信息
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public function getNewestOrder(){	
		$select = "{$this->tableName}.pdaa01,{$this->tableName}.pdaa04";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.pdaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取盘点明细列表信息(盘点状态不能为盘点完结/盘点作废)
	 * @return array $result 盘点单号列表信息
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public function getInventoryOrderList($inventoryStatus,$selectColumnStr=false){		
		$select = "{$this->tableStock}.pdab01,{$this->tableStock}.pdab02,{$this->tableStock}.pdab03,{$this->tableStock}.pdab11,{$this->tableStock}.pdab04,{$this->tableStock}.pdab07,{$this->tableStock}.pdab05,{$this->tableStock}.pdab06,{$this->tableStock}.pdab10";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.pdaa04 NOT IN (:inventoryOver,:inventoryInvalid)";
		$where['value']['inventoryOver'] = $inventoryStatus['inventoryOver'];
		$where['value']['inventoryInvalid'] = $inventoryStatus['inventoryInvalid'];

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableStock, "{$this->tableName}.pdaa01 = {$this->tableStock}.pdab01")
						->where($where['express'],$where['value'])
						->order("{$this->tableStock}.pdab02 "." DESC");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取当前盘点单号
	 * @return array $result 盘点单号
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function getCurrentInventoryOrder($inventoryStatus){		
		$select = "{$this->tableName}.pdaa01";
		$where['express'] = "{$this->tableName}.pdaa04 NOT IN (:inventoryOver,:inventoryInvalid)";
		$where['value']['inventoryOver'] = $inventoryStatus['inventoryOver'];
		$where['value']['inventoryInvalid'] = $inventoryStatus['inventoryInvalid'];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.pdaa01 "." DESC")
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取盘差列表信息
	 * @return array $result 盘差列表信息
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function generateDifferenceForm($inventoryStatus,$inventoryNum){		
		$select = "{$this->tableStock}.pdab02,{$this->tableStock}.pdab03,{$this->tableStock}.pdab11,{$this->tableStock}.pdab05,{$this->tableStock}.pdab06,{$this->tableStock}.pdab08,{$this->tableName}.pdaa03";
		$where['express'] = "{$this->tableName}.pdaa04 NOT IN (:inventoryOver,:inventoryInvalid) AND {$this->tableStock}.pdab01 = :inventoryNum AND {$this->tableStock}.pdab05 != {$this->tableStock}.pdab08";
		$where['value']['inventoryOver'] = $inventoryStatus['inventoryOver'];
		$where['value']['inventoryInvalid'] = $inventoryStatus['inventoryInvalid'];
		$where['value']['inventoryNum'] = $inventoryNum['pdaa01'];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableStock, "{$this->tableName}.pdaa01 = {$this->tableStock}.pdab01")
						->where($where['express'],$where['value'])
						->order("{$this->tableStock}.pdab02 "." DESC");
		$result = $this->dbCommand->queryAll();
		return $result;
	}


	/**
	 * @desc 系统设置->数据清理->删除库存盘点记录
	 * @author huyan
	 * @date 2016-02-19
	 */
	public function getStockStockInventoryToBeDel($pdsjq,$pdsjz){
		$where['express'] = "";
		$where['value'] = array();
		if(!empty($pdsjq)&&!empty($pdsjz)){
	    	$where['express'] .= "{$this->tableName}.pdaa03 >=:pdsjq AND {$this->tableName}.pdaa03 <= :pdsjz";
	    	$where['value'][':pdsjq'] =$pdsjq;
	    	$where['value'][':pdsjz'] =$pdsjz;
	    }
	    if(!empty($pdsjq)){
	    	$where['express'] .= "{$this->tableName}.pdaa03 >=:pdsjq";
	    	$where['value'][':pdsjq'] =$pdsjq;
	    }
	     if(!empty($pdsjz)){
	    	$where['express'] .= "{$this->tableName}.pdaa03 <=:pdsjz";
	    	$where['value'][':pdsjz'] =$pdsjz;
	    }
		$select = "{$this->tableName}.pdaa01,{$this->tableName}.pdaa03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

}

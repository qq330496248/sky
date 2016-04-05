<?php
/**
 * @desc 产品库存表操作类
 * @author WuJunhua
 * @date 2015-11-12 
 */
class cpaeDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-12 
	 * @param string $className
	 * @return cpaeDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-11-12
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cpae';
		$this->primaryKey = 'cpae01';
		$this->primaryKey2 = 'cpae02';
		$this->primaryKey3 = 'cpae05';
	}

	/**
	 * @desc 获取最新的产品入库批次
	 * @return array $result 产品入库批次信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function getMaxProductStock(){	
		$select = "{$this->tableName}.cpae01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.cpae01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取最新的采购单号(即入库单号)
	 * @return array $result 采购单号(即入库单号)
	 * @author WuJunhua
	 * @date 2015-12-15
	 */
	public function getMaxPurchaseNumber(){	
		$select = "{$this->tableName}.cpae20";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.cpae20 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 根据产品编号获取产品最新的库位、条码、属性
	 * @param int $goodId 产品编号
	 * @return array $result 库位、条码信息
	 * @author WuJunhua
	 * @date 2016-03-21
	 */
	public function getNewestLocation($goodId){	
		$select = "{$this->tableName}.cpae06,{$this->tableName}.cpae18,{$this->tableName}.cpae22";
		$where['express'] = "{$this->tableName}.cpae02 = :goodId ";
		$where['value'][':goodId'] = $goodId;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.cpae01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 查库存的总正品库存量、总次品库存量、总金额
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-03-22
	 */
	public function getTotalProductStock(){	
		$select = "sum({$this->tableName}.cpae03) as zpkcl,sum({$this->tableName}.cpae13) as zje,sum({$this->tableName}.cpae04) as cpkcl";
		$where['express'] = "{$this->tableName}.cpae03 > 0";
		$where['value'] = [];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 改价格时查找进货价
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2016-03-24
	 */
	public function getBuyingPrice($kuanhao){	
		$select = "max({$this->tableName}.cpae07) as cpjhj";
		$where['express'] = "{$this->tableName}.cpae02 = :kuanhao";
		$where['value'][':kuanhao'] = $kuanhao;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

}

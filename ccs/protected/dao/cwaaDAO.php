<?php
/**
 * @desc 结算明细表操作类
 * @author WuJunhua
 * @date 2015-12-10
 */
class cwaaDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-12-10
	 * @param string $className
	 * @return cwaaDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cwaa';
		$this->primaryKey = 'cwaa01';
	}

	/**
	 * @desc 获取最新的结算编号
	 * @return array $result 结算编号
	 * @author WuJunhua
	 * @date 2016-03-07
	 */
	public function getMaxBillingNumber(){	
		$select = "{$this->tableName}.cwaa01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.cwaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}
	
}

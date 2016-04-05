<?php
/**
 * @desc 收款明细表操作类
 * @author WuJunhua
 * @date 2016-03-07
 */
class cwabDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2016-03-07
	 * @param string $className
	 * @return cwabDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2016-03-07
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cwab';
		$this->primaryKey = 'cwab01';
	}
	
}

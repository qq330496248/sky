<?php
/**
 * @desc 订单拒收原因内容表操作类
 * @author WuJunhua
 * @date 2015-11-20
 */
class xsafDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-20
	 * @param string $className
	 * @return xsafDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'xsaf';
		$this->primaryKey = 'xsaf03';
	}
	
}

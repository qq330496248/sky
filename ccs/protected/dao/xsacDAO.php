<?php
/**
 * @desc 订单分业绩表操作类
 * @author WuJunhua
 * @date 2015-12-07
 */
class xsacDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-12-07
	 * @param string $className
	 * @return xsacDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-12-07
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'xsac';
		$this->primaryKey = true;
	}	
	
}

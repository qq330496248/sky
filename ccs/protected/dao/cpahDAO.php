<?php
/**
 * @desc 产品部门标示表操作类
 * @author Dengshaocong
 * @date 2016-03-31
 */
class cpahDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2016-03-31
	 * @param string $className
	 * @return cpahDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2016-03-31 
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cpah';
		$this->primaryKey = true;
	}
}
?>
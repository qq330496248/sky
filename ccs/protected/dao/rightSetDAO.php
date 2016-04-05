<?php
/**
 * @desc 权限位表操作类
 * @author DengShaocong
 * @date 2015-11-11
 */
class rightSetDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-11
	 * @param string $className
	 * @return rightSetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'rightset';
		$this->primaryKey = 'rightid';
	}
}
?>
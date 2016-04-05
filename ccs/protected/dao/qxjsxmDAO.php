<?php
/**
 * @desc 权限角色页面权限表操作类
 * @author DengShaocong
 * @date 2015-10-28
 */
class qxjsxmDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-10-28
	 * @param string $className
	 * @return qxjsxmDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'qxjsxm';
		$this->primaryKey = 'id';
	}
}
?>
<?php
/**
 * @desc 客户跟进标签表操作类
 * @author DengShaocong
 * @date 2015-11-3 
 */
class khgjbqDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-3
	 * @param string $className
	 * @return khgjbqDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khgjbq';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 获取所有客户意向信息
	 * @return array $result 客户意向信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function getKhgjbq(){	
		$select = "{$this->tableName}.id,{$this->tableName}.khgjbq,{$this->tableName}.xh";
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("id".' ASC');
		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}
}
?>
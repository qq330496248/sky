<?php
/**
 * @desc 省份表操作类
 * @author huyan
 * @date 2015-11-02 
 */
class approvinceDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-11-02 
	 * @param string $className
	 * @return appProvinceDAO.
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-11-02
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'appprovince';
		$this->primaryKey = 'pid';
	}

	/**
	 * @desc 获取省份信息
	 * @return array $result 省份信息
	 * @author huyan
	 * @date 2015-11-02
	 */
	public function getAllpro(){	
		$select = "{$this->tableName}.pid,{$this->tableName}.pname";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName);
		$result = $this->dbCommand->queryAll();
		//print_r($result);die;							   
		return $result;
	}

}
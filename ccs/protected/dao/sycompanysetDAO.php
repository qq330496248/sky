<?php
/**
 * @desc 广告表操作类
 * @author Dengshaocong
 * @date 2015-12-11 
 */
class sycompanysetDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2015-12-11
	 * @param string $className
	 * @return sycompanysetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2015-12-11 
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'sycompanyset';
		$this->primaryKey = 'id';
	}

	/**
	 * @desc 获取公司信息
	 * @return array $result 公司信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function getGsxx(){
		$select = "{$this->tableName}.id,{$this->tableName}.number,{$this->tableName}.name,{$this->tableName}.address,{$this->tableName}.logo,
					{$this->tableName}.phone,{$this->tableName}.email,{$this->tableName}.type,{$this->tableName}.linkman,{$this->tableName}.summary";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.id ")
						->limit(1,0);
		$result = $this->dbCommand->queryAll();						   
		return $result[0];
	}
}
?>
<?php
/**
 * @desc 客户投诉表操作类
 * @author huyan
 * @date 2015-12-04 
 */
class khahDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-12-04
	 * @param string $className
	 * @return khahDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khah';
		$this->tableOrder = 'khac';
		$this->tableOrderDetail = 'khad';
		$this->primaryKey = true;
		//$this->createtime = 'khac10';
	}
	/**
	 * @desc 获取投诉类型列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 客户投诉列表信息
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function getComplaintTypeList($page,$psize){
		$select = "{$this->tableName}.khah01,{$this->tableName}.khah02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						//->leftJoin($this->tableOrderDetail, "{$this->tableName}.khad01 = {$this->tableOrderDetail}.khad01")
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   //->leftJoin($this->tableOrderDetail, "{$this->tableName}.khad01 = {$this->tableOrderDetail}.khad01")
										   ->queryScalar();			   
		return $result;

	}
}
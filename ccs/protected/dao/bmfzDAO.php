<?php
/**
 * @desc 权限组表操作类
 * @author DengShaocong
 * @date 2015-11-9
 */
class bmfzDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-9
	 * @param string $className
	 * @return bmfzDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'bmfz';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 获取权限组列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function getAllGroup(){	
		$select = "{$this->tableName}.id,{$this->tableName}.bmfz,{$this->tableName}.ghkt,{$this->tableName}.value1,{$this->tableName}.ifs";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("id".' ASC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
									   
		return $result;
	}
}
?>
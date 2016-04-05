<?php
/**
 * @desc 权限角色表操作类
 * @author DengShaocong
 * @date 2015-10-28
 */
class qxjsDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-10-28
	 * @param string $className
	 * @return qxjsDAO
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
		$this->tableName = 'qxjs';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 获取权限角色列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function getAllRole($page,$psize){	
		
		$select = "{$this->tableName}.id,{$this->tableName}.qxjs";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->limit($psize, $psize * ($page - 1))
						->order("id".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
									   
		return $result;
	}
	/**
	 * @desc 获取权限角色信息
	 * @return array $result 权限角色信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getRoleForGh(){	
		$select = "{$this->tableName}.id,{$this->tableName}.qxjs";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("id".' DESC');
		$result = $this->dbCommand->queryAll();
									   
		return $result;
	}
}
?>
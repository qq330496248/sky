<?php
/**
 * @desc 权限角色表操作类
 * @author DengShaocong
 * @date 2015-11-11
 */
class groupRightDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-11
	 * @param string $className
	 * @return qxjsDAO
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
		$this->tableName = 'groupright';
		$this->primaryKey = 'groupbh';
	}
	/**
	 * @desc 获取权限角色列表信息
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function getGroupRight(){	
		$select = "{$this->tableName}.groupbh,{$this->tableName}.groupname";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("groupbh".' ASC');
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
	 * @date 2015-11-11
	 */
	public function getRoleForGh(){	
		$select = "{$this->tableName}.id,{$this->tableName}.qxjs";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("id".' ASC');
		$result = $this->dbCommand->queryAll();
									   
		return $result;
	}
	/**
	 * @desc 获取权限角色中最末尾的编号
	 * @return array $result 权限角色信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function getFinalGrNum(){
		$select = "{$this->tableName}.groupbh";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("groupbh".' DESC');
		$result = $this->dbCommand->queryAll();
									   
		return $result;
	}
}
?>
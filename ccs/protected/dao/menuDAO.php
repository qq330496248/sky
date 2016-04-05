<?php
/**
 * @desc 菜单表操作类
 * @author DengShaocong
 * @date 2015-11-11
 */
class menuDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-11
	 * @param string $className
	 * @return menuDAO
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
		$this->tableName = 'menu';
		$this->primaryKey = 'menu_name';
	}

	/**
	 * @desc 获取所有菜单
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function getMenu(){	
		$select = "{$this->tableName}.menu_name,{$this->tableName}.illustrate,{$this->tableName}.menu_bh,{$this->tableName}.display_num,{$this->tableName}.web,{$this->tableName}.right_id";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("display_num",'ASC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();								   
		return $result;
	}
}
?>
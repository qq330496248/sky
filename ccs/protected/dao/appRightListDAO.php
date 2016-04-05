<?php
/**
 * @desc 组权限表操作类
 * @author DengShaocong
 * @date 2015-10-28
 */
class appRightListDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-11
	 * @param string $className
	 * @return appRightListDAO
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
		$this->tableName = 'AppRightList';
		$this->primaryKey = true;
	}
	/**
	 * @desc 根据工号获取一个员工的权限位
	  * @param string $groupbh 员工的权限角色编号
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function getRyRight($groupbh){
		$select = "menu.menu_name,menu.illustrate,menu.display_num,menu.menu_bh,menu.web";
		$where['express'] = "{$this->tableName}.groupbh = :groupbh";
		$where['value'] = array(":groupbh" => $groupbh);
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin("rightset","{$this->tableName}.rightbh=rightset.rightID")
						->leftjoin("menu","rightset.rightID=menu.RIGHT_ID")
						->where($where['express'],$where['value'])
						->order("display_num");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
									   
		return $result;
	}
}
?>
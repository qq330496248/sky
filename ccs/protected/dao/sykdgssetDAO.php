<?php
/**
 * @desc 权限组表操作类
 * @author DengShaocong
 * @date 2015-11-9
 */
class sykdgssetDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-9
	 * @param string $className
	 * @return sykdgssetDAO
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
		$this->tableName = 'sykdgsset';
		$this->primaryKey = 'kdgsid';
	}
	/**
	 * @desc 获取快递公司列表信息
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function getAllKdgs(){	
		$select = "{$this->tableName}.kdgsid,{$this->tableName}.kdgstext,{$this->tableName}.ifuse";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("kdgsid".' ASC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
									   
		return $result;
	}

}
?>
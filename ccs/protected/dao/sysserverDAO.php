<?php
/**
 * @desc 服务器表操作类
 * @author Dengshaocong
 * @date 2016-03-16
 */
class sysserverDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2015-12-11
	 * @param string $className
	 * @return advertsetDAO
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
		$this->tableName = 'sysserver';
		$this->primaryKey = 'refSigns';
	}


	/**
	 * @desc 获取服务器列表
	 * @param int $page 页数
	 * @param int $psize 每页数
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function getServerByCond($page,$psize){
		$select = "{$this->tableName}.refSigns,{$this->tableName}.serverIp,{$this->tableName}.dbName,{$this->tableName}.dbAccount,{$this->tableName}.dbPwd";
		$where['express'] = '';
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result['list'] = $this->dbCommand->queryAll();	
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();					   
		return $result;
	}
}
?>
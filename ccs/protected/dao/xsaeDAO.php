<?php
/**
 * @desc 订单拒收原因表操作类
 * @author WuJunhua
 * @date 2015-11-20
 */
class xsaeDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-20
	 * @param string $className
	 * @return xsaeDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'xsae';
		$this->primaryKey = 'xsae01';
	}

	/**
	 * @desc 获取所有拒收原因分类
	 * @return array $result 所有拒收原因分类
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function getAllRejectReasons(){	
		$select = "{$this->tableName}.xsae01,{$this->tableName}.xsae02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->primaryKey} "." ASC");
		$result = $this->dbCommand->queryAll();
		return $result;
	}
	

	/**
	 * @desc 获取所有退货原因（大小类）
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getAllReasonsHasReject(){
		$select = "{$this->tableName}.xsae02,f.xsaf02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('xsaf f',"{$this->tableName}.xsae01 = f.xsaf01");
		$result = $this->dbCommand->queryAll();
		return $result;
	}
}

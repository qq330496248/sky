<?php
/**
 * @desc 产品属性详情表操作类
 * @author DengShaocong
 * @date 2015-11-5
 */
class cpsxxqDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-5
	 * @param string $className
	 * @return cpsxxqDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-5
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cpsxxq';
		$this->primaryKey = true;
	}
	/**
	 * @desc 根据产品ID获取与产品有关的信息
	 * @param string $cpid 产品ID
	 * @return array $result 产品属性信息
	 * @author DengShaocong
	 * @date 2015-11-5
	 */
	public function GetCpsxxqFromCp($cpid){
		$select = "xq.cpid,xq.cpsxxq,xq.sxid,sx.cpag02,sx.cpag01";
		$where['express'] = "xq.sxid > 0 ";

		$where['value'] = array();
		if(!empty($cpid)){
			$where['express'].=" AND xq.cpid = :cpid";
			$where['value'][':cpid'] = $cpid;
		}		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName.' as xq ')
						->leftjoin('cpag as sx',"xq.sxid = sx.cpag01")
						->where($where['express'],$where['value']);

		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}
}
?>
<?php
/**
 * @desc 产品属性表操作类
 * @author DengShaocong
 * @date 2015-11-4
 */
class cpagDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-4
	 * @param string $className
	 * @return cpagDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cpag';
		$this->primaryKey = 'cpag01';
	}

	/**
	 * @desc 获取产品属性信息
	 * @param string $cpsx 属性名
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 产品属性信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function getCpsxByCond($cpsx,$page,$psize){	
		$select = "{$this->tableName}.cpag01,{$this->tableName}.cpag02,{$this->tableName}.cpag03";
		$where['express'] = "{$this->tableName}.cpag03 = 0 ";
		$where['value'] = array();
		if(!empty($cpsx)){
			$where['express'] .= " and {$this->tableName}.cpag02 like :cpsx";
			$where['value'][':cpsx'] = '%'.$cpsx.'%';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1));

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
	/**
	 * @desc 获取产品属性详情（子属性）
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $parent 上一级属性的ID
	 * @return array $result 产品属性信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function getCpsxxqByCond($parent){
		$select = "{$this->tableName}.cpag01,{$this->tableName}.cpag02,{$this->tableName}.cpag04,{$this->tableName}.cpag03";
		$where['express'] = "{$this->tableName}.cpag03 != 0 ";
		$where['value'] = array();
		$where['express'].=" AND {$this->tableName}.cpag03 = :parent";
		$where['value'][':parent'] = $parent;
	
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("cpag01".' ASC');

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
		return $result;
	}
}
?>
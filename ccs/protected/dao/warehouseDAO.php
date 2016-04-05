<?php
/**
 * @desc 仓库表操作类
 * @author Dengshaocong
 * @date 2016-01-12
 */
class warehouseDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2016-01-12
	 * @param string $className
	 * @return warehouseDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2016-01-12 
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'warehouse';
		$this->primaryKey = 'id';
	}

	/**
	 * @desc  获取最后一个主键
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function getMaxWarehouseNumber(){
		$select = "{$this->tableName}.id";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.id ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc  获取库位信息
	 * @param int $page 页数
	 * @param int $page 每页显示的个数
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function getWareHouse($page,$psize){
		$select = "{$this->tableName}.id,{$this->tableName}.name,{$this->tableName}.place,{$this->tableName}.ifuse";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.id ".' DESC')
						->limit($psize, $psize * ($page - 1));
		$result['list'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->order("{$this->tableName}.id ".' DESC')
										   ->queryScalar();	
		return $result;
	}

	/**
	 * @desc  获取10条仓位信息
	 * @param string $location 库位
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-01-21
	 */
	public function getTenWarehouseData($location){
		$select = "{$this->tableName}.id,{$this->tableName}.name,{$this->tableName}.place";
		$where['express'] = "{$this->tableName}.id != :kong";
		$where['value'][':kong'] = '';
		if(!empty($location)){
			$where['express'].=" AND {$this->tableName}.place like :location";
			$where['value'][':location'] = '%'.$location.'%';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.id ".' DESC')
						->limit(10,0);
		$result = $this->dbCommand->queryAll();
		return $result;
	}
}

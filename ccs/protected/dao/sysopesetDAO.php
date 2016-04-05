<?php
/**
 * @desc 操作记录表操作类
 * @author Dengshaocong
 * @date 2015-12-2 
 */
class sysopesetDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2015-12-2 
	 * @param string $className
	 * @return sysopesetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2015-12-2 
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'sysopeset';
		$this->primaryKey = 'id';
	}

	/**
	 * @desc 根据条件获取操作记录
	 * @param array $setCond 条件
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @author Dengshaocong
	 * @date  2015-12-02
	 */
	public function getCzjl($setCond,$page,$psize){
		$select = "{$this->tableName}.id,{$this->tableName}.type,{$this->tableName}.thingid,{$this->tableName}.difference,{$this->tableName}.ry,
					{$this->tableName}.opetime";
		$where['express'] = "{$this->tableName}.id > 0";
		$where['value'] = array();
		if(!empty($setCond)){
			if(!empty($setCond['type'])){
				$where['express'].=" AND {$this->tableName}.type = :type ";
				$where['value'][':type'] = $setCond['type'];
			}
			if(!empty($setCond['ry'])){
				$where['express'].=" AND {$this->tableName}.ry = :ry ";
				$where['value'][':ry'] = $setCond['ry'];
			}
			if(!empty($setCond['thingid'])){
				$where['express'].=" AND {$this->tableName}.thingid = :thingid ";
				$where['value'][':thingid'] = $setCond['thingid'];
			}
			if(!empty($setCond['difference'])){
				$where['express'].=" AND {$this->tableName}.difference like :difference ";
				$where['value'][':difference'] = '%'.$setCond['difference'].'%';
			}
			if(!empty($setCond['beginDate'])){
				$where['express'].=" AND {$this->tableName}.opetime >= :beginDate ";
				$where['value'][':beginDate'] = $setCond['beginDate'];
			}
			if(!empty($setCond['endDate'])){
				$where['express'].=" AND {$this->tableName}.opetime <= :endDate ";
				$where['value'][':endDate'] = $setCond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("opetime DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();							   
		return $result;
	}
}
?>
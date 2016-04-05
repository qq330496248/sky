<?php
/**
 * @desc 登录操作类
 * @author DengShaocong
 * @date 2015-10-27 
 */
class loginsetDAO extends baseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-10-27
	 * @param string $className
	 * @return loginsetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'loginset';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 获取登录日志
	  * @param array $setCond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function getSet($setCond){
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.loginip,{$this->tableName}.loginmac,{$this->tableName}.loginfj,
					{$this->tableName}.logintime";
		$where['express'] = "{$this->tableName}.id > 0";
		$where['value'] = array();
		if(!empty($setCond)){
			if(!empty($setCond['username'])){
				$where['express'].=" AND {$this->tableName}.username like :username ";
				$where['value'][':username'] = '%'.$setCond['username'].'%';
			}
			if(!empty($setCond['begindate'])){
				$where['express'].=" AND {$this->tableName}.logintime >= :begindate ";
				$where['value'][':begindate'] = $setCond['begindate'];
			}
			if(!empty($setCond['enddate'])){
				$where['express'].=" AND {$this->tableName}.logintime <= :enddate ";
				$where['value'][':enddate'] = $setCond['enddate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("logintime DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
									   
		return $result;
	}
}
?>
<?php
/**
 * @desc 区县表操作类
 * @author WuJunhua
 * @date 2015-10-26 
 */
class appAreaDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-10-26
	 * @param string $className
	 * @return appAreaDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-10-26
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'apparea';
		$this->primaryKey = 'aid';
	}

	/**
	 * @desc 获取城市下面的区县信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $ids 省份、城市、区县ID
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2015-12-31
	 */
	public function getAllArea($page,$psize,$ids){
		$select = "{$this->tableName}.aname,{$this->tableName}.aid,appCity.cname,appProvince.pname";
		$where['express'] = "{$this->tableName}.aid > 0";
		$where['value'] = array();
		if(!empty($ids)){
			if(!empty($ids['aid'])){
				$where['express'].=" and {$this->tableName}.aid = :aid";
				$where['value'][':aid'] = $ids['aid'];
			}
			if(!empty($ids['cid'])){
				$where['express'].=" and appCity.cid = :cid";
				$where['value'][':cid'] =  $ids['cid'];
			}
			if(!empty($ids['pid'])){
				$where['express'].=" and appProvince.pid = :pid";
				$where['value'][':pid'] =  $ids['pid'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('appCity',"{$this->tableName}.cid=appCity.cid")
						->leftjoin('appProvince',"appCity.pid=appProvince.pid")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("aid".' DESC');

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftjoin('appCity',"{$this->tableName}.cid=appCity.cid")
										   ->leftjoin('appProvince',"appCity.pid=appProvince.pid")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}


	/**
	 * @desc 获取最大区县ID
	 * @param string $cid 市ID
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function getMaxAreaNumber($cid){
		$select = "{$this->tableName}.aid";
		$where['express'] = "{$this->tableName}.cid = :cid";
		$where['value'] = array('cid'=>$cid);
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.aid ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取单个区县
	 * @param string $id ID
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function getSingleArea($id){
		$select = "{$this->tableName}.aid,{$this->tableName}.aname,appCity.cid,appprovince.pid";
		$where['express'] = "{$this->tableName}.aid = :aid";
		$where['value'] = array('aid'=>$id);
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('appCity',"{$this->tableName}.cid=appCity.cid")
						->leftjoin('appProvince',"appCity.pid=appProvince.pid")
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.aid ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}
}
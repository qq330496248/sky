<?php
/**
 * @desc 城市表操作类
 * @author WuJunhua
 * @date 2015-10-26 
 */
class appCityDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-10-26
	 * @param string $className
	 * @return appCityDAO
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
		$this->tableName = 'appcity';
		$this->primaryKey = 'cid';
	}

	/**
	 * @desc 获取区号信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $condInfo 查询条件
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2015-01-14
	 */
	public function getAllCode($page,$psize,$condInfo){
		$select = "{$this->tableName}.cid,{$this->tableName}.cname,{$this->tableName}.areaCode";
		$where['express'] = "{$this->tableName}.cid > 0";
		$where['value'] = array();
		if(!empty($condInfo)){
			if(!empty($condInfo['pid'])){
				$where['express'].=" and {$this->tableName}.pid = :pid";
				$where['value'][':pid'] = $condInfo['pid'];
			}
			if(!empty($condInfo['name'])){
				$where['express'].=" and appCity.cname like :name";
				$where['value'][':name'] =  '%'.$condInfo['name'].'%';
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("cid".' DESC');

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}

	/**
	 * @desc 获取最大城市ID
	 * @param string $pid 省ID
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function getMaxNumber($pid){
		$select = "{$this->tableName}.cid";
		$where['express'] = "{$this->tableName}.pid = :pid";
		$where['value'] = array('pid'=>$pid);
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.cid ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

}
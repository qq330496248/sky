<?php
/**
 * @desc 采购单明细表操作类
 * @author DengShaocong
 * @date 2015-12-14
 */
class cgacDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-12-14
	 * @param string $className
	 * @return cgacDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cgac';
		$this->primaryKey = 'cgac01';
	}

	/**
	 * @desc 根据条件获取采购单
	 * @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @param array $condInfo 查询条件
	 * @return array $result 采购单结果信息
	 * @author huayan
	 * @date 2015-11-14
	 */
	public function getCgdByCond($page,$psize,$condInfo){
		$select = "{$this->tableName}.cgac01,{$this->tableName}.cgac02,{$this->tableName}.cgac03,{$this->tableName}.cgac08,{$this->tableName}.cgac04,{$this->tableName}.cgac05,
					{$this->tableName}.cgac06,{$this->tableName}.cgac07,,{$this->tableName}.cgac09,{$this->tableName}.cgac10,
					{$this->tableName}.cgac11,cgaa.cgaa01,cgaa.cgaa02,cgaa.cgaa03,cgaa.cgaa05,cgaa.cgaa06,cgaa.cgaa07,cgaa.cgaa08,cgaa.cgaa09,
					cgaa.cgaa10,cgaa.cgaa12,cgaa.cgaa13,cgaa.cgaa22";
		$where['express'] = "{$this->tableName}.cgac01 > 0";
		$where['value'] = array();
		if(!empty($condInfo)){
			if(!empty($condInfo['cpmc'])){
				$where['express'] .= " AND {$this->tableName}.cgac04 like :cpmc";
				$where['value'][':cpmc'] = "%".$condInfo['cpmc']."%";
			}
			if(!empty($condInfo['cgkh'])){
				$where['express'] .= " AND {$this->tableName}.cgac03 = :cgkh";
				$where['value'][':cgkh'] = $condInfo['cgkh'];
			}
			if(!empty($condInfo['cgdh'])){
				$where['express'] .= " AND {$this->tableName}.cgac02 like :cgdh";
				$where['value'][':cgdh'] = "%".$condInfo['cgdh']."%";
			}
			if(!empty($condInfo['gys'])){
				$where['express'] .= " AND cgaa.cgaa09 like :gys";
				$where['value'][':gys'] = $condInfo['gys'];
			}
			if(!empty($condInfo['begindate'])){
				$where['express'] .= " AND cgaa.cgaa06 >= :begindate";
				$where['value'][':begindate'] = $condInfo['begindate'];
			}
			if(!empty($condInfo['enddate'])){
				$where['express'] .= " AND cgaa.cgaa06 <= :enddate";
				$where['value'][':enddate'] = $condInfo['enddate'];
			}
			if(!empty($condInfo['finish'])){
				$where['express'] .= " AND cgaa.cgaa13 = :finish";
				$where['value'][':finish'] = $condInfo['finish'];
			}
			if(!empty($condInfo['check'])){
				$where['express'] .= " AND cgaa.cgaa02 = :check";
				$where['value'][':check'] = $condInfo['check'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cgaa',"{$this->tableName}.cgac02 = cgaa.cgaa01")
						->where($where['express'],$where['value'])
						->order("cgaa.cgaa01 DESC,cgac.cgac01 ASC")
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();	
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftjoin('cgaa',"{$this->tableName}.cgac02 = cgaa.cgaa01")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();						   
		return $result;
	}


	/**
	 * @desc 获取最大项目数
	 * @param string $id 采购单号
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getMaxCount($id){
		$select = "{$this->tableName}.cgac11";
		$where['express'] = "{$this->tableName}.cgac02 = '".$id."' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.cgac01 DESC");
		$result = $this->dbCommand->queryAll(); 
		if(empty($result)){
			return null;
		}
		return $result[0];
	}

	/**
	 * @desc 获取采购单下，所有采购项目的总价和数量
	 * @param string $id 采购单号
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getAllPriceAndNum($id){
		$select = "{$this->tableName}.cgac06,{$this->tableName}.cgac07";
		$where['express'] = "{$this->tableName}.cgac02 = '".$id."' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.cgac01 DESC");
		$result = $this->dbCommand->queryAll(); 
		return $result;
	}

	/**
	 * @desc 获取退货退货供应商记录商品详情
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function ReturnSupplierOrder($page,$psize,$orderNo){
		$where['express'] = "{$this->tableName}.cgac02 = :orderNo";
		$where['value']['orderNo'] = $orderNo;
		$select = "{$this->tableName}.cgac02,{$this->tableName}.cgac03,{$this->tableName}.cgac13,{$this->tableName}.cgac14,{$this->tableName}.cgac05,{$this->tableName}.cgac06,{$this->tableName}.cgac07,{$this->tableName}.cgac09,{$this->tableName}.cgac15";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.cgac01 ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}


	/**
	 * @desc 获取采购单下，产品采购数量以及入库数量
	 * @param string $id 采购单号
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function selectGetAndStock($id){
		$select = "sum({$this->tableName}.cgac06) has,sum({$this->tableName}.cgac12) stock";
		$where['express'] = "{$this->tableName}.cgac02 = '".$id."' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll(); 
		return $result[0];
	}
	
}
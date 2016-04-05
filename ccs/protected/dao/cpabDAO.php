<?php
/**
 * @desc 产品分类表操作类
 * @author DengShaocong
 * @date 2015-11-2 
 */
class cpabDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-2
	 * @param string $className
	 * @return cpabDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cpab';
		$this->primaryKey = 'cpab01';
	}
	/**
	 * @desc 获取产品一级分类列表信息
	 * @return array $result 产品分类信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function getCpfl($cpfl,$page,$psize){	
		$select = "{$this->tableName}.cpab01,{$this->tableName}.cpab02,{$this->tableName}.cpab03,{$this->tableName}.cpab04";
		$where['express'] = "{$this->tableName}.cpab06 = 0 ";
		$where['value'] = array();
		if(!empty($cpfl)){
			$where['express'] .= " and {$this->tableName}.cpab02 like :cpfl ";
			$where['value'][':cpfl'] = '%'.$cpfl.'%';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("cpab01".' DESC')
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
	/**
	 * @desc 根据条件获取产品分类列表信息
	 * @param string $flmc 产品名称
	 * @return array $result 产品分类信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function getCpflByCond($flmc){	
		$select = "{$this->tableName}.cpab01,{$this->tableName}.cpab02,{$this->tableName}.cpab03,{$this->tableName}.cpab04,{$this->tableName}.cpab05,{$this->tableName}.cpab06";
		$where['express'] = "{$this->tableName}.cpab01 > 0";
		$where['value'] = array();
		if(!empty($flmc)){
			$where['express'].=" AND {$this->tableName}.cpab02 like :cpab02";
			$where['value'][':cpab03'] = '%'.$flmc.'%';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("cpab01".' ASC');

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
	/**
	 * @desc 根据条件获取产品分类列表信息
	 * @param int $parent 产品上一级分类
	 * @return array $result 产品分类信息
	 * @author DengShaocong
	 * @date 2015-11-30
	 */
	public function getCpzfl($parent){
		$select = "{$this->tableName}.cpab01,{$this->tableName}.cpab02,{$this->tableName}.cpab03,{$this->tableName}.cpab04";
		$where['express'] = "{$this->tableName}.cpab06 = ".$parent;
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("cpab01".' DESC');

		$result['info'] = $this->dbCommand->queryAll();

		return $result;
	}

	
	/**
	 * @desc 获取退货产品统计——先获取所有商品类型（大类，小类）
	 * @param string $type 大类，小类
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getCpflForTj($type){
		$select = "{$this->tableName}.cpab02,{$this->tableName}.cpab06";
		if($type == 'higher'){
			$where['express'] = "{$this->tableName}.cpab06 = 0 ";
		}
		if($type == 'lower'){
			$where['express'] = "{$this->tableName}.cpab06 != 0 ";
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],array())
						->order("cpab01".' DESC');

		$result = $this->dbCommand->queryAll();
		return $result;
	}

	

	/**
	 * @desc 获取退货产品信息
	 * @param array @cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getThcptjDetails($cond){
		$select = "{$this->tableName}.cpab02,a.xsaa49,sum(b.xsab04) num,sum(b.xsab07) money,d.xsad06 ";
		$where['express'] = "a.xsaa49 = '退' and d.`xsad06` LIKE '%拒收%' and {$this->tableName}.cpab02 = '". $cond['cpfl'] ."' ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'] .= " and a.xsaa61 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'];
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= " and a.xsaa61 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpaa cpa',"{$this->tableName}.cpab01 = cpa.cpaa03")
						->leftjoin('xsab b','cpa.cpaa01 = b.`xsab03`')
						->leftjoin('xsaa a','a.xsaa02 = b.xsab01')
						->leftjoin('xsad d','a.`xsaa02` = d.xsad01')
		 				->where($where['express'],$where['value'])
		 				->group('b.xsab01');
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num']) || empty($result[0]['money'])){
			return array(
				'num'=>0,
				'money'=>0,
				'xsaa49'=>''
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取产品类别统计报表（下单，确认，发货，拒收，签收）
	 * @param array @cond 查询条件
	 * @param string @type 类型（下单，确认，发货，拒收，签收）
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getCplbtjbbByCond($cond,$type){
		$select = "sum(b.xsab04) orders,sum(b.xsab07) money";
		$where['express'] = "{$this->tableName}.cpab02 = '". $cond['cpfl'] ."' and a.xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond)){
			if($cond['type'] == 'ope'){
				if($type == "'已发货','拒收','交易成功'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and a.xsaa27 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and a.xsaa27 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else if($type == "'拒收'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and a.xsaa51 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and a.xsaa51 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else if($type == "'交易成功'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and a.xsaa28 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and a.xsaa28 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else{
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and a.xsaa61 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'];
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and a.xsaa61 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'];
					}
				}	
			}else{
				if(!empty($cond['beginDate'])){
					$where['express'] .= " and a.xsaa61 >= :beginDate ";
					$where['value'][':beginDate'] = $cond['beginDate'];
				}
				if(!empty($cond['endDate'])){
					$where['express'] .= " and a.xsaa61 <= :endDate ";
					$where['value'][':endDate'] = $cond['endDate'];
				}
			}
			if(!empty($cond['media'])){
				$where['express'] .= "and kh.khaa22 = :media ";
				$where['value'][':media'] = $cond['media'];
			}
		}
		$fk = 'cpaa03';
		if($cond['hol'] == 'lower'){
			$fk = 'cpaa04';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpaa cp',"{$this->tableName}.cpab01 = cp.$fk")
						->leftjoin('xsab b','cp.cpaa01 = b.`xsab03`')
						->leftjoin('xsaa a','a.xsaa02 = b.xsab01')
						->leftjoin('khaa kh','a.`xsaa04` = kh.khaa02')
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders']) && empty($result[0]['money'])){
			return array(
				'orders'=>0,
				'money'=>0
				);
		}
		return $result[0];

	}

	/**
	 * @desc 获取产品类别统计报表
	 * @param array @cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getCplbtjbbChart($cond,$type){
		$select = "sum(b.xsab04) orders,sum(b.xsab07) money";
		$where['express'] = "{$this->tableName}.cpab02 = '". $cond['cplb'] ."' and a.xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= "and a.xsaa23 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= "and a.xsaa23 <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
			}
		}
		$fk = 'cpaa03';
		if($cond['hol'] == 'lower'){
			$fk = 'cpaa04';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpaa cp',"{$this->tableName}.cpab01 = cp.$fk")
						->leftjoin('xsab b','cp.cpaa01 = b.`xsab03`')
						->leftjoin('xsaa a','a.xsaa02 = b.xsab01')
						->leftjoin('khaa kh','a.`xsaa04` = kh.khaa02')
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders']) && empty($result[0]['money'])){
			return array(
				'orders'=>0,
				'money'=>0
				);
		}
		return $result[0];
	}
}
?>
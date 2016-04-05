<?php
/**
 * @desc 订单表操作类
 * @author WuJunhua
 * @date 2015-10-28
 */
class xsaaDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-10-28
	 * @param string $className
	 * @return xsaaDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-10-28
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'xsaa';
		$this->tableAchievement = 'xsac';
		$this->tableOrderDetail = 'xsab';
		$this->primaryKey = 'xsaa01';
		$this->createtime = 'xsaa23';
	}

	/**
	 * @desc 获取客户订单列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $sequence 顺序或倒序 (ASC/DESC)
	 * @param string $order 根据order排序
	 * @param array $CondList 查询条件
	 * @param array $addrInfo 地址信息
	 * @param string $selectColumnStr 导出excel的字段
	 * @param int $sign 导出excel标识
	 * @return array $result 客户订单列表信息
	 * @author WuJunhua
	 * @date 2015-10-28
	 * @modify huyan 2015-12-21 修改查询条件
	 */
	public function getClientOrders($page,$psize,$sequence,$order,$CondList,$addrInfo,$selectColumnStr=false){	
		$select = "{$this->tableName}.xsaa01,{$this->tableName}.xsaa02,{$this->tableName}.xsaa03,{$this->tableName}.xsaa04,{$this->tableName}.xsaa05,{$this->tableName}.xsaa06,{$this->tableName}.xsaa11,{$this->tableName}.xsaa12,{$this->tableName}.xsaa13,
				   {$this->tableName}.xsaa19,{$this->tableName}.xsaa20,{$this->tableName}.xsaa23,{$this->tableName}.xsaa22,
				   {$this->tableName}.xsaa29,{$this->tableName}.xsaa35, {$this->tableName}.xsaa25, {$this->tableName}.xsaa27, {$this->tableName}.xsaa28,{$this->tableName}.xsaa08,
				   {$this->tableName}.xsaa39,{$this->tableName}.xsaa40,{$this->tableName}.xsaa36,{$this->tableName}.xsaa03,{$this->tableName}.xsaa41,{$this->tableName}.xsaa33,{$this->tableName}.xsaa48,{$this->tableName}.xsaa34";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}		   
		$where['express'] = "{$this->tableName}.xsaa01 > 0";
	    $where['value'] = array();

	    if (!empty($addrInfo)) {
			 if(!empty($addrInfo['khsf'])){
				$where['express'].=" AND {$this->tableName}.xsaa09 like :khsf";
				$where['value'][':khsf'] = '%'.$addrInfo['khsf'].'%';
			}
			  if(!empty($addrInfo['khsf'])&&!empty($addrInfo['city'])){
			 	$sfsq=$addrInfo['khsf'].','.$addrInfo['city'];
				$where['express'] .= " AND {$this->tableName}.xsaa09 like :sfsq";
			    $where['value'][':sfsq'] = "%{$sfsq}%";
			}
		}
        if(!empty($CondList)){
        	if(!empty($CondList['ddkh'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab03 like :ddkh";
				$where['value'][':ddkh'] = '%'.$CondList['ddkh'].'%';
			}
			if(!empty($CondList['cpmc'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab02 like :cpmc";
				$where['value'][':cpmc'] = '%'.$CondList['cpmc'].'%';
			}
			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :ddid";
				$where['value'][':ddid'] = '%'.$CondList['ddid'].'%';
			}
			if(!empty($CondList['shzt'])){
				$where['express'].=" AND {$this->tableName}.xsaa30 like :shzt";
				$where['value'][':shzt'] = '%'.$CondList['shzt'].'%';
			}
			if(!empty($CondList['jobnum'])){
				$where['express'].=" AND {$this->tableName}.xsaa48 like :jobnum";
				$where['value'][':jobnum'] = '%'.$CondList['jobnum'].'%';
			}
			if(!empty($CondList['shgh'])){
				$where['express'].=" AND {$this->tableName}.xsaa34 like :shgh";
				$where['value'][':shgh'] = '%'.$CondList['shgh'].'%';
			}
			if(!empty($CondList['khxm'])){
				$where['express'].=" AND {$this->tableName}.xsaa05 like :khxm";
				$where['value'][':khxm'] = '%'.$CondList['khxm'].'%';
			}
			if(!empty($CondList['khid'])){
				$where['express'].=" AND {$this->tableName}.xsaa04 like :khid";
				$where['value'][':khid'] = '%'.$CondList['khid'].'%';
			}
			if(!empty($CondList['[phone]'])){
				$where['express'].=" AND {$this->tableName}.xsaa06 like :phone";
				$where['value'][':phone'] = '%'.$CondList['phone'].'%';
			}

			if(!empty($CondList['ddzt'])){
				$where['express'].=" AND {$this->tableName}.xsaa29 like :ddzt";
				$where['value'][':ddzt'] = '%'.$CondList['ddzt'].'%';
			}
			if(!empty($CondList['jxfs'])){
				$where['express'].=" AND {$this->tableName}.xsaa12 like :jxfs";
				$where['value'][':jxfs'] = '%'.$CondList['jxfs'].'%';
			}
			if(!empty($CondList['khfz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 like :khfz";
				$where['value'][':khfz'] = '%'.$CondList['khfz'].'%';
			}
			if(!empty($CondList['zffs'])){
				$where['express'].=" AND {$this->tableName}.xsaa13 like :zffs";
				$where['value'][':zffs'] = '%'.$CondList['zffs'].'%';
			}

			if(!empty($CondList['ddlx'])){
				$where['express'].=" AND {$this->tableName}.xsaa11 like :ddlx";
				$where['value'][':ddlx'] = '%'.$CondList['ddlx'].'%';
			}

			if(!empty($CondList['khyx'])){
				$where['express'].=" AND {$this->tableName}.xsaa08 like :khyx";
				$where['value'][':khyx'] = '%'.$CondList['khyx'].'%';
			}
			if(!empty($CondList['sfjz'])){
				$where['express'].=" AND {$this->tableName}.xsaa35 like :sfjz";
				$where['value'][':sfjz'] = '%'.$CondList['sfjz'].'%';
			}
			if(!empty($CondList['kdgs'])){
				$where['express'].=" AND {$this->tableName}.xsaa41 like :kdgs";
				$where['value'][':kdgs'] = '%'.$CondList['kdgs'].'%';
			}
			//根据订单金额
		    if(!empty($CondList['jefwd'])&&!empty($CondList['jefwx'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa17 >=:jefwd AND {$this->tableName}.xsaa17 <= :jefwx";
		    	$where['value'][':jefwd'] = $CondList['jefwd'];
		    	$where['value'][':jefwx'] = $CondList['jefwx'];
		    }
		    if(!empty($CondList['jefwd'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa17 >=:jefwd";
		    	$where['value'][':jefwd'] = $CondList['jefwd'];
		    }
		    if(!empty($CondList['jefwx'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa17 <=:jefwx";
		    	$where['value'][':jefwx'] = $CondList['jefwx'];
		    }
			
			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if(!empty($CondList['sdsjq'])&&!empty($CondList['sdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa25 >=:sdsjq AND {$this->tableName}.xsaa25 <= :sdsjz";
		    	$where['value'][':sdsjq'] = $CondList['sdsjq'];
		    	$where['value'][':sdsjz'] = $CondList['sdsjz'];
		    }
		    if (!empty($CondList['sdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa25 >=:sdsjq";
		    	$where['value'][':sdsjq'] = $CondList['sdsjq'];
		    }
		    if (!empty($CondList['sdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa25 <=:sdsjz";
		    	$where['value'][':sdsjz'] = $CondList['sdsjz'];
		    }
		    if(!empty($CondList['fhsjq'])&&!empty($CondList['fhsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq AND {$this->tableName}.xsaa27 <= :fhsjz";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }
		    if (!empty($CondList['fhsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    }
		    if (!empty($CondList['fhsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 <=:fhsjz";
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }

		    if(!empty($CondList['qssjq'])&&!empty($CondList['qssjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 >=:qssjq AND {$this->tableName}.xsaa28 <= :qssjz";
		    	$where['value'][':qssjq'] = $CondList['qssjq'];
		    	$where['value'][':qssjz'] = $CondList['qssjz'];
		    }
		    if (!empty($CondList['qssjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 >=:qssjq";
		    	$where['value'][':qssjq'] = $CondList['qssjq'];
		    }
		    if (!empty($CondList['qssjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 <=:qssjz";
		    	$where['value'][':qssjz'] = $CondList['qssjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->group("{$this->tableName}.xsaa02")
						->order($order."  ".$sequence);
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->where($where['express'],$where['value'])
										   ->group("{$this->tableName}.xsaa02")
										   ->queryAll();
		$result['count'] = count($count);								   	
		return $result;
	}

	/**
	 * @desc 获取最新的订单编号
	 * @return array $result 订单编号信息
	 * @author WuJunhua
	 * @date 2015-11-02
	 */
	public function getMaxOrderNumber(){	
		$select = "{$this->tableName}.xsaa02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.xsaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取订单详情信息
	 * @param int $ordernum 订单序号
	 * @param string $symbol 符号( >、=、< )
	 * @return array $result 订单详情信息
	 * @author WuJunhua
	 * @date 2015-11-03
	 */
	public function findOrderDetail($ordernum,$symbol,$order){	
		$select = "*";
		$where['express'] = "{$this->tableName}.xsaa01 $symbol :ordernum";
		$where['value']['ordernum'] = $ordernum;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.xsaa01 ".$order)
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}
	
	/**
	 * @desc 获取序号最大的订单
	 * @return array $result 序号最大的订单
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	public function findMaxOrder(){	
		$select = "{$this->tableName}.xsaa01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.xsaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取序号最小的订单
	 * @return array $result 序号最小的订单
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	public function findMinOrder(){	
		$select = "{$this->tableName}.xsaa01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.xsaa01 ".' ASC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 根据不同的订单状态获取订单列表
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $orderStatus 订单状态
	 * @param string $sequence 顺序或倒序 (ASC/DESC)
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	public function getOrderList($page,$psize,$sequence,$order,$orderStatus){		
		$select = "{$this->tableName}.xsaa01,{$this->tableName}.xsaa02,{$this->tableName}.xsaa04,{$this->tableName}.xsaa05,{$this->tableName}.xsaa13,{$this->tableName}.xsaa19,{$this->tableName}.xsaa20,{$this->tableName}.xsaa23,{$this->tableName}.xsaa22,{$this->tableName}.xsaa29,{$this->tableName}.xsaa08,{$this->tableName}.xsaa39,{$this->tableName}.xsaa40,{$this->tableName}.xsaa36,{$this->tableName}.xsaa33,{$this->tableName}.xsaa48,{$this->tableName}.xsaa50";
		$where['express'] = "{$this->tableName}.xsaa29 = :orderstatus";
		$where['value']['orderstatus'] = $orderStatus;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("$order "." $sequence");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();								   
		return $result;
	}

	/**
	 * @desc 订单审核列表显示[只显示订单状态为已确认、已支付订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $orderStatus 订单状态
	 * @return array $result 客户订单列表信息
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function getCheckingOrder($page,$psize,$orderStatusArr,$CondList,$addrInfo,$selectColumnStr=false){
		$select = "{$this->tableName}.xsaa01,{$this->tableName}.xsaa02,{$this->tableName}.xsaa04,{$this->tableName}.xsaa05,{$this->tableName}.xsaa13,{$this->tableName}.xsaa19,{$this->tableName}.xsaa20,{$this->tableName}.xsaa23,{$this->tableName}.xsaa29,{$this->tableName}.xsaa41,
				   {$this->tableName}.xsaa48,{$this->tableName}.xsaa33,{$this->tableName}.xsaa08,{$this->tableName}.xsaa39,{$this->tableName}.xsaa40,{$this->tableName}.xsaa36";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.xsaa29 IN(:confirmed,:paid) AND {$this->tableName}.xsaa30 = :checked";
		$where['value']['confirmed'] = $orderStatusArr['confirmed'];
		$where['value']['paid'] = $orderStatusArr['paid'];
		$where['value']['checked'] = $orderStatusArr['checked'];

		if (!empty($addrInfo)) {
			 if(!empty($addrInfo['khsf'])){
				$where['express'].=" AND {$this->tableName}.xsaa09 like :khsf";
				$where['value'][':khsf'] = '%'.$addrInfo['khsf'].'%';
			}
			  if(!empty($addrInfo['khsf'])&&!empty($addrInfo['city'])){
			 	$sfsq=$addrInfo['khsf'].','.$addrInfo['city'];
				$where['express'] .= " AND {$this->tableName}.xsaa09 like :sfsq";
			    $where['value'][':sfsq'] = "%{$sfsq}%";
			}
		}
		if(!empty($CondList)){
			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :ddid";
				$where['value'][':ddid'] = '%'.$CondList['ddid'].'%';
			}
			if(!empty($CondList['khid'])){
				$where['express'].=" AND {$this->tableName}.xsaa04 like :khid ";
				$where['value'][':khid'] = '%'.$CondList['khid'].'%';
			}

			if(!empty($CondList['kddh'])){
				$where['express'].=" AND {$this->tableName}.xsaa03 like :kddh ";
				$where['value'][':kddh'] = '%'.$CondList['kddh'].'%';
			}
			if(!empty($CondList['ddshzt'])){
				$where['express'].=" AND {$this->tableName}.xsaa47 like :ddshzt ";
				$where['value'][':ddshzt'] = '%'.$CondList['ddshzt'].'%';
			}
			if(!empty($CondList['khfz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 like :khfz ";
				$where['value'][':khfz'] = '%'.$CondList['khfz'].'%';
			}
			if(!empty($CondList['khyx'])){
				$where['express'].=" AND {$this->tableName}.xsaa08 like :khyx ";
				$where['value'][':khyx'] = '%'.$CondList['khyx'].'%';
			}
			if(!empty($CondList['ddlx'])){
				$where['express'].=" AND {$this->tableName}.xsaa11 like :ddlx ";
				$where['value'][':ddlx'] = '%'.$CondList['ddlx'].'%';
			}
			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    } 
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} "." ASC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();								   
		return $result;
	}

	/**
	 * @desc 获取订单审核详情信息
	 * @param int $ordernum 订单序号
	 * @param string $symbol 符号( >、=、< )
	 * @return array $result 订单详情信息
	 * @author WuJunhua
	 * @date 2015-11-09
	 */
	public function findCheckingOrderDetail($ordernum,$symbol,$orderStatusArr){	
		$select = "*";
		$where['express'] = "{$this->tableName}.xsaa01 $symbol :ordernum AND {$this->tableName}.xsaa29 IN(:confirmed,:paid)";
		$where['value']['ordernum'] = $ordernum;
		$where['value']['confirmed'] = $orderStatusArr['confirmed'];
		$where['value']['paid'] = $orderStatusArr['paid'];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}
	
	/**
	 * @desc 获取订单审核序号最大的订单
	 * @return array $result 序号最大的订单
	 * @author WuJunhua
	 * @date 2015-11-09
	 */
	public function findMaxCheckingOrder($orderStatusArr){	
		$select = "{$this->tableName}.xsaa01";
		$where['express'] = "{$this->tableName}.xsaa29 = :confirmed OR {$this->tableName}.xsaa29 = :paid";
		$where['value']['confirmed'] = $orderStatusArr['confirmed'];
		$where['value']['paid'] = $orderStatusArr['paid'];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.xsaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取订单审核序号最小的订单
	 * @return array $result 序号最小的订单
	 * @author WuJunhua
	 * @date 2015-11-09
	 */
	public function findMinCheckingOrder($orderStatusArr){	
		$select = "{$this->tableName}.xsaa01";
		$where['express'] = "{$this->tableName}.xsaa29 = :confirmed OR {$this->tableName}.xsaa29 = :paid";
		$where['value']['confirmed'] = $orderStatusArr['confirmed'];
		$where['value']['paid'] = $orderStatusArr['paid'];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.xsaa01 ".' ASC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取订单(审核)详情的商品信息
	 * @param int $orderNo 订单编号
	 * @return array $result 订单明细信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function getOrderDetailGoodsMsg($orderNo){	
		$select = "{$this->tableOrderDetail}.xsab03,{$this->tableOrderDetail}.xsab02,{$this->tableOrderDetail}.xsab05,{$this->tableOrderDetail}.xsab06,{$this->tableOrderDetail}.xsab10,{$this->tableOrderDetail}.xsab11,{$this->tableOrderDetail}.xsab04,{$this->tableOrderDetail}.xsab08,{$this->tableName}.xsaa42,{$this->tableName}.xsaa19,{$this->tableName}.xsaa17,sum(cpae.cpae03) as cpae03,{$this->tableName}.xsaa16,{$this->tableName}.xsaa20,{$this->tableName}.xsaa21,cpae.cpae06,{$this->tableName}.xsaa49,{$this->tableOrderDetail}.xsab20";
		$where['express'] = "{$this->tableName}.xsaa02 = :orderNo";
		$where['value']['orderNo'] = $orderNo;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->leftJoin("cpae", "{$this->tableOrderDetail}.xsab03 = cpae.cpae02")
						->where($where['express'],$where['value'])
						->group("{$this->tableOrderDetail}.xsab03");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取物流发货列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 物流发货列表信息
	 * @author WuJunhua
	 * @date 2015-11-17
	 */
	public function getLogisticsDeliveryList($page,$psize,$sequence,$order,$orderStatus,$CondList,$selectColumnStr=false){
		$select = "{$this->tableName}.xsaa01,{$this->tableName}.xsaa02,{$this->tableName}.xsaa05,{$this->tableName}.xsaa23,{$this->tableName}.xsaa25,{$this->tableName}.xsaa29,{$this->tableName}.xsaa41,{$this->tableName}.xsaa03,{$this->tableName}.xsaa13,{$this->tableName}.xsaa19,{$this->tableName}.xsaa36";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.xsaa29 = :orderStatus";
		$where['value']['orderStatus'] = $orderStatus;

        if(!empty($CondList)){
			if(!empty($CondList['wlddh'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :wlddh";
				$where['value'][':wlddh'] = '%'.$CondList['wlddh'].'%';
			}
			if(!empty($CondList['kddh'])){
				$where['express'].=" AND {$this->tableName}.xsaa03 like :kddh";
				$where['value'][':kddh'] = '%'.$CondList['kddh'].'%';
			}
			if(!empty($CondList['khid'])){
				$where['express'].=" AND {$this->tableName}.xsaa04 like :khid";
				$where['value'][':khid'] = '%'.$CondList['khid'].'%';
			}
			if(!empty($CondList['khname'])){
				$where['express'].=" AND {$this->tableName}.xsaa05 like :khname";
				$where['value'][':khname'] = '%'.$CondList['khname'].'%';
			}

			if(!empty($CondList['kdgs'])){
				$where['express'].=" AND {$this->tableName}.xsaa41 like :kdgs";
				$where['value'][':kdgs'] = '%'.$CondList['kdgs'].'%';
			}
			if(!empty($CondList['zffs'])){
				$where['express'].=" AND {$this->tableName}.xsaa13 like :zffs";
				$where['value'][':zffs'] = '%'.$CondList['zffs'].'%';
			}
			if(!empty($CondList['szz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 like :szz";
				$where['value'][':szz'] = '%'.$CondList['szz'].'%';
			}
			if(!empty($CondList['khyx'])){
				$where['express'].=" AND {$this->tableName}.xsaa08 like :khyx";
				$where['value'][':khyx'] = '%'.$CondList['khyx'].'%';
			}

			if(!empty($CondList['ddlx'])){
				$where['express'].=" AND {$this->tableName}.xsaa11 like :ddlx";
				$where['value'][':ddlx'] = '%'.$CondList['ddlx'].'%';
			}

			if(!empty($CondList['ddfhzt'])){
				$where['express'].=" AND {$this->tableName}.xsaa29 like :ddfhzt";
				$where['value'][':ddfhzt'] = '%'.$CondList['ddfhzt'].'%';
			}
			
			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("$order "." $sequence");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();		
		return $result;
	}

	/**
	 * @desc 获取订单发货详情信息
	 * @param int $ordernum 订单序号
	 * @param string $symbol 符号( >、=、< )
	 * @return array $result 订单详情信息
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function findDeliverOrderDetail($ordernum,$symbol,$orderStatusArr,$order){	
		$select = "*";
		$where['express'] = "{$this->tableName}.xsaa01 $symbol :ordernum AND {$this->tableName}.xsaa29 = :shipping";
		$where['value']['ordernum'] = $ordernum;
		$where['value']['shipping'] = $orderStatusArr['shipping'];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.xsaa01 ".$order)
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取订单发货序号最大的订单
	 * @return array $result 序号最大的订单
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function findMaxDeliverOrder($orderStatusArr){	
		$select = "{$this->tableName}.xsaa01";
		$where['express'] = "{$this->tableName}.xsaa29 = :shipping";
		$where['value']['shipping'] = $orderStatusArr['shipping'];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.xsaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取订单发货序号最小的订单
	 * @return array $result 序号最小的订单
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function findMinDeliverOrder($orderStatusArr){	
		$select = "{$this->tableName}.xsaa01";
		$where['express'] = "{$this->tableName}.xsaa29 = :shipping";
		$where['value']['shipping'] = $orderStatusArr['shipping'];
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.xsaa01 ".' ASC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取退货订单记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $sequence 顺序/倒序
	 * @param string $order 按照什么排序
	 * @return array $result 退货订单记录列表信息
	 * @author WuJunhua
	 * @date 2015-11-25
	 */
	public function getReturnOrderRecordList($page,$psize,$orderStatus,$sequence,$order,$CondList,$selectColumnStr=false){	
		$select = "{$this->tableName}.xsaa02,{$this->tableName}.xsaa13,{$this->tableName}.xsaa29,{$this->tableName}.xsaa44,{$this->tableName}.xsaa23,{$this->tableName}.xsaa41,{$this->tableName}.xsaa03,{$this->tableName}.xsaa48,{$this->tableName}.xsaa22,{$this->tableName}.xsaa43";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$sequence = empty($sequence) ? 'DESC' : $sequence;
		$order = empty($order) ? 'xsaa43' : $order;
		$where['express'] = "{$this->tableName}.xsaa29 IN(:orderStatus,:jycg) AND {$this->tableName}.xsaa45 = :warehousingStatus";
		$where['value']['orderStatus'] = $orderStatus['ddzt'];
		$where['value']['jycg'] = $orderStatus['jycg'];
		$where['value']['warehousingStatus'] = $orderStatus['thrkzt'];

		if(!empty($CondList)){
			if(!empty($CondList['ddbh'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :ddbh";
				$where['value'][':ddbh'] = '%'.$CondList['ddbh'].'%';
			}
			if(!empty($CondList['zffs'])){
				$where['express'].=" AND {$this->tableName}.xsaa13 like :zffs ";
				$where['value'][':zffs'] = '%'.$CondList['zffs'].'%';
			}
			if(!empty($CondList['syz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 = :syz ";
				$where['value'][':syz'] = $CondList['syz'];
			}
			if(!empty($CondList['kdgs'])){
				$where['express'].=" AND {$this->tableName}.xsaa41 = :kdgs ";
				$where['value'][':kdgs'] = $CondList['kdgs'];
			}
			//根据时间段查询
		    if(!empty($CondList['ddsjq'])&&!empty($CondList['ddsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:ddsjq AND {$this->tableName}.xsaa23 <= :ddsjz";
		    	$where['value'][':ddsjq'] = $CondList['ddsjq'];
		    	$where['value'][':ddsjz'] = $CondList['ddsjz'];
		    }
		    if (!empty($CondList['ddsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:ddsjq";
		    	$where['value'][':ddsjq'] = $CondList['ddsjq'];
		    }
		    if (!empty($CondList['ddsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:ddsjz";
		    	$where['value'][':ddsjz'] = $CondList['ddsjz'];
		    }

		    if(!empty($CondList['rcsjq'])&&!empty($CondList['rcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 >=:rcsjq AND {$this->tableName}.xsaa43 <= :rcsjz";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
		    if (!empty($CondList['rcsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 >=:rcsjq";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    }
		    if (!empty($CondList['rcsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 <=:rcsjz";
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						//->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsac01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order($order." ".$sequence);
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   //->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsac01")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();		
		return $result;
	}

	/**
	 * @desc 获取部分退换货订单详情
	 * @param string $orderNo 订单编号
	 * @return array $result 订单详情信息
	 * @author WuJunhua
	 * @date 2015-12-03
	 */
	public function OrderSectionReturns($orderNo){	
		$select = "{$this->tableName}.xsaa02,{$this->tableName}.xsaa04,{$this->tableName}.xsaa16,{$this->tableName}.xsaa19,{$this->tableName}.xsaa13,{$this->tableName}.xsaa29,{$this->tableName}.xsaa23,{$this->tableName}.xsaa27,{$this->tableName}.xsaa36,{$this->tableName}.xsaa48,{$this->tableName}.xsaa28";
		$where['express'] = "{$this->tableName}.xsaa02 = :orderNo";
		$where['value']['orderNo'] = $orderNo;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 订单财务审核列表显示[默认显示订单状态已支付且已客审和已确认且已客审且已收定金不为0的订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $orderStatusArr 订单状态
	 * @return array $result 订单财务审核列表信息
	 * @author WuJunhua
	 * @date 2015-12-08
	 * @modify huyan  2015-12-11 修改查询条件
	 */
	public function getFinanceCheckingOrder($page,$psize,$sequence,$order,$orderStatusArr,$CondList,$selectColumnStr=false){
		$select = "{$this->tableName}.xsaa01,{$this->tableName}.xsaa02,{$this->tableName}.xsaa04,{$this->tableName}.xsaa05,{$this->tableName}.xsaa13,
				   {$this->tableName}.xsaa19,{$this->tableName}.xsaa20,{$this->tableName}.xsaa23,
				   {$this->tableName}.xsaa29,{$this->tableName}.xsaa48,{$this->tableName}.xsaa33,{$this->tableName}.xsaa36";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['value']['ysdj'] = 0;

		if(!empty($CondList['shzt']) && $CondList['shzt'] == '已审核'){
			$where['express'] = "{$this->tableName}.xsaa29 IN(:shipping,:shipped,:trading_success,:rejected) AND {$this->tableName}.xsaa30 = :finchecked AND {$this->tableName}.xsaa20 != :ysdj";
			$where['value']['finchecked'] = $orderStatusArr['finchecked']; //已财审
			$where['value']['shipping'] = $orderStatusArr['shipping']; //待发货
			$where['value']['shipped'] = $orderStatusArr['shipped']; //已发货
			$where['value']['trading_success'] = $orderStatusArr['trading_success']; //交易成功
			$where['value']['rejected'] = $orderStatusArr['rejected']; //拒收
		}else{
			$where['express'] = "{$this->tableName}.xsaa29 In(:confirmed,:paid) AND {$this->tableName}.xsaa30 = :checked AND {$this->tableName}.xsaa20 != :ysdj";
			$where['value']['confirmed'] = $orderStatusArr['confirmed'];
			$where['value']['paid'] = $orderStatusArr['paid'];
			$where['value']['checked'] = $orderStatusArr['checked'];
			
		}

		if(!empty($CondList)){
			if(!empty($CondList['shddid'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :shddid";
				$where['value'][':shddid'] = '%'.$CondList['shddid'].'%';
			}
			if(!empty($CondList['shkhid'])){
				$where['express'].=" AND {$this->tableName}.xsaa04 like :shkhid ";
				$where['value'][':shkhid'] = '%'.$CondList['shkhid'].'%';
			}
			
			if(!empty($CondList['shszz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 = :shszz ";
				$where['value'][':shszz'] = $CondList['shszz'];
			}

			//根据时间段查询
		    if(!empty($CondList['shsjq'])&&!empty($CondList['shsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:shsjq AND {$this->tableName}.xsaa23 <= :shsjz";
		    	$where['value'][':shsjq'] = $CondList['shsjq'];
		    	$where['value'][':shsjz'] = $CondList['shsjz'];
		    }
		    if (!empty($CondList['shsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:shsjq";
		    	$where['value'][':shsjq'] = $CondList['shsjq'];
		    }
		    if (!empty($CondList['shsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:shsjz";
		    	$where['value'][':shsjz'] = $CondList['shsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("$order "." $sequence");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();								   
		return $result;
	}

	/**
	 * @desc 获取订单财务审核详情
	 * @param int $ordernum 订单序号
	 * @param string $symbol 符号( >、=、< )
	 * @param array $orderStatusArr 订单状态
	 * @return array $result 订单详情信息
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function findFinanceCheckingOrderDetail($ordernum,$symbol,$orderStatusArr){	
		$select = "*";
		$where['express'] = "{$this->tableName}.xsaa01 $symbol :ordernum AND {$this->tableName}.xsaa29 IN(:confirmed,:paid,:shipping,:shipped,:trading_success,:rejected) AND {$this->tableName}.xsaa30 IN(:checked,:fiscalChecked) AND {$this->tableName}.xsaa20 != :ysdj";
		$where['value']['ordernum'] = $ordernum;
		$where['value']['confirmed'] = $orderStatusArr['confirmed'];
		$where['value']['paid'] = $orderStatusArr['paid'];
		$where['value']['shipping'] = $orderStatusArr['shipping'];
		$where['value']['checked'] = $orderStatusArr['checked'];
		$where['value']['fiscalChecked'] = $orderStatusArr['fiscalChecked'];
		$where['value']['shipped'] = $orderStatusArr['shipped']; //已发货
		$where['value']['trading_success'] = $orderStatusArr['trading_success']; //交易成功
		$where['value']['rejected'] = $orderStatusArr['rejected']; //拒收
		$where['value']['ysdj'] = 0;

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取订单财务审核序号最大的订单
	 * @return array $result 序号最大的订单
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function findMaxFinanceCheckingOrder($orderStatusArr){	
		$select = "{$this->tableName}.xsaa01";
		$where['express'] = "{$this->tableName}.xsaa30 IN(:checked,:fiscalChecked) AND {$this->tableName}.xsaa29 IN(:confirmed,:paid,:shipping,:shipped,:trading_success,:rejected) AND {$this->tableName}.xsaa20 != :ysdj";
		$where['value']['checked'] = $orderStatusArr['checked'];
		$where['value']['fiscalChecked'] = $orderStatusArr['fiscalChecked'];
		$where['value']['confirmed'] = $orderStatusArr['confirmed'];
		$where['value']['paid'] = $orderStatusArr['paid'];
		$where['value']['shipping'] = $orderStatusArr['shipping'];
		$where['value']['shipped'] = $orderStatusArr['shipped']; //已发货
		$where['value']['trading_success'] = $orderStatusArr['trading_success']; //交易成功
		$where['value']['rejected'] = $orderStatusArr['rejected']; //拒收
		$where['value']['ysdj'] = 0;

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.xsaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取订单财务审核序号最小的订单
	 * @return array $result 序号最小的订单
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function findMinFinanceCheckingOrder($orderStatusArr){	
		$select = "{$this->tableName}.xsaa01";
		$where['express'] = "{$this->tableName}.xsaa30 IN(:checked,:fiscalChecked) AND {$this->tableName}.xsaa29 IN(:confirmed,:paid,:shipping,:shipped,:trading_success,:rejected) AND {$this->tableName}.xsaa20 != :ysdj";
		$where['value']['checked'] = $orderStatusArr['checked'];
		$where['value']['fiscalChecked'] = $orderStatusArr['fiscalChecked'];
		$where['value']['confirmed'] = $orderStatusArr['confirmed'];
		$where['value']['paid'] = $orderStatusArr['paid'];
		$where['value']['shipping'] = $orderStatusArr['shipping'];
		$where['value']['shipped'] = $orderStatusArr['shipped']; //已发货
		$where['value']['trading_success'] = $orderStatusArr['trading_success']; //交易成功
		$where['value']['rejected'] = $orderStatusArr['rejected']; //拒收
		$where['value']['ysdj'] = 0;

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.xsaa01 ".' ASC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 出货订单列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $orderStatusArr 订单状态
	 * @return array $result 订单财务审核列表信息
	 * @author WuJunhua
	 * @date 2015-12-09
	 */
	public function getShipmentOrderList($page,$psize,$orderStatusArr,$CondList,$selectColumnStr=false){		
		$select = "{$this->tableName}.xsaa01,{$this->tableName}.xsaa02,{$this->tableName}.xsaa13,{$this->tableName}.xsaa19,{$this->tableName}.xsaa16,{$this->tableName}.xsaa27,
				   {$this->tableName}.xsaa29,{$this->tableName}.xsaa41,{$this->tableName}.xsaa03,
				   {$this->tableName}.xsaa48,{$this->tableName}.xsaa33,{$this->tableName}.xsaa57,
				   {$this->tableName}.xsaa58,{$this->tableName}.xsaa59,{$this->tableName}.xsaa54,{$this->tableName}.xsaa55";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}		   
		$where['express'] = "{$this->tableName}.xsaa29 IN(:tradingSuccess,:shipped,:rejected)";
		$where['value']['tradingSuccess'] = $orderStatusArr['tradingSuccess'];
		$where['value']['shipped'] = $orderStatusArr['shipped'];
		$where['value']['rejected'] = $orderStatusArr['rejected'];

		if(!empty($CondList)){
			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :ddid";
				$where['value'][':ddid'] = '%'.$CondList['ddid'].'%';
			}
			if(!empty($CondList['khid'])){
				$where['express'].=" AND {$this->tableName}.xsaa04 like :khid";
				$where['value'][':khid'] = '%'.$CondList['khid'].'%';
			}

			if(!empty($CondList['kddh'])){
				$where['express'].=" AND {$this->tableName}.xsaa03 like :kddh";
				$where['value'][':kddh'] = '%'.$CondList['kddh'].'%';
			}
            //$CondList['ywkdf'] 

            if(!empty($CondList['fplx'])){
				$where['express'].=" AND {$this->tableName}.xsaa14 like :fplx";
				$where['value'][':fplx'] = '%'.$CondList['fplx'].'%';
			}

			if(!empty($CondList['khly'])){
				$where['express'].=" AND {$this->tableName}.xsaa60 like :khly";
				$where['value'][':khly'] = '%'.$CondList['khly'].'%';
			}


			if(!empty($CondList['ddzt'])){
				if ($CondList['ddzt']=='已退货') {
					$where['express'].=" AND {$this->tableName}.xsaa45 = :ddzt";
				    $where['value'][':ddzt'] = '是';
				}else{
					$where['express'].=" AND {$this->tableName}.xsaa29 like :ddzt";
				    $where['value'][':ddzt'] = '%'.$CondList['ddzt'].'%';
				}

				
			}
			if(!empty($CondList['jxfs'])){
				$where['express'].=" AND {$this->tableName}.xsaa12 like :jxfs";
				$where['value'][':jxfs'] = '%'.$CondList['jxfs'].'%';
			}
			if(!empty($CondList['khfz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 like :khfz";
				$where['value'][':khfz'] = '%'.$CondList['khfz'].'%';
			}
			if(!empty($CondList['zffs'])){
				$where['express'].=" AND {$this->tableName}.xsaa13 like :zffs";
				$where['value'][':zffs'] = '%'.$CondList['zffs'].'%';
			}

			if(!empty($CondList['ddlx'])){
				$where['express'].=" AND {$this->tableName}.xsaa11 like :ddlx";
				$where['value'][':ddlx'] = '%'.$CondList['ddlx'].'%';
			}

			if(!empty($CondList['sfjz'])){
				$where['express'].=" AND {$this->tableName}.xsaa35 like :sfjz";
				$where['value'][':sfjz'] = '%'.$CondList['sfjz'].'%';
			}
			if(!empty($CondList['kdgs'])){
				$where['express'].=" AND {$this->tableName}.xsaa41 like :kdgs";
				$where['value'][':kdgs'] = '%'.$CondList['kdgs'].'%';
			}
			
			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		   
		    if(!empty($CondList['fhsjq'])&&!empty($CondList['fhsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq AND {$this->tableName}.xsaa27 <= :fhsjz";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }
		    if (!empty($CondList['fhsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    }
		    if (!empty($CondList['fhsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 <=:fhsjz";
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }

		    if(!empty($CondList['shsjq'])&&!empty($CondList['shsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 >=:shsjq AND {$this->tableName}.xsaa28 <= :shsjz";
		    	$where['value'][':shsjq'] = $CondList['shsjq'];
		    	$where['value'][':shsjz'] = $CondList['shsjz'];
		    }
		    if (!empty($CondList['shsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 >=:shsjq";
		    	$where['value'][':shsjq'] = $CondList['shsjq'];
		    }
		    if (!empty($CondList['shsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 <=:shsjz";
		    	$where['value'][':shsjz'] = $CondList['shsjz'];
		    }

		    //记账时间1
            if(!empty($CondList['jzsj1q'])&&!empty($CondList['jzsj1z'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa52 >=:jzsj1q AND {$this->tableName}.xsaa52 <= :jzsj1z";
		    	$where['value'][':jzsj1q'] = $CondList['jzsj1q'];
		    	$where['value'][':jzsj1z'] = $CondList['jzsj1z'];
		    }
		    if (!empty($CondList['jzsj1q'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa52 >=:jzsj1q";
		    	$where['value'][':jzsj1q'] = $CondList['jzsj1q'];
		    }
		    if (!empty($CondList['jzsj1z'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa52 <=:jzsj1z";
		    	$where['value'][':jzsj1z'] = $CondList['jzsj1z'];
		    }
		    //记账时间2
		    if(!empty($CondList['jzsj2q'])&&!empty($CondList['jzsj2z'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa52 >=:xsaa53 AND {$this->tableName}.xsaa53 <= :jzsj2z";
		    	$where['value'][':jzsj2q'] = $CondList['jzsj2q'];
		    	$where['value'][':jzsj2z'] = $CondList['jzsj2z'];
		    }
		    if (!empty($CondList['jzsj1q'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa53 >=:jzsj1q";
		    	$where['value'][':jzsj1q'] = $CondList['jzsj1q'];
		    }
		    if (!empty($CondList['jzsj2z'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa53 <=:jzsj2z";
		    	$where['value'][':jzsj2z'] = $CondList['jzsj2z'];
		    }
		}

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();								   
		return $result;
	}

	/**
	 * @desc 退换货汇总列表显示[只显示订单状态交易成功或拒收且退货换标识不为空]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $orderStatusArr 订单状态
	 * @return array $result 订单财务审核列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function getReturnOrderList($page,$psize,$sequence,$order,$CondList,$orderStatusArr,$selectColumnStr=false){		
		$select = "{$this->tableName}.xsaa01,{$this->tableName}.xsaa02,{$this->tableName}.xsaa04,{$this->tableName}.xsaa13,{$this->tableName}.xsaa19,{$this->tableName}.xsaa16,{$this->tableName}.xsaa44,{$this->tableName}.xsaa51,
				   {$this->tableName}.xsaa29,{$this->tableName}.xsaa41,{$this->tableName}.xsaa03,
				   {$this->tableName}.xsaa48,{$this->tableName}.xsaa60,{$this->tableName}.xsaa57,
				   {$this->tableName}.xsaa58,{$this->tableName}.xsaa59,{$this->tableName}.xsaa56";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		
		$where['express'] = "{$this->tableName}.xsaa29 IN(:tradingSuccess,:rejected) AND {$this->tableName}.xsaa49 IN(:return,:exchanges)";
		$where['value']['tradingSuccess'] = $orderStatusArr['tradingSuccess'];
		$where['value']['rejected'] = $orderStatusArr['rejected'];
		$where['value']['return'] = $orderStatusArr['return'];
		$where['value']['exchanges'] = $orderStatusArr['exchanges'];

		if(!empty($CondList)){
			if(!empty($CondList['sfrk'])){
				$where['express'].=" AND {$this->tableName}.xsaa45 like :sfrk";
				$where['value'][':sfrk'] = '%'.$CondList['sfrk'].'%';
			}

			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :ddid";
				$where['value'][':ddid'] = '%'.$CondList['ddid'].'%';
			}

			if(!empty($CondList['thdd'])){
				$where['express'].=" AND {$this->tableName}.xsaa49 like :thdd";
				$where['value'][':thdd'] = '%'.$CondList['thdd'].'%';
			}

			if(!empty($CondList['qbdd'])){
				$where['express'].=" AND {$this->tableName}.xsaa29 like :qbdd";
				$where['value'][':qbdd'] = '%'.$CondList['qbdd'].'%';
			}

			if(!empty($CondList['ddgh'])){
				$where['express'].=" AND {$this->tableName}.xsaa22 like :ddgh";
				$where['value'][':ddgh'] = '%'.$CondList['ddgh'].'%';
			}
			
			if(!empty($CondList['syz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 like :syz";
				$where['value'][':syz'] = '%'.$CondList['syz'].'%';
			}
			if(!empty($CondList['zffs'])){
				$where['express'].=" AND {$this->tableName}.xsaa13 like :zffs";
				$where['value'][':zffs'] = '%'.$CondList['zffs'].'%';
			}
			
			if(!empty($CondList['kdgs'])){
				$where['express'].=" AND {$this->tableName}.xsaa41 like :kdgs";
				$where['value'][':kdgs'] = '%'.$CondList['kdgs'].'%';
			}
		    if(!empty($CondList['fhsjq'])&&!empty($CondList['fhsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq AND {$this->tableName}.xsaa27 <= :fhsjz";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }
		    if (!empty($CondList['fhsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    }
		    if (!empty($CondList['fhsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 <=:fhsjz";
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }

		     if(!empty($CondList['thsjq'])&&!empty($CondList['thsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 >=:thsjq AND {$this->tableName}.xsaa51 <= :thsjz";
		    	$where['value'][':thsjq'] = $CondList['thsjq'];
		    	$where['value'][':thsjz'] = $CondList['thsjz'];
		    }
		    if (!empty($CondList['thsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 >=:thsjq";
		    	$where['value'][':thsjq'] = $CondList['thsjq'];
		    }
		    if (!empty($CondList['thsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 <=:thsjz";
		    	$where['value'][':thsjz'] = $CondList['thsjz'];
		    }
		}

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						//->order("{$this->createtime} "." DESC");
						->order("$order "." $sequence");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	   
		return $result;
	}

	/**
	 * @desc 退换货明细列表显示[只显示订单状态交易成功或拒收且退货换标识不为空]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $orderStatusArr 订单状态
	 * @return array $result 订单财务审核列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function getReturnOrderDetailsList($page,$psize,$orderStatusArr,$CondList,$selectColumnStr=false){		
		$select = "{$this->tableName}.xsaa02,{$this->tableName}.xsaa51,{$this->tableName}.xsaa13,{$this->tableName}.xsaa41,{$this->tableName}.xsaa03,{$this->tableOrderDetail}.xsab15,{$this->tableOrderDetail}.xsab03,{$this->tableOrderDetail}.xsab02,{$this->tableOrderDetail}.xsab14,{$this->tableName}.xsaa49,{$this->tableOrderDetail}.xsab20";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.xsaa29 IN(:tradingSuccess,:rejected) AND {$this->tableName}.xsaa49 IN(:return,:exchanges)";
		$where['value']['tradingSuccess'] = $orderStatusArr['tradingSuccess'];
		$where['value']['rejected'] = $orderStatusArr['rejected'];
		$where['value']['return'] = $orderStatusArr['return'];
		$where['value']['exchanges'] = $orderStatusArr['exchanges'];

		if(!empty($CondList)){
			if(!empty($CondList['sfrk'])){
				$where['express'].=" AND {$this->tableName}.xsaa45 like :sfrk";
				$where['value'][':sfrk'] = '%'.$CondList['sfrk'].'%';
			}

			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :ddid";
				$where['value'][':ddid'] = '%'.$CondList['ddid'].'%';
			}
			if(!empty($CondList['sfrk'])){
				$where['express'].=" AND {$this->tableName}.xsaa45 like :sfrk";
				$where['value'][':sfrk'] = '%'.$CondList['sfrk'].'%';
			}

			if(!empty($CondList['thdd'])){
				$where['express'].=" AND {$this->tableName}.xsaa49 like :thdd";
				$where['value'][':thdd'] = '%'.$CondList['thdd'].'%';
			}

			if(!empty($CondList['qbdd'])){
				$where['express'].=" AND {$this->tableName}.xsaa29 like :qbdd";
				$where['value'][':qbdd'] = '%'.$CondList['qbdd'].'%';
			}

			if(!empty($CondList['ddgh'])){
				$where['express'].=" AND {$this->tableName}.xsaa22 like :ddgh";
				$where['value'][':ddgh'] = '%'.$CondList['ddgh'].'%';
			}
			
			if(!empty($CondList['syz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 like :syz";
				$where['value'][':syz'] = '%'.$CondList['syz'].'%';
			}
			if(!empty($CondList['zffs'])){
				$where['express'].=" AND {$this->tableName}.xsaa13 like :zffs";
				$where['value'][':zffs'] = '%'.$CondList['zffs'].'%';
			}
			
			if(!empty($CondList['kdgs'])){
				$where['express'].=" AND {$this->tableName}.xsaa41 like :kdgs";
				$where['value'][':kdgs'] = '%'.$CondList['kdgs'].'%';
			}
		    if(!empty($CondList['fhsjq'])&&!empty($CondList['fhsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq AND {$this->tableName}.xsaa27 <= :fhsjz";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }
		    if (!empty($CondList['fhsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    }
		    if (!empty($CondList['fhsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 <=:fhsjz";
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }

		     if(!empty($CondList['thsjq'])&&!empty($CondList['thsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 >=:thsjq AND {$this->tableName}.xsaa51 <= :thsjz";
		    	$where['value'][':thsjq'] = $CondList['thsjq'];
		    	$where['value'][':thsjz'] = $CondList['thsjz'];
		    }
		    if (!empty($CondList['thsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 >=:thsjq";
		    	$where['value'][':thsjq'] = $CondList['thsjq'];
		    }
		    if (!empty($CondList['thsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 <=:thsjz";
		    	$where['value'][':thsjz'] = $CondList['thsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->queryScalar();								   							   
		return $result;
	}

	/**
	 * @desc 出货款号汇总列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $orderStatusArr 订单状态
	 * @return array $result 订单财务审核列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function getShipmentGoodsList($page,$psize,$orderStatusArr,$CondList,$selectColumnStr=false){		
		$select = "{$this->tableOrderDetail}.xsab03,{$this->tableOrderDetail}.xsab02,sum({$this->tableOrderDetail}.xsab04) as xsab04,sum({$this->tableOrderDetail}.xsab06) as xsab06,{$this->tableOrderDetail}.xsab19";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.xsaa29 IN(:tradingSuccess,:shipped,:rejected)";
		$where['value']['tradingSuccess'] = $orderStatusArr['tradingSuccess'];
		$where['value']['shipped'] = $orderStatusArr['shipped'];
		$where['value']['rejected'] = $orderStatusArr['rejected'];

        if(!empty($CondList)){
        	if(!empty($CondList['cpkh'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab03 like :cpkh";
				$where['value'][':cpkh'] = '%'.$CondList['cpkh'].'%';
			}
			/*if(!empty($CondList['gys'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab21 like :gys";
				$where['value'][':gys'] = '%'.$CondList['gys'].'%';
			}*/
			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :ddid";
				$where['value'][':ddid'] = '%'.$CondList['ddid'].'%';
			}

			if(!empty($CondList['ddgh'])){
				$where['express'].=" AND {$this->tableName}.xsaa48 like :ddgh";
				$where['value'][':ddgh'] = '%'.$CondList['ddgh'].'%';
			}
			if(!empty($CondList['ddzt'])){
				if ($CondList['ddzt']=='已退货') {
					$where['express'].=" AND {$this->tableName}.xsaa49 like :ddzt";
				    $where['value'][':ddzt'] = '%'.$CondList['ddzt'].'%';
				}
				else {
					$where['express'].=" AND {$this->tableName}.xsaa29 like :ddzt";
				    $where['value'][':ddzt'] = '%'.$CondList['ddzt'].'%';
				}
			}

			if(!empty($CondList['khzt'])){
				if ($CondList['ddzt']=='已收货') {
					$where['express'].=" AND {$this->tableName}.xsaa29 like :khzt";
				    $where['value'][':khzt'] = '%'.$CondList['khzt'].'%';
				}
				else {
					$where['express'].=" AND {$this->tableName}.xsaa49 like :khzt";
				    $where['value'][':khzt'] = '%'.$CondList['khzt'].'%';
				}
			}
			if(!empty($CondList['khly'])){
				$where['express'].=" AND {$this->tableName}.xsaa60 like :khly";
				$where['value'][':khly'] = '%'.$CondList['khly'].'%';
			}

			if(!empty($CondList['szz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 like :szz";
				$where['value'][':szz'] = '%'.$CondList['szz'].'%';
			}

			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		  
		    if(!empty($CondList['fhsjq'])&&!empty($CondList['fhsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq AND {$this->tableName}.xsaa27 <= :fhsjz";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }
		    if (!empty($CondList['fhsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    }
		    if (!empty($CondList['fhsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 <=:fhsjz";
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }

		    if(!empty($CondList['shsjq'])&&!empty($CondList['shsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 >=:shsjq AND {$this->tableName}.xsaa28 <= :shsjz";
		    	$where['value'][':shsjq'] = $CondList['shsjq'];
		    	$where['value'][':shsjz'] = $CondList['shsjz'];
		    }
		    if (!empty($CondList['shsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 >=:shsjq";
		    	$where['value'][':shsjq'] = $CondList['shsjq'];
		    }
		    if (!empty($CondList['shsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 <=:shsjz";
		    	$where['value'][':shsjz'] = $CondList['shsjz'];
		    }

            if(!empty($CondList['thsjq'])&&!empty($CondList['thsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 >=:thsjq AND {$this->tableName}.xsaa51 <= :thsjz";
		    	$where['value'][':thsjq'] = $CondList['thsjq'];
		    	$where['value'][':thsjz'] = $CondList['thsjz'];
		    }
		    if (!empty($CondList['thsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 >=:thsjq";
		    	$where['value'][':thsjq'] = $CondList['thsjq'];
		    }
		    if (!empty($CondList['thsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 <=:thsjz";
		    	$where['value'][':thsjz'] = $CondList['thsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->group("{$this->tableOrderDetail}.xsab03")
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableOrderDetail}.xsab03 "." ASC");
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->group("{$this->tableOrderDetail}.xsab03")
										   ->queryAll();
		$result['count'] = count($count);								   								   
		return $result;
	}

	/**
	 * @desc 出货款号明细列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $orderStatusArr 订单状态
	 * @return array $result 订单财务审核列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function getShipmentGoodsDetailsList($page,$psize,$orderStatusArr,$CondList,$selectColumnStr=false){		
		$select = "{$this->tableOrderDetail}.xsab01,{$this->tableOrderDetail}.xsab03,{$this->tableOrderDetail}.xsab02,{$this->tableOrderDetail}.xsab04,{$this->tableOrderDetail}.xsab06,{$this->tableOrderDetail}.xsab19";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.xsaa29 IN(:tradingSuccess,:shipped,:rejected)";
		$where['value']['tradingSuccess'] = $orderStatusArr['tradingSuccess'];
		$where['value']['shipped'] = $orderStatusArr['shipped'];
		$where['value']['rejected'] = $orderStatusArr['rejected'];

		 if(!empty($CondList)){
		 	if(!empty($CondList['cpkh'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab03 like :cpkh";
				$where['value'][':cpkh'] = '%'.$CondList['cpkh'].'%';
			}
			if(!empty($CondList['gys'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab21 like :gys";
				$where['value'][':gys'] = '%'.$CondList['gys'].'%';
			}
			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableName}.xsaa02 like :ddid";
				$where['value'][':ddid'] = '%'.$CondList['ddid'].'%';
			}
			if(!empty($CondList['ddgh'])){
				$where['express'].=" AND {$this->tableName}.xsaa48 like :ddgh";
				$where['value'][':ddgh'] = '%'.$CondList['ddgh'].'%';
			}
			if(!empty($CondList['ddzt'])){
				if ($CondList['ddzt']=='已退货') {
					$where['express'].=" AND {$this->tableName}.xsaa49 like :ddzt";
				    $where['value'][':ddzt'] = '%'.$CondList['ddzt'].'%';
				}
				else {
					$where['express'].=" AND {$this->tableName}.xsaa29 like :ddzt";
				    $where['value'][':ddzt'] = '%'.$CondList['ddzt'].'%';
				}
			}
			if(!empty($CondList['khzt'])){
				if ($CondList['ddzt']=='已收货') {
					$where['express'].=" AND {$this->tableName}.xsaa29 like :khzt";
				    $where['value'][':khzt'] = '%'.$CondList['khzt'].'%';
				}
				else {
					$where['express'].=" AND {$this->tableName}.xsaa49 like :khzt";
				    $where['value'][':khzt'] = '%'.$CondList['khzt'].'%';
				}
				
			}

			if(!empty($CondList['khly'])){
				$where['express'].=" AND {$this->tableName}.xsaa60 like :khly";
				$where['value'][':khly'] = '%'.$CondList['khly'].'%';
			}

			if(!empty($CondList['szz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 like :szz";
				$where['value'][':szz'] = '%'.$CondList['szz'].'%';
			}

			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		  
		    if(!empty($CondList['fhsjq'])&&!empty($CondList['fhsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq AND {$this->tableName}.xsaa27 <= :fhsjz";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }
		    if (!empty($CondList['fhsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 >=:fhsjq";
		    	$where['value'][':fhsjq'] = $CondList['fhsjq'];
		    }
		    if (!empty($CondList['fhsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa27 <=:fhsjz";
		    	$where['value'][':fhsjz'] = $CondList['fhsjz'];
		    }

		    if(!empty($CondList['shsjq'])&&!empty($CondList['shsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 >=:shsjq AND {$this->tableName}.xsaa28 <= :shsjz";
		    	$where['value'][':shsjq'] = $CondList['shsjq'];
		    	$where['value'][':shsjz'] = $CondList['shsjz'];
		    }
		    if (!empty($CondList['shsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 >=:shsjq";
		    	$where['value'][':shsjq'] = $CondList['shsjq'];
		    }
		    if (!empty($CondList['shsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa28 <=:shsjz";
		    	$where['value'][':shsjz'] = $CondList['shsjz'];
		    }

            if(!empty($CondList['thsjq'])&&!empty($CondList['thsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 >=:thsjq AND {$this->tableName}.xsaa51 <= :thsjz";
		    	$where['value'][':thsjq'] = $CondList['thsjq'];
		    	$where['value'][':thsjz'] = $CondList['thsjz'];
		    }
		    if (!empty($CondList['thsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 >=:thsjq";
		    	$where['value'][':thsjq'] = $CondList['thsjq'];
		    }
		    if (!empty($CondList['thsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa51 <=:thsjz";
		    	$where['value'][':thsjz'] = $CondList['thsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.xsaa02 "." ASC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->queryScalar();	
		return $result;
	}

	/**
	 * @desc 获取退货款号汇总列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 退货款号汇总列表信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 * @modify huyan 修改查询条件
	 */
	public function getReturnGoodsSummaryList($page,$psize,$goodStatus,$sequence,$order,$CondList,$selectColumnStr=false){	
		$select = "{$this->tableOrderDetail}.xsab03,{$this->tableOrderDetail}.xsab02,sum({$this->tableOrderDetail}.xsab14) as xsab14,sum({$this->tableOrderDetail}.xsab15) as xsab15,{$this->tableOrderDetail}.xsab19";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableOrderDetail}.xsab20 = :goodStatus";
		$where['value']['goodStatus'] = $goodStatus;

		if(!empty($CondList)){
			if(!empty($CondList['cpmc'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab02 like :cpmc";
				$where['value'][':cpmc'] = '%'.$CondList['cpmc'].'%';
			}
			if(!empty($CondList['cpkh'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab03 like :cpkh ";
				$where['value'][':cpkh'] = '%'.$CondList['cpkh'].'%';
			}
			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab01 = :ddid ";
				$where['value'][':ddid'] = $CondList['ddid'];
			}
			if(!empty($CondList['kdgs'])){
				$where['express'].=" AND {$this->tableName}.xsaa41 = :kdgs ";
				$where['value'][':kdgs'] = $CondList['kdgs'];
			}

			if(!empty($CondList['zffs'])){
				$where['express'].=" AND {$this->tableName}.xsaa13 = :zffs ";
				$where['value'][':zffs'] = $CondList['zffs'];
			}
			if(!empty($CondList['szz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 = :szz ";
				$where['value'][':szz'] = $CondList['szz'];
			}
			//根据时间段查询
		    if(!empty($CondList['rcsjq'])&&!empty($CondList['rcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 >=:rcsjq AND {$this->tableName}.xsaa43 <= :rcsjz";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
		    if (!empty($CondList['rcsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 >=:rcsjq";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    }
		    if (!empty($CondList['rcsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 <=:rcsjz";
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->where($where['express'],$where['value'])
						->group("{$this->tableOrderDetail}.xsab03")
						->limit($psize, $psize * ($page - 1))
						->order($order." ".$sequence);
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										  ->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->where($where['express'],$where['value'])
										   ->group("{$this->tableOrderDetail}.xsab03")
										   ->queryAll();
		$result['count'] = count($count);								   
		return $result;
	}


	/**
	 * @desc 获取退货款号明细列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 退货款号明细列表信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 * @modify huyan 2015-12-11 添加查询条件
	 */
	public function getReturnGoodsDetailsList($page,$psize,$goodStatus,$CondList,$selectColumnStr=false){		
		$select = "{$this->tableOrderDetail}.xsab01,{$this->tableOrderDetail}.xsab03,{$this->tableOrderDetail}.xsab02,{$this->tableOrderDetail}.xsab14,{$this->tableOrderDetail}.xsab15,{$this->tableOrderDetail}.xsab19,{$this->tableOrderDetail}.xsab17";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableOrderDetail}.xsab20 = :goodStatus";
		$where['value']['goodStatus'] = $goodStatus;

		if(!empty($CondList)){
			if(!empty($CondList['cpmc'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab02 like :cpmc";
				$where['value'][':cpmc'] = '%'.$CondList['cpmc'].'%';
			}
			if(!empty($CondList['cpkh'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab03 like :cpkh ";
				$where['value'][':cpkh'] = '%'.$CondList['cpkh'].'%';
			}
			if(!empty($CondList['ddid'])){
				$where['express'].=" AND {$this->tableOrderDetail}.xsab01 = :ddid ";
				$where['value'][':ddid'] = $CondList['ddid'];
			}
			if(!empty($CondList['kdgs'])){
				$where['express'].=" AND {$this->tableName}.xsaa41 = :kdgs ";
				$where['value'][':kdgs'] = $CondList['kdgs'];
			}
			if(!empty($CondList['zffs'])){
				$where['express'].=" AND {$this->tableName}.xsaa13 = :zffs ";
				$where['value'][':zffs'] = $CondList['zffs'];
			}
			if(!empty($CondList['syz'])){
				$where['express'].=" AND {$this->tableName}.xsaa31 = :syz ";
				$where['value'][':syz'] = $CondList['syz'];
			}
			
			//根据时间段查询
		    if(!empty($CondList['rcsjq'])&&!empty($CondList['rcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 >=:rcsjq AND {$this->tableName}.xsaa43 <= :rcsjz";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
		    if (!empty($CondList['rcsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 >=:rcsjq";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    }
		    if (!empty($CondList['rcsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa43 <=:rcsjz";
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
		}

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1));
						//->order("{$this->tableOrderDetail}.xsab17 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}


	/**
	 * @desc 获取出货或退换货订单详情
	 * @param int $orderno 订单编号
	 * @return array $result 订单详情信息
	 * @author WuJunhua
	 * @date 2015-12-11
	 */
	public function getOrderShipmentOrReturnsDetails($orderno){	
		$select = "{$this->tableName}.xsaa04,{$this->tableName}.xsaa02,{$this->tableName}.xsaa13,{$this->tableName}.xsaa48,{$this->tableName}.xsaa60,{$this->tableName}.xsaa23,{$this->tableName}.xsaa27,{$this->tableName}.xsaa41,{$this->tableName}.xsaa03,{$this->tableName}.xsaa19,{$this->tableName}.xsaa20,{$this->tableName}.xsaa21,{$this->tableName}.xsaa16,{$this->tableName}.xsaa28,{$this->tableName}.xsaa29,{$this->tableName}.xsaa36,{$this->tableName}.xsaa54,{$this->tableName}.xsaa55";
		$where['express'] = "{$this->tableName}.xsaa02 = :orderno";
		$where['value']['orderno'] = $orderno;
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/*/**
	 * @desc 获取客户订单记录
	 * @param string $clientno 客户编号
	 * @return array $result 客户跟进记录信息
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function GetOrderRecord($clientno){	
		$select = "{$this->tableName}.khae01,{$this->tableName}.khae02,{$this->tableName}.khae03,{$this->tableName}.khae04,{$this->tableName}.khae05,{$this->tableName}.khae06,{$this->tableName}.khae07,{$this->tableName}.khae08,{$this->tableName}.khae09";
		$where['express'] = "{$this->tableName}.khae01 = :clientno";
		$where['value']['clientno'] = $clientno;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->createtime} "." DESC");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 根据订单号找到客户id
	 * @param string $clientno 客户编号
	 * @author huyan
	 * @date 2016-01-06
	 */
	public function getCustomerid($kehuid){
	    $where['express'] = "{$this->tableName}.xsaa02 = :kehuid";
		$where['value']['kehuid'] = $kehuid;
		$select = "{$this->tableName}.xsaa04";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit(1,0)
						->order("{$this->tableName}.xsaa23 ".' DESC');
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取客户的订单历史交易记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 客户订单列表信息
	 * @author WuJunhua
	 * @date 2016-01-21
	 */
	public function getClientOrderRecord($clientno,$page,$psize){	
		$select = "{$this->tableName}.xsaa01,{$this->tableName}.xsaa02,{$this->tableName}.xsaa03,{$this->tableName}.xsaa04,{$this->tableName}.xsaa05,{$this->tableName}.xsaa06,{$this->tableName}.xsaa11,{$this->tableName}.xsaa12,{$this->tableName}.xsaa13,
				   {$this->tableName}.xsaa19,{$this->tableName}.xsaa20,{$this->tableName}.xsaa23,{$this->tableName}.xsaa22,
				   {$this->tableName}.xsaa29,{$this->tableName}.xsaa35, {$this->tableName}.xsaa25, {$this->tableName}.xsaa27, {$this->tableName}.xsaa28,{$this->tableName}.xsaa08,
				   {$this->tableName}.xsaa39,{$this->tableName}.xsaa40,{$this->tableName}.xsaa36,{$this->tableName}.xsaa03,{$this->tableName}.xsaa41,{$this->tableName}.xsaa33,{$this->tableName}.xsaa48,{$this->tableName}.xsaa34";
		$where['express'] = "{$this->tableName}.xsaa04 = :clientno";
	    $where['value']['clientno'] = $clientno;
	    
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.xsaa23 ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}

	/**
	 * @desc 系统设置->数据清理->查询要删除的订单
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function getOrderToBeDel($searchType,$xdsjq,$xdsjz,$zfdd,$wqrdd){
		$where['express'] = "{$this->tableName}.xsaa01>0";
		$where['value'] = array();
		if($searchType == 1){
			if(!empty($xdsjq)&&!empty($xdsjz)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :zxgjz AND {$this->tableName}.xsaa29 =:zfdd";
		    	$where['value'][':xdsjq'] =$xdsjq;
		    	$where['value'][':xdsjz'] =$xdsjz;
		    	$where['value'][':zfdd']=$zfdd;
		    }
		    if(!empty($xdsjq)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa29 =:zfdd";
		    	$where['value'][':xdsjq'] =$xdsjq;
		    	$where['value'][':zfdd'] =$zfdd;
		    }
		     if(!empty($xdsjz)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz AND {$this->tableName}.xsaa29 =:zfdd";
		    	$where['value'][':xdsjq'] =$xdsjz;
		    	$where['value'][':zfdd'] = $zfdd;
		    }
		}
		if($searchType == 2){
			if(!empty($xdsjq)&&!empty($xdsjz)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :zxgjz AND {$this->tableName}.xsaa29 =:wqrdd";
		    	$where['value'][':xdsjq'] =$xdsjq;
		    	$where['value'][':xdsjz'] =$xdsjz;
		    	$where['value'][':wqrdd'] = $wqrdd;
		    }
		    if(!empty($xdsjq)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa29 =:wqrdd";
		    	$where['value'][':xdsjq'] =$xdsjq;
		    	$where['value'][':wqrdd'] = $wqrdd;
		    }
		     if(!empty($xdsjz)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz AND {$this->tableName}.xsaa29 =:wqrdd";
		    	$where['value'][':xdsjq'] =$xdsjz;
		    	$where['value'][':wqrdd'] = $wqrdd;
		    }
		}
		if($searchType == 3){
			if(!empty($xdsjq)&&!empty($xdsjz)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :zxgjz";
		    	$where['value'][':xdsjq'] =$xdsjq;
		    	$where['value'][':xdsjz'] =$xdsjz;
		    }
		    if(!empty($xdsjq)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq";
		    	$where['value'][':xdsjq'] =$xdsjq;
		    }
		     if(!empty($xdsjz)){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz";
		    	$where['value'][':xdsjq'] =$xdsjz;
		    }
		}
		$select = "{$this->tableName}.xsaa02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}


	/**
	 * @desc 获取地域统计报表（下单，确认，发货，拒收，签收）
	 * @param array $cond 查询条件
	 * @param string $type 类型（下单，确认，发货，拒收，签收）
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getDytjbbByCond($cond,$type){
		$select = "SUM({$this->tableName}.xsaa19) money,COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa09 like '%". $cond['pro'] ."%' and {$this->tableName}.xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond)){
			if($cond['type'] == 'ope'){
				if($type == "'已发货','拒收','交易成功'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and {$this->tableName}.xsaa27 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and {$this->tableName}.xsaa27 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else if($type == "'拒收'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and {$this->tableName}.xsaa51 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and {$this->tableName}.xsaa51 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else if($type == "'交易成功'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and {$this->tableName}.xsaa28 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and {$this->tableName}.xsaa28 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else{
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and {$this->tableName}.xsaa61 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'];
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and {$this->tableName}.xsaa61 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'];
					}
				}	
			}else{
				if(!empty($cond['beginDate'])){
					$where['express'] .= " and {$this->tableName}.xsaa61 >= :beginDate ";
					$where['value'][':beginDate'] = $cond['beginDate'];
				}
				if(!empty($cond['endDate'])){
					$where['express'] .= " and {$this->tableName}.xsaa61 <= :endDate ";
					$where['value'][':endDate'] = $cond['endDate'];
				}
			}

			if(!empty($cond['khyx'])){
				$where['express'] .= "and kh.khaa25 = :khyx ";
				$where['value'][':khyx'] = $cond['khyx'];
			}
			if(!empty($cond['dept'])){
				$where['express'] .= "and dept.depttext = :dept ";
				$where['value'][':dept'] = $cond['dept'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa kh',"kh.khaa02 = {$this->tableName}.xsaa04")
//						->leftjoin('rylist as ry',"ry.username=kh.khaa32")
//						->leftjoin('deptset dept',"dept.depttext=ry.department")
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['money']) && empty($result[0]['orders'])){
			return array(
				'money'=>0,
				'orders'=>0
				);
		}
		return $result[0];
	}

	/**
	 * @desc  获取快递拒收统计——发货，拒收，签收
	 * @param array $cond 查询条件
	 * @param string $type 类型（发货，拒收，签收）
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getKdjstjByCond($cond,$type){
		$select = "SUM({$this->tableName}.xsaa19) money,COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa41 = '". $cond['kdgs'] ."' and {$this->tableName}.xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'] .= " and {$this->tableName}.xsaa61 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'];
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= " and {$this->tableName}.xsaa61 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders'])){
			return array(
				'money'=>0,
				'orders'=>0
				);
		}
		return $result[0];
	}

	/**
	 * @desc  获取时间段内所有订单的数量和总金额
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getAllOrdersAndMoney($cond){
		$select = "SUM({$this->tableName}.xsaa19) money,COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa02 != '' ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'] .= " and {$this->tableName}.xsaa61 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'];
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= " and {$this->tableName}.xsaa61 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders'])){
			return array(
				'money'=>0,
				'orders'=>0
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取退货原因信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getThyytjDetails($cond){
		$select = "SUM({$this->tableName}.xsaa19) money,COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa49 = '退' and d.xsad06 like '%". $cond['reason'] ."%' ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'] .= " and {$this->tableName}.xsaa61 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'];
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= " and {$this->tableName}.xsaa61 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('xsad d',"{$this->tableName}.xsaa02 = d.xsad01")
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'money'=>0,
				'orders'=>0
				);
		}
		return $result[0];
	}

	/**
	 * @desc 根据订单号获取结算信息
	 * @param string $orderno 订单号
	 * @author WuJunhua
	 * @date 2016-03-08
	 */
	public function getBilingInfo($orderno){
		$select = "{$this->tableName}.xsaa44,{$this->tableName}.xsaa57,{$this->tableName}.xsaa58,{$this->tableName}.xsaa59,cwaa.cwaa01";
		$where['express'] = "{$this->tableName}.xsaa02 = :orderno";
		$where['value']['orderno'] = $orderno;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cwaa',"{$this->tableName}.xsaa02 = cwaa.cwaa02")
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取退货订单[拒收状态的订单且订单总额>退货金额]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $CondList 查询条件
	 * @return array $result 退货订单列表信息
	 * @author WuJunhua
	 * @date 2016-03-09
	 */
	public function getReturnOrder($page,$psize,$orderStatusArr,$CondList){	
		$select = "{$this->tableName}.xsaa02,{$this->tableName}.xsaa05,{$this->tableName}.xsaa19,{$this->tableName}.xsaa23,{$this->tableName}.xsaa44,{$this->tableName}.xsaa48";
		$where['express'] = "{$this->tableName}.xsaa29 = :rejected AND {$this->tableName}.xsaa19 > {$this->tableName}.xsaa44";
	    $where['value']['rejected'] = $orderStatusArr['rejected'];

        if(!empty($CondList)){
			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq AND {$this->tableName}.xsaa23 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.xsaa23 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.xsaa02 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 获取订单信息
	 * @param array $cond 查询条件
	 * @param string $type 类型（下单，等待审核，完成）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function getOrderMessage($cond,$type){
		$select = "COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa48 = '". $cond['username'] ."' and {$this->tableName}.xsaa29 = $type ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'] .= " and {$this->tableName}.xsaa61 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'];
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= " and {$this->tableName}.xsaa61 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array('orders'=>0);
		}
		return $result[0];
	}

	/**
	 * @desc 首页当中获取最近七天业绩
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function getSevenDetails($cond){
		$select = "COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa48 = '". $cond['username'] ."' and {$this->tableName}.xsaa61 = '". $cond['date'] ."' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return 0;
		}
		return $result[0]['orders'];
	}

	/**
	 * @desc 获取今天下单数
	 * @param string $date 当前年月日
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function getTodayOrders($date){
		$select = "COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa61 = '". $date ."' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders'])){
			return 0;
		}
		return $result[0]['orders'];
	}

	/**
	 * @desc 获取今天下单数
	 * @param string $date 当前年月日
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function getTodayFinishedOrders($date){
		$select = "COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa29 = '交易成功' and {$this->tableName}.xsaa61 = '". $date ."' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return 0;
		}
		return $result[0]['orders'];
	}

	/**
	 * @desc 根据订单号获取订单总价和商品总价(核实是否相等)
	 * @param string $orderno 订单号
	 * @author WuJunhua
	 * @date 2016-03-21
	 */
	public function verifyOrderMoney($orderno){
		$select = "{$this->tableName}.xsaa19,sum({$this->tableOrderDetail}.xsab08) as xsab08";
		$where['express'] = "{$this->tableName}.xsaa02 = :orderno";
		$where['value']['orderno'] = $orderno;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrderDetail, "{$this->tableName}.xsaa02 = {$this->tableOrderDetail}.xsab01")
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryRow();
		return $result;
	}


	/**
	 * @desc 获取财务人员工作提示
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function getCwryMessage(){
		$select = "count({$this->tableName}.xsaa01) orders";
		$where = "{$this->tableName}.xsaa29 = '未确认' ";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where,array());
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders'])){
			return array(
				'orders'=>0
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取物流人员工作提示
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function getWlryMessage(){
		$select = "count({$this->tableName}.xsaa01) orders";
		$where = "{$this->tableName}.xsaa29 = '待发货' ";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where,array());
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders'])){
			return array(
				'orders'=>0
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取地域统计报表（下单，确认，发货，拒收，签收）
	 * @param array $cond 查询条件
	 * @param string $type 类型（下单，确认，发货，拒收，签收）
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getDytjbbChart($cond,$type){
		$select = "SUM({$this->tableName}.xsaa19) money,COUNT({$this->tableName}.xsaa01) orders";
		$where['express'] = "{$this->tableName}.xsaa09 like '%". $cond['pro'] ."%' and {$this->tableName}.xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= "and {$this->tableName}.xsaa23 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= "and {$this->tableName}.xsaa23 <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa kh',"kh.khaa02 = {$this->tableName}.xsaa04")
//						->leftjoin('rylist as ry',"ry.username=kh.khaa32")
//						->leftjoin('deptset dept',"dept.depttext=ry.department")
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['money']) && empty($result[0]['orders'])){
			return array(
				'money'=>0,
				'orders'=>0
				);
		}
		return $result[0];
	}
	
}
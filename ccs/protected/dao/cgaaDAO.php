<?php
/**
 * @desc 客户表操作类
 * @author huyan
 * @date 2015-11-12 
 */
class cgaaDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-11-12
	 * @param string $className
	 * @return cgaaDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-11-12
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cgaa';
		$this->tableOrder = 'cgac';
		$this->primaryKey = 'cgaa01';
		//$this->createtime = 'khaa30';
	}

	/**
	 * @desc 获取最后一个采购单单号
	 * @return array $result 采购单结果信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function getMaxCgdNumber(){	
		$select = "{$this->tableName}.cgaa01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.cgaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取最大项目数
	 * @param string $id 采购单号
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function getMaxCount($id){
		$select = "{$this->tableName}.cgaa08,{$this->tableName}.cgaa12,{$this->tableName}.cgaa13,{$this->tableName}.cgaa19";
		$where['express'] = "{$this->tableName}.cgaa01 = '".$id."' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.cgaa19 DESC");
		$result = $this->dbCommand->queryAll(); 

		return $result[0];
	}

	/**
	 * @desc 获取采购单总价以及总数量
	 * @param string $id 采购单号
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getTotalPriceAndNum($id){
		$select = "{$this->tableName}.cgaa03,{$this->tableName}.cgaa04";
		$where['express'] = "{$this->tableName}.cgaa01 = '".$id."' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.cgaa01");
		$result = $this->dbCommand->queryAll(); 

		return $result[0];
	}

	/**
	 * @desc 获取最大项目数
	 * @param string $id 采购单号
	 * @param string $count 第几个项目
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function getSingleCgd($id,$count){
		$select = "{$this->tableName}.cgaa03,{$this->tableName}.cgaa05,{$this->tableName}.cgaa06,{$this->tableName}.cgaa07,{$this->tableName}.cgaa16";
		$where['express'] = "{$this->tableName}.cgaa01 = '".$id."' and {$this->tableName}.cgaa19 = ".$count." ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.cgaa11 DESC");
		$result = $this->dbCommand->queryAll(); 

		return $result;
	}

	/**
	 * @desc 根据查询条件获取已审核的采购单(退货总数 != 采购量)
	 * @param array $orderInfo 采购单查询条件
	 * @param array $orderStatusArr 订单状态
	 * @return array $result 订单财务审核列表信息
	 * @author WuJunhua
	 * @date 2015-12-14
	 */
	public function getAuditedPostedOrder($orderInfo,$orderStatusArr){
		$select = "{$this->tableOrder}.cgac02,{$this->tableOrder}.cgac03,{$this->tableOrder}.cgac04,{$this->tableOrder}.cgac06,{$this->tableOrder}.cgac12,{$this->tableName}.cgaa20,{$this->tableName}.cgaa09,{$this->tableName}.cgaa14,{$this->tableName}.cgaa03,{$this->tableName}.cgaa04,{$this->tableName}.cgaa08,{$this->tableName}.cgaa05,{$this->tableName}.cgaa06";
		$where['express'] = "{$this->tableName}.cgaa02 = :audited AND {$this->tableName}.cgaa04 != {$this->tableName}.cgaa16";
		$where['value'][':audited'] = $orderStatusArr['audited'];

		if(!empty($orderInfo)){
			if(!empty($orderInfo['purchaseNo'])){
				$where['express'].=" AND {$this->tableName}.cgaa01 = :purchaseNo";
				$where['value'][':purchaseNo'] = $orderInfo['purchaseNo'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.cgaa01 = {$this->tableOrder}.cgac02")
						->where($where['express'],$where['value'])
						->order("{$this->tableOrder}.cgac03 "." DESC");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取退货供应商的采购单[要入库、采购总额>退货金额且不等于已入账]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $CondList 查询条件
	 * @param array $orderStatus 采购单状态
	 * @return array $result 退货供应商的采购单信息
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function getReturnSuppliersOrder($page,$psize,$CondList,$orderStatus){	
		$select = "{$this->tableName}.cgaa01,{$this->tableName}.cgaa03,{$this->tableName}.cgaa04,{$this->tableName}.cgaa05,{$this->tableName}.cgaa06,{$this->tableName}.cgaa15,{$this->tableName}.cgaa16,{$this->tableName}.cgaa09";
		$where['express'] = " {$this->tableName}.cgaa03 > {$this->tableName}.cgaa15 AND {$this->tableName}.cgaa12 != :haveMoney AND {$this->tableName}.cgaa20 != ''";
	    $where['value'][':haveMoney'] = $orderStatus['haveMoney'];
	    
        if(!empty($CondList)){
        	if(!empty($CondList['gys'])){
				$where['express'].=" AND {$this->tableName}.cgaa09 = :gys";
				$where['value'][':gys'] = $CondList['gys'];
			}
			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 >=:xdsjq AND {$this->tableName}.cgaa06 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.cgaa01 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 获取已审核且未全部入库的采购单[入库类型为采购单入库]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $CondList 查询条件
	 * @return array $result 已审核且未全部入库的采购单信息
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function getAuditedPaidOrder($page,$psize,$CondList,$orderStatusArr){	
		$select = "{$this->tableName}.cgaa01,{$this->tableName}.cgaa03,{$this->tableName}.cgaa04,{$this->tableName}.cgaa05,{$this->tableName}.cgaa06,{$this->tableName}.cgaa08,{$this->tableName}.cgaa09";
		if($CondList['sign'] == 1){
			$where['express'] = "{$this->tableName}.cgaa20 != :warehousing AND {$this->tableName}.cgaa21 = :directStorage";
			$where['value'][':directStorage'] = $orderStatusArr['directStorage'];
		}else{
			$where['express'] = "{$this->tableName}.cgaa02 = :audited AND {$this->tableName}.cgaa20 != :warehousing AND {$this->tableName}.cgaa21 = :purchaseStorage";
			$where['value'][':audited'] = $orderStatusArr['audited'];
			$where['value'][':purchaseStorage'] = $orderStatusArr['purchaseStorage'];
		}
		$where['value'][':warehousing'] = $orderStatusArr['warehousing'];

        if(!empty($CondList)){
        	if(!empty($CondList['gys'])){
				$where['express'].=" AND {$this->tableName}.cgaa09 = :gys";
				$where['value'][':gys'] = $CondList['gys'];
			}
			//根据时间段查询
		    if(!empty($CondList['xdsjq'])&&!empty($CondList['xdsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 >=:xdsjq AND {$this->tableName}.cgaa06 <= :xdsjz";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		    if (!empty($CondList['xdsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 >=:xdsjq";
		    	$where['value'][':xdsjq'] = $CondList['xdsjq'];
		    }
		    if (!empty($CondList['xdsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 <=:xdsjz";
		    	$where['value'][':xdsjz'] = $CondList['xdsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.cgaa01 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 根据采购单号来获取采购单的相关明细信息
	 * @param string $purchaseNo 采购单号
	 * @return array $result 采购单的相关明细信息
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function getPurchaseOrderInfo($purchaseNo){	
		$select = "{$this->tableName}.cgaa09,{$this->tableOrder}.cgac03,{$this->tableOrder}.cgac04,{$this->tableOrder}.cgac05,{$this->tableOrder}.cgac06,{$this->tableOrder}.cgac07,{$this->tableOrder}.cgac08,{$this->tableOrder}.cgac14";
		$where['express'] = "{$this->tableName}.cgaa01 = :purchaseNo";
		$where['value'][':purchaseNo'] = $purchaseNo;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.cgaa01 = {$this->tableOrder}.cgac02")
						->where($where['express'],$where['value'])
						->order("{$this->tableOrder}.cgac03 "." DESC");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取退货供应商记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $orderStatus 采购单状态
	 * @param array $CondList 查询条件
	 * @return array $result 退货供应商记录列表信息
	 * @author WuJunhua
	 * @date 2016-03-11
	 */
	public function getReturnSupplierRecordList($page,$psize,$orderStatus,$CondList,$selectColumnStr=false){	
		$select = "{$this->tableName}.cgaa01,{$this->tableName}.cgaa09,{$this->tableName}.cgaa16,{$this->tableName}.cgaa15,{$this->tableName}.cgaa05,{$this->tableName}.cgaa06,{$this->tableName}.cgaa17,{$this->tableName}.cgaa18";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.cgaa19 = :finished";
		$where['value']['finished'] = $orderStatus['finished'];

		if(!empty($CondList)){
			if(!empty($CondList['cgdh'])){
				$where['express'].=" AND {$this->tableName}.cgaa01 like :cgdh";
				$where['value'][':cgdh'] = '%'.$CondList['cgdh'].'%';
			}
			if(!empty($CondList['gys'])){
				$where['express'].=" AND {$this->tableName}.cgaa09 = :gys ";
				$where['value'][':gys'] = $CondList['gys'];
			}
			//根据时间段查询
		    if(!empty($CondList['ddsjq'])&&!empty($CondList['ddsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 >=:ddsjq AND {$this->tableName}.cgaa06 <= :ddsjz";
		    	$where['value'][':ddsjq'] = $CondList['ddsjq'];
		    	$where['value'][':ddsjz'] = $CondList['ddsjz'];
		    }
		    if (!empty($CondList['ddsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 >=:ddsjq";
		    	$where['value'][':ddsjq'] = $CondList['ddsjq'];
		    }
		    if (!empty($CondList['ddsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.cgaa06 <=:ddsjz";
		    	$where['value'][':ddsjz'] = $CondList['ddsjz'];
		    }

		    if(!empty($CondList['rcsjq'])&&!empty($CondList['rcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.cgaa18 >=:rcsjq AND {$this->tableName}.cgaa18 <= :rcsjz";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
		    if (!empty($CondList['rcsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.cgaa18 >=:rcsjq";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    }
		    if (!empty($CondList['rcsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.cgaa18 <=:rcsjz";
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.cgaa18 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}


	/**
	 * @desc 获取供应商进销存报表明细（进货）
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-22
	 */
	public function getMygysjxcByCondJH($cond){
		$select = "sum({$this->tableName}.cgaa04) as num,sum({$this->tableName}.cgaa03) as money";
		$where['express'] = " {$this->tableName}.cgaa09 = '". $cond['gysname'] ."' and {$this->tableName}.cgaa06 >= '". $cond['beginDate'] ."' and {$this->tableName}.cgaa06 <= '". $cond['endDate'] ."' ";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],array());
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num']) && empty($result[0]['money'])){
			return array(
				'num' => 0,
				'money' => 0
				);
		}
		return $result[0];
	}

}


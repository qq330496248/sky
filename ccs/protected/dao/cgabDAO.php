<?php
/**
 * @desc 供应商表操作类
 * @author Dengshaocong
 * @date 2015-11-24
 */
class cgabDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2015-11-24
	 * @param string $className
	 * @return cgabDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2015-11-24
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cgab';
		$this->primaryKey = 'cgab01';
	}

	/**
	 * @desc 获取供应商中最末尾的编号
	 * @return array $result 供应商编号信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function getFinalGysNum(){
		$select = "{$this->tableName}.cgab01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("cgab01".' DESC');
		$result = $this->dbCommand->queryAll();
									   
		return $result;
	}
	/**
	 * @desc 根据条件获取供应商信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $gysInfo 条件
	 * @author Dengshaocong
	 * @date 2015-11-23 
	 */
	public function getGysByCond($page,$psize,$gysInfo){
		$select = "{$this->tableName}.cgab01,{$this->tableName}.cgab02,{$this->tableName}.cgab04,{$this->tableName}.cgab18,{$this->tableName}.cgab14,
					{$this->tableName}.cgab13,{$this->tableName}.cgab15,{$this->tableName}.cgab17,{$this->tableName}.cgab21,{$this->tableName}.cgab23";
		$where['express'] = "{$this->tableName}.cgab01 != '' ";
		$where['value'] = array();
		if(!empty($gysInfo)){
			if(!empty($gysInfo['id'])){
				$where['express'] .= " AND {$this->tableName}.cgab01 like :cgab01 ";
				$where['value'][':cgab01'] = '%'.$gysInfo['id'].'%';
			}
			if(!empty($gysInfo['name'])){
				$where['express'].=" AND {$this->tableName}.cgab02 like :cgab02 ";
				$where['value'][':cgab02'] = '%'.$gysInfo['name'].'%';
			}
			if(!empty($gysInfo['begindate'])){
				$where['express'].=" AND {$this->tableName}.cgab13 >= :begindate ";
				$where['value'][':begindate'] = $gysInfo['begindate'];
			}
			if(!empty($gysInfo['enddate'])){
				$where['express'].=" AND {$this->tableName}.cgab13 <= :enddate ";
				$where['value'][':enddate'] = $gysInfo['enddate'];
			}
			if(!empty($gysInfo['cgwy'])){
				$where['express'].=" AND {$this->tableName}.cgab20 = :cgwy ";
				$where['value'][':cgwy'] = $gysInfo['cgwy'];
			}
			if(!empty($gysInfo['cgzy'])){
				$where['express'].=" AND {$this->tableName}.cgab22 = :cgzy ";
				$where['value'][':cgzy'] = $gysInfo['cgzy'];
			}
			if(!empty($gysInfo['money'])){
				$where['express'].=" AND {$this->tableName}.cgab18 ".$gysInfo['money'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("cgab01 DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
									   
		return $result;
	}
	/**
	 * @desc 获取供应商信息
	 * @author Dengshaocong
	 * @date 2015-11-23 
	 */	
	public function getGys(){
		$select = "{$this->tableName}.cgab01,{$this->tableName}.cgab02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("cgab01 DESC");
		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}

	public function getGysByFl($cpfl){
		
	}


	/**
	 * @desc 获取所有供应商
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2016-01-12
	 */
	public function getSupplierOptions(){
		$select = "{$this->tableName}.cgab02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.cgab17 ",'DESC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取所有供应商
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2016-01-12
	 */
	public function getGysForReport($condInfo,$page,$psize){
		$select = "{$this->tableName}.cgab01,{$this->tableName}.cgab02,{$this->tableName}.cgab04,{$this->tableName}.cgab20,{$this->tableName}.cgab21,{$this->tableName}.cgab22,{$this->tableName}.cgab23";
		$where['express'] = "{$this->tableName}.cgab01 != '' ";
		$where['value'] = array();
		if(!empty($gysInfo)){
			if(!empty($gysInfo['id'])){
				$where['express'] .= " AND {$this->tableName}.cgab01 like :cgab01 ";
				$where['value'][':cgab01'] = '%'.$gysInfo['id'].'%';
			}
			if(!empty($gysInfo['name'])){
				$where['express'].=" AND {$this->tableName}.cgab02 like :cgab02 ";
				$where['value'][':cgab02'] = '%'.$gysInfo['name'].'%';
			}
			if(!empty($gysInfo['begindate'])){
				$where['express'].=" AND {$this->tableName}.cgab13 >= :begindate ";
				$where['value'][':begindate'] = $gysInfo['begindate'];
			}
			if(!empty($gysInfo['enddate'])){
				$where['express'].=" AND {$this->tableName}.cgab13 <= :enddate ";
				$where['value'][':enddate'] = $gysInfo['enddate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("cgab01 DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
									   
		return $result;
	}

	/**
	 * @desc 获取供应商统计报表（采购量）
	 * @param array $condInfo  查询条件
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-02-22
	 */
	public function getGystjbbByCondCG($condInfo){
		$select = "SUM(cgaa03) totalMoney,SUM(cgaa04) totalNum,SUM(cgaa08) totalFreight";
		$where['express'] = " {$this->tableName}.cgab01 = '".$condInfo['gysID']."' ";
		$where['value'] = array();
		/*if(!empty($condInfo['begindate'])){
			$where['express'] = " {$this->tableName}.cgab06 > :begindate ";
			$where['value'][':begindate'] = $condInfo['begindate'];
		}
		if(!empty($condInfo['enddate'])){
			$where['express'] = " {$this->tableName}.cgab06 > :enddate ";
			$where['value'][':enddate'] = $condInfo['enddate'];
		}*/
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cgaa',"{$this->tableName}.cgab01 = cgaa.cgaa14")
						->where($where['express'],$where['value'])
						->order("cgab01 DESC");
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['totalNum']) || empty($result[0]['totalMoney'])){
			return array(
				'totalMoney'=>'0',
				'totalNum'=>'0',
				'totalFreight'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取供应商统计报表（库存量）
	 * @param array $condInfo  查询条件
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-02-22
	 */
	public function getGystjbbByCondKC($condInfo){
		$select = "SUM(cpae03) totalNum";
		$where['express'] = " {$this->tableName}.cgab01 = '".$condInfo['gysID']."' ";
		$where['value'] = array();
		/*if(!empty($condInfo['begindate'])){
			$where['express'] = " {$this->tableName}.cgab06 > :begindate ";
			$where['value'][':begindate'] = $condInfo['begindate'];
		}
		if(!empty($condInfo['enddate'])){
			$where['express'] = " {$this->tableName}.cgab06 > :enddate ";
			$where['value'][':enddate'] = $condInfo['enddate'];
		}*/
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpaa',"{$this->tableName}.cgab01 = cpaa.cpaa18")
						->leftjoin('cpae',"cpaa.cpaa01 = cpae.cpae02")
						->where($where['express'],$where['value'])
						->order("cgab01 DESC");
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['totalNum'])){
			return array(
				'totalNum'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取供应商统计报表（发货量）
	 * @param array $condInfo  查询条件
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-02-22
	 */
	public function getGystjbbByCondFH($condInfo){
		$select = "SUM(cgaa03) totalMoney,SUM(cgaa04) totalNum,SUM(cgaa08) totalFreight";
		$where['express'] = " {$this->tableName}.cgab01 = '".$condInfo['gysID']."' and cgaa.cgaa02 = '已审核' and cgaa.cgaa12 = '已打款' and cgaa.cgaa13 = '未完成' ";
		$where['value'] = array();
		/*if(!empty($condInfo['begindate'])){
			$where['express'] = " {$this->tableName}.cgab06 > :begindate ";
			$where['value'][':begindate'] = $condInfo['begindate'];
		}
		if(!empty($condInfo['enddate'])){
			$where['express'] = " {$this->tableName}.cgab06 > :enddate ";
			$where['value'][':enddate'] = $condInfo['enddate'];
		}*/
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cgaa',"{$this->tableName}.cgab01 = cgaa.cgaa14")
						->where($where['express'],$where['value'])
						->order("cgab01 DESC");
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['totalNum']) || empty($result[0]['totalMoney'])){
			return array(
				'totalMoney'=>'0',
				'totalNum'=>'0',
				'totalFreight'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取供应商统计报表（收货量）
	 * @param array $condInfo  查询条件
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-02-22
	 */
	public function getGystjbbByCondSH($condInfo){
		$select = "SUM(cgaa03) totalMoney,SUM(cgaa04) totalNum,SUM(cgaa08) totalFreight";
		$where['express'] = " {$this->tableName}.cgab01 = '".$condInfo['gysID']."' and cgaa.cgaa13 = '已完成' ";
		$where['value'] = array();
		/*if(!empty($condInfo['begindate'])){
			$where['express'] = " {$this->tableName}.cgab06 > :begindate ";
			$where['value'][':begindate'] = $condInfo['begindate'];
		}
		if(!empty($condInfo['enddate'])){
			$where['express'] = " {$this->tableName}.cgab06 > :enddate ";
			$where['value'][':enddate'] = $condInfo['enddate'];
		}*/
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cgaa',"{$this->tableName}.cgab01 = cgaa.cgaa14")
						->where($where['express'],$where['value'])
						->order("cgab01 DESC");
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['totalNum']) || empty($result[0]['totalMoney'])){
			return array(
				'totalMoney'=>'0',
				'totalNum'=>'0',
				'totalFreight'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 根据条件获取供应商信息（与之前一个类似的方法，查询条件不同，用于供应商进销存报表）
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $cond 条件
	 * @author Dengshaocong
	 * @date 2016-03-22
	 */
	public function getAllGysByCond($page,$psize,$cond){
		$select = "{$this->tableName}.cgab01,{$this->tableName}.cgab02,{$this->tableName}.cgab04,{$this->tableName}.cgab18,{$this->tableName}.cgab14,
					{$this->tableName}.cgab13,{$this->tableName}.cgab15,{$this->tableName}.cgab17,{$this->tableName}.cgab21,{$this->tableName}.cgab23";
		$where['express'] = "{$this->tableName}.cgab01 != '' ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['gysid'])){
				$where['express'] .= " and {$this->tableName}.cgab01 like :gysid ";
				$where['value'][':gysid'] = '%'.$cond['gysid'].'%';
			}
			if(!empty($cond['gysname'])){
				$where['express'] .= " and {$this->tableName}.cgab02 like :gysname ";
				$where['value'][':gysname'] = '%'.$cond['gysname'].'%';
			}
			if(!empty($cond['jkfs'])){
				$where['express'] .= " and {$this->tableName}.cgab15 = :jkfs ";
				$where['value'][':jkfs'] = $cond['jkfs'];
			}
			if(!empty($cond['gysfl'])){
				$where['express'] .= " and {$this->tableName}.cgab19 = :gysfl ";
				$where['value'][':gysfl'] = $cond['gysfl'];
			}
			if(!empty($cond['cgwy'])){
				$where['express'] .= " and {$this->tableName}.cgab20 = :cgwy ";
				$where['value'][':cgwy'] = $cond['cgwy'];
			}
			if(!empty($cond['beginDate'])){
				$where['express'] .= " and {$this->tableName}.cgab17 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("cgab01 DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();								   
		return $result;
	}
}
?>
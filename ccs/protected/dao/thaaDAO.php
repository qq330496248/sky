<?php
/**
 * @desc 通话记录表操作类
 * @author WuJunhua
 * @date 2016-01-28
 */
class thaaDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2016-01-28 
	 * @param string $className
	 * @return thaaDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2016-01-28
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'thaa';
		$this->primaryKey = 'thaa01';
		$this->tableClient = 'khaa';
		$this->tableRylist = 'rylist';
		$this->createtime = 'thaa06';
	}

	/**
	 * @desc 根据号码获取通话记录里的客户信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author WuJunhua
	 * @date 2016-01-28
	 */
	public function getClientInfoByNumber($page,$psize,$CondList){	
	    $where['express'] = "{$this->tableName}.thaa01 > 0 ";
		$where['value'] = array();
		if(!empty($CondList)){
			if(!empty($CondList['zjhm'])){
				$where['express'].=" AND {$this->tableName}.thaa02 like :zjhm";
				$where['value'][':zjhm'] = '%'.$CondList['zjhm'].'%';
			}
			if(!empty($CondList['bjhm'])){
				$where['express'].=" AND {$this->tableName}.thaa03 like :bjhm";
				$where['value'][':bjhm'] = '%'.$CondList['bjhm'].'%';
			}
			if(!empty($CondList['khid'])){
				$where['express'].=" AND {$this->tableClient}.khaa02 like :khid";
				$where['value'][':khid'] = '%'.$CondList['khid'].'%';
			}
			if(!empty($CondList['thgh'])){
				$where['express'].=" AND {$this->tableClient}.khaa32 like :thgh";
				$where['value'][':thgh'] = '%'.$CondList['thgh'].'%';
			}
			if(!empty($CondList['khly'])){
				$where['express'].=" AND {$this->tableClient}.khaa25 like :khly";
				$where['value'][':khly'] = '%'.$CondList['khly'].'%';
			}

			if(!empty($CondList['thfj'])){
				$where['express'].=" AND {$this->tableRylist}.fenji like :thfj";
				$where['value'][':thfj'] = '%'.$CondList['thfj'].'%';
			}
			//根据时间段查询
		    if(!empty($CondList['khzcsjq'])&&!empty($CondList['khzcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.thaa06 >=:khzcsjq AND {$this->tableName}.thaa06 <= :khzcsjz";
		    	$where['value'][':khzcsjq'] = $CondList['khzcsjq'];
		    	$where['value'][':khzcsjz'] = $CondList['khzcsjz'];
		    }
		    if (!empty($CondList['khzcsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.thaa06 >=:khzcsjq";
		    	$where['value'][':khzcsjq'] = $CondList['khzcsjq'];
		    }
		    if (!empty($CondList['khzcsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.thaa06 <=:khzcsjz";
		    	$where['value'][':khzcsjz'] = $CondList['khzcsjz'];
		    }
		}	
		$select = "{$this->tableName}.thaa02,{$this->tableName}.thaa03,{$this->tableRylist}.username,{$this->tableRylist}.personname,{$this->tableClient}.khaa02,{$this->tableClient}.khaa03,{$this->tableClient}.khaa32,{$this->tableClient}.khaa25,{$this->tableClient}.khaa12,{$this->tableClient}.khaa22,{$this->tableName}.thaa09,{$this->tableName}.thaa06,{$this->tableName}.thaa05";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableClient, "{$this->tableName}.thaa02 = {$this->tableClient}.khaa06")
						->leftJoin($this->tableRylist, "{$this->tableName}.thaa03 = {$this->tableRylist}.fenji")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableClient, "{$this->tableName}.thaa02 = {$this->tableClient}.khaa06")
										   ->leftJoin($this->tableRylist, "{$this->tableName}.thaa03 = {$this->tableRylist}.fenji")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}

	/**
	 * @desc 系统设置->数据清理->查询要删除的通话记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function getCallRecordToBeDel($thsjq,$thsjz){
		$where['express'] = "{$this->tableName}.thaa01>0";
		$where['value'] = array();
		if(!empty($thsjq)&&!empty($thsjz)){
	    	$where['express'] .= " AND {$this->tableName}.thaa06 >=:thsjq AND {$this->tableName}.thaa06 <= :thsjz";
	    	$where['value'][':thsjq'] =$thsjq;
	    	$where['value'][':thsjz'] =$thsjz;
	    }
	    if(!empty($thsjq)){
	    	$where['express'] .= " AND {$this->tableName}.thaa06 >=:thsjq";
	    	$where['value'][':thsjq'] =$thsjq;
	    }
	     if(!empty($thsjz)){
	    	$where['express'] .= " AND {$this->tableName}.thaa06 <=:thsjz";
	    	$where['value'][':thsjz'] =$thsjz;
	    }
		$select = "{$this->tableName}.thaa01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取客户通话记录
	 * @author huyan
	 * @date 2016-03-02
	 */
	public function GetCallRecords($khphonecall,$page,$psize){	
		$select = "{$this->tableName}.thaa01,{$this->tableName}.thaa03,{$this->tableName}.thaa05,{$this->tableName}.thaa06,{$this->tableName}.thaa09";
		$where['express'] = "{$this->tableName}.thaa03 = :khphonecall";
		$where['value']['khphonecall'] = $khphonecall;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value'])
						->order("{$this->createtime} ".' DESC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取分机通话记录报表——已接电话
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getFjthtjbbByCondReceived($cond){
		$select = "{$this->tableName}.thaa05";
		$where['express'] = "{$this->tableName}.thaa03 = '".$cond['fenji']."' and {$this->tableName}.thaa09 = 'ANSWERED' ";
		$where['value'] = array();
		if($cond['beginDate']){
			$where['express'] .= " and {$this->tableName}.thaa06 >= :beginDate ";
			$where['value']['beginDate'] = $cond['beginDate']; 
		}
		if($cond['endDate']){
			$where['express'] .= " and {$this->tableName}.thaa06 <= :endDate ";
			$where['value']['endDate'] = $cond['endDate']; 
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取分机通话记录报表——未接电话
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getFjthtjbbByCondMissed($cond){
		$select = "a.thaa05";
		$where['express'] = " a.thaa09 = 'NO ANSWER' ";
		$where['value'] = array();
		if($cond['beginDate']){
			$where['express'] .= " and a.thaa06 >= :beginDate";
			$where['value']['beginDate'] = $cond['beginDate']; 
		}
		if($cond['endDate']){
			$where['express'] .= " and a.thaa06 <= :endDate";
			$where['value']['endDate'] = $cond['endDate']; 
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from("(SELECT {$this->tableName}.`thaa05`,{$this->tableName}.thaa06,{$this->tableName}.thaa09 FROM {$this->tableName} WHERE {$this->tableName}.thaa03 = '".$cond['fenji']."' OR {$this->tableName}.thaa02 = '".$cond['fenji']."') a")
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取分机通话记录报表——已拨电话
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getFjthtjbbByCondDialed($cond){
		$select = "{$this->tableName}.thaa05";
		$where['express'] = " {$this->tableName}.thaa02 = '".$cond['fenji']."' and {$this->tableName}.thaa09 = 'ANSWERED' ";
		$where['value'] = array();
		if($cond['beginDate']){
			$where['express'] .= " and {$this->tableName}.thaa06 >= :beginDate ";
			$where['value']['beginDate'] = $cond['beginDate']; 
		}
		if($cond['endDate']){
			$where['express'] .= " and {$this->tableName}.thaa06 <= :endDate ";
			$where['value']['endDate'] = $cond['endDate']; 
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();

		return $result;
	}

}

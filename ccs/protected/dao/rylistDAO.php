<?php
/**
 * @desc 登录操作类
 * @author DengShaocong
 * @date 2015-10-27 
 */
class rylistDAO extends baseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-10-27
	 * @param string $className
	 * @return rylistDAO
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
		$this->tableName = 'rylist';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 获取考员工工号列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 员工工号信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getAllGh($page,$psize){	
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.pwd,
					{$this->tableName}.limitIp,{$this->tableName}.limitMAC,{$this->tableName}.personname,qxjs.qxjs";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('qxjs',"{$this->tableName}.post=qxjs.id")
						//->limit($psize, $psize * ($page - 1))
						->order("id".' ASC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	

									   
		return $result;
	}
	/**
	 * @desc 根据条件获取员工工号列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $ryInfo 查询条件
	 * @return array $result 员工工号信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getRylistByCond($page,$psize,$ryInfo,$selectColumnStr=false){	
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.pwd,{$this->tableName}.enabled,{$this->tableName}.fenji,{$this->tableName}.loginIp,{$this->tableName}.managerPower,{$this->tableName}.loginTime,{$this->tableName}.telephone,{$this->tableName}.limitIp,{$this->tableName}.limitMAC,{$this->tableName}.isonline,{$this->tableName}.personname,{$this->tableName}.postID,{$this->tableName}.post";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}		
		$where['express'] = "{$this->tableName}.id > 0";
		$where['value'] = array();

		if(!empty($ryInfo)){
			if(!empty($ryInfo['username'])){
				$where['express'].=" AND {$this->tableName}.username like :username";
				$where['value'][':username'] = '%'.$ryInfo['username'].'%';
			}
			if(!empty($ryInfo['personname'])){
				$where['express'].=" AND {$this->tableName}.personname like :personname ";
				$where['value'][':personname'] = '%'.$ryInfo['qxjsid'].'%';
			}
			if(!empty($ryInfo['groupbh'])){
				$where['express'].=" AND {$this->tableName}.postID like :groupbh ";
				$where['value'][':groupbh'] = '%'.$ryInfo['groupbh'].'%';
			}
			if(!empty($ryInfo['dept'])){
				$where['express'].=" AND {$this->tableName}.department = :dept ";
				$where['value'][':dept'] = $ryInfo['dept'];
			}
			if(!empty($ryInfo['isonline'])){
				$where['express'].=" AND {$this->tableName}.isonline like :isonline ";
				$where['value'][':isonline'] = '%'.$ryInfo['isonline'].'%';
			}
			if(!empty($ryInfo['enabled'])){
				$where['express'].=" AND {$this->tableName}.enabled like :enabled ";
				$where['value'][':enabled'] = '%'.$ryInfo['enabled'].'%';
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("id".' DESC');

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										//   ->leftjoin('groupright',"{$this->tableName}.postID=groupright.groupbh")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
	/**
	 * @desc 获取员工工号列表信息
	 * @return array $result 员工工号信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getRylistForSelect(){
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.pwd,{$this->tableName}.enabled,
					{$this->tableName}.loginIp,{$this->tableName}.managerPower,{$this->tableName}.loginTime,
					{$this->tableName}.limitIp,{$this->tableName}.limitMAC,{$this->tableName}.isonline,
					{$this->tableName}.enabled,{$this->tableName}.personname,groupright.groupname";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('groupright',"{$this->tableName}.postID=groupright.groupbh")
						->order("id".' ASC');

		$result['info'] = $this->dbCommand->queryAll();

		return $result;
	}

	/**
	 * @desc 根据权限角色编号获取员工工号信息
	 * @return array $result 员工工号信息
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function getRylistByGroupbh($groupbh){
		$select = "{$this->tableName}.id,{$this->tableName}.username";

		$where['express'] = "{$this->tableName}.postID = '".$groupbh."' ";
		$where['value'] = array();

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("id".' ASC');

		$result['info'] = $this->dbCommand->queryAll();

		return $result;
	}
	
	/**
	 * @desc 根据部门编号获取员工工号信息
	 * @param string $dept 部门名称
	 * @return array $result 员工工号信息
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function getRylistByBm($dept){
		$select = "{$this->tableName}.id,{$this->tableName}.username";

		$where['express'] = "{$this->tableName}.department = ".$dept." ";
		$where['value'] = array();

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("id".' ASC');

		$result['info'] = $this->dbCommand->queryAll();

		return $result;
	}

	/**
	 * @desc 获取所有工号信息
	 * @return array $result 权限角色信息
	 * @author WuJunhua
	 * @date 2015-11-16
	 */
	public function getAllWorkNumber(){	
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.personname,{$this->tableName}.fenji";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("id".' ASC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

		/**
	 * @desc 获取当前工号的下属工号（用于转下属客户）
	 * @return array $result 权限角色信息
	 * @author huyan
	 * @date 2016-03-04
	 */
	public function getAllSuborWorkNumber($sjghid){	
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.personname";
		$where['express'] = "{$this->tableName}.higherlevel = :sjghid";
		$where['value']['sjghid'] = $sjghid;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("id".' ASC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc获取工号姓名
	 * @return array $result 权限角色信息
	 * @author huyan
	 * @date 2015-11-16
	 * modify huyan 2015-12-30 分页
	 */
	public function getNamNumber($cond,$page,$psize){	
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.personname";
		$where['express'] = "{$this->tableName}.id != '' ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['dept'])){
				$where['express'] .= " and {$this->tableName}.department = :dept ";
				$where['value'][':dept'] = $cond['dept'];
			}
			if(!empty($cond['gh'])){
				$where['express'] .= " and {$this->tableName}.username like :gh ";
				$where['value'][':gh'] = '%'.$cond['gh'].'%';
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("id".' ASC');
		$result['info'] = $this->dbCommand->queryAll();
		 $result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
		 								   ->from($this->tableName)
		 								   ->where($where['express'],$where['value'])
		 								   ->queryScalar();
		return $result;
	}

	/**
	 * @desc查询工号姓名
	 * @return array $result 权限角色信息
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function getUserNumber($searchtype,$keyword){	
		if($searchtype==1){
			$where['express'] = "{$this->tableName}.username = :gonghao";
			$where['value']['gonghao'] = $keyword;
		}
		if($searchtype==2){
			$where['express'] = "{$this->tableName}.personname = :xingming";
			$where['value']['xingming'] = $keyword;
		}
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.personname";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
						/*->order("id".' ASC');*/
		$result = $this->dbCommand->queryrow();
		return $result;
	}

	/**
	 * @desc查询工号姓名
	 * @return array $result 权限角色信息
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function getJobNumber($JobNumber){

		$where['express'] = "{$this->tableName}.username = :JobNumber";
		$where['value']['JobNumber'] = $JobNumber;
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.personname";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
						/*->order("id".' ASC');*/
		$result = $this->dbCommand->queryrow();
		
		return $result;
	}

	/**
	 * @desc群发时获取工号
	 * @return array $result 权限角色信息
	 * @author huyan
	 * @date 2015-12-22
	 */
	public function getnameAndNumber(){	
		$select = "{$this->tableName}.username";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("id".' ASC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取采购文员列表
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-01-12
	 */
	public function getCgwyList(){
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.personname";
		$where['express'] = "groupright.groupname = '采购人员'";
		$where['value'] = array();
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('groupright',"{$this->tableName}.postID=groupright.groupbh")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取采购专员列表
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-01-12
	 */
	public function getCgzyList(){
		$select = "{$this->tableName}.id,{$this->tableName}.username,{$this->tableName}.personname";
		$where['express'] = "groupright.groupname = '采购专员'";
		$where['value'] = array();
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('groupright',"{$this->tableName}.postID=groupright.groupbh")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		
		return $result;
	}

	/**
	 * @desc根据工号查找姓名
	 * @return array $result 
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function getTransfername($khgh2){

		$where['express'] = "{$this->tableName}.username = :khgh2";
		$where['value']['khgh2'] = $khgh2;
		$select = "{$this->tableName}.personname";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryrow();
		
		return $result;
	}

	/**
	 * @desc 获取所有业务员工
	 * @author DengShaocong
	 * @date 2016-02-19
	 */
	public function selectAllByNothing(){
		$select= "*";
		$where = "dept.ifmarket='是'";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->leftjoin('deptset dept',"{$this->tableName}.department=dept.depttext")
						->where($where,array())
						->from($this->tableName);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取所有员工
	 * @author DengShaocong
	 * @date 2016-02-19
	 */
	public function selectAll(){
		$select= "*";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取员工业绩统计报表（下单，审单，发货，拒收，签收）
	 * @param array $cond 查询条件
	 * @param string $type 类型（下单，审单，发货，拒收，签收）
	 * @author DengShaocong
	 * @date 2016-02-19
	 */
	public function getYgyjtjbbByCond($cond,$type){
		$select = "SUM(xsaa19) money,count(xsaa01) orders";
		$where['express'] = " {$this->tableName}.personname = '" . $cond['personname'] . "' ";
		$where['value'] = array();
		if(!empty($type)){
			$where['express'] .= " AND xs.`xsaa29` in ($type) ";
		}
		if(!empty($cond)){
			if(!empty($cond['orderBeginDate'])){
				$where['express'] .= "and xs.xsaa24 >= :orderBeginDate ";
				$where['value'][':orderBeginDate'] = $cond['orderBeginDate'].' 00:00:00';
			}
			if(!empty($cond['orderEndDate'])){
				$where['express'] .= "and xs.xsaa24 <= :orderEndDate ";
				$where['value'][':orderEndDate'] = $cond['orderEndDate'].' 23:59:59';
			}
			if(!empty($cond['accBeginDate'])){
				$where['express'] .= "and xs.xsaa28 >= :accBeginDate ";
				$where['value'][':accBeginDate'] = $cond['accBeginDate'].' 00:00:00';
			}
			if(!empty($cond['accEndDate'])){
				$where['express'] .= "and xs.xsaa28 <= :accEndDate ";
				$where['value'][':accEndDate'] = $cond['accEndDate'].' 23:59:59';
			}
			if(!empty($cond['media'])){
				$where['express'] .= "and kh.khaa22 = :media ";
				$where['value'][':media'] = $cond['media'];
			}
		}
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa as kh',"{$this->tableName}.username = kh.khaa32")
						->leftjoin('xsaa as xs',"xs.xsaa04 = kh.khaa02")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.username");
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders'])){
			return array(
				'money'=>'0',
				'orders'=>'0'
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取员工业绩统计报表（人数）
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-19
	 */
	public function getYgyjtjbbByCondRS($cond){
		$select = "COUNT(khaa01) num";
		$where['express'] = " {$this->tableName}.personname = '" . $cond['personname'] . "' ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['orderBeginDate'])){
				$where['express'] .= "and kh.khaa30 >= :orderBeginDate ";
				$where['value'][':orderBeginDate'] = $cond['orderBeginDate'];
			}
			if(!empty($cond['orderEndDate'])){
				$where['express'] .= "and kh.khaa30 <= :orderEndDate ";
				$where['value'][':orderEndDate'] = $cond['orderEndDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa as kh',"{$this->tableName}.username=kh.khaa32")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.username");
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'num'=>'0'
				);
		}
		return $result[0];
	}
	
   /**
	* @desc 把在线状态改为离线的状态(js定时器每1分钟检测一次)
	* @param  $nowTime string 当前操作时间
	* @param  $lineArr array 是否在线状态
	* @return int $result 结果信息
	* @author WuJunhua
	* @date 2016-02-25
	*/
    public function updateLineStatus($nowTime,$lineArr){
    	$this->dbCommand->reset();
    	$sql = "update {$this->tableName} set isonline = '{$lineArr['offline']}' where UNIX_TIMESTAMP('{$nowTime}') - UNIX_TIMESTAMP(opetime) > 120 and isonline = '{$lineArr['online']}'";
    	$result = $this->dbConnection->createCommand($sql)->execute();
    	return $result;
    }

    /**
	 * @desc 获取员工考核统计信息
	 * @param array $cond 查询条件
	 * @param string $type 考核项目类型（T奖，F罚）
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
    public function getYgkhtjbbByCond($cond,$type){
    	$select = "COUNT(e.id) num,sum(xm.score) score";
		$where['express'] = " {$this->tableName}.personname = '" . $cond['personname'] . "' and xm.type = '$type' ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= "and e.lrdate >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= "and e.lrdate <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('examine e',"{$this->tableName}.id=e.ryid")
						->leftjoin('khxm xm',"e.xmid=xm.id")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num'])){
			return array(
				'num'=>'0',
				'score'=>'0'
				);
		}
		return $result[0];
    }

    /**
	 * @desc 获取员工业绩统计报表（下单，审单，签收）
	 * @param array $cond 查询条件
	 * @param string $type 类型（下单，审单，签收）
	 * @author DengShaocong
	 * @date 2016-02-19
	 */
	public function getJxyjbbByCond($cond,$type){
		$select = "SUM(xsaa17) money,count(xsaa01) orders";
		$where['express'] = " {$this->tableName}.personname = '" . $cond['personname'] . "' ";
		$where['value'] = array();
		if(!empty($type)){
			$where['express'] .= " AND xs.`xsaa29` in ($type) ";
		}
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= "and xs.xsaa61 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= "and xs.xsaa61 <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}	
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('xsaa as xs',"{$this->tableName}.username = xs.`xsaa48`")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.username");
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'money'=>'0',
				'orders'=>'0'
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取接线有效率报表——获取拨号信息（拨号数，接听数）
	 * @param array $cond 查询条件
	 * @param string $type 类型（拨号数，接听数）
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getJxyxlbbBH($cond,$type){
		$select = "count(thaa01) num";
		$where['express'] = "{$this->tableName}.personname = '". $cond['personname'] ."' ";
		$where['value'] = array();
		if($type != ''){
			$where['express'] .= " and th.thaa09 = '". $type ."' ";
		}
		if(!empty($cond['beginDate'])){
			$where['express'] .= "and th.thaa06 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= "and th.thaa06 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('thaa as th',"{$this->tableName}.fenji = th.`thaa02`")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'num'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取接线有效率报表——获取无效用户数
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getJxyxlbbWXKH($cond){
		$select = "COUNT(khaa01) num";
		$where['express'] = " {$this->tableName}.personname = '" . $cond['personname'] . "' and kh.khaa23 = '无效资料' ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= "and kh.khaa30 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= "and kh.khaa30 <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa as kh',"{$this->tableName}.username=kh.khaa32")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.username");
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'num'=>'0'
				);
		}
		return $result[0];
	}


	public function getTenJobnumList($goodName){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa06,{$this->tableName}.cpaa10,sum({$this->tableStock}.cpae03) as cpae03";
		$where['express'] = "{$this->tableName}.cpaa01 > 0";
		$where['value'] = array();
		if(!empty($goodName)){
			$where['express'].=" AND {$this->tableName}.cpaa02 like :goodName";
			$where['value'][':goodName'] = '%'.$goodName.'%';
		}
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin("{$this->tableStock}","{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.cpaa01")
						->limit(10,0)
						->order("cpaa01".' DESC');
		$result = $this->dbCommand->queryAll();
	}

	/**
	 * @desc 获取当前在线人数
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function getOnlinePeopleNum(){
		$select = "COUNT(*) num";
		$where['express'] = " {$this->tableName}.isonline = 'T' ";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return 0;
		}
		return $result[0]['num'];
	}
















	/**
	 * @desc 获取员工业绩统计图表——详情
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function getYgyjtjbbChart($cond,$type){
		$select = "SUM(xsaa19) money,count(xsaa01) orders";
		$where['express'] = " {$this->tableName}.personname = '" . $cond['name'] . "' ";
		$where['value'] = array();
		if(!empty($type)){
			$where['express'] .= " AND xs.`xsaa29` in ($type) ";
		}
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= "and xs.xsaa23 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= "and xs.xsaa23 <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
			}
		}	
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('xsaa as xs',"{$this->tableName}.username = xs.`xsaa48`")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.username");
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders'])){
			return array(
				'money'=>0,
				'orders'=>0
				);
		}
		return $result[0];
	}
}

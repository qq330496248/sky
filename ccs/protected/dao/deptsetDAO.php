<?php
/**
 * @desc 权限组表操作类
 * @author DengShaocong
 * @date 2015-11-9
 */
class deptsetDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-9
	 * @param string $className
	 * @return deptsetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'deptset';
		$this->primaryKey = 'deptid';
	}
	/**
	 * @desc 获取部门列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function getAllDept(){	
		$select = "dept.deptid,dept.depttext as deptname,dept.ifmarket,dept.level";
		$where = "dept.deptID > 1";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName." as dept")
						->leftJoin('deptset as higher', "dept.higherlevel = higher.deptID")
						->where($where,array())
						->order("dept.level".' ASC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
									   
		return $result;
	}

	/**
	 * @desc 获取一个部门的信息
	 * @param int $level 当前等级
	 * @param int $higherdept 上一级部门的编号
	 * @param int $limit 从第几个开始取（以0位开头）
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function getSingleDept($level,$higherdept,$limit){	
		$select = "{$this->tableName}.deptid,{$this->tableName}.depttext,{$this->tableName}.ifmarket,{$this->tableName}.higherlevel,{$this->tableName}.level";
		$where['experss'] = "{$this->tableName}.level = ".$level." and {$this->tableName}.higherlevel = ".$higherdept;
		$where['value'] = array(); 
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.deptid".' ASC')
						->where($where['experss'],$where['value'])
						->limit(1,$limit);
		$result = $this->dbCommand->queryAll();	
		if($result){
			return $result[0];
		}							   
		return null;
	}

	/**
	 * @desc 获取某一部门的下级部门的数量
	 * @param int $level 当前等级（0为一级部门）
	 * @param int $higherdept 上一级部门的编号（0为一级部门）
	 * @return array $result 部门列表信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function getCurrentLevelNum($level,$higherdept){
		$select = "count(*) as count";
		$where['experss'] = "{$this->tableName}.level = ".$level." and {$this->tableName}.higherlevel = ".$higherdept;
		$where['value'] = array(); 
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['experss'],$where['value']);
		$result = $this->dbCommand->queryAll();
									   
		return $result[0];
	}


	/**
	 * @desc  获取最后一个主键
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getMaxDeptNumber(){
		$select = "{$this->tableName}.deptid";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.deptid ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 根据上级部门编号获取部门
	 * @param int $highid 上级部门ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function getBmByHigher($highid){
		$select = "{$this->tableName}.deptid";
		$where['experss'] = "{$this->tableName}.higherlevel = ".$highid;
		$where['value'] = array(); 
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['experss'],$where['value']);
		$result = $this->dbCommand->queryAll();
									   
		return $result;
	}


	/**
	 * @desc 获取分组业绩统计报表（下单，审单，发货，拒收，签收）
	 * @param array $cond 查询条件
	 * @param string $type 类型（下单，审单，发货，拒收，签收）
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getFzyjtjbbByCond($cond,$type){
		$select = "SUM(xsaa19) money,count(xsaa01) orders";
		$where['express'] = "{$this->tableName}.depttext = '".$cond['dept']."' ";
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
			if(!empty($cond['khyx'])){
				$where['express'] .= "and kh.khaa25 = :khyx ";
				$where['value'][':khyx'] = $cond['khyx'];
			}
			if(!empty($cond['media'])){
				$where['express'] .= "and kh.khaa22 = :media ";
				$where['value'][':media'] = $cond['media'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('rylist as ry',"{$this->tableName}.depttext=ry.department")
						->leftjoin('khaa as kh',"ry.username = kh.khaa32")
						->leftjoin('xsaa as xs',"xs.xsaa04 = kh.khaa02")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.depttext");
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
	 * @desc 获取分组业绩统计报表（人数）
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getFzyjtjbbByCondRS($cond){
		$select = "COUNT(khaa01) num";
		$where['express'] = "{$this->tableName}.depttext = '".$cond['dept']."' ";
		$where['value'] = array();
		if(!empty($type)){
			$where['express'] .= " AND xs.`xsaa29` in ($type) ";
		}
		if(!empty($cond)){
			if(!empty($cond['orderBeginDate'])){
				$where['express'] .= "and kh.khaa30 >= :orderBeginDate ";
				$where['value'][':orderBeginDate'] = $cond['orderBeginDate'];
			}
			if(!empty($cond['orderEndDate'])){
				$where['express'] .= "and kh.khaa30 <= :orderEndDate ";
				$where['value'][':orderEndDate'] = $cond['orderEndDate'];
			}
			if(!empty($cond['khyx'])){
				$where['express'] .= "and kh.khaa25 = :khyx ";
				$where['value'][':khyx'] = $cond['khyx'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('rylist as ry',"{$this->tableName}.depttext=ry.department")
						->leftjoin('khaa as kh',"ry.`username` = kh.khaa32")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.depttext");
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'num'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取进线时段分析报表——人数
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getJxsdfxbbByCondRS($cond){
		$select = " COUNT(kh.`khaa01`) num";
		$where['express'] = "kh.khaa30 >= '".$cond['beginDate']." ".$cond['beginTime'] ."' and kh.khaa30 <= '".$cond['beginDate']." ".$cond['endTime'] ."' " ;
		$where['value'] = array();
		if(!empty($cond['khyx'])){
			$where['express'] .= "and xs.khaa25 >= :khyx ";
			$where['value'][':khyx'] = $cond['khyx'];
		}
		if(!empty($cond['dept'])){
			$where['express'] .= "and {$this->tableName}.depttext <= :dept ";
			$where['value'][':dept'] = $cond['dept'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('rylist as ry',"{$this->tableName}.depttext=ry.department")
						->leftjoin('khaa as kh',"ry.username=kh.khaa32")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.depttext");
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'num'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取进线时段分析报表——确认订单
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getJxsdfxbbByCondQR($cond){
		$select = "SUM(xsaa19) money,COUNT(xsaa01) orders";
		$where['express'] = "xs.xsaa23 >= '".$cond['beginDate']." ".$cond['beginTime'] ."' and xs.xsaa23 <= '".$cond['beginDate']." ".$cond['endTime'] ."' and xs.xsaa29 !='未确认' " ;
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['khyx'])){
				$where['express'] .= "and kh.khaa25 = :khyx ";
				$where['value'][':khyx'] = $cond['khyx'];
			}
			if(!empty($cond['dept'])){
				$where['express'] .= "and {$this->tableName}.depttext = :dept ";
				$where['value'][':dept'] = $cond['dept'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('rylist as ry',"{$this->tableName}.depttext=ry.department")
						->leftjoin('khaa as kh',"ry.username=kh.khaa32")
						->leftjoin('xsaa as xs',"kh.khaa02=xs.xsaa04")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.depttext");
		$result = $this->dbCommand->queryAll();
		if(empty($result['orders'])){
			return array(
				'money'=>'0',
				'orders'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取订单追踪统计报表（未客审，已客审，未财审，已财审，待发货，已发货）
	 * @param array $cond 查询条件
	 * @param string $type1 订单状态（待发货，已发货，拒收，交易成功）
	 * @param string $type2 审核状态（已客审，已财审）
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getDdzztjbbByCond($cond,$type1,$type2){
		$select = "SUM(xsaa19) money,COUNT(xsaa01) orders";
		$where['express'] = "{$this->tableName}.depttext = '".$cond['dept']."' ";
		$where['value'] = array();
		if(!empty($type1)){
			$where['express'] .= " and xs.xsaa29 in ($type1) ";
		}
		if(!empty($type2)){
			$where['express'] .= " and xs.xsaa30 in ($type2) ";
		}
		if(empty($type1) && empty($type2)){
			$where['express'] .= " and xs.xsaa30 = '' ";
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
			if(!empty($cond['khyx'])){
				$where['express'] .= "and kh.khaa25 = :khyx ";
				$where['value'][':khyx'] = $cond['khyx'];
			}
			if(!empty($cond['dept'])){
				$where['express'] .= "and {$this->tableName}.depttext = :dept ";
				$where['value'][':dept'] = $cond['dept'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('rylist as ry',"{$this->tableName}.depttext=ry.department")
						->leftjoin('khaa as kh',"ry.username=kh.khaa32")
						->leftjoin('xsaa as xs',"kh.khaa02=xs.xsaa04")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.depttext");
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
	 * @desc 获取所有部门信息
	 * @return array $result 部门信息
	 * @author huyan
	 * @date 2016-03-09
	 */
	public function getAllDepartment(){	
		$select = "{$this->tableName}.deptID,{$this->tableName}.depttext";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("deptID".' ASC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取分组业绩统计报表（下单，审单，发货，拒收，签收）
	 * @param array $cond 查询条件
	 * @param string $type 类型（下单，审单，发货，拒收，签收）
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getFzyjtjbbChart($cond,$type){
		$select = "SUM(xsaa19) money,count(xsaa01) orders";
		$where['express'] = "{$this->tableName}.depttext = '".$cond['dept']."' ";
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
						->leftjoin('rylist as ry',"{$this->tableName}.depttext=ry.department")
						->leftjoin('khaa as kh',"ry.username = kh.khaa32")
						->leftjoin('xsaa as xs',"xs.xsaa04 = kh.khaa02")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.depttext");
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders'])){
			return array(
				'money'=>'0',
				'orders'=>'0'
				);
		}
		return $result[0];
	}


}
?>
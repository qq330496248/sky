<?php
/**
 * @desc 系统配置表操作类
 * @author WuJunhua
 * @date 2015-11-01
 */
class syssetDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-01
	 * @param string $className
	 * @return syssetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'sysset';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 获取所有客户意向信息
	 * @return array $result 客户意向信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function getKhyx(){	
		$select = "{$this->tableName}.id,{$this->tableName}.valuetype1,{$this->tableName}.valuetype2,{$this->tableName}.valuetype3";
		$where['express'] = "{$this->tableName}.typeencode = 'A016'";
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
	 * @desc 获取所有会员等级信息
	 * @return array $result 客户意向信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function getHydj(){	
		$select = "{$this->tableName}.id,{$this->tableName}.valuetype1";
		$where['express'] = "{$this->tableName}.typeencode = 'A012'";
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
	 * @desc 获取所有客户意向信息
	 * @return array $result 客户意向信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function getKhgjbq(){	
		$select = "{$this->tableName}.id,{$this->tableName}.valuetype1,{$this->tableName}.valuetype3";
		$where['express'] = "{$this->tableName}.typeencode = 'A006'";
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
	 * @desc 获取所有电话黑名单
	 * @return array $result 客户意向信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function getDhhmd(){
		$select = "{$this->tableName}.id,{$this->tableName}.valuetype1,{$this->tableName}.valuetype4,{$this->tableName}.valuetype5";
		$where['express'] = "{$this->tableName}.typeencode = 'A028'";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("id".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}
	/**
	 * @desc 获取所有职业
	 * @return array $result 客户意向信息
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function getZy(){
		$select = "{$this->tableName}.id,{$this->tableName}.valuetype1";
		$where['express'] = "{$this->tableName}.typeencode = 'A017'";
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
	 * @desc 获取所有订单审核
	 * @return array $result 订单审核状态
	 * @author huyan
	 * @date 2015-11-25
	 */
	public function getAuditStatus(){
		$select = "{$this->tableName}.id,{$this->tableName}.valuetype1";
		$where['express'] = "{$this->tableName}.typeencode = 'A026'";
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
	 * @desc 获取所有屏蔽的短信关键字
	 * @return array $result 客户意向信息
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function getDxgjz(){
		$select = "{$this->tableName}.id,{$this->tableName}.valuetype1";
		$where['express'] = "{$this->tableName}.typeencode = 'A030'";
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
	 * @desc 获取列名信息（导入导出EXCEL）
	 * @param $page int 页数
	 * @param $psize int 每页显示条数
	 * @param $type string 类型
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	function getCol($page,$psize,$type){
		$select = "{$this->tableName}.id,{$this->tableName}.valuetype1,{$this->tableName}.valuetype3,{$this->tableName}.valuetype4,{$this->tableName}.valuetype5";
		$where['express'] = "{$this->tableName}.typeencode = 'A033' and {$this->tableName}.valuetype1 = '$type' and {$this->tableName}.valuetype4 != ''";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("valuetype4")
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}

	/**
	 * @desc 获取列名信息（设置EXCEL格式）
	 * @param $type string 类型
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function getDBInfo($type){
		$select = "{$this->tableName}.valuetype2,{$this->tableName}.valuetype3,{$this->tableName}.id";
		$where['express'] = "{$this->tableName}.typeencode = 'A033' and {$this->tableName}.valuetype1 = '$type' and {$this->tableName}.valuetype4 = ''";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("valuetype2");
		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取列名信息（导入EXCEL）
	 * @param $type string 类型
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function getDBList($type){
		$select = "{$this->tableName}.valuetype2,{$this->tableName}.valuetype3,{$this->tableName}.id";
		$where['express'] = "{$this->tableName}.typeencode = 'A033' and {$this->tableName}.valuetype1 = '$type' and {$this->tableName}.valuetype4 != ''";
		$where['value'] = array();
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("valuetype4");
		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}
	/**
	 * @desc 获取导出excel字段、标题信息
	 * @param $type string 类型
	 * @author WuJunhua
	 * @date 2016-01-29
	 */
	public function getTitleInfo($type){
		$select = "{$this->tableName}.valuetype2,{$this->tableName}.valuetype3";
		$where['express'] = "{$this->tableName}.valuetype1 = :type and {$this->tableName}.valuetype4 != ''";
		$where['value']['type'] = $type;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.valuetype4 ".' ASC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取意向统计（下单，确认，发货，签收）
	 * @param $type string 类型（下单，确认，发货，签收）
	 * @param $cond array 查询条件
	 * @author DengShaocong
	 * @date 2016-02-17
	 */
	public function getYxbbByCond($cond,$type){
		$select = "sum(xsaa19) money,COUNT(xsaa01) orders";
		$where['express'] = "{$this->tableName}.typeencode = 'A016' and {$this->tableName}.valuetype1 = '".$cond['yx']."' ";
		$where['value'] = array();
		if(!empty($type)){
			$where['express'] .= " AND xs.`xsaa29` in ($type) ";
		}
		if(!empty($cond)){
			if($cond['type'] == '下单时间'){
				if(!empty($cond['beginDate'])){
					$where['express'] .= " and xs.xsaa61 >= :beginDate ";
					$where['value'][':beginDate'] = $cond['beginDate'];
				}
				if(!empty($cond['endDate'])){
					$where['express'] .= " and xs.xsaa61 <= :endDate ";
					$where['value'][':endDate'] = $cond['endDate'];
				}
			}else{
				if(!empty($cond['beginDate'])){
					$where['express'] .= " and kh.khaa17 >= :beginDate ";
					$where['value'][':beginDate'] = $cond['beginDate'];
				}
				if(!empty($cond['endDate'])){
					$where['express'] .= " and kh.khaa17 <= :endDate ";
					$where['value'][':endDate'] = $cond['endDate'];
				}
			}
			if(!empty($cond['dept'])){
				$where['express'] .= " and ry.department = :dept ";
				$where['value'][':dept'] = $cond['dept'];
			}
			if(!empty($cond['inline'])){
				$where['express'] .= " and kh.khaa24 = :inline ";
				$where['value'][':inline'] = $cond['inline'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa kh',"{$this->tableName}.valuetype1 = kh.khaa25")
						->leftjoin('xsaa xs',"kh.khaa02 = xs.xsaa04")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.valuetype1");
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
	 * @desc 获取意向统计（人数）
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-17
	 */
	public function getYxbbByCondRS($cond){
		$select = "count(khaa01) num";
		$where['express'] = "{$this->tableName}.typeencode = 'A016' and {$this->tableName}.valuetype1 = '".$cond['yx']."' ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= " and kh.khaa30 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= " and kh.khaa30 <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'];
			}
			if(!empty($cond['dept'])){
				$where['express'] .= " and ry.department = :dept ";
				$where['value'][':dept'] = $cond['dept'];
			}
			if(!empty($cond['inline'])){
				$where['express'] .= " and kh.khaa24 = :inline ";
				$where['value'][':inline'] = $cond['inline'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa kh',"{$this->tableName}.valuetype1 = kh.khaa25")
						->leftjoin('rylist ry',"ry.username = kh.khaa25")
						->leftjoin('xsaa xs',"kh.khaa02 = xs.xsaa04")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.valuetype1");
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'num'=>'0'
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取进线方式统计报表（下单，确认，发货，拒收，签收）
	 * @param $cond array 查询条件
	 * @param $type string 类型（下单，确认，发货，拒收，签收）
	 * @author DengShaocong
	 * @date 2016-02-17
	 */
	public function getJxfstjbbByCond($cond,$type){
		$select = "sum(xsaa19) money,COUNT(xsaa01) orders";
		$where['express'] = " xs.xsaa29 in ($type) and {$this->tableName}.valuetype1 = '".$cond['jxfs']."' ";
		$where['value'] = array();
		if(!empty($cond)){
			if($cond['type'] == 'ope'){
				if($type == "'已发货','拒收','交易成功'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and xs.xsaa27 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and xs.xsaa27 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else if($type == "'拒收'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and xs.xsaa51 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and xs.xsaa51 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else if($type == "'交易成功'"){
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and xs.xsaa28 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and xs.xsaa28 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
					}
				}else{
					if(!empty($cond['beginDate'])){
						$where['express'] .= " and xs.xsaa61 >= :beginDate ";
						$where['value'][':beginDate'] = $cond['beginDate'];
					}
					if(!empty($cond['endDate'])){
						$where['express'] .= " and xs.xsaa61 <= :endDate ";
						$where['value'][':endDate'] = $cond['endDate'];
					}
				}	
			}else{
				if(!empty($cond['beginDate'])){
					$where['express'] .= " and xs.xsaa61 >= :beginDate ";
					$where['value'][':beginDate'] = $cond['beginDate'];
				}
				if(!empty($cond['endDate'])){
					$where['express'] .= " and xs.xsaa61 <= :endDate ";
					$where['value'][':endDate'] = $cond['endDate'];
				}
			}

			if(!empty($cond['khyx'])){
				$where['express'] .= "and kh.khaa25 = :khyx ";
				$where['value'][':khyx'] = $cond['khyx'];
			}
			if(!empty($cond['media'])){
				$where['express'] .= "and kh.khaa22 = :media ";
				$where['value'][':media'] = $cond['media'];
			}
			if(!empty($cond['dept'])){
				$where['express'] .= "and dept.depttext = :dept ";
				$where['value'][':dept'] = $cond['dept'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa kh',"{$this->tableName}.valuetype1 = kh.khaa24")
						->leftjoin('xsaa xs',"kh.khaa02 = xs.xsaa04")
//						->leftjoin('rylist as ry',"ry.username=kh.khaa32")
//						->leftjoin('deptset dept',"dept.depttext=ry.department")
						->where($where['express'],$where['value'])
						->group('xs.xsaa29,kh.khaa25');
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
	 * @desc 获取进线方式统计报表——人数
	 * @param $cond array 查询条件
	 * @author DengShaocong
	 * @date 2016-02-17
	 */
	public function getJxfstjbbByCondRS($cond){
		$select = "COUNT(khaa01) num";
		$where['express'] = " kh.khaa24 = '". $cond['jxfs'] ."' ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= " and kh.khaa30 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= " and kh.khaa30 <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khaa kh',"{$this->tableName}.valuetype1 = kh.khaa24")
						->where($where['express'],$where['value'])
						->group('kh.khaa24');
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'num'=>'0'
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取意向统计（下单，确认，发货，签收）
	 * @param $type string 类型（下单，确认，发货，签收）
	 * @param $cond array 查询条件
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getYxtjbbChart($cond,$type){
		$select = "sum(xsaa19) money,COUNT(xsaa01) orders";
		$where['express'] = "{$this->tableName}.typeencode = 'A016' and {$this->tableName}.valuetype1 = '".$cond['yx']."' ";
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
						->leftjoin('khaa kh',"{$this->tableName}.valuetype1 = kh.khaa25")
						->leftjoin('xsaa xs',"kh.khaa02 = xs.xsaa04")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.valuetype1");
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
	 * @desc 获取进线方式统计报表（下单，确认，发货，拒收，签收）
	 * @param $cond array 查询条件
	 * @param $type string 类型（下单，确认，发货，拒收，签收）
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getJxfstjbbChart($cond,$type){
		$select = "sum(xsaa19) money,COUNT(xsaa01) orders";
		$where['express'] = " xs.xsaa29 in ($type) and {$this->tableName}.valuetype1 = '".$cond['jxfs']."' ";
		$where['value'] = array();
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
						->leftjoin('khaa kh',"{$this->tableName}.valuetype1 = kh.khaa24")
						->leftjoin('xsaa xs',"kh.khaa02 = xs.xsaa04")
//						->leftjoin('rylist as ry',"ry.username=kh.khaa32")
//						->leftjoin('deptset dept',"dept.depttext=ry.department")
						->where($where['express'],$where['value'])
						->group('xs.xsaa29,kh.khaa25');
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
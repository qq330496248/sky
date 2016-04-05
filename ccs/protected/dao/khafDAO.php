<?php
/**
 * @desc外部短信表操作类
 * @author huyan
 * @date 2015-11-16
 */
class khafDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-11-16
	 * @param string $className
	 * @return khafDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khaf';
		$this->tableOrder = 'khaa';
		$this->primaryKey = 'khaf01';
	}

	/**
	 * @desc 获取客户短信列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @author huyan
	 * @date 2015-11-16
	 */
	//
	public function getMessage($page,$psize,$khyfdx){
		$dxlx='接收';
		$where['express'] = "{$this->tableName}.khaf12 = :接收";
		$where['value']['接收'] = $dxlx;
		$select = "{$this->tableName}.khaf02,{$this->tableName}.khaf03,{$this->tableName}.khaf04,{$this->tableName}.khaf05,{$this->tableName}.khaf06,{$this->tableName}.khaf07,{$this->tableName}.khaf10,{$this->tableName}.khaf11,{$this->tableName}.khaf12";

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();

		return $result;
	}

	/**
	 * @desc 获取查询客户短信列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function SMSQuery($page,$psize,$khzl1Client,$khphone,$kssj,$jssj,$khszz){
		$select = "{$this->tableName}.khaf02,{$this->tableName}.khaf03,{$this->tableName}.khaf04,{$this->tableName}.khaf05,{$this->tableName}.khaf06,{$this->tableName}.khaf07,{$this->tableName}.khaf08";
		$where['express'] = "{$this->tableName}.khaf01 >= 1";
		$where['value'] = array();
		if(!empty($khzl1Client)){
			$where['express'] .= " AND {$this->tableName}.khaf05  like :khzl1Client";
			$where['value'][':khzl1Client'] = "%{$khzl1Client}%";
		}
		if(!empty($khphone)){
			$where['express'] .= " AND {$this->tableName}.khaf04 like :khphone";
			$where['value'][':khphone'] = "%{$khphone}%";
		}
		if(!empty($khszz)){
			$where['express'] .= " AND {$this->tableName}.khaf10 like :khszz";
			$where['value'][':khszz'] = "%{$khszz}%";
		}
		if(!empty($kssj)&&!empty($jssj)){
			$where['express'] .= " AND {$this->tableName}.khaf07 >=:kssj AND {$this->tableName}.khaf07 <= :jssj";
			$where['value'][':kssj'] = $kssj;
			$where['value'][':jssj'] = $jssj;
		}
		if(!empty($kssj)){
			$where['express'] .= " AND {$this->tableName}.khaf07 >=:kssj";
			$where['value'][':kssj'] = $kssj;
		}
		if(!empty($jssj)){
			$where['express'] .= " AND {$this->tableName}.khaf07 <=:jssj";
			$where['value'][':jssj'] = $jssj;
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();								   
		return $result;

	}

	/**
	 * @desc 根据不同的短信状态获取短信列表
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $orderStatus 短信状态
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	public function getShortMessage($page,$psize,$ShortMessage,$CondList){		
		$select = "{$this->tableName}.khaf02,{$this->tableName}.khaf03,{$this->tableName}.khaf04,{$this->tableName}.khaf05,{$this->tableName}.khaf06,{$this->tableName}.khaf07,{$this->tableName}.khaf08";
		$where['express'] = "{$this->tableName}.khaf02 = :ShortMessage";
		$where['value']['ShortMessage'] = $ShortMessage;
		 if(!empty($CondList)){
			if(!empty($CondList['gsgh'])){
				$where['express'].=" AND {$this->tableName}.khaf05 like :gsgh";
				$where['value'][':gsgh'] = '%'.$CondList['gsgh'].'%';
			}
			if(!empty($CondList['khphone'])){
				$where['express'].=" AND {$this->tableName}.khaf04 like :khphone";
				$where['value'][':khphone'] = '%'.$CondList['khphone'].'%';
			}
			/*if(!empty($CondList['khszz'])){
				$where['express'].=" AND {$this->tableName}.khaf04 like :khszz";
				$where['value'][':khszz'] = '%'.$CondList['khszz'].'%';
			}*/
		    if(!empty($CondList['kssj'])&&!empty($CondList['jssj'])){
		    	$where['express'] .= " AND {$this->tableName}.khaf07 >=:kssj AND {$this->tableName}.khaf07 <= :jssj";
		    	$where['value'][':kssj'] = $CondList['kssj'];
		    	$where['value'][':jssj'] = $CondList['jssj'];
		    }
		    if (!empty($CondList['kssj'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaf07 >=:kssj";
		    	$where['value'][':kssj'] = $CondList['kssj'];
		    }
		    if (!empty($CondList['jssj'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaf07 <=:jssj";
		    	$where['value'][':jssj'] = $CondList['jssj'];
		    }
		}

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();								   
		return $result;
	}

	/**
	 * @desc 获取客户详情页面短信记录（外部短信）
	 * @author huyan
	 * @date 2016-03-03
	 */
	public function GetShortmesRecords($khphonecall,$page,$psize){	
		$select = "{$this->tableName}.khaf01,{$this->tableName}.khaf02,{$this->tableName}.khaf03,{$this->tableName}.khaf04,{$this->tableName}.khaf05,{$this->tableName}.khaf06,{$this->tableName}.khaf07";
		$where['express'] = "{$this->tableName}.khaf02 = :khphonecall";
		$where['value']['khphonecall'] = $khphonecall;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value'])
		 				->order("{$this->tableName}.khaf01".' DESC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

}
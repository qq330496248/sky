<?php
/**
 * @desc 跟进记录表操作类
 * @author huyan
 * @date 2015-10-27 
 */
class khaeDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-11-11
	 * @param string $className
	 * @return khaeDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-11-11
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khae';
		$this->tableOrder = 'khaa';
		$this->primaryKey = true;
		$this->createtime = 'khae08';
	}

	/**
	 * @desc 获取跟进记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @author huyan
	 * @date 2015-11-11
	 */
	public function getFollowing($page,$psize,$CondList,$JobNuber,$selectColumnStr=false){
		$select = "{$this->tableName}.khae12,{$this->tableName}.khae01,{$this->tableOrder}.khaa03,{$this->tableName}.khae02,{$this->tableName}.khae03,{$this->tableName}.khae04,{$this->tableName}.khae05,{$this->tableName}.khae06,{$this->tableName}.khae07,{$this->tableName}.khae08,{$this->tableName}.khae09,{$this->tableName}.khae10,{$this->tableOrder}.khaa32,{$this->tableOrder}.khaa33";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
	    $where['express'] = "{$this->tableName}.khae12 > 0 AND {$this->tableName}.khae04 = :JobNuber";
		$where['value']['JobNuber'] = $JobNuber;

		 if(!empty($CondList)){
			if(!empty($CondList['khid'])){
				$where['express'].=" AND {$this->tableName}.khae01 like :khid";
				$where['value'][':khid'] = '%'.$CondList['khid'].'%';
			}
			if(!empty($CondList['sfwc'])){
				$where['express'].=" AND {$this->tableName}.khae10 like :sfwc";
				$where['value'][':sfwc'] = '%'.$CondList['sfwc'].'%';
			}
			if(!empty($CondList['gjbq'])){
				$where['express'].=" AND {$this->tableName}.khae02 like :gjbq";
				$where['value'][':gjbq'] = '%'.$CondList['gjbq'].'%';
			}
			if(!empty($CondList['khszz'])){
				$where['express'].=" AND {$this->tableName}.khae11 like :khszz";
				$where['value'][':khszz'] = '%'.$CondList['khszz'].'%';
			}
			if(!empty($CondList['khapr'])){
				$where['express'].=" AND {$this->tableName}.khae04 like :khapr";
				$where['value'][':khapr'] = '%'.$CondList['khapr'].'%';
				
			}
			if(!empty($CondList['khgjr'])){
				$where['express'].=" AND {$this->tableName}.khae06 like :khgjr";
				$where['value'][':khgjr'] = '%'.$CondList['khgjr'].'%';
			}
			//根据时间段查询
		    if(!empty($CondList['gjsjq'])&&!empty($CondList['gjsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khae08 >=:gjsjq AND {$this->tableName}.khae08 <= :gjsjz";
		    	$where['value'][':gjsjq'] = $CondList['gjsjq'];
		    	$where['value'][':gjsjz'] = $CondList['gjsjz'];
		    }
		    if (!empty($CondList['gjsjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khae08 >=:gjsjq";
		    	$where['value'][':gjsjq'] = $CondList['gjsjq'];
		    }
		    if (!empty($CondList['gjsjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khae08 <=:gjsjz";
		    	$where['value'][':gjsjz'] = $CondList['gjsjz'];
		    }
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khae01 = {$this->tableOrder}.khaa02")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		//$result = $this->dbCommand->queryAll();
		 $result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
		 								   ->from($this->tableName)
		 								   ->leftJoin($this->tableOrder, "{$this->tableName}.khae01 = {$this->tableOrder}.khaa02")
		 								   ->where($where['express'],$where['value'])
		 								   ->queryScalar();
		return $result;
	}


	/**
	 * @desc 获取客户跟进记录
	 * @param string $clientno 客户编号
	 * @return array $result 客户跟进记录信息
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function GetFollowRecording($clientno){	
		$select = "{$this->tableName}.khae12,{$this->tableName}.khae01,{$this->tableName}.khae02,{$this->tableName}.khae03,{$this->tableName}.khae04,{$this->tableName}.khae05,{$this->tableName}.khae06,{$this->tableName}.khae07,{$this->tableName}.khae08,{$this->tableName}.khae09";
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
	 * @desc 获取查询跟进记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @author huyan
	 * @date 2015-11-18
	 */
	public function CombinedFollow($clientNo,$searchType,$keyword,$khzl1Client,$khzl2Client,$retaintype){//$clientInfo,
		$where['express'] = "";
		$where['value'] = array();
		if($searchType == 1){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableName}.khae01 = :ordernum";
			    $where['value']['ordernum'] = $khzl2Client;
			}
			if ($retaintype==2) {
				$where['express'] = "{$this->tableName}.khae01 = :ordernum";
			    $where['value']['ordernum'] = $khzl1Client;
			}
			
		}
		if($searchType == 2){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableName}.khae01 = :khphone";
			    $where['value']['khphone'] = $khzl2Client;
			}
			if ($retaintype==2) {
				$where['express'] = "{$this->tableName}.khae01 = :khphone";
			    $where['value']['khphone'] = $khzl1Client;
			}
			
		}
		if($searchType == 3){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableName}.khae01 = :khname";
			    $where['value']['khname'] = $khzl2Client;
			}
			if ($retaintype==1) {
				$where['express'] = "{$this->tableName}.khae01 = :khname";
			    $where['value']['khname'] = $khzl1Client;
			}
		}
		$select = "{$this->tableOrder}.khaa02,{$this->tableName}.khae01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khae01 = {$this->tableOrder}.khaa02")
						->where($where['express'],$where['value']);
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.khae01 = {$this->tableOrder}.khaa02")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();				   
		return $result;

	}

	/**
	 * @desc 系统设置->数据清理->查询要删除的客户跟进记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function getFollowToBeDel($gjsjq,$gjsjz){
		$where['express'] = "{$this->tableName}.khae12>0";
		$where['value'] = array();
		if(!empty($gjsjq)&&!empty($gjsjz)){
	    	$where['express'] .= " AND {$this->tableName}.khae08 >=:gjsjq AND {$this->tableName}.khae08 <= :gjsjz";
	    	$where['value'][':xdsjq'] =$gjsjq;
	    	$where['value'][':gjsjz'] =$gjsjz;
	    }
	    if(!empty($gjsjq)){
	    	$where['express'] .= " AND {$this->tableName}.khae08 >=:gjsjq";
	    	$where['value'][':gjsjq'] =$gjsjq;
	    }
	     if(!empty($gjsjz)){
	    	$where['express'] .= " AND {$this->tableName}.khae08 <=:gjsjz";
	    	$where['value'][':gjsjz'] =$gjsjz;
	    }
		$select = "{$this->tableName}.khae12";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 系统设置->数据清理->查询要转移的跟进记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function getFollowTransfer($khgh1){
		$where['express'] = "{$this->tableName}.khae04 = :khgh1";
		$where['value']['khgh1'] = $khgh1;
		$select = "{$this->tableName}.khae12,{$this->tableName}.khae04";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取客户待办事项信息
	 * @author DengShaocong
	 * @param array $cond 查询条件
	 * @return array $result 结果集
	 * @date 2016-03-14
	 */
	public function getClientBacklog($cond){
		$select = "{$this->tableName}.khae12,{$this->tableName}.khae01,kh.khaa01,kh.khaa03,{$this->tableName}.khae02,{$this->tableName}.khae04,{$this->tableName}.khae05,{$this->tableName}.khae06,{$this->tableName}.khae07,{$this->tableName}.khae08,{$this->tableName}.khae09,xs.xsaa02,xs.xsaa01,{$this->tableName}.khae03  ";
		if($cond['type'] == '未完成'){
			$where['express'] = "{$this->tableName}.khae09 != '1970-01-01 00:00:00' and {$this->tableName}.khae10 = '未完成' and {$this->tableName}.khae06 = '". $cond['account'] ."' ";
		}else if($cond['type'] == '已完成'){
			$where['express'] = "{$this->tableName}.khae09 != '1970-01-01 00:00:00' and {$this->tableName}.khae10 = '已完成' and {$this->tableName}.khae06 = '". $cond['account'] ."' ";
		}else{
			$where['express'] = "{$this->tableName}.khae09 != '1970-01-01 00:00:00' and {$this->tableName}.khae10 = '未完成' and {$this->tableName}.khae04 = '". $cond['account'] ."' ";
		}		
		$where['value'] = array();

		if(!empty($cond['backlogType'])){
			$where['express'] .= " and {$this->tableName}.khae02 = :backlogType";
			$where['value'][':backlogType'] = $cond['backlogType'];
 		}	
 		if(!empty($cond['khid'])){
			$where['express'] .= " and {$this->tableName}.khae02 like :khid ";
			$where['value'][':khid'] = '%'.$cond['khid'].'%';
 		}
 		if(!empty($cond['khxm'])){
			$where['express'] .= " and {$this->tableName}.khae02 like :khxm ";
			$where['value'][':khxm'] = '%'.$cond['khxm'].'%';
 		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->leftjoin('khaa kh',"{$this->tableName}.khae01 = kh.khaa02")
		 				->leftjoin('xsaa xs',"kh.khaa02 = xs.xsaa04")
		 				->where($where['express'],$where['value']);
		$result['list'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftjoin('khaa kh',"{$this->tableName}.khae01 = kh.khaa02")
										   ->leftjoin('xsaa xs',"kh.khaa02 = xs.xsaa04")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	

		return $result;
	}
}
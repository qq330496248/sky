<?php
/**
 * @desc 客户投诉表操作类
 * @author huyan
 * @date 2015-10-27 
 */
class khacDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-12-03
	 * @param string $className
	 * @return khacDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khac';
		$this->tableOrder = 'khad';
		$this->tableOrderDetail = 'khah';
		$this->primaryKey = 'khac14';
		$this->createtime = 'khac10';
	}

	/**
	 * @desc 获取客户投诉列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 客户投诉列表信息
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function GetComplaint($page,$psize,$JobNuber,$CondList,$selectColumnStr=false){	
		$select = "{$this->tableName}.khac14,{$this->tableName}.khac01,{$this->tableName}.khac13,{$this->tableName}.khac02,{$this->tableName}.khac05,{$this->tableName}.khac06,{$this->tableName}.khac03,{$this->tableName}.khac09,{$this->tableName}.khac04,{$this->tableName}.khac10,{$this->tableName}.khac11,{$this->tableName}.khac08,{$this->tableName}.khac07";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.khac09 = :JobNuber";
		$where['value']['JobNuber'] = $JobNuber;

		 if(!empty($CondList)){
			if(!empty($CondList['gjgh'])){
				$where['express'].=" AND {$this->tableName}.khac04 like :gjgh";
				$where['value'][':gjgh'] = '%'.$CondList['gjgh'].'%';
			}

			if(!empty($CondList['khtsgh'])){
				$where['express'].=" AND {$this->tableName}.khac03 like :khtsgh";
				$where['value'][':khtsgh'] = '%'.$CondList['khtsgh'].'%';
			}

			if(!empty($CondList['sfcl'])){
				$where['express'].=" AND {$this->tableName}.khac12 like :sfcl";
				$where['value'][':sfcl'] = '%'.$CondList['sfcl'].'%';
			}

			if(!empty($CondList['tsxm'])){
				$where['express'].=" AND {$this->tableName}.khac13 like :tsxm";
				$where['value'][':tsxm'] = '%'.$CondList['tsxm'].'%';
			}

			if(!empty($CondList['khtslx'])){
				$where['express'].=" AND {$this->tableName}.khac02 like :khtslx";
				$where['value'][':khtslx'] = '%'.$CondList['khtslx'].'%';
			}
			
			//根据时间段查询
		    if(!empty($CondList['tssjq'])&&!empty($CondList['tssjz'])){
		    	
		    	$where['express'] .= " AND {$this->tableName}.khac10 >=:tssjq AND {$this->tableName}.khac10 <= :tssjz";
		    	$where['value'][':tssjq'] = $CondList['tssjq'];
		    	$where['value'][':tssjz'] = $CondList['tssjz'];
		    }
		    if (!empty($CondList['tssjq'])) {
		    	
		    	$where['express'] .= " AND {$this->tableName}.khac10 >=:tssjq";
		    	$where['value'][':tssjq'] = $CondList['tssjq'];
		    }
		    if (!empty($CondList['tssjz'])) {
		    	
		    	$where['express'] .= " AND {$this->tableName}.khac10 <=:tssjz";
		    	$where['value'][':tssjz'] = $CondList['tssjz'];
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
	 * @desc 根据不同的统计方式，获取不同的信息
	 * @param array $cond 查询条件
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getMessageForTstjbb($cond){
		//根据条件选择字段
		$select = $cond['type']." as colname,count(khac01)";
		$where['express'] = "{$this->tableName}.khac10 >= '".$cond['beginDate']." 00:00:00' and {$this->tableName}.khac10 <= '".$cond['endDate']." 23:59:59' ";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],array())
						->group($cond['type']);
		$result = $this->dbCommand->queryAll();

		return $result;
	}


	/**
	 * @desc 获取投诉统计报表信息（总数，未处理，全额退款，部分退款，退货，换货，产品赠送，赠品赠送）
	 * @param array $cond 查询条件
	 * @param string $type 处理结果
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getTstjbbByCond($cond,$type){
		$select = "count(khac01) as num";
		$where['express'] = "{$this->tableName}.".$cond['type']." = '".$cond['colName']."' ";
		$where['value'] = array();
		if(!empty($type)){
			if($type == "'未处理'"){
				$where['express'] .= "and {$this->tableName}.khac08 = '' ";
			}else{
				$where['express'] .= "and {$this->tableName}.khac08 = $type ";
			}
		}
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= " and {$this->tableName}.khac10 >= :beginDate";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= " and {$this->tableName}.khac10 <= :endDate";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->group($cond['type']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num'])){
			return array(
				'num'=>0
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取投诉总数
	 * @param array $cond 查询条件
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getTstjbbByCondZS($cond){
		$select = "count(khac01) as num";
		$where['express'] = "{$this->tableName}.".$cond['type']." = '".$cond['colName']."' ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= " and {$this->tableName}.khac10 >= :beginDate";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= " and {$this->tableName}.khac10 <= :endDate";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array(
				'num'=>0
				);
		}
		return $result[0];
	}
}
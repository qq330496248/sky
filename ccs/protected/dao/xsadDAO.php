<?php
/**
 * @desc 订单跟进记录表操作类
 * @author WuJunhua
 * @date 2015-11-13
 */
class xsadDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-13
	 * @param string $className
	 * @return xsadDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'xsad';
		$this->primaryKey = true;
		$this->createtime = 'xsad04';
	}

	/**
	 * @desc 获取订单跟进记录
	 * @param string $orderNo 订单编号
	 * @return array $result 订单跟进记录信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function getOrderFollowRecording($page,$psize,$orderNo){	
		$select = "{$this->tableName}.xsad07,{$this->tableName}.xsad08,{$this->tableName}.xsad04,{$this->tableName}.xsad06,{$this->tableName}.xsad10";
		$where['express'] = "{$this->tableName}.xsad01 = :orderNo";
		$where['value']['orderNo'] = $orderNo;
		/*$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.xsad10".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;*/

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.xsad10".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		//$result = $this->dbCommand->queryAll();
		 $result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
		 								   ->from($this->tableName)
		 								   ->where($where['express'],$where['value'])
		 								   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 系统设置->数据清理->查询要删除的订单跟进记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function getOrderFollow($ddsjq,$ddsjz){
		$where['express'] = "{$this->tableName}.xsad10>0";
		$where['value'] = array();
		if(!empty($ddsjq)&&!empty($ddsjz)){
	    	$where['express'] .= " AND {$this->tableName}.xsad04 >=:ddsjq AND {$this->tableName}.xsad04 <= :ddsjz";
	    	$where['value'][':ddsjq'] =$ddsjq;
	    	$where['value'][':ddsjz'] =$ddsjz;
	    }
	    if(!empty($ddsjq)){
	    	$where['express'] .= " AND {$this->tableName}.xsad04 >=:ddsjq";
	    	$where['value'][':ddsjq'] =$ddsjq;
	    }
	     if(!empty($ddsjz)){
	    	$where['express'] .= " AND {$this->tableName}.xsad04 <=:ddsjz";
	    	$where['value'][':ddsjz'] =$ddsjz;
	    }
		$select = "{$this->tableName}.xsad10";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取含有退货信息的订单跟进记录
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getRejectOrder(){
		$select = "{$this->tableName}.xsad01,{$this->tableName}.xsad06";
		$where['express'] = "{$this->tableName}.xsad06 like '%拒收%'";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],array())
		 				->group("{$this->tableName}.xsad01");
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
	public function getOrderBacklog($cond){
		$select = "{$this->tableName}.xsad01,{$this->tableName}.xsad02,{$this->tableName}.xsad03,{$this->tableName}.xsad04,{$this->tableName}.xsad05,{$this->tableName}.xsad06,{$this->tableName}.xsad07,{$this->tableName}.xsad08,kh.khaa02,kh.khaa01,kh.khaa03,xs.xsaa01,xs.xsaa02 ";
		if($cond['type'] == '未完成'){
			$where['express'] = "{$this->tableName}.xsad11 = '是' and {$this->tableName}.xsad12 = '未完成' and xsad02 = '". $cond['account'] ."' ";
		}else if($cond['type'] == '已完成'){
			$where['express'] = "{$this->tableName}.xsad11 = '是' and {$this->tableName}.xsad12 = '已完成' and xsad02 = '". $cond['account'] ."' ";
		}else{
			$where['express'] = "{$this->tableName}.xsad11 = '是' and {$this->tableName}.xsad07 = '"+ $cond['account'] +"' ";
		}		
		$where['value'] = array();
		if(!empty($cond['khid'])){
			$where['express'] .= " and kh.khaa02 like :khid ";
			$where['value'][':khid'] = '%'.$cond['khid'].'%';
 		}
 		if(!empty($cond['khxm'])){
			$where['express'] .= " and kh.khaa03 like :khxm ";
			$where['value'][':khxm'] = '%'.$cond['khxm'].'%';
 		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('xsaa xs',"{$this->tableName}.xsad01 = xs.xsaa02")
						->leftjoin('khaa kh',"xs.xsaa04 = kh.khaa02")
		 				->where($where['express'],array());
		$result['list'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftjoin('xsaa xs',"{$this->tableName}.xsad01 = xs.xsaa02")
										   ->leftjoin('khaa kh',"xs.xsaa04 = kh.khaa02")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
}

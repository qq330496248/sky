<?php
/**
 * @desc 产品库存异动明细表操作类
 * @author WuJunhua
 * @date 2015-11-13 
 */
class cpafDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-13 
	 * @param string $className
	 * @return cpafDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-11-12
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cpaf';
		$this->primaryKey = 'cpaf01';
	}

	/**
	 * @desc 系统设置->数据清理->查询要删除的出库入库记录
	 * @author huyan
	 * @date 2016-02-18
	 */
	public function getStorageRecords($jlsjq,$jlsjz,$crklx){
		$where['express'] = "{$this->tableName}.cpaf01>0";
		$where['value'] = array();
		if (!empty($crklx)) {
		    if ($crklx=='入库') {
	    		$rkpy='盘盈';
	    		$cgdrk='采购单入库';
	    		$zjrk='直接入库';
	    		$thrc='退货入仓';
	    	    $where['express'] .= " AND {$this->tableName}.cpaf09 like :rkpy OR {$this->tableName}.cpaf09 like :cgdrk OR {$this->tableName}.cpaf09 like :zjrk OR {$this->tableName}.cpaf09 like :thrc";
	    	    $where['value'][':rkpy'] ='%'.$rkpy.'%';
	    	    $where['value'][':cgdrk'] ='%'.$cgdrk.'%';
	    	    $where['value'][':zjrk']='%'.$zjrk.'%';
	    	    $where['value'][':thrc']='%'.$thrc.'%';
		    }
		     if ($crklx=='出库') {
		    	$ckpk='盘亏';
		    	$ckpp='出库';
		    	$where['express'] .= " AND {$this->tableName}.cpaf09 like :ckpk OR {$this->tableName}.cpaf09 like :ckpp ";
		    	$where['value'][':ckpk'] ='%'.$ckpk.'%';
		    	$where['value'][':ckpp'] ='%'.$ckpp.'%';
		    }
		}
	    //根据时间段查询
	    if(!empty($jlsjq)&&!empty($jlsjz)){
	    	$where['express'] .= " AND {$this->tableName}.cpaf07 >=:jlsjq AND {$this->tableName}.cpaf07 <= :jlsjz";
	    	$where['value'][':jlsjq'] = $jlsjq;
	    	$where['value'][':jlsjz'] = $jlsjz;
	    }
	    if(!empty($jlsjq)){
	    	$where['express'] .= " AND {$this->tableName}.cpaf07 >=:jlsjq";
	    	$where['value'][':jlsjq'] = $jlsjq;
	    }
	    if(!empty($jlsjz)){
	    	$where['express'] .= " AND {$this->tableName}.cpaf07 <=:jlsjz";
	    	$where['value'][':jlsjz'] = $jlsjz;
	    }
		$select = "{$this->tableName}.cpaf01,{$this->tableName}.cpaf07";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取库存明细-明细
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function getInventoryDetail($page,$psize,$CondList){
		$where['express'] = "{$this->tableName}.cpaf02 = :batch AND {$this->tableName}.cpaf03 = :styleNum";
		$where['value']['batch'] = $CondList['batch'];
		$where['value']['styleNum'] = $CondList['styleNum'];
		//根据时间段查询
		if (!empty($CondList)) {
			if(!empty($CondList['ydsjq']) && !empty($CondList['ydsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.cpaf07 >= :ydsjq AND {$this->tableName}.cpaf07 <= :ydsjz";
		    	$where['value'][':ydsjq'] = $CondList['ydsjq'];
		    	$where['value'][':ydsjz'] = $CondList['ydsjz'];
		    }
		    if(!empty($CondList['ydsjq'])){
		    	$where['express'] .= " AND {$this->tableName}.cpaf07 >= :ydsjq";
		    	$where['value'][':ydsjq'] = $CondList['ydsjq'];
		    }
		    if(!empty($CondList['ydsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.cpaf07 <= :ydsjz";
		    	$where['value'][':ydsjz'] = $CondList['ydsjz'];
		    }
	       if(!empty($CondList['ydlx'])){
		    	$where['express'] .= " AND {$this->tableName}.cpaf09 like :ydlx";
		    	$where['value'][':ydlx'] = $CondList['ydlx'];
		    }
	    }
		$select = "{$this->tableName}.cpaf02,{$this->tableName}.cpaf03,{$this->tableName}.cpaf05,{$this->tableName}.cpaf07,{$this->tableName}.cpaf09,{$this->tableName}.cpaf10,{$this->tableName}.cpaf12";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.cpaf07 ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

}

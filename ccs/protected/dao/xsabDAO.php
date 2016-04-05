<?php
/**
 * @desc 订单明细表操作类
 * @author WuJunhua
 * @date 2015-11-12 
 */
class xsabDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-12 
	 * @param string $className
	 * @return xsabDAO
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
		$this->tableName = 'xsab';
		$this->tableOrder = 'xsaa';
		$this->tableStock = 'cpae';
		$this->primaryKey = true;
	}

	/**
	 * @desc 退货款号汇总查询
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 退货款号记录列表信息
	 * @author huyan
	 * @date 2015-12-10
	 */
	public function RefundNumberInquiry($page,$psize,$cpmc,$cpkh,$rcsjq,$rcsjz,$ddid,$gysid,$kdgs,$zffs,$syz,$goodStatus){
		$where['express'] = "{$this->tableName}.xsab12 = :goodStatus";
		$where['value']['goodStatus'] = $goodStatus;

		if (!empty($cpmc)) {
			$where['express'] .= " AND {$this->tableName}.xsab02 like :cpmc";
			$where['value'][':cpmc'] = "%{$cpmc}%";
		}
		if (!empty($cpkh)) {
			$where['express'] .= " AND {$this->tableName}.xsab03 like :cpkh";
			$where['value'][':cpkh'] = "%{$cpkh}%";
		}
		if (!empty($ddid)) {
			$where['express'] .= " AND {$this->tableName}.xsab01 like :ddid";
			$where['value'][':ddid'] = "%{$ddid}%";
		}
		if (!empty($kdgs)) {
			$where['express'] .= " AND {$this->tableOrder}.xsaa41 like :kdgs";
			$where['value'][':kdgs'] = "%{$kdgs}%";
		}
		if (!empty($zffs)) {
			$where['express'] .= " AND {$this->tableOrder}.xsaa13 like :zffs";
			$where['value'][':zffs'] = "%{$zffs}%";
		}
		if (!empty($syz)) {
			$where['express'] .= " AND {$this->tableOrder}.xsaa31 like :syz";
			$where['value'][':syz'] = "%{$syz}%";
		}
		if (!empty($gysid)) {
			$where['express'] .= " AND {$this->tableOrder}.xsaa31 like :gysid";
			$where['value'][':gysid'] = "%{$gysid}%";
		}

		if(!empty($rcsjq)&&!empty($rcsjz)){
			$where['express'] .= " AND {$this->tableOrder}.xsaa43 >=:rcsjq AND {$this->tableOrder}.xsaa43 <= :rcsjz";
			$where['value'][':rcsjq'] = $rcsjq;
			$where['value'][':rcsjz'] = $rcsjz;
		}
		if(!empty($rcsjq)){
			$where['express'] .= " AND {$this->tableOrder}.xsaa43 >=:rcsjq";
			$where['value'][':rcsjq'] = $rcsjq;
		}
		if(!empty($rcsjz)){
			$where['express'] .= " AND {$this->tableOrder}.xsaa43 <=:rcsjz";
			$where['value'][':rcsjz'] = $rcsjz;
		}
        $select = "{$this->tableName}.xsab03,{$this->tableName}.xsab02,sum({$this->tableName}.xsab14) as xsab14,sum({$this->tableName}.xsab15) as xsab15,{$this->tableName}.xsab19,{$this->tableOrder}.xsaa31,{$this->tableOrder}.xsaa41,{$this->tableOrder}.xsaa43";

        $this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.xsab01 = {$this->tableOrder}.xsaa02")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.xsab01 = {$this->tableOrder}.xsaa02")
						                   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;

	}

	/**
	 * @desc 退货款号明细查询
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 退货款号明细列表信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 */
	// public function DetailedInquiry($page,$psize,$cpmc,$cpkh,$rcsjq,$rcsjz,$ddid,$gysid,$kdgs,$zffs,$syz,$goodStatus){
	//      $where['express'] = "{$this->tableName}.xsab12 = :goodStatus";
	// 	$where['value']['goodStatus'] = $goodStatus;

	// 	//print_r($goodStatus);die;

	// 	if (!empty($cpmc)) {
	// 		$where['express'] .= " AND {$this->tableName}.xsab02 like :cpmc";
	// 		$where['value'][':cpmc'] = "%{$cpmc}%";
	// 	}
	// 	if (!empty($cpkh)) {
	// 		$where['express'] .= " AND {$this->tableName}.xsab03 like :cpkh";
	// 		$where['value'][':cpkh'] = "%{$cpkh}%";
	// 	}
	// 	if (!empty($ddid)) {
	// 		$where['express'] .= " AND {$this->tableName}.xsab01 like :ddid";
	// 		$where['value'][':ddid'] = "%{$ddid}%";
	// 	}
	// 	if (!empty($kdgs)) {
	// 		$where['express'] .= " AND {$this->tableOrder}.xsaa41 like :kdgs";
	// 		$where['value'][':kdgs'] = "%{$kdgs}%";
	// 	}
	// 	if (!empty($zffs)) {
	// 		$where['express'] .= " AND {$this->tableOrder}.xsaa13 like :zffs";
	// 		$where['value'][':zffs'] = "%{$zffs}%";
	// 	}
	// 	if (!empty($syz)) {
	// 		$where['express'] .= " AND {$this->tableOrder}.xsaa31 like :syz";
	// 		$where['value'][':syz'] = "%{$syz}%";
	// 	}
	// 	if (!empty($gysid)) {
	// 		$where['express'] .= " AND {$this->tableOrder}.xsaa31 like :gysid";
	// 		$where['value'][':gysid'] = "%{$gysid}%";
	// 	}

	// 	if(!empty($rcsjq)&&!empty($rcsjz)){
	// 		$where['express'] .= " AND {$this->tableOrder}.xsaa43 >=:rcsjq AND {$this->tableOrder}.xsaa43 <= :rcsjz";
	// 		$where['value'][':rcsjq'] = $rcsjq;
	// 		$where['value'][':rcsjz'] = $rcsjz;
	// 	}
	// 	if(!empty($rcsjq)){
	// 		$where['express'] .= " AND {$this->tableOrder}.xsaa43 >=:rcsjq";
	// 		$where['value'][':rcsjq'] = $rcsjq;
	// 	}
	// 	if(!empty($rcsjz)){
	// 		$where['express'] .= " AND {$this->tableOrder}.xsaa43 <=:rcsjz";
	// 		$where['value'][':rcsjz'] = $rcsjz;
	// 	}

	// 	$select = "{$this->tableName}.xsab03,{$this->tableName}.xsab02,sum({$this->tableName}.xsab14) as xsab14,sum({$this->tableName}.xsab15) as xsab15,{$this->tableName}.xsab19,{$this->tableOrder}.xsaa31,{$this->tableOrder}.xsaa41,{$this->tableOrder}.xsaa43";

 //        $this->dbCommand->reset();
	// 	$this->dbCommand->select($select)
	// 					->from($this->tableName)
	// 					->leftJoin($this->tableOrder, "{$this->tableName}.xsab01 = {$this->tableOrder}.xsaa02")
	// 					->where($where['express'],$where['value'])
	// 					->limit($psize, $psize * ($page - 1));
	// 	$result['info'] = $this->dbCommand->queryAll();
	// 	$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
	// 									   ->from($this->tableName)
	// 									   ->leftJoin($this->tableOrder, "{$this->tableName}.xsab01 = {$this->tableOrder}.xsaa02")
	// 					                   ->where($where['express'],$where['value'])
	// 									   ->where($where['express'],$where['value'])
	// 									   ->queryScalar();		
	// 	return $result;

	// }


	/**
	 * @desc 获取订单列表
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-14
	 */
	public function getObtainorderdetails($orderNo){		
		$select = "{$this->tableName}.xsab01,{$this->tableName}.xsab02,{$this->tableName}.xsab03,{$this->tableName}.xsab04,{$this->tableName}.xsab05,{$this->tableName}.xsab06,{$this->tableName}.xsab07,{$this->tableName}.xsab08";
		$where['express'] = "{$this->tableName}.xsab01 = :orderNo";
		$where['value']['orderNo'] = $orderNo;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();

		return $result;
	}


	/**
	 * @desc 根据订单号和产品名称获取订单明细
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-14
	 */
	public function getSmallClasscation($girard,$orderNo){
		$where['express'] = "{$this->tableName}.xsab03 = :girard AND {$this->tableName}.xsab01 = :orderNo";
	    $where['value']['girard'] = $girard;
	    $where['value']['orderNo'] = $orderNo;	
		$select = "{$this->tableName}.xsab01,{$this->tableName}.xsab02,{$this->tableName}.xsab03,{$this->tableName}.xsab04,{$this->tableName}.xsab05,{$this->tableName}.xsab06,{$this->tableName}.xsab07";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						//->order("{$this->tableName}.khad05 ".' DESC')
						->limit(1,0);	
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取订单商品款号
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-21
	 */
	public function getDifferOrder($orderNo){		
		$select = "{$this->tableName}.xsab03";
		$where['express'] = "{$this->tableName}.xsab01 = :orderNo";
		$where['value']['orderNo'] = $orderNo;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();

		return $result;
	}

	/**
	 * @desc 获取订单商品总价和总数
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-29
	 */
	public function getTotalPrice($orderno){		
		$select = "{$this->tableName}.xsab04,{$this->tableName}.xsab07,{$this->tableName}.xsab08,{$this->tableName}.xsab11";
		$where['express'] = "{$this->tableName}.xsab01 = :orderno";
		$where['value']['orderno'] = $orderno;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		
		return $result;
	}

	
}

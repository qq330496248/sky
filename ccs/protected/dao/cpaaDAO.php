<?php
/**
 * @desc 产品表操作类
 * @author WuJunhua
 * @date 2015-11-13 
 */
class cpaaDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-13
	 * @param string $className
	 * @return cpaaDAO
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
		$this->tableName = 'cpaa';
		$this->tableStock = 'cpae';
		$this->tableProDetail = 'cpaf';
		$this->primaryKey = 'cpaa01';
	}
	/**
	 * @desc 根据条件获取产品
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $cond 查询条件
	 * @return array $result 产品信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function getCpByCond($page,$psize,$cond,$selectColumnStr=false){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa06,{$this->tableName}.cpaa07,{$this->tableName}.cpaa08,{$this->tableName}.cpaa09,{$this->tableName}.cpaa06,{$this->tableName}.cpaa10,{$this->tableName}.cpaa13,{$this->tableName}.cpaa14,{$this->tableName}.cpaa16,{$this->tableName}.cpaa19,cpab.cpab02 as fl,cpad.cpad03";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.cpaa01 > 0";
		$where['value'] = array();

		if(!empty($cond)){
			if(!empty($cond['cpaa02'])){
				$where['express'].=" AND {$this->tableName}.cpaa02 like :cpaa02";
				$where['value'][':cpaa02'] = '%'.$cond['cpaa02'].'%';
			}
			if(!empty($cond['cpaa03'])){
				$where['express'].=" AND {$this->tableName}.cpaa03 = :cpaa03 ";
				$where['value'][':cpaa03'] = $cond['cpaa03'];
			}
			if(!empty($cond['cpaa05'])){
				$where['express'].=" AND {$this->tableName}.cpaa05 = :cpaa05 ";
				$where['value'][':cpaa05'] = $cond['cpaa05'];
			}
			if(!empty($cond['cpaa16'])){
				$where['express'].=" AND {$this->tableName}.cpaa16 like :cpaa16 ";
				$where['value'][':cpaa16'] = '%'.$cond['cpaa16'].'%';
			}
			if(!empty($cond['cpaa08'])){
				$where['express'].=" AND {$this->tableName}.cpaa08 = :cpaa08 ";
				$where['value'][':cpaa08'] = $cond['cpaa08'];
			}
			if(!empty($cond['cpaa09'])){
				$where['express'].=" AND {$this->tableName}.cpaa09 = :cpaa09 ";
				$where['value'][':cpaa09'] = $cond['cpaa09'];
			}
			if(!empty($cond['cpaa14'])){
				$where['express'].=" AND {$this->tableName}.cpaa14 = :cpaa14 ";
				$where['value'][':cpaa14'] = $cond['cpaa14'];
			}
			if(!empty($cond['begindate'])){
				$where['express'].=" AND {$this->tableName}.cpaa07 >= :begindate ";
				$where['value'][':begindate'] = $cond['begindate'];
			}
			if(!empty($cond['enddate'])){
				$where['express'].=" AND {$this->tableName}.cpaa07 <= :enddate ";
				$where['value'][':enddate'] = $cond['enddate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpab',"{$this->tableName}.cpaa03=cpab.cpab01")
						->leftjoin('cpad',"{$this->tableName}.cpaa05=cpad.cpad01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("cpaa01".' DESC');

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
	/**
	 * @desc 根据条件获取产品（批量修改）
	 * @return array $result 产品信息
	 * @author DengShaocong
	 * @date 2015-12-1
	 */
	public function getCp($cond){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02";
		$where['express'] = "{$this->tableName}.cpaa01 > 0";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['cpaa01'])){
				$where['express'].=" AND {$this->tableName}.cpaa01 = :cpaa01";
				$where['value'][':cpaa01'] = $cond['cpaa01'];
			}
			if(!empty($cond['cpaa02'])){
				$where['express'].=" AND {$this->tableName}.cpaa02 like :cpaa02";
				$where['value'][':cpaa02'] = '%'.$cond['cpaa02'].'%';
			}
			if(!empty($cond['cpaa03'])){
				$where['express'].=" AND {$this->tableName}.cpaa03 = :cpaa03 ";
				$where['value'][':cpaa03'] = $cond['cpaa03'];
			}
			if(!empty($cond['cpaa04'])){
				$where['express'].=" AND {$this->tableName}.cpaa04 = :cpaa04 ";
				$where['value'][':cpaa04'] = $cond['cpaa04'];
			}
			if(!empty($cond['cpaa05'])){
				$where['express'].=" AND {$this->tableName}.cpaa05 = :cpaa05 ";
				$where['value'][':cpaa05'] = $cond['cpaa05'];
			}
		}

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("cpaa01".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 根据产品分类获取产品
	 * @param int $cpfl 产品分类ID
	 * @return array $result 产品信息
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function getCpByFl($cpfl){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02";
		$where['express'] = "{$this->tableName}.cpaa03 = ".$cpfl." ";
		$where['value'] = array();
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("cpaa01".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 根据产品品牌获取产品
	 * @param int $cppp 产品品牌ID
	 * @return array $result 产品信息
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function getCpByPp($cppp){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02";
		$where['express'] = "{$this->tableName}.cpaa05 = ".$cppp." ";
		$where['value'] = array();
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("cpaa01".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}
	/**
	 * @desc 根据ID获取产品
	 * @param int $id ID
	 * @return array $result 产品信息
	 * @author DengShaocong
	 * @date 2015-12-1
	 */
	public function getCpById($id){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa06,{$this->tableName}.cpaa07,
					{$this->tableName}.cpaa08,{$this->tableName}.cpaa09,{$this->tableName}.cpaa06,{$this->tableName}.cpaa10,
					{$this->tableName}.cpaa12,{$this->tableName}.cpaa13,{$this->tableName}.cpaa14,{$this->tableName}.cpaa16,
					cpab.cpab01,cpab.cpab02,cpad.cpad01,cpad.cpad03,cgab.cgab01,cgab.cgab02";
		$where['express'] = "{$this->tableName}.cpaa01 = ".$id;
		$where['value'] = array();
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpab',"{$this->tableName}.cpaa03=cpab.cpab01")
						->leftjoin('cpad',"{$this->tableName}.cpaa05=cpad.cpad01")
						->leftjoin('cgab',"{$this->tableName}.cpaa18=cgab.cgab01")
						->where($where['express'],$where['value'])
						->order("cpaa01".' DESC');

		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 根据产品主键获取一个产品属性（一级）
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-5
	 */
	public function getCpsxParent($id){
		$select = "cpag.cpag03";
		$where['express'] = "{$this->tableName}.cpaa01 = :cpaa01 ";
		$where['value'][':cpaa01'] = $id;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpsxxq',"{$this->tableName}.cpaa01=cpsxxq.cpid")
						->leftjoin('cpag',"cpsxxq.sxid=cpag.cpag01")
						->where($where['express'],$where['value'])
						->order("cpaa01".' ASC');

		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 下单时根据商品编号获取商品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-01-05
	 */
	public function findGoodListByGoodId($goodId){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa06,{$this->tableName}.cpaa10,sum({$this->tableStock}.cpae03) as cpae03,{$this->tableName}.cpaa11,{$this->tableName}.cpaa12,{$this->tableName}.cpaa13,{$this->tableName}.cpaa16";
		$where['express'] = "{$this->tableName}.cpaa01 = :goodId ";
		$where['value'][':goodId'] = $goodId;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin("{$this->tableStock}","{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.cpaa01");
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 下单时获取10条最新的商品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function findAllGoodList($goodName){
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
		return $result;
	}

	/**
	 * @desc 全部产品信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-03-22
	 */
	public function GettsAllGood($page,$psize,$cpkh,$cpmc){	
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa06,{$this->tableName}.cpaa10,sum({$this->tableStock}.cpae03) as cpae03";
		$where['express'] = "{$this->tableName}.cpaa01 > 0";
		$where['value'] = array();
		if(!empty($cpkh)){
			$where['express'].=" AND {$this->tableName}.cpaa01 like :cpkh";
			$where['value'][':cpkh'] = '%'.$cpkh.'%';
		}
		if(!empty($cpmc)){
			$where['express'].=" AND {$this->tableName}.cpaa02 like :cpmc";
			$where['value'][':cpmc'] = '%'.$cpmc.'%';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin("{$this->tableStock}","{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->group("{$this->tableName}.cpaa01")
					    ->order("cpaa01".' DESC');
						//->order("$order "." $sequence");
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftjoin("{$this->tableStock}","{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
										   ->where($where['express'],$where['value'])
										   ->group("{$this->tableName}.cpaa01")
										   ->queryAll();
		$result['count'] = count($count);					   		
		return $result;
	}

	/**
	 * @desc 获取产品库存明细列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 客户订单列表信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 * @modify WuJunhua 2016-03-16 完善查询条件
	 */
	public function getProductStockDetails($page,$psize,$CondList,$selectColumnStr=false){		
		$select = "{$this->tableStock}.cpae01,{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa10,{$this->tableStock}.cpae06,{$this->tableStock}.cpae03,{$this->tableStock}.cpae04,{$this->tableStock}.cpae09,{$this->tableStock}.cpae07,{$this->tableStock}.cpae13,{$this->tableName}.cpaa15,{$this->tableName}.cpaa08,{$this->tableStock}.cpae21";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
        if($CondList['stock'] == 2){
        	$where['express'] = "{$this->tableStock}.cpae01 > 0";
        }else{
        	$where['express'] = "{$this->tableStock}.cpae03 > 0";
        }
		$where['value'] = [];

		if(!empty($CondList)){
			if(!empty($CondList['cpmc'])){
				$where['express'].=" AND {$this->tableName}.cpaa02 like :cpmc";
				$where['value'][':cpmc'] = '%'.$CondList['cpmc'].'%';
			}
			if(!empty($CondList['cpkh'])){
				$where['express'].=" AND {$this->tableName}.cpaa01 like :cpkh ";
				$where['value'][':cpkh'] = '%'.$CondList['cpkh'].'%';
			}
			
			if(!empty($CondList['cpjj'])){
				if($CondList['cpjj'] == '='){
					$where['express'].=" AND {$this->tableName}.cpaa06 = :price";
				}
				if($CondList['cpjj'] == '>'){
					$where['express'].=" AND {$this->tableName}.cpaa06 > :price";
				}
				if($CondList['cpjj'] == '<'){
					$where['express'].=" AND {$this->tableName}.cpaa06 < :price";
				}
				$where['value'][':price'] = $CondList['price'];
			}
			if(!empty($CondList['location'])){
				$where['express'].=" AND {$this->tableStock}.cpae06 like :location ";
				$where['value'][':location'] = '%'.$CondList['location'].'%';
			}
			if(!empty($CondList['cpsxj'])){
				$where['express'].=" AND {$this->tableName}.cpaa08 = :cpsxj ";
				$where['value'][':cpsxj'] = $CondList['cpsxj'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableStock, "{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						//->leftJoin('cgab', "{$this->tableName}.cpaa18 = cgab.cgab01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						//->group("{$this->tableName}.cpaa01")
						//->order("{$this->tableStock}.cpae01 "." DESC");
						->order(array('cpaa01 DESC','cpae01 DESC'));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count']  = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableStock, "{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						                   //->leftJoin('cgab', "{$this->tableName}.cpaa18 = cgab.cgab01")
						                   ->where($where['express'],$where['value'])
										   //->group("{$this->tableName}.cpaa01")
										   ->queryScalar();	
		//$result['count'] = count($count);	
		return $result;
	}

	/**
	 * @desc库存明细查询
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param int $$khname 查询条件
	 * @param int $khphone 查询条件
	 * @return array $result 查询到的库存明细列表信息
	 * @author huyan
	 * @date 2015-11-25
	 */
	public function getQueryStock($page,$psize,$cpmc,$cpkh,$zhrksjq,$zhrksjz,$zhchsjq,$zhchsjz,$cpfl1,$kcs,$cpsxj,$cpjj){
		//$where['express'] = '';
		$where['express'] = "{$this->tableName}.cpaa01 > 0";
		$where['value'] = array();
		if(!empty($cpmc)){
			$where['express'] .= " AND {$this->tableName}.cpaa02 like :cpmc";
			$where['value'][':cpmc'] = "%{$cpmc}%";
		}
		
		if(!empty($cpkh)){
			$where['express'] .= " AND {$this->tableName}.cpaa01 like :cpkh";
			$where['value'][':cpkh'] = "%{$cpkh}%";
		}
		if(!empty($kcs)){
			$where['express'] .= " AND {$this->tableStock}.cpae03 like :kcs";
			$where['value'][':kcs'] = "%{$kcs}%";
		}
		if(!empty($cpsxj)){
			$where['express'] .= " AND {$this->tableName}.cpaa08 like :cpsxj";
			$where['value'][':cpsxj'] = "%{$cpsxj}%";
		}
		if(!empty($cpjj)){
			$where['express'] .= " AND {$this->tableStock}.cpae07 like :cpjj";
			$where['value'][':cpjj'] = "%{$cpjj}%";
		}
		if(!empty($zhrksjq)&&!empty($zhrksjz)){
			$where['express'] .= " AND {$this->tableProDetail}.cpaf07 >=:zhrksjq AND {$this->tableName}.cpaf07 <= :zhrksjz";
			$where['value'][':zhrksjq'] = $zhrksjq;
			$where['value'][':zhrksjz'] = $zhrksjz;
		}
		if(!empty($zhrksjq)){
			$where['express'] .= " AND {$this->tableProDetail}.cpaf07 >=:zhrksjq";
			$where['value'][':zhrksjq'] = $zhrksjq;
		}
		if(!empty($zhrksjz)){
			$where['express'] .= " AND {$this->tableProDetail}.cpaf07 <=:zhrksjz";
			$where['value'][':zhrksjz'] = $zhrksjz;
		}
		if(!empty($zhchsjq)&&!empty($zhchsjz)){
			$where['express'] .= " AND {$this->tableProDetail}.cpaf07 >=:zhchsjq AND {$this->tableName}.cpaf07 <= :zhchsjz";
			$where['value'][':zhchsjq'] = $zhchsjq;
			$where['value'][':zhchsjz'] = $zhchsjz;
		}
		if(!empty($zhchsjq)){
			$where['express'] .= " AND {$this->tableProDetail}.cpaf07 >=:zhchsjq";
			$where['value'][':zhchsjq'] = $zhchsjq;
		}
		if(!empty($zhchsjz)){
			$where['express'] .= " AND {$this->tableProDetail}.cpaf07 <=:zhchsjz";
			$where['value'][':zhchsjz'] = $zhchsjz;
		}

		$select = "{$this->tableName}.cpaa01,{$this->tableProDetail}.cpaf07,{$this->tableName}.cpaa02,{$this->tableName}.cpaa10,{$this->tableStock}.cpae06,sum({$this->tableStock}.cpae03) as cpae03,{$this->tableStock}.cpae04,{$this->tableStock}.cpae09,{$this->tableStock}.cpae07,{$this->tableStock}.cpae13,{$this->tableName}.cpaa15,{$this->tableName}.cpaa08,cgab.cgab02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableStock, "{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						->leftJoin('cgab', "{$this->tableName}.cpaa18 = cgab.cgab01")
						->leftJoin('cpaf', "{$this->tableName}.cpaa01 = cpaf.cpaf03")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->group("{$this->tableName}.cpaa01")
						->order("{$this->tableName}.cpaa07 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$count  = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableStock, "{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						                   ->leftJoin('cgab', "{$this->tableName}.cpaa18 = cgab.cgab01")
						                   ->where($where['express'],$where['value'])
										   ->group("{$this->tableName}.cpaa01")
										   ->queryAll();		
		$result['count'] = count($count);	
		return $result;
	}

	/**
	 * @desc 获取库存盘点列表信息(库存量 > 0)
	 * @return array $result 退货款号明细列表信息
	 * @author WuJunhua
	 * @date 2015-11-30
	 */
	public function getInventoryCheckList($goodName){		
		$select = "{$this->tableStock}.cpae01,{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa10,{$this->tableStock}.cpae12,{$this->tableStock}.cpae03,{$this->tableStock}.cpae06,{$this->tableStock}.cpae02";
		$where['express'] = "{$this->tableStock}.cpae03 > :kcl";
		$where['value']['kcl'] = 0;
		if(!empty($goodName)){
			$where['express'].=" AND {$this->tableName}.cpaa02 like :goodName";
			$where['value'][':goodName'] = '%'.$goodName.'%';
		}
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableStock, "{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						->where($where['express'],$where['value'])
						->limit(10,0)
						->order("{$this->tableStock}.cpae01 "." DESC");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 盘点时根据批次号、商品编号获取商品信息
	 * @return array $result 商品信息
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function getGoodById($goodId,$batchId){		
		$select = "{$this->tableStock}.cpae01,{$this->tableName}.cpaa02,{$this->tableStock}.cpae02";
		$where['express'] = "{$this->tableStock}.cpae01 = :batchId AND {$this->tableStock}.cpae02 = :goodId";
		$where['value']['goodId'] = $goodId;
		$where['value']['batchId'] = $batchId;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableStock, "{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取库存盘点流水记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 库存盘点流水记录列表信息
	 * @author WuJunhua
	 * @date 2015-12-03
	 */
	public function getInventoryFlowRecordList($page,$psize,$goodStatus,$CondList,$selectColumnStr=false){		
		$select = "pdaa.pdaa01,{$this->tableName}.cpaa01,{$this->tableName}.cpaa16,{$this->tableName}.cpaa02,pdab.pdab08,pdaa.pdaa02,pdaa.pdaa03";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "pdaa.pdaa04 = :goodStatus";
		$where['value']['goodStatus'] = $goodStatus;
		
		if(!empty($CondList)){
			if(!empty($CondList['cpmc'])){
			$where['express'] .= " AND {$this->tableName}.cpaa02 like :cpmc";
			$where['value'][':cpmc'] = '%'.$CondList['cpmc'].'%';
		    }
		    if(!empty($CondList['cpkh'])){
		    	$where['express'] .= " AND {$this->tableName}.cpaa01 like :cpkh";
		    	$where['value'][':cpkh'] = '%'.$CondList['cpkh'].'%';
		    }
		    if(!empty($CondList['pdczr'])){
		    	$where['express'] .= " AND pdaa.pdaa02 like :pdczr";
		    	$where['value'][':pdczr'] = '%'.$CondList['pdczr'].'%';
		    }
		    if(!empty($CondList['pdtxm'])){
		    	$where['express'] .= " AND {$this->tableName}.cpaa15 like :pdtxm";
		    	$where['value'][':pdtxm'] = '%'.$CondList['pdtxm'].'%';
		    }

		    //根据时间段查询
		    if(!empty($CondList['pdsjq']) && !empty($CondList['pdsjz'])){
		    	$where['express'] .= " AND pdaa.pdaa03 >=:pdsjq AND pdaa.pdaa03 <= :pdsjz";
		    	$where['value'][':pdsjq'] = $CondList['pdsjq'];
		    	$where['value'][':pdsjz'] = $CondList['pdsjz'];
		    }
		    if (!empty($CondList['pdsjq'])) {
		    	$where['express'] .= " AND pdaa.pdaa03 >=:pdsjq";
		    	$where['value'][':pdsjq'] = $CondList['pdsjq'];
		    }
		    if (!empty($CondList['pdsjz'])) {
		    	$where['express'] .= " AND pdaa.pdaa03 <=:pdsjz";
		    	$where['value'][':pdsjz'] = $CondList['pdsjz'];
		    }
		}

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin('pdab', "{$this->tableName}.cpaa01 = pdab.pdab03")
						->leftJoin('pdaa', "pdab.pdab01 = pdaa.pdaa01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("pdaa.pdaa03 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin('pdab', "{$this->tableName}.cpaa01 = pdab.pdab03")
										   ->leftJoin('pdaa', "pdab.pdab01 = pdaa.pdaa01")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();		
		return $result;
	}

	/**
	 * @desc @desc库存盘点记录查询
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 库存盘点流水记录列表信息
	 * @author huyan
	 * @date 2015-12-10
	 */
	public function InventoryRecordQuery($page,$psize,$cpmc,$cpkh,$pdczr,$pdtxm,$goodStatus){		
		$where['express'] = "pdaa.pdaa04 = :goodStatus";
		$where['value']['goodStatus'] = $goodStatus;
	    if(!empty($cpmc)){
			$where['express'] .= " AND {$this->tableName}.cpaa02 like :cpmc";
			$where['value'][':cpmc'] = "%{$cpmc}%";
		}
		if(!empty($cpkh)){
			$where['express'] .= " AND {$this->tableName}.cpaa01 like :cpkh";
			$where['value'][':cpkh'] = "%{$cpkh}%";
		}
		if(!empty($pdczr)){
			$where['express'] .= " AND pdaa.pdaa02 like :pdczr";
			$where['value'][':pdczr'] = "%{$pdczr}%";
		}

		if(!empty($pdtxm)){
			$where['express'] .= " AND {$this->tableName}.cpaa15 like :pdtxm";
			$where['value'][':pdtxm'] = "%{$pdtxm}%";
		}


		$select = "pdaa.pdaa01,{$this->tableName}.cpaa01,{$this->tableName}.cpaa15,{$this->tableName}.cpaa16,{$this->tableName}.cpaa02,pdab.pdab08,pdaa.pdaa02,pdaa.pdaa03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin('pdab', "{$this->tableName}.cpaa01 = pdab.pdab03")
						->leftJoin('pdaa', "pdab.pdab01 = pdaa.pdaa01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("pdaa.pdaa03 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin('pdab', "{$this->tableName}.cpaa01 = pdab.pdab03")
										   ->leftJoin('pdaa', "pdab.pdab01 = pdaa.pdaa01")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();		
		return $result;
	}

	/**
	 * @desc 获取库存异动明细记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $transactionType 入库类型
	 * @return array $result 客户订单列表信息
	 * @author WuJunhua
	 * @date 2015-12-31
	 */
	public function getProductWarehousingRecording($page,$psize,$transactionType,$CondList,$selectColumnStr=false){		
		$select = "{$this->tableProDetail}.cpaf02,{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableProDetail}.cpaf16,{$this->tableProDetail}.cpaf08,{$this->tableProDetail}.cpaf05,{$this->tableProDetail}.cpaf07,{$this->tableProDetail}.cpaf09,{$this->tableProDetail}.cpaf14,{$this->tableProDetail}.cpaf12,{$this->tableProDetail}.cpaf10";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
        $where['express'] = "{$this->tableProDetail}.cpaf09 NOT IN(:directStorage,:purchaseStorage,:endWarehousing)";
		$where['value']['directStorage'] = $transactionType['directStorage'];
		$where['value']['purchaseStorage'] = $transactionType['purchaseStorage'];
		$where['value']['endWarehousing'] = $transactionType['endWarehousing'];
		
		if (!empty($CondList)) {
		    if(!empty($CondList['rkcw'])){
				$where['express'].=" AND {$this->tableStock}.cpae06 like :rkcw";
				$where['value'][':rkcw'] = '%'.$CondList['rkcw'].'%';
			}
			if(!empty($CondList['rkgys'])){
				$where['express'].=" AND {$this->tableProDetail}.cpaf14 like :rkgys";
				$where['value'][':rkgys'] = '%'.$CondList['rkgys'].'%';
			}
			if(!empty($CondList['rkpc'])){
				$where['express'].=" AND {$this->tableStock}.cpae01 like :rkpc";
				$where['value'][':rkpc'] = '%'.$CondList['rkpc'].'%';
			}
		    //根据时间段查询
		    if(!empty($CondList['rcsjq'])&&!empty($CondList['rcsjz'])){
		    	$where['express'] .= " AND {$this->tableProDetail}.cpaf07 >=:rcsjq AND {$this->tableProDetail}.cpaf07 <= :rcsjz";
		    	$where['value'][':rcsjq'] =$CondList['rcsjq'];
		    	$where['value'][':rcsjz'] =$CondList['rcsjz'];
		    }
		    if (!empty($CondList['rcsjq'])) {
		    	$where['express'] .= " AND {$this->tableProDetail}.cpaf07 >=:rcsjq";
		    	$where['value'][':rcsjq'] = $CondList['rcsjq'];
		    }
		    if (!empty($CondList['rcsjz'])) {
		    	$where['express'] .= " AND {$this->tableProDetail}.cpaf07 <=:rcsjz";
		    	$where['value'][':rcsjz'] = $CondList['rcsjz'];
		    }
	    }
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						//->leftJoin($this->tableStock, "{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
						//->leftJoin($this->tableProDetail, "{$this->tableStock}.cpae01 = {$this->tableProDetail}.cpaf02 and {$this->tableStock}.cpae02 = {$this->tableProDetail}.cpaf03")
						->leftJoin($this->tableProDetail, "{$this->tableName}.cpaa01 = {$this->tableProDetail}.cpaf03")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableProDetail}.cpaf07 "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   //->leftJoin($this->tableStock, "{$this->tableName}.cpaa01 = {$this->tableStock}.cpae02")
										   //->leftJoin($this->tableProDetail, "{$this->tableStock}.cpae01 = {$this->tableProDetail}.cpaf02 and {$this->tableStock}.cpae02 = {$this->tableProDetail}.cpaf03")
										   ->leftJoin($this->tableProDetail, "{$this->tableName}.cpaa01 = {$this->tableProDetail}.cpaf03")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 获取产品销售统计——获取产品信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getCpxstjByCond($cond){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,b.cgab02,{$this->tableName}.cpaa07";
		$where['express'] = " {$this->tableName}.cpaa01 > 0 ";
		$where['value'] = array();
		if(!empty($cond['ppmc'])){
			$where['express'].=" AND {$this->tableName}.cpaa05 like :cpaa05 ";
			$where['value'][':cpaa05'] = '%'.$cond['ppmc'].'%';
		}
		if(!empty($cond['cpkh'])){
			$where['express'].=" AND {$this->tableName}.cpaa01 = :cpaa01 ";
			$where['value'][':cpaa01'] = $cond['cpkh'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cgab b',"{$this->tableName}.cpaa18 = b.cgab01")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取产品销售统计——获取统计信息（确认，发货，收货）
	 * @param array $cond 查询条件
	 * @param string $type 类型（确认，发货，收货）
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getCpxstjDetails($cond,$type){
		$select = "sum(xsab04) orders,sum(xsab08) money";
		$where['express'] = " {$this->tableName}.cpaa01 = ". $cond['cpkh'] ." and xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'].=" AND a.xsaa61 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'];
		}
		if(!empty($cond['endDate'])){
			$where['express'].=" AND a.xsaa61 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'];
		}
		if(!empty($cond['media'])){
			$where['express'].=" AND kh.khaa22 = :media ";
			$where['value'][':media'] = $cond['media'];
		}

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('xsab b',"{$this->tableName}.cpaa01 = b.xsab03")
						->leftjoin('xsaa a',"b.xsab01 = a.xsaa02")
						->leftjoin('khaa kh',"a.xsaa04 = kh.khaa02")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['orders']) && empty($result[0]['money'])){
			return array(
				'orders'=>0,
				'money'=>0
				);
		}
		return $result[0];
	}

	/**
	 * @desc 获取每日出库报表——获取产品列表
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getMrckbbCp($cond){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa16";
		$where['express'] = " {$this->tableName}.cpaa01 > 0 ";
		$where['value'] = array();
		if(!empty($cond['cpmc'])){
			$where['express'].=" AND {$this->tableName}.cpaa02 like :cpmc ";
			$where['value'][':cpmc'] = '%'.$cond['cpmc'].'%';
		}
		if(!empty($cond['cpkh'])){
			$where['express'].=" AND {$this->tableName}.cpaa01 like :cpkh ";
			$where['value'][':cpkh'] = '%'.$cond['cpkh'].'%';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取每日出库报表——获取报表信息（无=库存，入库，出库）
	 * @param array $cond 查询条件
	 * @param string $type 类型（无=库存，入库，出库）
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getMrckbbByCond($cond,$type){
		$select = "SUM(af.cpaf08) num";
		$where['express'] = " {$this->tableName}.cpaa01 = ".$cond['cpaa']." ";
		$where['value'] = array();
		if($type == ''){
			$select = "ae.cpae03 zpkc,ae.cpae04 cpkc,ae.cpae06 kw";
		}else{
			$where['express'] .= " and af.cpaf09 like '%$type%' ";
		}
		if(!empty($cond['beginDate'])){
			$where['express'] .= " and af.cpaf07 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'].' 00:00:00';
		}
		if(!empty($cond['endDate'])){
			$where['express'] .= " and af.cpaf07 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'].' 23:59:59';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpae ae',"{$this->tableName}.cpaa01 = ae.cpae02")
						->leftjoin('cpaf af',"ae.cpae01 = af.cpaf02")
						->where($where['express'],$where['value'])
						->group('ae.cpae06');
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num'])){
			if($type == ''){
				return array(
					'zpkc'=>0,
					'cpkc'=>0,
					'kw'=>''
					);
			}else{
				return array(
					'num'=>0
					);
			}
		}
		return $result[0];
	}


	/**
	 * @desc 根据主键查找商品库存
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function checkStock($id){
		$select = "sum(cpae03) sum";
		$where['express'] = "ae.cpae02 = '$id'";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpae ae',"{$this->tableName}.cpaa01 = ae.cpae02")
						->where($where['express'],array())
						->group("{$this->tableName}.cpaa01");
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array('sum'=>0);
		}
		return $result[0];
	}

	/**
	 * @desc 获取供应商进销存报表明细（库存）
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-22
	 */
	public function getMygysjxcByCondKC($cond){
		$select = "sum(cpae03) as num,sum(cpae13) as money,count({$this->tableName}.cpaa01) as count";
		$where['express'] = "{$this->tableName}.cpaa18 = '". $cond['gysid'] ."' ";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpae ae',"{$this->tableName}.cpaa01 = ae.cpae02")
						->where($where['express'],array());
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num']) && empty($result[0]['money'])){
			return array(
				'num'=>0,
				'money'=>0,
				'count'=>empty($result) ? 0 : $result[0]['count']
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取供应商进销存报表明细（发货，收货）
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-22
	 */
	public function getMygysjxcByCond($cond,$type){
		$select = "sum(xsab04) orders,sum(xsab08) money,sum(xsab05) cost";
		$where['express'] = " {$this->tableName}.cpaa18 = '". $cond['gysid'] ."' and xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond['beginDate'])){
			$where['express'].=" AND a.xsaa61 >= :beginDate ";
			$where['value'][':beginDate'] = $cond['beginDate'];
		}
		if(!empty($cond['endDate'])){
			$where['express'].=" AND a.xsaa61 <= :endDate ";
			$where['value'][':endDate'] = $cond['endDate'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('xsab b',"{$this->tableName}.cpaa01 = b.xsab03")
						->leftjoin('xsaa a',"b.xsab01 = a.xsaa02")
						->leftjoin('khaa kh',"a.xsaa04 = kh.khaa02")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();

		if(empty($result[0]['orders']) && empty($result[0]['money']) && empty($result[0]['cost'])){
			return array(
				'orders'=>0,
				'money'=>0,
				'cost'=>0
				);
		}
		return $result[0];
	}

	/**
	 * @desc 下单时验证输入的商品名称是否存在
	 * @param string $goodName 商品名称
	 * @author huyan
	 * @date 2016-03-24
	 */
	public function checkGoodsNameIsExits($goodName){	
		$select = "{$this->tableName}.cpaa02,{$this->tableName}.cpaa03,";
		$where['express'] = "";
		$where['value'] = array();
		if (!empty($goodName)) {
			$where['express'] .= "{$this->tableName}.cpaa02 like :goodName";
			$where['value'][':goodName'] = "%{$goodName}%";
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 下单时验证输入的商品款号是否存在
	 * @param string $goodName 商品名称
	 * @author huyan
	 * @date 2016-03-24
	 */
	public function checkGoodsNumberIsExits($goodNumber){	
		$select = "{$this->tableName}.cpaa02,{$this->tableName}.cpaa03,";
		$where['express'] = "";
		$where['value'] = array();
		if (!empty($goodNumber)) {
			$where['express'] .= "{$this->tableName}.cpaa01 like :goodNumber";
			$where['value'][':goodNumber'] = "%{$goodNumber}%";
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 根据条件获取产品
	 * @param array $cond 查询条件
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 产品信息
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function getAllCpkhByCond($cond,$page,$psize){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,cgab.cgab02,cgab.cgab21,{$this->tableName}.cpaa07";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.cpaa01 > 0";
		$where['value'] = array();

		if(!empty($cond)){
			if(!empty($cond['cpfl'])){
				$where['express'].=" AND {$this->tableName}.cpaa03 = :cpfl ";
				$where['value'][':cpfl'] = $cond['cpfl'];
			}
			if(!empty($cond['cpzfl'])){
				$where['express'].=" AND {$this->tableName}.cpaa04 = :cpzfl ";
				$where['value'][':cpzfl'] = $cond['cpzfl'];
			}
			if(!empty($cond['cpkh'])){
				$where['express'].=" AND {$this->tableName}.cpaa01 = :cpkh ";
				$where['value'][':cpkh'] = $cond['cpkh'];
			}
			if(!empty($cond['gysID'])){
				$where['express'].=" AND cgab.cgab01 like :gysID ";
				$where['value'][':gysID'] = '%'.$cond['gysID'].'%';
			}
			if(!empty($cond['gysName'])){
				$where['express'].=" AND cgab.cgab02 like :gysName ";
				$where['value'][':gysName'] = '%'.$cond['gysName'].'%';
			}
			if(!empty($cond['cgwy'])){
				$where['express'].=" AND cgab.cgab20 = :cgwy ";
				$where['value'][':cgwy'] = $cond['cgwy'];
			}
			if(!empty($cond['jkfs'])){
				$where['express'].=" AND cgab.cgab02 like :gysName ";
				$where['value'][':gysName'] = '%'.$cond['gysName'].'%';
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cgab',"{$this->tableName}.cpaa18=cgab.cgab01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("cpaa01".' DESC');

		$result['list'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}


	/**
	 * @desc 获取款号进销存报表明细（进货，进货中）
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function getKhjxcByCondJH($cond,$type){
		$select = "sum(cgac06) num,sum(cgac07) money,avg(cgac05) cost";
		$where['express'] = "{$this->tableName}.cpaa01 = ".$cond['cpkh']." and cgaa.cgaa13 = $type ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= " and cgaa.cgaa06 >= :beginDate";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= " and cgaa.cgaa06 <= :endDate";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cgac',"{$this->tableName}.cpaa01=cgac.cgac03")
						->leftjoin('cgaa','cgac02=cgaa01')
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num']) && empty($result[0]['money']) && empty($result[0]['cost'])){
			return array(
				'num'=>0,
				'money'=>0,
				'cost'=>0
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取款号进销存报表明细（发货，收货）
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function getKhjxcByCondOrders($cond,$type){
		$select = "sum(xsab04) num,sum(xsab08) money,sum(xsab07) cost";
		$where['express'] = "{$this->tableName}.cpaa01 = ".$cond['cpkh']." and xsaa.xsaa29 in ($type) ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= " and xsaa.xsaa23 >= :beginDate";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= " and xsaa.xsaa23 <= :endDate";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('xsab',"{$this->tableName}.cpaa01=xsab.xsab03")
						->leftjoin('xsaa','xsab02=xsaa01')
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num']) && empty($result[0]['money']) && empty($result[0]['cost'])){
			return array(
				'num'=>0,
				'money'=>0,
				'cost'=>0
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取款号进销存报表明细（退货，退货中）
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function getKhjxcByCondTH($cond,$type){
		$select = "sum(cgac14) num,sum(cgac13) money,avg(cgac05) cost";
		$where['express'] = "{$this->tableName}.cpaa01 = ".$cond['cpkh']." and cgaa.cgaa13 = $type ";
		$where['value'] = array();
		if(!empty($cond)){
			if(!empty($cond['beginDate'])){
				$where['express'] .= " and cgaa.cgaa06 >= :beginDate";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= " and cgaa.cgaa06 <= :endDate";
				$where['value'][':endDate'] = $cond['endDate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cgac',"{$this->tableName}.cpaa01=cgac.cgac03")
						->leftjoin('cgaa','cgac02=cgaa01')
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num']) && empty($result[0]['money']) && empty($result[0]['cost'])){
			return array(
				'num'=>0,
				'money'=>0,
				'cost'=>0
				);
		}
		return $result[0];
	}


	/**
	 * @desc 获取款号进销存报表明细（库存）
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function getKhjxcByCondKC($cond){
		$select = "sum(cpae03) as num,sum(cpae13) as money";
		$where['express'] = "{$this->tableName}.cpaa01 = ".$cond['cpkh']." ";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpae ae',"{$this->tableName}.cpaa01 = ae.cpae02")
						->where($where['express'],array());
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num']) && empty($result[0]['money'])){
			return array(
				'num'=>0,
				'money'=>0
				);
		}
		return $result[0];
	}
	/**
	 * @desc 获取所有产品（首页显示预警产品）
	 * @return array $reslut 列表信息
	 * @author DengShaocong
	 * @date 2016-03-24
	 */
	public function getAllProducts(){
		$select = "{$this->tableName}.cpaa01,{$this->tableName}.cpaa02,{$this->tableName}.cpaa20,{$this->tableName}.cpaa16,sum(cpae.cpae03) sum";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('cpae',"{$this->tableName}.cpaa01=cpae.cpae02")
						->group("{$this->tableName}.cpaa01");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

}
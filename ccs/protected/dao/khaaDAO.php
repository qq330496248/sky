<?php
/**
 * @desc 客户表操作类
 * @author WuJunhua
 * @date 2015-10-27 
 */
class khaaDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-10-27
	 * @param string $className
	 * @return khaaDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-10-26
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khaa';
		$this->tableOrder = 'xsaa';
		$this->tableOrderDetail = 'xsab';
		$this->primaryKey = 'khaa01';
		$this->createtime = 'khaa30';
	}

	/**
	 * @desc 获取我的客户列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author WuJunhua
	 * @date 2015-10-28
	 */
	public function GetMyClient($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo,$selectColumnStr=false){		
		$select = "{$this->tableName}.khaa01,{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa06,{$this->tableName}.khaa04,{$this->tableName}.khaa23,
				   {$this->tableName}.khaa38,{$this->tableName}.khaa30,{$this->tableName}.khaa18,{$this->tableName}.khaa19,
				   {$this->tableName}.khaa20,{$this->tableName}.khaa28,{$this->tableName}.khaa25,{$this->tableName}.khaa22,
				   {$this->tableName}.khaa12,{$this->tableName}.khaa32,{$this->tableName}.khaa33,{$this->tableName}.khaa46";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.khaa32 = :JobNumber";
		$where['value']['JobNumber'] = $JobNumber;
		if (!empty($addrInfo)) {
			 if(!empty($addrInfo['khsf'])){
				$where['express'].=" AND {$this->tableName}.khaa12 like :khsf";
				$where['value'][':khsf'] = '%'.$addrInfo['khsf'].'%';
			}
			  if(!empty($addrInfo['khsf'])&&!empty($addrInfo['city'])){
			 	$sfsq=$addrInfo['khsf'].','.$addrInfo['city'];
			 	
				$where['express'] .= " AND {$this->tableName}.khaa12 like :sfsq";
			    $where['value'][':sfsq'] = "%{$sfsq}%";
			}
			 if(!empty($addrInfo['khsf'])&&!empty($addrInfo['city'])&&!empty($addrInfo['area'])){
			 	$sfqx=$addrInfo['khsf'].','.$addrInfo['city'].','.$addrInfo['area'];
				$where['express'] .= " AND {$this->tableName}.khaa12 like :sfqx";
			    $where['value'][':sfqx'] = "%{$sfqx}%";
			}
		}
		if (!empty($CondList)) {
		    if(!empty($CondList['khname'])){
				$where['express'].=" AND {$this->tableName}.khaa03 like :khname";
				$where['value'][':khname'] = '%'.$CondList['khname'].'%';
			}
		    if(!empty($CondList['khsr'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa05 like :khsr";
		    	$where['value'][':khsr'] = '%'.$CondList['khsr'].'%';
		    }
		    if(!empty($CondList['khphone'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa06 like :khphone";
		    	$where['value'][':khphone'] = '%'.$CondList['khphone'].'%';
		    }
		    if(!empty($CondList['khdj'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa23 like :khdj";
		    	$where['value'][':khdj'] = '%'.$CondList['khdj'].'%';
		    }
		    if(!empty($CondList['khgmcp'])){
		    	$where['express'] .= " AND {$this->tableOrderDetail}.xsab02 like :khgmcp OR {$this->tableOrderDetail}.xsab03 like :khgmcp";
		    	$where['value'][':khgmcp'] = '%'.$CondList['khgmcp'].'%';
		    	
		    }
		    if(!empty($CondList['zcfs'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa29 like :zcfs";
		    	$where['value'][':zcfs'] = '%'.$CondList['zcfs'].'%';
		    }
		    if(!empty($CondList['khly'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa22 like :khly";
		    	$where['value'][':khly'] =  '%'.$CondList['khly'].'%';
		    }
		    if(!empty($CondList['nsr'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa27 like :nsr";
		    	$where['value'][':nsr'] =  '%'.$CondList['nsr'].'%';
		    }
		    if(!empty($CondList['gmcs'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa35 like :gmcs";
		    	$where['value'][':gmcs'] = '%'.$CondList['gmcs'].'%';
		    }
		    if(!empty($CondList['khxb'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa04 like :khxb";
		    	$where['value'][':khxb'] =  '%'.$CondList['khxb'].'%';
		    }
		    //根据消费金额查询
		    if(!empty($CondList['xfjed'])&&!empty($CondList['xfjex'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 >=:xfjed AND {$this->tableName}.khaa28 <= :xfjex";
		    	$where['value'][':xfjed'] = $CondList['xfjed'];
		    	$where['value'][':xfjex'] = $CondList['xfjex'];
		    }
		    if(!empty($CondList['xfjed'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 >=:xfjed";
		    	$where['value'][':xfjed'] =  $CondList['xfjed'];
		    }
		    if(!empty($CondList['xfjex'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 <=:xfjex";
		    	$where['value'][':xfjex'] = $CondList['xfjex'];
            }

		    //根据时间段查询
		    if(!empty($CondList['zxgjq'])&&!empty($CondList['zxgjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa18 >=:zxgjq AND {$this->tableName}.khaa18 <= :zxgjz";
		    	$where['value'][':zxgjq'] =$CondList['zxgjz'];
		    	$where['value'][':zxgjz'] =$CondList['zxgjq'];
		    }
		    if (!empty($CondList['zxgjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa18 >=:zxgjq";
		    	$where['value'][':zxgjq'] = $CondList['zxgjq'];
		    }
		    if (!empty($CondList['zxgjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa18 <=:zxgjz";
		    	$where['value'][':zxgjz'] = $CondList['zxgjz'];
		    }
		    if(!empty($CondList['zxzdq'])&&!empty($CondList['zxzdz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa19 >=:zxzdq AND {$this->tableName}.khaa19 <= :zxzdz";
		    	$where['value'][':zxzdq'] = $CondList['zxzdq'];
		    	$where['value'][':zxzdz'] = $CondList['zxzdz'];
		    }
		    if (!empty($CondList['zxzdq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa19 >=:zxzdq";
		    	$where['value'][':zxzdq'] = $CondList['zxzdq'];
		    }
		    if (!empty($CondList['zxzdz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa19 <=:zxzdz";
		    	$where['value'][':zxzdz'] =$CondList['zxzdz'];
		    }

		    if(!empty($CondList['zxqsq'])&&!empty($CondList['zxqsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 >=:zxqsq AND {$this->tableName}.khaa20 <= :zxqsz";
		    	$where['value'][':zxqsq'] = $CondList['zxqsq'];
		    	$where['value'][':zxqsz'] = $CondList['zxqsz'];
		    }
		    if(!empty($CondList['zxqsq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 >=:zxqsq";
		    	$where['value'][':zxqsq'] = $CondList['zxqsq'];
		    	
		    }
		    if(!empty($CondList['zxqsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 <=:zxqsz";
		    	$where['value'][':zxqsz'] = $CondList['zxqsz'];
		    	
		    }
		
		    if(!empty($CondList['zxjsq'])&&!empty($CondList['zxjsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 >=:zxjsq AND {$this->tableName}.khaa21 <= :zxjsz";
		    	$where['value'][':zxjsq'] = $CondList['zxjsq'];
		    	$where['value'][':zxjsz'] = $CondList['zxjsz'];
		    }
		    if(!empty($CondList['zxjsq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 >=:zxjsq";
		    	$where['value'][':zxjsq'] = $CondList['zxjsq'];
		    	
		    }
		    if(!empty($CondList['zxjsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 <=:zxjsz";
		    	$where['value'][':zxjsz'] = $CondList['zxjsz'];
		    	
		    }

		    if(!empty($CondList['khzcsjq'])&&!empty($CondList['khzcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 >=:khzcsjq AND {$this->tableName}.khaa30 <= :khzcsjz";
		    	$where['value'][':khzcsjq'] = $CondList['khzcsjq'];
		    	$where['value'][':khzcsjz'] = $CondList['khzcsjz'];
		    }
		    if(!empty($CondList['khzcsjq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 >=:khzcsjq";
		    	$where['value'][':khzcsjq'] = $CondList['khzcsjq'];
		    }
		    if(!empty($CondList['khzcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 <=:khzcsjz";
		    	$where['value'][':khzcsjz'] = $CondList['khzcsjz'];
		    }

		    if(!empty($CondList['khnlq'])&&!empty($CondList['khnlz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 >=:khnlq AND {$this->tableName}.khaa47 <= :khnlz";
		    	$where['value'][':khnlq'] =$CondList['khnlq'];
		    	$where['value'][':khnlz'] =$CondList['khnlz'];
		    }

		    if(!empty($CondList['khnlq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 >=:khnlq";
		    	$where['value'][':khnlq'] = $CondList['khnlq'];
		    }
		    if(!empty($CondList['khnlz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 <=:khnlz";
		    	$where['value'][':khnlz'] = $CondList['khnlz'];
		    }
	    }
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->leftJoin($this->tableOrderDetail, "{$this->tableOrder}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->group("{$this->tableName}.khaa02")
						->order("$order $sequence");
						//->order("$order "." $sequence");
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						                   ->leftJoin($this->tableOrderDetail, "{$this->tableOrder}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->where($where['express'],$where['value'])
										   ->group("{$this->tableName}.khaa02")
										   ->queryAll();
		$result['count'] = count($count);					   		
		return $result;
	}


	/**
	 * @desc 获取未分配客户列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-04-01
	 */
	public function GetNoDistribution($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo,$selectColumnStr=false){		
		$select = "{$this->tableName}.khaa01,{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa06,{$this->tableName}.khaa04,{$this->tableName}.khaa23,
				   {$this->tableName}.khaa38,{$this->tableName}.khaa30,{$this->tableName}.khaa18,{$this->tableName}.khaa19,
				   {$this->tableName}.khaa20,{$this->tableName}.khaa28,{$this->tableName}.khaa25,{$this->tableName}.khaa22,
				   {$this->tableName}.khaa12,{$this->tableName}.khaa32,{$this->tableName}.khaa33,{$this->tableName}.khaa46";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$gmcs=0;
		$sffp='';
		$where['express'] = "{$this->tableName}.khaa48 = :sffp AND {$this->tableName}.khaa35 > :gmcs";
		$where['value']['sffp'] = $sffp;
		$where['value']['gmcs'] = $gmcs;



		if (!empty($addrInfo)) {
			 if(!empty($addrInfo['khsf'])){
				$where['express'].=" AND {$this->tableName}.khaa12 like :khsf";
				$where['value'][':khsf'] = '%'.$addrInfo['khsf'].'%';
			}
			  if(!empty($addrInfo['khsf'])&&!empty($addrInfo['city'])){
			 	$sfsq=$addrInfo['khsf'].','.$addrInfo['city'];
			 	
				$where['express'] .= " AND {$this->tableName}.khaa12 like :sfsq";
			    $where['value'][':sfsq'] = "%{$sfsq}%";
			}
			 if(!empty($addrInfo['khsf'])&&!empty($addrInfo['city'])&&!empty($addrInfo['area'])){
			 	$sfqx=$addrInfo['khsf'].','.$addrInfo['city'].','.$addrInfo['area'];
				$where['express'] .= " AND {$this->tableName}.khaa12 like :sfqx";
			    $where['value'][':sfqx'] = "%{$sfqx}%";
			}
		}
		if (!empty($CondList)) {
		    if(!empty($CondList['khname'])){
				$where['express'].=" AND {$this->tableName}.khaa03 like :khname";
				$where['value'][':khname'] = '%'.$CondList['khname'].'%';
			}
		    if(!empty($CondList['khsr'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa05 like :khsr";
		    	$where['value'][':khsr'] = '%'.$CondList['khsr'].'%';
		    }
		    if(!empty($CondList['khphone'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa06 like :khphone";
		    	$where['value'][':khphone'] = '%'.$CondList['khphone'].'%';
		    }
		    if(!empty($CondList['khdj'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa23 like :khdj";
		    	$where['value'][':khdj'] = '%'.$CondList['khdj'].'%';
		    }
		    if(!empty($CondList['khgmcp'])){
		    	$where['express'] .= " AND {$this->tableOrderDetail}.xsab02 like :khgmcp OR {$this->tableOrderDetail}.xsab03 like :khgmcp";
		    	$where['value'][':khgmcp'] = '%'.$CondList['khgmcp'].'%';
		    	
		    }
		    if(!empty($CondList['zcfs'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa29 like :zcfs";
		    	$where['value'][':zcfs'] = '%'.$CondList['zcfs'].'%';
		    }
		    if(!empty($CondList['khly'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa22 like :khly";
		    	$where['value'][':khly'] =  '%'.$CondList['khly'].'%';
		    }
		    if(!empty($CondList['nsr'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa27 like :nsr";
		    	$where['value'][':nsr'] =  '%'.$CondList['nsr'].'%';
		    }
		    if(!empty($CondList['gmcs'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa35 like :gmcs";
		    	$where['value'][':gmcs'] = '%'.$CondList['gmcs'].'%';
		    }
		    if(!empty($CondList['khxb'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa04 like :khxb";
		    	$where['value'][':khxb'] =  '%'.$CondList['khxb'].'%';
		    }
		    //根据消费金额查询
		    if(!empty($CondList['xfjed'])&&!empty($CondList['xfjex'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 >=:xfjed AND {$this->tableName}.khaa28 <= :xfjex";
		    	$where['value'][':xfjed'] = $CondList['xfjed'];
		    	$where['value'][':xfjex'] = $CondList['xfjex'];
		    }
		    if(!empty($CondList['xfjed'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 >=:xfjed";
		    	$where['value'][':xfjed'] =  $CondList['xfjed'];
		    }
		    if(!empty($CondList['xfjex'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 <=:xfjex";
		    	$where['value'][':xfjex'] = $CondList['xfjex'];
            }

		    //根据时间段查询
		    if(!empty($CondList['zxgjq'])&&!empty($CondList['zxgjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa18 >=:zxgjq AND {$this->tableName}.khaa18 <= :zxgjz";
		    	$where['value'][':zxgjq'] =$CondList['zxgjz'];
		    	$where['value'][':zxgjz'] =$CondList['zxgjq'];
		    }
		    if (!empty($CondList['zxgjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa18 >=:zxgjq";
		    	$where['value'][':zxgjq'] = $CondList['zxgjq'];
		    }
		    if (!empty($CondList['zxgjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa18 <=:zxgjz";
		    	$where['value'][':zxgjz'] = $CondList['zxgjz'];
		    }
		    if(!empty($CondList['zxzdq'])&&!empty($CondList['zxzdz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa19 >=:zxzdq AND {$this->tableName}.khaa19 <= :zxzdz";
		    	$where['value'][':zxzdq'] = $CondList['zxzdq'];
		    	$where['value'][':zxzdz'] = $CondList['zxzdz'];
		    }
		    if (!empty($CondList['zxzdq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa19 >=:zxzdq";
		    	$where['value'][':zxzdq'] = $CondList['zxzdq'];
		    }
		    if (!empty($CondList['zxzdz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa19 <=:zxzdz";
		    	$where['value'][':zxzdz'] =$CondList['zxzdz'];
		    }

		    if(!empty($CondList['zxqsq'])&&!empty($CondList['zxqsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 >=:zxqsq AND {$this->tableName}.khaa20 <= :zxqsz";
		    	$where['value'][':zxqsq'] = $CondList['zxqsq'];
		    	$where['value'][':zxqsz'] = $CondList['zxqsz'];
		    }
		    if(!empty($CondList['zxqsq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 >=:zxqsq";
		    	$where['value'][':zxqsq'] = $CondList['zxqsq'];
		    	
		    }
		    if(!empty($CondList['zxqsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 <=:zxqsz";
		    	$where['value'][':zxqsz'] = $CondList['zxqsz'];
		    	
		    }
		
		    if(!empty($CondList['zxjsq'])&&!empty($CondList['zxjsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 >=:zxjsq AND {$this->tableName}.khaa21 <= :zxjsz";
		    	$where['value'][':zxjsq'] = $CondList['zxjsq'];
		    	$where['value'][':zxjsz'] = $CondList['zxjsz'];
		    }
		    if(!empty($CondList['zxjsq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 >=:zxjsq";
		    	$where['value'][':zxjsq'] = $CondList['zxjsq'];
		    	
		    }
		    if(!empty($CondList['zxjsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 <=:zxjsz";
		    	$where['value'][':zxjsz'] = $CondList['zxjsz'];
		    	
		    }

		    if(!empty($CondList['khzcsjq'])&&!empty($CondList['khzcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 >=:khzcsjq AND {$this->tableName}.khaa30 <= :khzcsjz";
		    	$where['value'][':khzcsjq'] = $CondList['khzcsjq'];
		    	$where['value'][':khzcsjz'] = $CondList['khzcsjz'];
		    }
		    if(!empty($CondList['khzcsjq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 >=:khzcsjq";
		    	$where['value'][':khzcsjq'] = $CondList['khzcsjq'];
		    }
		    if(!empty($CondList['khzcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 <=:khzcsjz";
		    	$where['value'][':khzcsjz'] = $CondList['khzcsjz'];
		    }

		    if(!empty($CondList['khnlq'])&&!empty($CondList['khnlz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 >=:khnlq AND {$this->tableName}.khaa47 <= :khnlz";
		    	$where['value'][':khnlq'] =$CondList['khnlq'];
		    	$where['value'][':khnlz'] =$CondList['khnlz'];
		    }

		    if(!empty($CondList['khnlq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 >=:khnlq";
		    	$where['value'][':khnlq'] = $CondList['khnlq'];
		    }
		    if(!empty($CondList['khnlz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 <=:khnlz";
		    	$where['value'][':khnlz'] = $CondList['khnlz'];
		    }
	    }
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->leftJoin($this->tableOrderDetail, "{$this->tableOrder}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->group("{$this->tableName}.khaa02")
						->order("$order $sequence");
						//->order("$order "." $sequence");
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						                   ->leftJoin($this->tableOrderDetail, "{$this->tableOrder}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->where($where['express'],$where['value'])
										   ->group("{$this->tableName}.khaa02")
										   ->queryAll();
		$result['count'] = count($count);					   		
		return $result;
	}

	/**
	 * @desc 获取我的下属客户列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 我的下属客户列表信息
	 * @author huyan
	 * @date 2015-11-20
	 */
	public function Subordinate($page,$psize,$CondList,$order,$JobNumber,$addrInfo,$selectColumnStr=false){
		$select = "{$this->tableName}.khaa01,{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa06,{$this->tableName}.khaa04,{$this->tableName}.khaa23,
				   {$this->tableName}.khaa38,{$this->tableName}.khaa30,{$this->tableName}.khaa18,{$this->tableName}.khaa19,
				   {$this->tableName}.khaa20,{$this->tableName}.khaa28,{$this->tableName}.khaa25,{$this->tableName}.khaa22,
				   {$this->tableName}.khaa12,{$this->tableName}.khaa32,{$this->tableName}.khaa33,{$this->tableName}.khaa46";
		if(!empty($selectColumnStr)){
			$select = $selectColumnStr;
		}
		$where['express'] = "{$this->tableName}.khaa46 = :JobNumber";
		$where['value']['JobNumber'] = $JobNumber;

		if (!empty($addrInfo)) {
			 if(!empty($addrInfo['khsf'])){
				$where['express'].=" AND {$this->tableName}.khaa12 like :khsf";
				$where['value'][':khsf'] = '%'.$addrInfo['khsf'].'%';
			}
			  if(!empty($addrInfo['khsf'])&&!empty($addrInfo['city'])){
			 	$sfsq=$addrInfo['khsf'].','.$addrInfo['city'];
			 	
				$where['express'] .= " AND {$this->tableName}.khaa12 like :sfsq";
			    $where['value'][':sfsq'] = "%{$sfsq}%";
			}
			 if(!empty($addrInfo['khsf'])&&!empty($addrInfo['city'])&&!empty($addrInfo['area'])){
			 	$sfqx=$addrInfo['khsf'].','.$addrInfo['city'].','.$addrInfo['area'];
				$where['express'] .= " AND {$this->tableName}.khaa12 like :sfqx";
			    $where['value'][':sfqx'] = "%{$sfqx}%";
			}
		}
		if (!empty($CondList)) {
		    if(!empty($CondList['khname'])){
				$where['express'].=" AND {$this->tableName}.khaa03 like :khname";
				$where['value'][':khname'] = '%'.$CondList['khname'].'%';
			}
		    if(!empty($CondList['khsr'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa05 like :khsr";
		    	$where['value'][':khsr'] = '%'.$CondList['khsr'].'%';
		    }
		    if(!empty($CondList['khphone'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa06 like :khphone";
		    	$where['value'][':khphone'] = '%'.$CondList['khphone'].'%';
		    }
		    if(!empty($CondList['khdj'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa23 like :khdj";
		    	$where['value'][':khdj'] = '%'.$CondList['khdj'].'%';
		    }
		    if(!empty($CondList['khgmcp'])){
		    	$where['express'] .= " AND {$this->tableOrderDetail}.xsab02 like :khgmcp OR {$this->tableOrderDetail}.xsab03 like :khgmcp";
		    	$where['value'][':khgmcp'] = '%'.$CondList['khgmcp'].'%';
		    	
		    }
		    if(!empty($CondList['zcfs'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa29 like :zcfs";
		    	$where['value'][':zcfs'] = '%'.$CondList['zcfs'].'%';
		    }
		    if(!empty($CondList['khly'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa22 like :khly";
		    	$where['value'][':khly'] =  '%'.$CondList['khly'].'%';
		    }
		    if(!empty($CondList['nsr'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa27 like :nsr";
		    	$where['value'][':nsr'] =  '%'.$CondList['nsr'].'%';
		    }
		    if(!empty($CondList['gmcs'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa35 like :gmcs";
		    	$where['value'][':gmcs'] = '%'.$CondList['gmcs'].'%';
		    }
		    if(!empty($CondList['khxb'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa04 like :khxb";
		    	$where['value'][':khxb'] =  '%'.$CondList['khxb'].'%';
		    }
		    //根据消费金额查询
		    if(!empty($CondList['xfjed'])&&!empty($CondList['xfjex'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 >=:xfjed AND {$this->tableName}.khaa28 <= :xfjex";
		    	$where['value'][':xfjed'] = $CondList['xfjed'];
		    	$where['value'][':xfjex'] = $CondList['xfjex'];
		    }
		    if(!empty($CondList['xfjed'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 >=:xfjed";
		    	$where['value'][':xfjed'] =  $CondList['xfjed'];
		    }
		    if(!empty($CondList['xfjex'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa28 <=:xfjex";
		    	$where['value'][':xfjex'] = $CondList['xfjex'];
            }

		    //根据时间段查询
		    if(!empty($CondList['zxgjq'])&&!empty($CondList['zxgjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa18 >=:zxgjq AND {$this->tableName}.khaa18 <= :zxgjz";
		    	$where['value'][':zxgjq'] =$CondList['zxgjz'];
		    	$where['value'][':zxgjz'] =$CondList['zxgjq'];
		    }
		    if (!empty($CondList['zxgjq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa18 >=:zxgjq";
		    	$where['value'][':zxgjq'] = $CondList['zxgjq'];
		    }
		    if (!empty($CondList['zxgjz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa18 <=:zxgjz";
		    	$where['value'][':zxgjz'] = $CondList['zxgjz'];
		    }
		    if(!empty($CondList['zxzdq'])&&!empty($CondList['zxzdz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa19 >=:zxzdq AND {$this->tableName}.khaa19 <= :zxzdz";
		    	$where['value'][':zxzdq'] = $CondList['zxzdq'];
		    	$where['value'][':zxzdz'] = $CondList['zxzdz'];
		    }
		    if (!empty($CondList['zxzdq'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa19 >=:zxzdq";
		    	$where['value'][':zxzdq'] = $CondList['zxzdq'];
		    }
		    if (!empty($CondList['zxzdz'])) {
		    	$where['express'] .= " AND {$this->tableName}.khaa19 <=:zxzdz";
		    	$where['value'][':zxzdz'] =$CondList['zxzdz'];
		    }

		    if(!empty($CondList['zxqsq'])&&!empty($CondList['zxqsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 >=:zxqsq AND {$this->tableName}.khaa20 <= :zxqsz";
		    	$where['value'][':zxqsq'] = $CondList['zxqsq'];
		    	$where['value'][':zxqsz'] = $CondList['zxqsz'];
		    }
		    if(!empty($CondList['zxqsq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 >=:zxqsq";
		    	$where['value'][':zxqsq'] = $CondList['zxqsq'];
		    	
		    }
		    if(!empty($CondList['zxqsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa20 <=:zxqsz";
		    	$where['value'][':zxqsz'] = $CondList['zxqsz'];
		    	
		    }
		
		    if(!empty($CondList['zxjsq'])&&!empty($CondList['zxjsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 >=:zxjsq AND {$this->tableName}.khaa21 <= :zxjsz";
		    	$where['value'][':zxjsq'] = $CondList['zxjsq'];
		    	$where['value'][':zxjsz'] = $CondList['zxjsz'];
		    }
		    if(!empty($CondList['zxjsq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 >=:zxjsq";
		    	$where['value'][':zxjsq'] = $CondList['zxjsq'];
		    	
		    }
		    if(!empty($CondList['zxjsz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa21 <=:zxjsz";
		    	$where['value'][':zxjsz'] = $CondList['zxjsz'];
		    	
		    }
		    if(!empty($CondList['khzcsjq'])&&!empty($CondList['khzcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 >=:khzcsjq AND {$this->tableName}.khaa30 <= :khzcsjz";
		    	$where['value'][':khzcsjq'] = $CondList['khzcsjq'];
		    	$where['value'][':khzcsjz'] = $CondList['khzcsjz'];
		    }
		    if(!empty($CondList['khzcsjq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 >=:khzcsjq";
		    	$where['value'][':khzcsjq'] = $CondList['khzcsjq'];
		    }
		    if(!empty($CondList['khzcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 <=:khzcsjz";
		    	$where['value'][':khzcsjz'] = $CondList['khzcsjz'];
		    }

		    if(!empty($CondList['khnlq'])&&!empty($CondList['khnlz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 >=:khnlq AND {$this->tableName}.khaa47 <= :khnlz";
		    	$where['value'][':khnlq'] =$CondList['khnlq'];
		    	$where['value'][':khnlz'] =$CondList['khnlz'];
		    }

		    if(!empty($CondList['khnlq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 >=:khnlq";
		    	$where['value'][':khnlq'] = $CondList['khnlq'];
		    }
		    if(!empty($CondList['khnlz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa47 <=:khnlz";
		    	$where['value'][':khnlz'] = $CondList['khnlz'];
		    }
	    }
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->leftJoin($this->tableOrderDetail, "{$this->tableOrder}.xsaa02 = {$this->tableOrderDetail}.xsab01")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} ".' DESC')
						->group("{$this->tableName}.khaa02");
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						                   ->leftJoin($this->tableOrderDetail, "{$this->tableOrder}.xsaa02 = {$this->tableOrderDetail}.xsab01")
										   ->where($where['express'],$where['value'])
										   ->group("{$this->tableName}.khaa02")
										   ->queryAll();
		$result['count'] = count($count);
		return $result;
	}


	/**
	 * @desc 获取查询我的客户列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param int $searchType 查询类型
	 * @param int $keyword 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public function getClientData($page,$psize,$searchType,$keyword){		
		$where['express'] = "{$this->tableName}.khaa01 > 0";
		$where['value'] = array();
		if(!empty($keyword)){
			switch ($searchType) {
				case 1:
					$where['express'] .= " AND {$this->tableName}.khaa02 like :keyword";
					$where['value'][':keyword'] = "%{$keyword}%";
					break;
				case 2:
					$where['express'] .= " AND {$this->tableOrder}.xsaa02 like :keyword";
					$where['value'][':keyword'] = "%{$keyword}%";
					break;
				case 3:
					$where['express'] .= " AND {$this->tableOrder}.xsaa03 like :keyword";
					$where['value'][':keyword'] = "%{$keyword}%";
					break;
				case 4:
					$where['express'] .= " AND {$this->tableName}.khaa06 like :keyword";
					$where['value'][':keyword'] = "%{$keyword}%";
					break;
				case 5:
					$where['express'] .= " AND {$this->tableName}.khaa11 like :keyword";
					$where['value'][':keyword'] = "%{$keyword}%";
					break;
				case 6:
					$where['express'] .= " AND {$this->tableName}.khaa03 like :keyword";
					$where['value'][':keyword'] = "%{$keyword}%";
					break;
				case 7:
					$where['express'] .= " AND {$this->tableName}.khaa09 like :keyword";
					$where['value'][':keyword'] = "%{$keyword}%";
					break;

				default:
					return false;
					break;
			}
		}
		
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa04,{$this->tableName}.khaa23,
				   {$this->tableName}.khaa38,{$this->tableName}.khaa30,{$this->tableName}.khaa18,{$this->tableName}.khaa19,
				   {$this->tableName}.khaa20,{$this->tableName}.khaa28,{$this->tableName}.khaa25,{$this->tableName}.khaa22,{$this->tableName}.khaa12,{$this->tableName}.khaa32,{$this->tableName}.khaa33";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->where($where['express'],$where['value'])
						->group("{$this->tableName}.khaa02")
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
										   ->where($where['express'],$where['value'])
										   ->group("{$this->tableName}.khaa02")
										   ->queryAll();
		$result['count'] = count($count);								   
		return $result;
	}


	/**
	 * @desc 合并客户资料查询
	 * @param int $searchType 查询类型
	 * @param int $keyword 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author huyan
	 * @date 2015-11-17
	 *modify huyan  2015-11-18  修改查询条件
	 */
	public function getCustomer($searchType,$keyword,$clientno){
		$where['express'] = "{$this->tableName}.khaa02 != :clientno";
	    $where['value']['clientno'] = $clientno;
		if($searchType == 1){
			$where['express'] .= " AND {$this->tableName}.khaa02 = :ordernum";
			$where['value']['ordernum'] = $keyword;
		}
		if($searchType == 2){
			$where['express'] .= " AND {$this->tableName}.khaa06 = :khphone";
			$where['value']['khphone'] = $keyword;
		}
		if($searchType == 3){
			$where['express'] .= " AND {$this->tableName}.khaa03 = :khname";
			$where['value']['khname'] = $keyword;
		}
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa06";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa01 ".' DESC');
		$result = $this->dbCommand->queryRow(); 
		return $result;
	}

	/**
	 * @desc 获取客户编号信息
	 * @return array $result 客户编号信息
	 * @author huyan
	 * @date 2015-11-02
	 */
	public function getMaxCustomerNumber(){	
		$select = "{$this->tableName}.khaa02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.khaa01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取序号最大的下属客户
	 * @return array $result 序号最大的客户
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function findMaxOrder($JobNumber){	
		$select = "{$this->tableName}.khaa02";
		$where['express'] = "{$this->tableName}.khaa46 = :JobNumber";
	    $where['value']['JobNumber'] = $JobNumber;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa02 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取序号最小的下属客户
	 * @return array $result 序号最小的客户
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function findMinOrder($JobNumber){	
		$select = "{$this->tableName}.khaa02";
		$where['express'] = "{$this->tableName}.khaa46 = :JobNumber";
	    $where['value']['JobNumber'] = $JobNumber;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa02 ".' ASC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

		/**
	 * @desc 获取序号最大的客户
	 * @return array $result 序号最大的客户
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function findMaxcustomer($JobNumber){	
		$select = "{$this->tableName}.khaa02";
		$where['express'] = "{$this->tableName}.khaa32 = :JobNumber";
	    $where['value']['JobNumber'] = $JobNumber;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa02 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取序号最小的客户
	 * @return array $result 序号最小的客户
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function findMincustomer($JobNumber){	
		$select = "{$this->tableName}.khaa02";
		$where['express'] = "{$this->tableName}.khaa32 = :JobNumber";
	    $where['value']['JobNumber'] = $JobNumber;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa02 ".' ASC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 提交合并客户资料
	 * @param int $searchType 查询类型
	 * @author huyan
	 * @date 2015-11-18
	 */
	public function getComitMerger($clientNo,$searchType,$keyword,$khzl1Client,$khzl2Client,$retaintype){
		if($searchType == 1){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableOrder}.xsaa04 = :ordernum";
			    $where['value']['ordernum'] = $khzl2Client;
			}
			if ($retaintype==2) {
				$where['express'] = "{$this->tableOrder}.xsaa04 = :ordernum";
			    $where['value']['ordernum'] = $khzl1Client;
			}
		}
		if($searchType == 2){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableOrder}.xsaa04 = :phone";
			    $where['value']['phone'] = $khzl2Client;
			}	
			if ($retaintype==2) {
				$where['express'] = "{$this->tableOrder}.xsaa04 = :phone";
			    $where['value']['phone'] = $khzl1Client;
			}	
		}
		if($searchType == 3){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableOrder}.xsaa04 = :khname";
			    $where['value']['khname'] = $khzl2Client;
			}	
			if ($retaintype==2) {
				$where['express'] = "{$this->tableOrder}.xsaa04 = :khname";
			    $where['value']['khname'] = $khzl1Client;
			}
			}
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa06,{$this->tableOrder}.xsaa04,{$this->tableOrder}.xsaa05";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->where($where['express'],$where['value']);
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 添加订单时获取该客户的历史订单记录
	 * @param int $searchType 查询类型
	 * @param int $keyword 每页显示的记录条数
	 * @return array $result 订单结果信息
	 * @author huyan
	 * @date 2015-11-30
	 */
	public function HistoricalOrder($clientNo){	//,$clientInfo
		if (!empty($clientNo)) {
			$where['express'] = "{$this->tableOrder}.xsaa04 = :clientNo";
	        $where['value']['clientNo'] = $clientNo;
		}	
		$select = "{$this->tableName}.khaa28,{$this->tableName}.khaa35";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->where($where['express'],$where['value']);
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 提交合并客户资料
	 * @param int $searchType 查询类型
	 * @param int $keyword 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author huyan
	 * @date 2015-11-18
	 */
	public function OrderInquiry($clientNo){
		$where['express'] = "{$this->tableOrder}.xsaa04 = :clientNo";
		$where['value']['clientNo'] = $clientNo;
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableOrder}.xsaa04,{$this->tableOrder}.xsaa05";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->where($where['express'],$where['value']);
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 添加客户资料查询用户名是否存在
	 * @param int $searchType 查询类型
	 * @param int $keyword 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function QueryUser($khname){	
		$where['express'] = "{$this->tableName}.khaa03 = :khname";
		$where['value']['khname'] = $khname;

		$select = "{$this->tableName}.khaa03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
						/*->order("id".' ASC');*/
		$result = $this->dbCommand->queryrow();
		return $result;
	}

	/**
	 * @desc /查询该客户有没有订单(返回单个)
	 * @param int $searchType 查询类型
	 * @param int $keyword 每页显示的记录条数
	 * @author huyan
	 * @date 2015-12-09
	 */
	public function getComplaintOrder($clientNo){
	    $where['express'] = "{$this->tableOrder}.xsaa04 = :clientNo";
		$where['value']['clientNo'] = $clientNo;
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableOrder}.xsaa04,{$this->tableOrder}.xsaa05,{$this->tableOrder}.xsaa02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->where($where['express'],$where['value'])
						//->order("{$this->tableName}.khad05 ".' DESC')
						->limit(1,0);	
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 查询该订单对应的客户id
	 * @param int $searchType 查询类型
	 * @param int $keyword 每页显示的记录条数
	 * @author huyan
	 * @date 2015-12-09
	 */
	public function OrderComplaint($ddclientNo,$clientNo){
	    $where['express'] = "{$this->tableOrder}.xsaa02 = :ddclientNo AND {$this->tableOrder}.xsaa04 = :clientNo";
		$where['value']['ddclientNo'] = $ddclientNo;
		$where['value']['clientNo'] = $clientNo;
		$select = "{$this->tableName}.khaa02,{$this->tableOrder}.xsaa04,{$this->tableOrder}.xsaa05,{$this->tableOrder}.xsaa02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->where($where['express'],$where['value'])
						->order("{$this->tableOrder}.xsaa01".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
        
	}

     /**
	 * @desc添加投诉时，根据客户id查找客户姓名
	 * @author huyan
	 * @date 2015-12-10
	 */
	public function getkhnameResult($clientNo){
	    $where['express'] = "{$this->tableName}.khaa02 = :clientNo";
		$where['value']['clientNo'] = $clientNo;
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa01".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
        
	}

	/**
	 * @desc 获取客户订单记录
	 * @param string $clientno 客户编号
	 * @return array $result 客户订单记录信息
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function GetOrderRecord($clientno,$page,$psize){	
		$select = "{$this->tableOrder}.xsaa02,{$this->tableOrder}.xsaa29,{$this->tableOrder}.xsaa13,{$this->tableOrder}.xsaa17,{$this->tableOrder}.xsaa23,{$this->tableOrder}.xsaa28,{$this->tableOrder}.xsaa33,{$this->tableOrder}.xsaa32,{$this->tableOrderDetail}.xsab02";
		$where['express'] = "{$this->tableOrder}.xsaa04 = :clientno";
		$where['value']['clientno'] = $clientno;

		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						//->from($this->tableName)
						->from($this->tableName)
		 				->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
		 				->leftJoin($this->tableOrderDetail, "{$this->tableOrder}.xsaa02 = {$this->tableOrderDetail}.xsab01")
		 				->where($where['express'],$where['value'])
						->group("{$this->tableOrder}.xsaa02");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取客户详情添加投诉订单号选项
	 * @param string $clientno 客户编号
	 * @return array $result 客户跟进记录信息
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function getOrderOptions($ddkhbh){
		$select = "{$this->tableOrder}.xsaa02";
		$where['express'] = "{$this->tableOrder}.xsaa04 = :ddkhbh";
	    $where['value']['ddkhbh'] = $ddkhbh;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->where($where['express'],$where['value']);
						//->order("{$this->tableName}.khad05 ");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取客户详情信息
	 * @param int $clientno 客户编号
	 * @param string $symbol 符号( >、=、< )
	 * @return array $result 订单详情信息
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function findCustomerDetail($clientno,$symbol,$order,$JobNumber){	
		$select = "{$this->tableName}.khaa01,{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa04,{$this->tableName}.khaa05,{$this->tableName}.khaa06,{$this->tableName}.khaa07,{$this->tableName}.khaa08,{$this->tableName}.khaa09,{$this->tableName}.khaa10,{$this->tableName}.khaa11,{$this->tableName}.khaa12,{$this->tableName}.khaa13,{$this->tableName}.khaa14,{$this->tableName}.khaa15,{$this->tableName}.khaa16,{$this->tableName}.khaa17,{$this->tableName}.khaa18,{$this->tableName}.khaa19,{$this->tableName}.khaa20,{$this->tableName}.khaa21,{$this->tableName}.khaa22,{$this->tableName}.khaa23,{$this->tableName}.khaa24,{$this->tableName}.khaa25,{$this->tableName}.khaa26,{$this->tableName}.khaa27,{$this->tableName}.khaa28,{$this->tableName}.khaa29,{$this->tableName}.khaa30,{$this->tableName}.khaa31,{$this->tableName}.khaa32,{$this->tableName}.khaa33,{$this->tableName}.khaa34,{$this->tableName}.khaa35,{$this->tableName}.khaa36,{$this->tableName}.khaa37,{$this->tableName}.khaa38,{$this->tableName}.khaa39,{$this->tableName}.khaa40,{$this->tableName}.khaa41,{$this->tableName}.khaa42,{$this->tableName}.khaa43,{$this->tableName}.khaa44,{$this->tableName}.khaa45,{$this->tableName}.khaa46";
		$where['express'] = "{$this->tableName}.khaa32 = :JobNumber AND {$this->tableName}.khaa02 $symbol :clientno";
		$where['value']['clientno'] = $clientno;
		$where['value']['JobNumber'] = $JobNumber;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa01 ".$order)
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取下属客户详情信息
	 * @param int $clientno 客户编号
	 * @param string $symbol 符号( >、=、< )
	 * @return array $result 订单详情信息
	 * @author huyan
	 * @date 2016-03-03
	 */
	public function findsubordinateCustomers($clientno,$symbol,$order,$JobNumber){
		$select = "{$this->tableName}.khaa01,{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa04,{$this->tableName}.khaa05,
				   {$this->tableName}.khaa06,{$this->tableName}.khaa07,{$this->tableName}.khaa08,{$this->tableName}.khaa09,
				   {$this->tableName}.khaa10,{$this->tableName}.khaa11,{$this->tableName}.khaa12,{$this->tableName}.khaa13,
				   {$this->tableName}.khaa14,{$this->tableName}.khaa15,{$this->tableName}.khaa16,{$this->tableName}.khaa17,{$this->tableName}.khaa18,{$this->tableName}.khaa19,{$this->tableName}.khaa20,{$this->tableName}.khaa21,{$this->tableName}.khaa22,{$this->tableName}.khaa23,{$this->tableName}.khaa24,{$this->tableName}.khaa25,
				   {$this->tableName}.khaa26,{$this->tableName}.khaa27,{$this->tableName}.khaa28,{$this->tableName}.khaa29,
				   {$this->tableName}.khaa30,{$this->tableName}.khaa31,{$this->tableName}.khaa32,{$this->tableName}.khaa33,
				   {$this->tableName}.khaa34,{$this->tableName}.khaa35,{$this->tableName}.khaa36,{$this->tableName}.khaa37,{$this->tableName}.khaa38,{$this->tableName}.khaa39,{$this->tableName}.khaa40,{$this->tableName}.khaa41,{$this->tableName}.khaa42,{$this->tableName}.khaa43,{$this->tableName}.khaa44,{$this->tableName}.khaa45,{$this->tableName}.khaa46";
	    $where['express'] = "{$this->tableName}.khaa46 = :JobNumber AND {$this->tableName}.khaa02 $symbol :clientno";
		$where['value']['clientno'] = $clientno;
		$where['value']['JobNumber'] = $JobNumber;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa01 ".$order)
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}


	/**
	 * @desc 获取一个客户信息，用于excel上传
	 * @return array $result 客户信息
	 * @author DengShaocong
	 * @date 2016-01-04
	 */
	public function getExcelClient(){
		$select = "COLUMN_NAME";
		$where = " table_name = 'khaa' AND table_schema = 'db000' AND COLUMN_NAME = 'khaa02' OR COLUMN_NAME = 'khaa03' OR COLUMN_NAME = 'khaa04'OR COLUMN_NAME = 'khaa23' OR COLUMN_NAME = 'khaa38' OR COLUMN_NAME = 'khaa30' OR COLUMN_NAME = 'khaa18' OR COLUMN_NAME = 'khaa19' OR COLUMN_NAME = 'khaa20' OR COLUMN_NAME = 'khaa28' OR COLUMN_NAME = 'khaa25' OR COLUMN_NAME = 'khaa22'OR COLUMN_NAME = 'khaa12' OR COLUMN_NAME = 'khaa32' OR COLUMN_NAME = 'khaa33'";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from('information_schema.COLUMNS')
						->where($where,array());
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取所有客户id
	 * @return array $result 
	 * @author huyan
	 * @date 2016-01-07
	 */
	public function getCustomerNumberOptions($JobNuber){

		$where['express'] = "{$this->tableName}.khaa32 = :JobNuber";
		$where['value']['JobNuber'] = $JobNuber;
		$select = "{$this->tableName}.khaa02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khaa01 ");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取客户id  姓名
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-01-07
	 */
	public function getNameAndId($page,$psize,$JobNuber){
	    $where['express'] = "{$this->tableName}.khaa32 = :JobNuber";
		$where['value']['JobNuber'] = $JobNuber;	
		$select = "{$this->tableName}.khaa01,{$this->tableName}.khaa02,{$this->tableName}.khaa03,";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.khaa01".' ASC');
		$result['info'] = $this->dbCommand->queryAll();
		 $result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
		 								   ->from($this->tableName)
		 								   ->where($where['express'],$where['value'])
		 								   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 添加投诉客户id 姓名查询
	 * @author huyan
	 * @date 2016-01-07
	 */
	public function QueryNameOrdId($page,$psize,$searchtype,$keyword,$JobNuber){
		$where['express'] = "{$this->tableName}.khaa32 = :JobNuber";
		$where['value']['JobNuber'] = $JobNuber;
		if($searchtype==1){
			/*$where['express'] .= " AND {$this->tableName}.khaa02 = :khid";
			$where['value']['khid'] = $keyword;*/
			$where['express'] .= " AND {$this->tableName}.khaa02 like :keyword";
			$where['value'][':keyword'] = "%{$keyword}%";
		}
		if($searchtype==2){
			$where['express'] .= " AND {$this->tableName}.khaa03 like :keyword";
			$where['value'][':keyword'] = "%{$keyword}%";
		}
		if($searchtype==3){
		/*	$where['express'] .= " AND {$this->tableName}.khaa03 = :xingming";
			$where['value']['xingming'] = $keyword;*/
			$where['express'] .= " AND {$this->tableName}.khaa06 like :keyword";
			$where['value'][':keyword'] = "%{$keyword}%";
		}
		$select = "{$this->tableName}.khaa01,{$this->tableName}.khaa02,{$this->tableName}.khaa03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("{$this->tableName}.khaa01 ".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$count = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryAll();
		$result['count'] = count($count);								   		
		return $result;
	}

	//删除客户资料时，查询客户有没有未成交订单
	public function getOrderInq($clientNo){	
		$jysfcg='交易成功';
		$where['express'] = "{$this->tableOrder}.xsaa04 = :clientNo AND {$this->tableOrder}.xsaa29 != :jysfcg";
		$where['value']['clientNo'] = $clientNo;
		$where['value']['jysfcg'] = $jysfcg;
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableOrder}.xsaa02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftJoin($this->tableOrder, "{$this->tableName}.khaa02 = {$this->tableOrder}.xsaa04")
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryRow(); 
		return $result;
	}

	/**
	 * @desc 根据呼入号码来获取客户资料
	 * @param string $callerId 呼入号码
	 * @return array $result 订单详情信息
	 * @author WuJunhua
	 * @date 2015-12-24
	 */
	public function getClientDetailByNumber($callerId){	
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa03,{$this->tableName}.khaa04,{$this->tableName}.khaa47,{$this->tableName}.khaa28";
		$where['express'] = "{$this->tableName}.khaa06 = :callerId OR {$this->tableName}.khaa07 = :callerId OR {$this->tableName}.khaa08 = :callerId";
		$where['value']['callerId'] = $callerId;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryRow();
		return $result;
	}


	/**
	 * @desc 系统设置->数据清理->查询要转移的客户资料
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function getCustomerTransfer($khgh1){
		$where['express'] = "{$this->tableName}.khaa32 = :khgh1";
		$where['value']['khgh1'] = $khgh1;
		$select = "{$this->tableName}.khaa32,{$this->tableName}.khaa33";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
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
	public function getCustomername($khgh2){

		$where['express'] = "{$this->tableName}.khaa32 = :khgh2";
		$where['value']['khgh2'] = $khgh2;
		$select = "{$this->tableName}.khaa33";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryrow();
		
		return $result;
	}
	/**
	 * @desc 系统设置->数据清理->查询要删除的客户资料
	 * @author huyan
	 * @date 2016-02-18
	 */
	public function getCustomerToBeDel($CondList){
		$where['express'] = "{$this->tableName}.khaa01>0";
		$where['value'] = array();
		if (!empty($CondList)) {
		    if(!empty($CondList['khdj'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa23 like :khdj";
		    	$where['value'][':khdj'] = '%'.$CondList['khdj'].'%';
		    }
		    if(!empty($CondList['kehuyx'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa25 like :kehuyx";
		    	$where['value'][':kehuyx'] = '%'.$CondList['kehuyx'].'%';
		    }
		    if(!empty($CondList['khgh'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa32 like :khgh";
		    	$where['value'][':khgh'] = '%'.$CondList['khgh'].'%';
		    }
		    //根据时间段查询
		    if(!empty($CondList['zcsjq'])&&!empty($CondList['zcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 >=:zcsjq AND {$this->tableName}.khaa30 <= :zcsjz";
		    	$where['value'][':zcsjq'] = $zcsjq;
		    	$where['value'][':zcsjz'] = $zcsjz;
		    }
		    if(!empty($CondList['zcsjq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 >=:zcsjq";
		    	$where['value'][':zcsjq'] = $CondList['zcsjq'];
		    }
		    if(!empty($CondList['zcsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa30 <=:zcsjz";
		    	$where['value'][':zcsjz'] = $CondList['zcsjz'];
		    }

		     if(!empty($CondList['gjsjq'])&&!empty($CondList['gjsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa18 >=:gjsjq AND {$this->tableName}.khaa18 <= :gjsjz";
		    	$where['value'][':gjsjq'] = $gjsjq;
		    	$where['value'][':zcsjz'] = $zcsjz;
		    }
		    if(!empty($CondList['gjsjq'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa18 >=:gjsjq";
		    	$where['value'][':gjsjq'] = $CondList['gjsjq'];
		    }
		    if(!empty($CondList['gjsjz'])){
		    	$where['express'] .= " AND {$this->tableName}.khaa18 <=:gjsjz";
		    	$where['value'][':gjsjz'] = $CondList['gjsjz'];
		    }

	    }
		$select = "{$this->tableName}.khaa02,{$this->tableName}.khaa01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取地域统计报表——获取地区人数
	 * @param $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getDytjbbByCondRS($cond){
		$select = "count({$this->tableName}.khaa01) num";
		$where['express'] = "{$this->tableName}.khaa12 like '%". $cond['pro'] ."%' ";
		$where['value'] = array();
		
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array('num'=>0);
		}
		return $result[0];
	}

	/**
	 * @desc 获取工号客户数统计信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getGhkhstjbbByCond($cond){
		$select = "count({$this->tableName}.khaa01) num";
		$where['express'] = "{$this->tableName}.khaa32 = '". $cond['username'] ."' ";
		$where['value'] = array();
		if($cond['media']){
			$where['express'] .= " and {$this->tableName}.khaa22 = :media ";
			$where['value'][':media'] = $cond['media'];
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
		 				->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryAll();
		if(empty($result)){
			return array('num'=>0);
		}
		return $result[0];
	}

}
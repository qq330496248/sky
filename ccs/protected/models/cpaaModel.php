<?php
/**
 * @desc 产品表相关操作类
 * @author DengShaocong
 * @date 2015-11-3
 */
class cpaaModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cpaaModel对象
	 * @return cpaaModel
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 添加产品
	 * @param array $cpInfo 产品资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function addCp($cpInfo){
		if(empty($cpInfo)){
			return array('res'=>'error','msg'=>'相关信息不完整，添加失败');
		}
		$result = cpaaDAO::getInstance()->insert($cpInfo,true);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}

		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 根据条件查找产品
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $cond 查找条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 * @modify WuJunhua 2016-02-04 增加产品列表的导出excel功能
	 */
	public function getCpByCond($page,$psize,$cond,$sign){
		$cp = cpaaDAO::getInstance()->getCpByCond($page,$psize,$cond);
		if($sign == 1){
			//导出产品列表excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[18]); //导出产品列表excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$cp = cpaaDAO::getInstance()->getCpByCond($page,$psize,$cond,$selectColumnStr);
				}
			}
			
			if(!empty($cp['info']) && is_array($cp['info'])){
				$data = $cp['info'];
				$fileName = 'jx';  
				$tableName = '产品列表';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);

				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['count'] = $cp['count'];
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['count'] = 0;
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['count'] = 0;
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}

		//判断是否查询到有数据
		if(!empty($cp) && is_array($cp)){
			$result['result'] = 'success';
			$result['list'] = $cp['info'];
			$result['count'] = $cp['count'];
			//顺序、倒序需要返回页码和条数
			$result['page'] = $page;	
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 根据条件查找产品（批量修改）
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-1
	 */
	public function getCp($cond){
		$cp = cpaaDAO::getInstance()->getCp($cond);
		//判断是否查询到有数据
		if(!empty($cp) && is_array($cp)){
			$result['result'] = 'success';
			$result['list'] = $cp['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 根据产品分类查找产品
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function getCpByFl($cpfl){
		$cp = cpaaDAO::getInstance()->getCpByFl($cpfl);
		//判断是否查询到有数据
		if(!empty($cp) && is_array($cp)){
			$result['result'] = 'success';
			$result['list'] = $cp['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 根据产品品牌查找产品
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function getCpByPp($cppp){
		$cp = cpaaDAO::getInstance()->getCpByPp($cppp);
		//判断是否查询到有数据
		if(!empty($cp) && is_array($cp)){
			$result['result'] = 'success';
			$result['list'] = $cp['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 根据主键删除一个产品
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function deleteCp($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'删除错误');
		}
		$check = cpaaDAO::getInstance()->checkStock($id);
		if(!empty($check) && $check['sum'] > 0){
			return array('mes'=>'false','msg'=>'库存不为0，删除失败');
		}
		
		$result = cpaaDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('mes'=>'false','msg'=>'删除失败');
		}
		return array('mes'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc 根据主键查找一个产品
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function getSingleCp($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'错误');
		}
		$result = cpaaDAO::getInstance()->findByAttributes(array('cpaa01' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个产品信息
	 * @param int $id ID
	 * @param array $cpInfo 修改内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function updateCp($id,$cpInfo){
		if(empty($id) || empty($cpInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}

		$cpsxResult = cpsxxqDAO::getInstance()->delete(array('cpid' => $id));

		$result = cpaaDAO::getInstance()->updateByPk($id,$cpInfo);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}

	/**
	 * @desc 根据主键修改一个产品信息（批量）
	 * @param int $id ID
	 * @param array $cpInfo 修改内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-2
	 */
	public function PlUpdateCp($id,$cpInfo){
		if(empty($id) || empty($cpInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = cpaaDAO::getInstance()->updateByPk($id,$cpInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}

	/**
	 * @desc 根据产品主键获取一个产品属性（一级）
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-5
	 */
	public function getCpsxParent($id){
		$sx = cpaaDAO::getInstance()->getCpsxParent($id);
		return $sx;
	}

	/**
	 * @desc 下单时根据商品编号获取商品信息
	 * @param int $goodId 商品编号
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-12
	 */
	public function getGoodList($goodId){
		if(empty($goodId)){
			return array('res'=>'error','msg'=>'商品编号有误');
		}
		$result = cpaaDAO::getInstance()->findGoodListByGoodId($goodId);
		if(empty($result)){
			return array('res'=>'error','msg'=>'操作有误，获取商品信息失败');
		}
		$locationArr = cpaeDAO::getInstance()->getNewestLocation($goodId);
		if(!empty($locationArr)){
			$result['cpae06'] = $locationArr['cpae06'];
			$result['cpae18'] = $locationArr['cpae18'];
			$result['cpae22'] = $locationArr['cpae22'];
		}
		return $result;
	}

	/**
	 * @desc 下单时获取10条最新的商品信息
	 * @param string $goodName 商品名称
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function getAllGoodList($goodName){
		$result = cpaaDAO::getInstance()->findAllGoodList($goodName);
		if(empty($result)){
			return array('res'=>'error','msg'=>'操作有误，获取商品信息失败');
		}
		return $result;
	}

	/**
	 * @desc 全部产品信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-03-22
	 */
	public function GettsAllGood($page,$psize,$cpkh,$cpmc){
		$result = array();  //获取列表数据的结果
		$clientList = cpaaDAO::getInstance()->GettsAllGood($page,$psize,$cpkh,$cpmc);
		//判断是否查询到有数据
		if(!empty($clientList['info']) && is_array($clientList['info'])){
			$result['result'] = 'success';
			$result['list'] = $clientList['info'];
			$result['count'] = $clientList['count'];
			$result['page'] = $page;
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	public function GetGood($goodItems){
		$goodcount = count($goodItems);
		for($a = 0;$a < $goodcount;$a++){
			$judgment = cpaaDAO::getInstance()->findByAttributes(array('xsab03'=>$goodcount[$a],'xsab01'=>$orderNo),array('xsab03'));
		}
	}

	/**
	 * @desc 获取产品库存明细列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 * @modify WuJunhua 2016-03-16 完善查询条件
	 */
	public function getProductStockDetails($page,$psize,$CondList,$sign){
		$result = array();  //获取列表数据的结果
		$productList = cpaaDAO::getInstance()->getProductStockDetails($page,$psize,$CondList);
		$totalArr = cpaeDAO::getInstance()->getTotalProductStock();
		$productList['total'] = $totalArr;
		if($sign == 1){
			//导出库存明细excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[6]); //导出库存明细excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$productList = cpaaDAO::getInstance()->getProductStockDetails($page,$psize,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($productList['info']) && is_array($productList['info'])){
				$data = $productList['info'];
				$fileName = 'jx';  
				$tableName = '库存明细';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);
				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['count'] = $productList['count'];
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['count'] = 0;
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['count'] = 0;
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}

		//判断是否查询到有数据
		if(!empty($productList['info']) && is_array($productList['info'])){
			$result['result'] = 'success';
			$result['list'] = $productList['info'];
			$result['total'] = $productList['total'];
			$result['count'] = $productList['count'];
			//顺序、倒序需要返回页码和条数
			$result['page'] = $page;	
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}


	/**
	 * @desc 库存明细查询
	 * @author huyan
	 * @date 2015-11-25
	 */
	public function getQueryStock($page,$psize,$cpmc,$cpkh,$zhrksjq,$zhrksjz,$zhchsjq,$zhchsjz,$cpfl1,$kcs,$cpsxj,$cpjj){
		//$result = array();
		/*print_r($cpmc);die;*/
		$clientList = cpaaDAO::getInstance()->getQueryStock($page,$psize,$cpmc,$cpkh,$zhrksjq,$zhrksjz,$zhchsjq,$zhchsjz,$cpfl1,$kcs,$cpsxj,$cpjj);
       	//print_r($clientList);die;
		//判断是否查询到有数据
		if(!empty($clientList['info']) && is_array($clientList['info'])){
			$result['result'] = 'success';
			$result['list'] = $clientList['info'];
			$result['count'] = $clientList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;	
	}

	/**
	 * @desc 根据ID获取多个产品信息
	 * @param string $allCp 多个产品ID
	 * @return array $result 列表信息
	 * @author Dengshaocong
	 * @date 2015-12-1
	 */
	public function getCpById($allCp){
		if(empty($allCp)){
			return array('res'=>'error','msg'=>'操作有误，获取商品信息失败');
		}
		$cpArray = explode(" ", $allCp);
		$result['list'] = array();
		for($i = 0; $i < count($cpArray); $i ++){
			$cpResult = cpaaDAO::getInstance()->getCpById($cpArray[$i]);
			array_push($result['list'], $cpResult);
		}
		if(count($result) > 0){
			$result['res'] = 'success';
		}else{
			$result['res'] = 'false';
		}
		return $result;
	}

	/**
	 * @desc 盘点时根据批次号、商品编号获取商品信息
	 * @param int $goodId 商品编号
	 * @param string $batchId 批次号
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function getGoodById($goodId,$batchId){
		if(empty($goodId) || empty($batchId)){
			return array('res'=>'error','msg'=>'商品编号有误');
		}
		$result = cpaaDAO::getInstance()->getGoodById($goodId,$batchId);
		if(empty($result)){
			return array('res'=>'error','msg'=>'操作有误，获取商品信息失败');
		}
		return $result;
	}

	/**
	 * @desc 根据主键获取一个产品名称
	 * @param int $id ID
	 * @return array $string 产品名
	 * @author DengShaocong
	 * @date 2015-12-2
	 */
	public function getNameById($id){
		if(empty($id)){
			return '错误';
		}
		$result = cpaaDAO::getInstance()->findByAttributes(array('cpaa01' => $id));
		return $result['cpaa02'];
	}

	/**
	 * @desc 获取库存盘点流水记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 库存盘点流水记录列表信息
	 * @author WuJunhua
	 * @date 2015-12-03
	 */
	public function getInventoryFlowRecordList($page,$psize,$CondList,$sign){
		$result = [];  //获取列表数据的结果 
		$goodStatus = cpglConst::$InventoryStatus[5]; //盘点完结
		$orderList = cpaaDAO::getInstance()->getInventoryFlowRecordList($page,$psize,$goodStatus,$CondList);

		if($sign == 1){
			//导出库存盘点记录excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[12]); //导出库存盘点记录excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = cpaaDAO::getInstance()->getInventoryFlowRecordList($page,$psize,$goodStatus,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '库存盘点记录';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);

				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['count'] = $orderList['count'];
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['count'] = 0;
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['count'] = 0;
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}

		//判断是否查询到有数据
		if(!empty($orderList['info']) && is_array($orderList['info'])){
			$result['result'] = 'success';
			$result['list'] = $orderList['info'];
			$result['count'] = $orderList['count'];
			//顺序、倒序需要返回页码和条数
			$result['page'] = $page;	
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}


	/**
	 * @desc库存盘点记录查询
	 * @author huyan
	 * @date 2015-12-10
	 */
	public function InventoryRecordQuery($page,$psize,$cpmc,$cpkh,$pdczr,$pdtxm){
		$result = array();  //获取列表数据的结果
	    $goodStatus = cpglConst::$InventoryStatus[5]; //盘点完结
		$orderList = cpaaDAO::getInstance()->InventoryRecordQuery($page,$psize,$cpmc,$cpkh,$pdczr,$pdtxm,$goodStatus);
		
		//判断是否查询到有数据
		if(!empty($orderList['info']) && is_array($orderList['info'])){
			$result['result'] = 'success';
			$result['list'] = $orderList['info'];
			$result['count'] = $orderList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;

	}

	/**
	 * @desc 下单时验证输入的商品名称是否存在
	 * @param string $goodName 商品名称
	 * @author WuJunhua
	 * @date 2015-12-30
	 * @modify huyan 2016-03-24 修改查找方法
	 */
	public function checkGoodsNameIsExits($goodName){
		$condition = array('cpaa02' => $goodName);
		$goodData = cpaaDAO::getInstance()->checkGoodsNameIsExits($goodName);
		if(empty($goodData)){
			return array('res'=>'tips','msg'=>'输入的商品名称不存在，请重新输入！');
		}
		return array('res'=>'success','msg'=>'获取成功');
	}

	/**
	 * @desc 下单时验证输入的款号是否存在
	 * @param int $goodNumber 商品款号
	 * @author WuJunhua
	 * @date 2015-12-30
	 * @modify huyan 2016-03-24 修改查找方法
	 */
	public function checkGoodsNumberIsExits($goodNumber){
		$condition = array('cpaa01' => $goodNumber);
		$goodData = cpaaDAO::getInstance()->checkGoodsNumberIsExits($goodNumber);
		if(empty($goodData)){
			return array('res'=>'tips','msg'=>'输入的商品款号不存在，请重新输入！');
		}
		return array('res'=>'success','msg'=>'获取成功');
	}

	/**
	 * @desc 获取库存异动明细记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param int $sign 导出excel标识
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-12-31
	 */
	public function getProductWarehousingRecording($page,$psize,$sign,$CondList){
		$result = [];  //获取列表数据的结果
		$transactionType = []; //入库类型
		$transactionType['directStorage'] = cpglConst::$StockTransactionType[7]; //生成直接入库单号
		$transactionType['purchaseStorage'] = cpglConst::$StockTransactionType[8]; //提交保存
		$transactionType['endWarehousing'] = cpglConst::$StockTransactionType[9]; //终止退货入仓
		$productList = cpaaDAO::getInstance()->getProductWarehousingRecording($page,$psize,$transactionType,$CondList);

		if($sign == 1){
			//导出入库记录excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[10]); //导出入库记录excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$productList = cpaaDAO::getInstance()->getProductWarehousingRecording($page,$psize,$transactionType,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($productList['info']) && is_array($productList['info'])){
				$data = $productList['info'];
				$fileName = 'jx';  
				$tableName = '入库记录';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);
				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['count'] = $productList['count'];
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['count'] = 0;
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['count'] = 0;
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}

		//判断是否查询到有数据
		if(!empty($productList['info']) && is_array($productList['info'])){
			$result['result'] = 'success';
			$result['list'] = $productList['info'];
			$result['count'] = $productList['count'];
			//顺序、倒序需要返回页码和条数
			$result['page'] = $page;	
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 从Excel添加产品
	 * @param array $cpInfo 产品资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-01
	 */
	public function addCpFromExcel($cpInfo){
		if(empty($cpInfo)){
			return array('res'=>'error','msg'=>'添加出错');
		}
		//库存信息
		$kcInfo['cpae03'] = $cpInfo['cpae03'];
		$kcInfo['cpae07'] = $cpInfo['cpae07'];
		$kcInfo['cpae13'] = $cpInfo['cpae03']*$cpInfo['cpae07'];
		unset($cpInfo['cpae03']);
		unset($cpInfo['cpae07']);

		$cpList = cpaaDAO::getInstance()->findByAttributes(array('cpaa02'=>$cpInfo['cpaa02'],'cpaa16'=>$cpInfo['cpaa16']));
		if(empty($cpList)){
			$cpInfo['cpaa07'] = date('Y-m-d H:i:s');
			cpaaDAO::getInstance()->insert($cpInfo,true);
			$cpList = cpaaDAO::getInstance()->findByAttributes(array('cpaa02'=>$cpInfo['cpaa02'],'cpaa16'=>$cpInfo['cpaa16']));
			$kcInfo['cpae02'] = $cpList['cpaa01'];
			$kcInfo['cpae19'] = $cpList['cpaa10'];
			$icInfo['cpae05'] = '';

			//从cpaeModel.php复制来的方法，生成主键
			$productStock = cpaeDAO::getInstance()->getMaxProductStock();
			//生成批次号
			if(!empty($productStock)){
				$date = substr($productStock['cpae01'],0,6);
				if($date == date('ymd')){
					$id = substr($productStock['cpae01'],-4,4);
					$id += 1;
					$stockId = sprintf("%04d",$id);
					$stockNo = date('ymd').$stockId;
				}else{
					$id = '1';
					$stockId = sprintf("%04d",$id);
					$stockNo = date('ymd').$stockId;   //格式 例如：1511120001 【批次号】
				}
			}else{
				$id = '1';
				$stockId = sprintf("%04d",$id);
				$stockNo = date('ymd').$stockId;
			}
			$kcInfo['cpae01'] = $stockNo;  //批次号

			//生成入库单号
			$orderList = cpaeDAO::getInstance()->getMaxPurchaseNumber();
			if(!empty($orderList)){
				$date = substr($orderList['cpae20'],2,4);
				if($date == date('ym')){
					$id = substr($orderList['cpae20'],-4,4);
					$id += 1;
					$orderId = sprintf("%04d",$id);
					$orderNo = 'RK'.date('ym').$orderId;
				}else{
					$id = '1';
					$orderId = sprintf("%04d",$id);
					$orderNo = 'RK'.date('ym').$orderId;
				}
			}else{
				$id = '1';
				$orderId = sprintf("%04d",$id);
				$orderNo = 'RK'.date('ym').$orderId;
			}
			$kcInfo['cpae20'] = $orderNo; 
			$result = cpaeDAO::getInstance()->insert($kcInfo,true);

		}else{
			$kcList = cpaeDAO::getInstance()->findByAttributes(array('cpae02'=>$cpList['cpaa01'],'cpae19'=>$cpList['cpaa10']));
			if(empty($kcList)){
				$cpList = cpaaDAO::getInstance()->findByAttributes(array('cpaa02'=>$cpInfo['cpaa02'],'cpaa16'=>$cpInfo['cpaa16']));
				$kcInfo['cpae02'] = $cpList['cpaa01'];
				$kcInfo['cpae19'] = $cpList['cpaa10'];
				$icInfo['cpae05'] = '';

				//从cpaeModel.php复制来的方法，生成主键
				$productStock = cpaeDAO::getInstance()->getMaxProductStock();
				//生成批次号
				if(!empty($productStock)){
					$date = substr($productStock['cpae01'],0,6);
					if($date == date('ymd')){
						$id = substr($productStock['cpae01'],-4,4);
						$id += 1;
						$stockId = sprintf("%04d",$id);
						$stockNo = date('ymd').$stockId;
					}else{
						$id = '1';
						$stockId = sprintf("%04d",$id);
						$stockNo = date('ymd').$stockId;   //格式 例如：1511120001 【批次号】
					}
				}else{
					$id = '1';
					$stockId = sprintf("%04d",$id);
					$stockNo = date('ymd').$stockId;
				}
				$kcInfo['cpae01'] = $stockNo;  //批次号

				//生成入库单号
				$orderList = cpaeDAO::getInstance()->getMaxPurchaseNumber();
				if(!empty($orderList)){
					$date = substr($orderList['cpae20'],2,4);
					if($date == date('ym')){
						$id = substr($orderList['cpae20'],-4,4);
						$id += 1;
						$orderId = sprintf("%04d",$id);
						$orderNo = 'RK'.date('ym').$orderId;
					}else{
						$id = '1';
						$orderId = sprintf("%04d",$id);
						$orderNo = 'RK'.date('ym').$orderId;
					}
				}else{
					$id = '1';
					$orderId = sprintf("%04d",$id);
					$orderNo = 'RK'.date('ym').$orderId;
				}
				$kcInfo['cpae20'] = $orderNo; 
				$result = cpaeDAO::getInstance()->insert($kcInfo,true);

			}else{
				//正品库存量（03）增加，价格修改（07），总价修改（13）
				$kcList['cpae03'] += $kcInfo['cpae03'];
				$kcList['cpae07'] = $kcInfo['cpae07'];
				$kcList['cpae13'] = $kcList['cpae03']*$kcList['cpae07'];
				$id['cpae01'] = $kcList['cpae01'];
				$id['cpae02'] = $kcList['cpae02'];
				unset($kcList['cpae01']);
				unset($kcList['cpae02']);
				$result = cpaeDAO::getInstance()->update($id,$kcList);
			}
		}
		if(empty($result)){// && $kcList['cpae13'] != 0?
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 获取产品销售统计——获取产品信息
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getCpxstjByCond($cond,$sign){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'today':
				$cond['beginDate'] = date('Y-m-d');
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'yesterday':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				break;

			case 'seven':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -7 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'thirty':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -30 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'month':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = $dateList1[0].'-'.$dateList1[1].'-01' ;
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'lastDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
				break;

			case 'nextDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +1 day '));
				break;

			case 'lastSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -7 day '));
				break;

			case 'nextSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +7 day '));
				break;

			case 'lastThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -30 day '));
				break;

			case 'nextThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +30 day '));
				break;

			case 'lastMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' -1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' -1 day '));
				break;

			case 'nextMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' +1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' +2 month -1 day '));
				break;

			default:

				break;
		}

		$result['result'] = 'success';
		$result['list'] = array();

		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['qrCount'] = 0;//总确认数
		$result['qrMoney'] = 0;//总确认金额
		$result['fhCount'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['shCount'] = 0;//总签收数
		$result['shMoney'] = 0;//总签收金额

		$cpList = cpaaDAO::getInstance()->getCpxstjByCond($cond);
		for($i = 0; $i < count($cpList); $i ++){
			$cond['cpkh'] = $cpList[$i]['cpaa01'];
			$cond['cpmc'] = $cpList[$i]['cpaa02'];
			$cond['gys'] = $cpList[$i]['cgab02'];
			$cond['time'] = $cpList[$i]['cpaa07'];
			$demoList = $this->getCpxstjDetails($cond);//临时array
			$result['list'][$i] = $demoList;

			//各项相加
			$result['fhCount'] += $demoList['fhOrders'];
			$result['fhMoney'] += $demoList['fhMoney'];
			$result['qrCount'] += $demoList['qrOrders'];
			$result['qrMoney'] += $demoList['qrMoney'];
			$result['shCount'] += $demoList['shOrders'];
			$result['shMoney'] += $demoList['shMoney'];
		}

		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[29]); //导出产品销售统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
				$reportList = []; //报表显示信息
				foreach ($result['list'] as $key => $value) {
					$reportList[$key]['cpkh'] = $value['cpkh'];
					$reportList[$key]['cpmc'] = $value['cpmc'];
					$reportList[$key]['qrOrders'] = $value['qrOrders'];
					$reportList[$key]['qrMoney'] = $value['qrMoney'];
					$reportList[$key]['fhOrders'] = $value['fhOrders'];
					$reportList[$key]['fhMoney'] = $value['fhMoney'];
					$reportList[$key]['shOrders'] = $value['shOrders'];
					$reportList[$key]['shMoney'] = $value['shMoney'];
					$reportList[$key]['gys'] = $value['gys'];
					$reportList[$key]['time'] = $value['time'];
				}
			}
			
			if(!empty($reportList) && is_array($reportList)){
				$data = $reportList;
				$fileName = 'jx';  
				$tableName = '产品销售统计报表';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);

				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}

		return $result;
	}

	/**
	 * @desc 获取产品销售统计——获取统计信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getCpxstjDetails($cond){
		$result['cpkh'] = $cond['cpkh'];
		$result['cpmc'] = $cond['cpmc'];
		$result['gys'] = $cond['gys'];
		$result['time'] = $cond['time'];
		$qrList = cpaaDAO::getInstance()->getCpxstjDetails($cond,"'已确认','已发货','交易成功'");//确认订单
		$fhList = cpaaDAO::getInstance()->getCpxstjDetails($cond,"'已发货','交易成功'");//发货订单
		$shList = cpaaDAO::getInstance()->getCpxstjDetails($cond,"'交易成功'");//签收订单

		$result['qrOrders'] = $qrList['orders'];
		$result['qrMoney'] = $qrList['money'];
		$result['fhOrders'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['shOrders'] = $shList['orders'];
		$result['shMoney'] = $shList['money'];

		return $result;
	}

	/**
	 * @desc 获取每日出库报表——获取产品列表
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getMrckbbByCond($cond,$sign){
		$result['result'] = 'success';
		$result['list'] = array();
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$cpList = cpaaDAO::getInstance()->getMrckbbCp($cond);
		$count = count($cpList);
		for($i = 0; $i < $count; $i ++){
			$cond['cpmc'] = $cpList[$i]['cpaa02'];
			$cond['cpkh'] = $cpList[$i]['cpaa16'];
			$cond['cpaa'] = $cpList[$i]['cpaa01'];
			$result['list'][$i] = $this->getMrckbbDetails($cond);
		}

		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[23]); //导出每日出库报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$reportList = []; //报表显示信息
				foreach ($result['list'] as $key => $value) {
					$reportList[$key]['cpkh'] = $value['cpkh'];
					$reportList[$key]['cpmc'] = $value['cpmc'];
					$reportList[$key]['kw'] = $value['kw'];
					$reportList[$key]['jhsNum'] = $value['jhsNum'];
					$reportList[$key]['chsNum'] = $value['chsNum'];
					$reportList[$key]['zpkc'] = $value['zpkc'];
					$reportList[$key]['cpkc'] = $value['cpkc'];
				}	
			}
			
			if(!empty($reportList) && is_array($reportList)){
				$data = $reportList;
				$fileName = 'jx';  
				$tableName = '每日出库报表';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);

				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}
		return $result;
	}

	/**
	 * @desc 获取每日出库报表——获取报表信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getMrckbbDetails($cond){
		$result['cpmc'] = $cond['cpmc'];
		$result['cpkh'] = $cond['cpkh'];
		$cpkc = cpaaDAO::getInstance()->getMrckbbByCond($cond,'');//库存信息
		$result['jhsNum'] = cpaaDAO::getInstance()->getMrckbbByCond($cond,'出库')['num'];//进货数信息
		$result['chsNum'] = cpaaDAO::getInstance()->getMrckbbByCond($cond,'入库')['num'];//出货数信息
		$result['kw'] = $cpkc['kw'];//库位
		$result['zpkc'] = $cpkc['zpkc'];//正品库存
		$result['cpkc'] = $cpkc['cpkc'];//次品库存

		return $result;
	}

	/**
	 * @desc 检查当前输入款号是否存在，存在则填写
	 * @param string $cpkh 产品款号ID
	 * @author DengShaocong
	 * @date 2016-03-15
	 */
	public function checkAndGetCp($cpkh){
		$result = array();
		$demoCP = cpaaDAO::getInstance()->findByAttributes(array('cpaa01'=>$cpkh));
		if(empty($demoCP)){
			$result['result'] = 'false';
		}else{
			$result['result'] = 'success';
			$result['cp'] = $demoCP;
		}
		return $result;
	}


	/**
	 * @desc 获取款号进销存报表信息
	 * @param array $cond 查询条件
	 * @param int $page 页数
	 * @param int $psize 页显示数
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-22
	 */
	public function getKhjxcByCond($cond,$page,$psize){
		$result = array();
		$result['result'] = 'success';

		$result['beginDate'] = $cond['beginDate'];//用于页面回显
		$result['endDate'] = $cond['endDate'];//用于页面回显
		$result['totalJhNum'] = 0;//进货数
		$result['totalJhMoney'] = 0;//进货金额
		$result['totalFhCost'] = 0;//进货单价
		$result['totalFhNum'] = 0;//发货数
		$result['totalFhMoney'] = 0;//发货金额
		$result['totalJhCost'] = 0;//发货成本
		$result['totalShNum'] = 0;//收货数
		$result['totalShMoney'] = 0;//收货金额
		$result['totalShCost'] = 0;//收货成本
		$result['totalThNum'] = 0;//退货数
		$result['totalThMoney'] = 0;//退货金额
		$result['totalThCost'] = 0;//退货成本
		$result['totalFhzNum'] = 0;//发货中数
		$result['totalFhzMoney'] = 0;//发货中金额
		$result['totalFhzPrice'] = 0;//发货中单价
		$result['totalFhzCost'] = 0;//发货中成本
		$result['totalThzNum'] = 0;//退货中数
		$result['totalThzMoney'] = 0;//退货中金额
		$result['totalThzPrice'] = 0;//退货中单价
		$result['totalThzCost'] = 0;//退货中成本
		$result['totalKcNum'] = 0;//库存数
		$result['totalKcMoney'] = 0;//库存金额
		$result['totalPcNum'] = 0;//盘差数
		$result['totalPcMoney'] = 0;//盘差金额

		$result['totalGrossProfit'] = 0;//毛利
		$result['totalProfitRatio'] = '0%';//毛利率
		//时间回显存储完之后，添加时分秒
		$cond['beginDate'] .= ' 00:00:00';
		$cond['endDate'] .= ' 23:59:59';

		$cpList = cpaaDAO::getInstance()->getAllCpkhByCond($cond,$page,$psize);

		$result['count'] = $cpList['count'];

		$count = count($cpList['list']);
		for ($i=0; $i < $count; $i++) { 
			$cond['cpkh'] = $cpList['list'][$i]['cpaa01'];
			$cond['cpmc'] = $cpList['list'][$i]['cpaa02'];
			$cond['gys'] = $cpList['list'][$i]['cgab02'];
			$cond['cgwy'] = $cpList['list'][$i]['cgab21'];
			$cond['tjsj'] = $cpList['list'][$i]['cpaa07'];

			$demoList = $this->getKhjxcDetails($cond);
			$result['list'][$i] = $demoList; 

			$result['totalJhNum'] += $demoList['jhNum'];//进货数
			$result['totalJhMoney'] += $demoList['jhMoney'];//进货金额
			$result['totalFhNum'] += $demoList['fhNum'];//发货数
			$result['totalFhMoney'] += $demoList['fhMoney'];//发货金额
			$result['totalFhCost'] += $demoList['fhCost'];//发货成本
			$result['totalShNum'] += $demoList['shNum'];//收货数
			$result['totalShMoney'] += $demoList['shMoney'];//收货金额
			$result['totalShCost'] += $demoList['shCost'];//收货成本
			$result['totalThNum'] += $demoList['thNum'];//退货数
			$result['totalThMoney'] += $demoList['thMoney'];//退货金额
			$result['totalThCost'] += $demoList['thCost'];//退货成本
			$result['totalFhzNum'] += $demoList['fhzNum'];//发货中数
			$result['totalFhzMoney'] += $demoList['fhzMoney'];//发货中金额
			$result['totalFhzCost'] += $demoList['fhzCost'];//发货中成本
			$result['totalThzNum'] += $demoList['thzNum'];//退货中数
			$result['totalThzMoney'] += $demoList['thzMoney'];//退货中金额
			$result['totalThzCost'] += $demoList['thzCost'];//退货中成本
			$result['totalKcNum'] += $demoList['kcNum'];//库存数
			$result['totalKcMoney'] += $demoList['kcMoney'];//库存金额
			$result['totalPcNum'] += $demoList['pcNum'];//盘差数
			$result['totalPcMoney'] += $demoList['pcMoney'];//盘差金额
		}

		$result['totalGrossProfit'] = $result['totalShMoney'] - $result['totalJhMoney'];

		$result['totalFhCost'] = $result['totalFhNum'] > 0 ? $result['totalFhMoney']/$result['totalFhNum'] : 0;//发货单价
		$result['totalFhzPrice'] = $result['totalFhzNum'] > 0 ? $result['totalFhzMoney']/$result['totalFhzNum'] : 0;//发货中单价
		$result['totalThzPrice'] = $result['totalThzNum'] > 0 ? $result['totalThzMoney']/$result['totalThzNum'] : 0;//退货中单价

		if($result['totalJhMoney'] > 0){
			$result['totalProfitRatio'] = sprintf('%.2f',$result['totalGrossProfit']/$result['totalJhMoney']*100).'%';
		}
		return $result;
	}


	/**
	 * @desc 获取款号进销存报表明细
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function getKhjxcDetails($cond){
		$result['cpkh'] = $cond['cpkh'];
		$result['cpmc'] = $cond['cpmc'];
		$result['gys'] = $cond['gys'];
		$result['cgwy'] = $cond['cgwy'];
		$result['tjsj'] = explode(' ', $cond['tjsj'])[0];
		$result['profitRatio'] = '0%';
//注意，这里的盘点内容，没有金额
		$jhList = cpaaDAO::getInstance()->getKhjxcByCondJH($cond,"'已完成'");//进货信息
		$fhList = cpaaDAO::getInstance()->getKhjxcByCondOrders($cond,"'已发货','拒收','交易成功'");//发货信息
		$shList = cpaaDAO::getInstance()->getKhjxcByCondOrders($cond,"'交易成功'");//收货信息
		$thList = cpaaDAO::getInstance()->getKhjxcByCondTH($cond,"'已完成'");//退货信息
		$fhzList = cpaaDAO::getInstance()->getKhjxcByCondOrders($cond,"'已发货'");//发货途中信息
		$thzList = cpaaDAO::getInstance()->getKhjxcByCondTH($cond,"'未完成'");//退货途中信息
		$kcList = cpaaDAO::getInstance()->getKhjxcByCondKC($cond);//库存信息
		$pcList = pdabDAO::getInstance()->getKhjxcByCondPD($cond);//盘查信息
		//信息添加
		$result['jhNum'] = $jhList['num'];//进货数
		$result['jhMoney'] = $jhList['money'];//
		$result['jhCost'] = $jhList['num'] > 0 ? $jhList['money']/$jhList['num'] : 0;//
		$result['fhNum'] = $fhList['num'];//
		$result['fhMoney'] = $fhList['money'];//
		$result['fhCost'] = $fhList['cost'];//
		$result['fhPrice'] = $fhList['num'] > 0 ? $fhList['cost']/$fhList['num'] : 0;//
		$result['shNum'] = $shList['num'];//
		$result['shMoney'] = $shList['money'];//
		$result['shCost'] = $shList['cost'];//
		$result['thNum'] = $thList['num'];//
		$result['thMoney'] = $thList['money'];//
		$result['thCost'] = $thList['cost'];//
		$result['fhzNum'] = $fhzList['num'];//
		$result['fhzMoney'] = $fhzList['money'];//
		$result['fhzPrice'] = $fhzList['num'] > 0 ? $fhzList['money']/$fhzList['num'] : 0;//
		$result['fhzCost'] = $fhzList['cost'];//
		$result['thzNum'] = $thzList['num'];//
		$result['thzMoney'] = $thzList['money'];//
		$result['thzPrice'] = $thzList['num'] > 0 ? $thzList['money']/$thzList['num'] : 0;//
		$result['thzCost'] = $thzList['cost'];//
		$result['kcNum'] = $kcList['num'];//
		$result['kcMoney'] = $kcList['money'];//
		$result['pcNum'] = $pcList['num'];//
		$result['pcMoney'] = $pcList['money'];//

		$result['grossProfit'] = $shList['money'] - $jhList['money'];//
		if($result['jhMoney'] > 0){
			$result['profitRatio'] = sprintf('%.2f',$result['grossProfit']/$result['jhMoney']*100).'%';//
		}
		return $result;
	}


	/**
	 * @desc 获取报警产品（数量低于预警线）
	 * @return array $reslut 列表信息
	 * @author DengShaocong
	 * @date 2016-03-24
	 */
	public function getWarningProducts(){
		$cpList = cpaaDAO::getInstance()->getAllProducts();
		$result = array();
		$count = count($cpList);
		$listNum = 0;
		for ($i=0; $i < $count; $i++) { 
			$demoList = $this->toHandleWarningMess($cpList[$i]);
			if(!empty($demoList)){
				$result[$listNum] = $demoList;
				$listNum ++ ;
			}
		}
		return $result;
	}


	/**
	 * @desc 处理产品信息，如果库存低于预警线，返回array，否则返回null
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2016-03-24
	 */
	public function toHandleWarningMess($cpList){
		if(empty($cpList['sum'])){
			$cpList['sum'] = 0;
		}
		if($cpList['sum'] < $cpList['cpaa20']){
			return $cpList;
		}
		return null;
	}
}

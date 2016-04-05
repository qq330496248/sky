<?php
/**
 * @desc 产品库存表相关操作类
 * @author WuJunhua
 * @date 2015-11-12
 */
class cpaeModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cpaeModel对象
	 * @return cpaeModel
	 * @author WuJunhua
	 * @date 2015-11-12
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 产品入库(直接入库)
	 * @param array $productInfo 产品资料
	 * @param array $goodItems 单条或多条产品信息
	 * @param array $purchaseArr 采购单信息
	 * @param array $styleNum 单个或多个产品款号
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-12
	 * @modify 2016-03-16 WuJunhua 把"提交保存"和"直接入库"两个动作合并到一起
	 */
	public function productDirectStorage($productInfo,$goodItems,$purchaseArr,$styleNum){
		if(empty($productInfo) || empty($goodItems)){
			return array('res'=>'error','msg'=>'操作有误，产品入库失败');
		}

		//检验入库时是否有重复商品
		$num1 = count($styleNum);
		if($num1 > 1){
			$arr2 = array_unique($styleNum);
    		$num2 = count($arr2);
    		for($a = 0;$a < $num1;$a++){
	    	    if ($num1 > $num2) {
	            	return array('res'=>'tips','msg'=>'存在重复商品,请删除并修改入库数量');
	            }
    	    }
		}

		$productStock = cpaeDAO::getInstance()->getMaxProductStock(); //查最新的批次号
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
		$product = []; 
		$product['cpae01'] = $productInfo['cpaf02'] = $stockNo;  //批次号

		$productInfo['cpaf09'] = cpglConst::$StockTransactionType[1]; //直接入库
		//直接入库操作时要生成入库单号(采购单号)
		$orderList = cgaaDAO::getInstance()->getMaxCgdNumber();
		if(!empty($orderList)){
			$date = substr($orderList['cgaa01'],2,4);
			if($date == date('ym')){
				$id = substr($orderList['cgaa01'],-4,4);
				$id += 1;
				$orderId = sprintf("%04d",$id);
				$orderNo = 'CG'.date('ym').$orderId;
			}else{
				$id = '1';
				$orderId = sprintf("%04d",$id);
				$orderNo = 'CG'.date('ym').$orderId;
			}
		}else{
			$id = '1';
			$orderId = sprintf("%04d",$id);
			$orderNo = 'CG'.date('ym').$orderId;
		}

		$purchaseDetails = [];
		$product['cpae20'] = $productInfo['cpaf11'] = $purchaseArr['cgaa01'] = $purchaseDetails['cgac02'] = $orderNo;
		$purchaseArr['cgaa21'] = cgglConst::$PurchaseOrderType[2]; //采购单类型为：直接入库
		$purchaseArr['cgaa05'] = Yii::app()->session['account']; //操作人
		$purchaseArr['cgaa06'] = date('Y-m-d H:i:s'); //下单时间
		$purchaseDetails['cgac10'] = '已入库';
		$purchaseArr['cgaa20'] = cgglConst::$PurchaseOrderStatus[3]; //已全部入库
		$purchaseArr['cgaa13'] = '已完成';
		$productArr = []; //库存表信息
		$proDetailsArr = []; //库存明细表信息
		$purchaseDetailsArr = []; //采购单明细信息

		//处理单个或多个产品信息
		$goodItemsArr = array_chunk($goodItems,8);
		$count = count($goodItemsArr);
		$purchaseArr['cgaa04'] = 0; //采购总数
		$purchaseArr['cgaa03'] = 0; //采购总价
		if(!empty($goodItemsArr)){
			for ($i = 0; $i < $count; $i++) { 

				if(empty($goodItemsArr[$i][0])){
					return array('res'=>'tips','msg'=>'产品款号不能为空');
				}
				if(empty($goodItemsArr[$i][1])){
					return array('res'=>'tips','msg'=>'产品名称不能为空');
				}
				$conditionNumber = array('cpaa01' => $goodItemsArr[$i][0]);
    	    	$testGoodNumber = cpaaDAO::getInstance()->isExists($conditionNumber);
				if(empty($testGoodNumber)){
					return array('res'=>'tips','msg'=>'输入的商品款号不存在，请重新输入！');
				}
				$productInfo['cpaf03'] = $product['cpae02'] = $purchaseDetails['cgac03'] = $goodItemsArr[$i][0];

				$conditionName = array('cpaa02' => $goodItemsArr[$i][1]);
    	    	$testGoodName = cpaaDAO::getInstance()->isExists($conditionName);
				if(empty($testGoodName)){
					return array('res'=>'tips','msg'=>'输入的商品名称不存在，请重新输入！');
				}
				$purchaseDetails['cgac04'] = $goodItemsArr[$i][1];
				$product['cpae10'] = $goodItemsArr[$i][2];
				$product['cpae11'] = $goodItemsArr[$i][3];

				$zprks = (float)$goodItemsArr[$i][4];
				if($zprks == 0 || empty($zprks)){
					return array('res'=>'tips','msg'=>'款号'.$goodItemsArr[$i][0].'的正品入库量不能为空');
				}

				$purchaseArr['cgaa04'] += $zprks;
				$productInfo['cpaf08'] = $product['cpae03'] = $purchaseDetails['cgac06'] = $purchaseDetails['cgac12'] = $zprks;
				$product['cpae04'] = (float)$goodItemsArr[$i][5];
				$jhj = (float)$goodItemsArr[$i][6];
				if($jhj == 0 || empty($jhj)){
					return array('res'=>'tips','msg'=>'款号'.$goodItemsArr[$i][0].'的进货价不能为空');
				}
				$product['cpae07'] = $purchaseDetails['cgac05'] = $jhj;
				$product['cpae13'] = $purchaseDetails['cgac07'] = $purchaseDetails['cgac12'] * $purchaseDetails['cgac05'];
				$purchaseArr['cgaa03'] += $purchaseDetails['cgac07'];
				$product['cpae21'] = $purchaseArr['cgaa09'];
				$purchaseArr['cgaa02'] = cgglConst::$WhetherToAudit[1]; //已审核
				$purchaseDetails['cgac11'] = $i;

				if(empty($goodItemsArr[$i][7])){
					return array('res'=>'tips','msg'=>'款号'.$goodItemsArr[$i][0].'的库位不能为空');
				}
				$conditionLocal = array('place' => $goodItemsArr[$i][7]);
    	    	$testLocal = warehouseDAO::getInstance()->isExists($conditionLocal);
				if(empty($testLocal)){
					return array('res'=>'tips','msg'=>'款号'.$goodItemsArr[$i][0].'输入的库位不存在，请重新输入！');
				}
				$productInfo['cpaf05'] = $product['cpae06'] = $goodItemsArr[$i][7];
				$productInfo['cpaf15'] = '0'; //入库为正数
				$productArr[] = $product;
				$proDetailsArr[] = $productInfo;
				$purchaseDetailsArr[] = $purchaseDetails;

			}
			
		}
		
		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			//遍历把产品信息插入到产品库存表
			foreach($productArr as $value){
				$result = cpaeDAO::getInstance()->insert($value,true);
			}
			//遍历把产品信息插入到产品库存明细表
			foreach($proDetailsArr as $val){
				$res = cpafDAO::getInstance()->insert($val);
			}
			//生成新的采购单
			$cgdResult = cgaaDAO::getInstance()->insert($purchaseArr,true);
			//插入到采购明细表
			foreach($purchaseDetailsArr as $val){
				$cgdmxResult = cgacDAO::getInstance()->insert($val);
			}
			
			if(empty($result) || empty($res) || empty($cgdResult) || empty($cgdmxResult)){
				return array('res'=>'error','msg'=>'产品入库失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}
		return array('res'=>'success','msg'=>'产品入库成功');
		
	}

	/**
	 * @desc 产品入库(采购单入库)
	 * @param string $purchaseNo 采购单号
	 * @param array $productInfo 产品资料
	 * @param array $goodItems 单条或多条产品信息
	 * @param array $purchaseInfo 采购单信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-12-16
	 */
	public function purchaseOrderStorage($purchaseNo,$productInfo,$goodItems,$purchaseInfo){
		if(empty($productInfo) || empty($goodItems)){
			return array('res'=>'error','msg'=>'操作有误，采购单入库失败');
		}
		if(empty($purchaseNo)){
			return array('res'=>'error','msg'=>'采购单号不能为空');
		}

		$product = []; 
		$productArr = []; //库存表信息
		$proDetailsArr = []; //库存明细表信息
		$proArr = []; //产品表信息
		$purchaseDetailsArr = []; //采购单明细信息
		$goodItemsArr = array_chunk($goodItems,10);
		$purchaseDetails['cgac10'] = '已入库';

		$batchArr = cpaeDAO::getInstance()->findByAttributes(array('cpae20' => $purchaseNo),array('cpae01'));
		//若该采购单号的库存没有批次，要生成新的批次;反之，取当前采购单的批次
		if(empty($batchArr)){
			$productStock = cpaeDAO::getInstance()->getMaxProductStock(); //查最新的批次号
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
			$product['cpae01'] = $productInfo['cpaf02'] = $stockNo;
		}else{
			$product['cpae01'] = $productInfo['cpaf02'] = $batchArr['cpae01'];
		}

		//处理单个或多个产品信息
		if(!empty($goodItemsArr)){
			foreach($goodItemsArr as $val){
				$warehousingNum = (float)$val[5];
				if($warehousingNum == 0 || empty($warehousingNum)){
					return array('res'=>'tips','msg'=>'款号'.$val[0].'的正品入库数不能为空');
				}
				if(empty($val[7])){
					return array('res'=>'tips','msg'=>'款号'.$val[0].'的库位不能为空');
				}
				$conditionLocal = array('place' => $val[7]);
    	    	$testLocal = warehouseDAO::getInstance()->isExists($conditionLocal);
				if(empty($testLocal)){
					return array('res'=>'tips','msg'=>'款号'.$val[0].'输入的库位不存在，请重新输入！');
				}
				$purchaseArray = cgacDAO::getInstance()->findByAttributes(array('cgac02' => $purchaseNo,'cgac03' => $val[0]),array('cgac05','cgac06','cgac12','cgac14'));
				if($warehousingNum + $purchaseArray['cgac12'] > $purchaseArray['cgac06']){
					return array('res'=>'tips','msg'=>'款号'.$val[0].'的入库总数不能大于采购量');
				}
				if($purchaseArray['cgac06'] == $purchaseArray['cgac12']){
					return array('res'=>'tips','msg'=>'款号'.$val[0].'已全部入库');
				}

				$purchaseDetails['cgac03'] = $pro['cpaa01'] = $productInfo['cpaf03'] = $product['cpae02'] = $val[0];
				$product['cpae10'] = $val[1];
				$product['cpae11'] = $val[2];
				$productInfo['cpaf08'] = $product['cpae03'] = $warehousingNum;
				$purchaseDetails['cgac12'] = $purchaseArray['cgac12'] + $warehousingNum;
				$product['cpae07'] = $purchaseArray['cgac05'];
				$product['cpae13'] = $purchaseArray['cgac05'] * $warehousingNum;
				$product['cpae21'] = $purchaseInfo['cgaa09'];
				
				$product['cpae04'] = $val[6];
				$productInfo['cpaf05'] = $product['cpae06'] = $val[7];
				$pro['cpaa15'] = $product['cpae22'] = $val[8];
				$purchaseDetails['cgac02'] = $productInfo['cpaf11'] = $product['cpae20'] = $purchaseNo;
				$productInfo['cpaf15'] = '0'; //入库为正数
				$productArr[] = $product;
				$proDetailsArr[] = $productInfo;
				$proArr[] = $pro;
				$purchaseDetailsArr[] = $purchaseDetails; 
			}
		}

		if(empty($batchArr)){
			//生成新的批次时，插入数据(即该采购单第一次入库)
			foreach($productArr as $value){
				$result = cpaeDAO::getInstance()->insert($value,true);
			}
		}else{
			//批次存在时，查出系统剩余的库存量和总额，相加后再更新
			foreach($productArr as $key => $value){
				$stockArr = cpaeDAO::getInstance()->findByAttributes(array('cpae20' => $purchaseNo,'cpae01' => $value['cpae01'],'cpae02' => $value['cpae02']),array('cpae03','cpae04','cpae13'));
				$result = cpaeDAO::getInstance()->update(array('cpae20' => $purchaseNo,'cpae01' => $value['cpae01'],'cpae02' => $value['cpae02']),array('cpae03' => $value['cpae03'] + $stockArr['cpae03'],'cpae04' => $value['cpae04'] + $stockArr['cpae04'],'cpae13' => $value['cpae13'] + $stockArr['cpae13'],'cpae06' => $value['cpae06'],'cpae22' => $value['cpae22'],'cpae10' => $value['cpae10'],'cpae11' => $value['cpae11']));
			}
		}
		if(empty($result)){
			return array('res'=>'error','msg'=>'采购单入库失败');
		}

		//处理采购总量和商品入库总量是否相等的逻辑
		$purchaseInfo['cgaa13'] = '未完成';
		$purchaseInfo['cgaa20'] = cgglConst::$PurchaseOrderStatus[1]; //部分已入库
		$goodsPurchaseNum = 0.00; //商品入库总数
		if(!empty($cgdmxResult)){
			$cgTotalNum = cgaaDAO::getInstance()->findByAttributes(array('cgaa01' => $purchaseNo),array('cgaa04'));
			$cgdmxInfo = cgacDAO::getInstance()->findAllByAttributes(array('cgac02' => $purchaseNo),array('cgac12'));
			foreach($cgdmxInfo as $val){
				$goodsPurchaseNum += $val['cgac12'];
			}
			//所有商品入库完毕，这个采购单就算完结
			if($cgTotalNum['cgaa04'] == $goodsPurchaseNum){
				$purchaseInfo['cgaa13'] = '已完成';
				$purchaseInfo['cgaa20'] = cgglConst::$PurchaseOrderStatus[3]; //已全部入库
			}
		}

		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			//遍历把产品信息插入到产品库存明细表
			foreach($proDetailsArr as $val){
				$res = cpafDAO::getInstance()->insert($val);
			}
			//遍历更新产品的条码(产品表)
			foreach($proArr as $v){
				$cpResult = cpaaDAO::getInstance()->update(array('cpaa01'=>$v['cpaa01']),array('cpaa15'=>$v['cpaa15']));
			}
			//遍历更新采购单明细表[采购单的商品已入库]
			foreach($purchaseDetailsArr as $p){
				$cgdmxResult = cgacDAO::getInstance()->update(array('cgac02'=>$p['cgac02'],'cgac03'=>$p['cgac03']),array('cgac10' => $p['cgac10'],'cgac12' => $p['cgac12']));
			}
			//更新采购单表[采购单入库已完成]
			$cgdResult = cgaaDAO::getInstance()->update(array('cgaa01' => $purchaseNo),$purchaseInfo);

			if(empty($res)){
				return array('res'=>'error','msg'=>'采购单入库失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}
		return array('res'=>'success','msg'=>'采购单入库成功');
		
	}

	/**
	 * @desc 获取库存盘点列表信息(库存量 > 0)
	 * @return array $result 退货款号明细列表信息
	 * @author WuJunhua
	 * @date 2015-11-30
	 */
	public function getInventoryCheckList($goodName){
		$orderList = array();
		$orderList = cpaaDAO::getInstance()->getInventoryCheckList($goodName);
		if(empty($orderList)){
			return array('res'=>'error','msg'=>'获取库存盘点列表信息失败');
		}
		return $orderList;
	}

	/**
	 * @desc 商品入账(盘盈、盘亏)
	 * @param array $goodItems 单条或多条产品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function goodsRecorded($goodItems){
		$inventoryStatus = []; //盘点状态
		$inventoryStatus['inventoryOver'] = cpglConst::$InventoryStatus[5];
		$inventoryStatus['inventoryInvalid'] = cpglConst::$InventoryStatus[6];
		$inventoryNum = pdaaDAO::getInstance()->getCurrentInventoryOrder($inventoryStatus);
		if(empty($inventoryNum)){
			return array('res'=>'error','msg'=>'没有生成新的盘点单号，请进行生成盘点单号操作');
		}
		$orderInfo = []; //库存盘点信息
		$orderInfo['pdaa01'] = $inventoryNum['pdaa01'];
		$orderInfo['pdaa02'] = Yii::app()->session['account'];
		$orderInfo['pdaa03'] = date('Y-m-d H:i:s');
		$orderInfo['pdaa04'] = cpglConst::$InventoryStatus[5];
		$productArr = []; //盘亏库存
		$overageArr = []; //盘盈库存
		$proDetailsArr = []; //库存明细

		//处理单个或多个产品信息
		$goodItemsArr = array_chunk($goodItems,4);
		$product['cpaf07'] = date('Y-m-d H:i:s');
		if(!empty($goodItemsArr)){
			foreach($goodItemsArr as $val){
				$product['cpaf02'] = $productInfo['cpae01'] = $val[0];
				$overageInfo['cpae02'] = $product['cpaf03'] = $productInfo['cpae02'] = $val[1];
				//根据批次和款号查出仓位、价格
				$position = cpaeDAO::getInstance()->findByAttributes(array('cpae01'=>$productInfo['cpae01'],'cpae02'=>$productInfo['cpae02']),array('cpae06','cpae07'));
				$overageInfo['cpae06'] = $productInfo['cpae06'] = $product['cpaf05'] = $position['cpae06'];
				$productInfo['cpae03'] = $val[2];
				$productInfo['cpae07'] = $position['cpae07'];

				//盘盈处理
				if($val[3] > 0){
					$productStock = cpaeDAO::getInstance()->getMaxProductStock();
					//盘盈要生成新的批次号
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
					//盘盈生成的新的批次
					$product['cpaf02'] = $overageInfo['cpae01'] = $stockNo; 
					$overageInfo['cpae03'] = $product['cpaf08'] = $val[3];
					$overageInfo['cpae13'] = $val[3] * $position['cpae07'];
					$product['cpaf09'] = cpglConst::$StockTransactionType[5];
					$product['cpaf15'] = '0'; //盘盈为正数
					unset($productInfo);
				}

				//盘亏处理
				if($val[3] < 0){
					$product['cpaf08'] = - $val[3];
					$product['cpaf09'] = cpglConst::$StockTransactionType[6];
					$product['cpaf15'] = '1'; //盘亏为负数
					unset($overageInfo);
				}

				if(!empty($productInfo)){
					$productArr[] = $productInfo;
				}
				if(!empty($overageInfo)){
					$overageArr[] = $overageInfo;
				}
				$proDetailsArr[] = $product;
			}
		}

		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			//盘亏时,遍历更新库存表的库存量
			if(!empty($productArr)){
				foreach($productArr as $val){
					$updateResult = cpaeDAO::getInstance()->update(array('cpae01'=>$val['cpae01'],'cpae02'=>$val['cpae02']),array('cpae03' => $val['cpae03'],'cpae13' => $val['cpae03'] * $val['cpae07']));
				}
			}
			//盘盈时,生成新的批次插入到库存表
			if(!empty($overageArr)){
				foreach($overageArr as $value){
					$insertResult = cpaeDAO::getInstance()->insert($value,true);
				}
			}
			//遍历把产品信息插入到产品库存明细表
			foreach($proDetailsArr as $val){
				$res = cpafDAO::getInstance()->insert($val);
			}
			//盘点完结
			$inventoryResult = pdaaDAO::getInstance()->update(array('pdaa01'=>$orderInfo['pdaa01']),array('pdaa02'=>$orderInfo['pdaa02'],'pdaa03'=>$orderInfo['pdaa03'],'pdaa04'=>$orderInfo['pdaa04']));

			if(empty($res) || empty($inventoryResult)){
				return array('res'=>'error','msg'=>'入账失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}
		return array('res'=>'success','msg'=>'入账成功');
		
	}

	/**
	 * @desc 仓库报废
	 * @param array $productInfo 产品库存信息
	 * @param int $authentic 正品报废数
	 * @param array $inventoryDetail 库存明细信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-03-17
	 */
	public function warehouseScrapped($productInfo,$authentic,$inventoryDetail){
		//需要查询的字段信息
		$selections = array('cpae03','cpae04','cpae06','cpae07','cpae20','cpae21');
		$inventory = cpaeDAO::getInstance()->findByAttributes($productInfo,$selections);
		if($authentic > $inventory['cpae03']){
			return array('res'=>'error','msg'=>'正品报废数不能大于正品库存量');
		}
		//库存明细的相关信息
		$inventoryDetail['cpaf05'] = $inventory['cpae06'];
		$inventoryDetail['cpaf07'] = date('Y-m-d H:i:s');
		$inventoryDetail['cpaf08'] = $authentic;
		$inventoryDetail['cpaf09'] = cpglConst::$StockTransactionType[11];
		$inventoryDetail['cpaf11'] = $inventory['cpae20'];
		$inventoryDetail['cpaf14'] = $inventory['cpae21'];
		$inventoryDetail['cpaf15'] = 1;
		$inventoryDetail['cpaf16'] = Yii::app()->session['account'];

		$result = cpaeDAO::getInstance()->update($productInfo,array('cpae03' => $inventory['cpae03'] - $authentic,'cpae13' => ($inventory['cpae03'] - $authentic) * $inventory['cpae07']));
		$detailResult = cpafDAO::getInstance()->insert($inventoryDetail);
		if(empty($result) || empty($detailResult)){
			return array('res'=>'error','msg'=>'操作失败');
		}
		return array('res'=>'success','msg'=>'操作成功');
	}

}

<?php
/**
 * @desc 采购表相关操作类
 * @author huyan
 * @date 2015-11-12
 */
class cgaaModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cgaaModel对象
	 * @return cgaaModel
	 * @author huyan
	 * @date 2015-11-12
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取最后一个采购单单号
	 * @return array $result 采购单结果信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 * @modify 2016-03-15 WuJunhua 修复采购单号的生成
	 */
	public function getMaxCgdNumber(){
		$cgdList = cgaaDAO::getInstance()->getMaxCgdNumber();
		$cgdNo = "";
		if(!empty($cgdList)){
			$date = substr($cgdList['cgaa01'],2,4);
			if($date == date('ym')){
				$id = substr($cgdList['cgaa01'],-4,4);
				$id += 1;
				$orderId = sprintf("%04d",$id);
				$cgdNo = 'CG'.date('ym').$orderId;
			}else{
				$id = '1';
				$orderId = sprintf("%04d",$id);
				$cgdNo = 'CG'.date('ym').$orderId;
			}
		}else{
			$id = '1';
			$orderId = sprintf("%04d",$id);
			$cgdNo = 'CG'.date('ym').$orderId;
		}
		return $cgdNo;
	}

	/**
	 * @desc 添加采购单
	 * @param array $commonInfo 用于采购单的信息
	 * @param array $totalInfo 采购单明细信息总汇
	 * @return array $result 采购单结果信息
	 * @author huayan
	 * @date 2015-11-12
	 */
	public function addCgd($totalInfo,$commonInfo){
		if(empty($totalInfo) || empty($commonInfo)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}

		//采购单明细信息
		$cgkh = explode(',',$totalInfo['cgkh']);
		$cgmc = explode(',',$totalInfo['cgmc']);
		$cghh = explode(',',$totalInfo['cghh']);
		$cgjhj = explode(',',$totalInfo['cgjhj']);
		$cgsl = explode(',',$totalInfo['cgsl']);
		$cgsx = explode(',',$totalInfo['cgsx']);
		//每一项进货价是否为空
		foreach ($cgjhj as  $value) {
			if(empty($value) || $value < 0){
				return array('res'=>'message','msg'=>'所有进货价以及采购量都要输入大于‘0’的数字');
			}
		}
		//每一项采购量是否为空	
		foreach ($cgsl as  $value) {
			if(empty($value) || $value < 0){
				return array('res'=>'message','msg'=>'所有进货价以及采购量都要输入大于‘0’的数字');
			}
		}

		$count = count($cgkh);
		//检验是否有重复商品
		for ($i=0; $i < $count; $i++) { 
			for ($j=$i+1; $j < $count; $j++) { 
				if($cgkh[$i] == $cgkh[$j]){
					return array('res'=>'message','msg'=>'存在重复商品，请删除并修改商品数量');
				}
			}
		}
		//采购单信息
		$cgdInfo['cgaa09'] = $commonInfo['gys'];
		$cgdInfo['cgaa14'] = $commonInfo['gysID'];
		$cgdInfo['cgaa08'] = $commonInfo['cgyf'] != '' ? $commonInfo['cgyf'] : 0;
		$cgdInfo['cgaa10'] = $commonInfo['cgbz'];
		$cgdInfo['cgaa07'] = $commonInfo['dhsj'].' 00:00:00';
		$cgdInfo['cgaa11'] = $commonInfo['number'];
		$cgdInfo['cgaa05'] = $commonInfo['setter'];
		$cgdInfo['cgaa06'] = $commonInfo['submitdate'];
		$cgdInfo['cgaa21'] = cgglConst::$PurchaseOrderType[1];
		$cgdInfo['cgaa01'] = $this->getMaxCgdNumber();

		$cgdAddResult = cgaaDAO::getInstance()->insert($cgdInfo,true);

		if(empty($cgdAddResult)){
			return array('res'=>'false','msg'=>'采购单添加失败');
		}
		//用于采购明细中的项目数
		$count = 0;
		//采购单，商品总进货价
		$cgdInfo['cgaa03'] = 0;
		//采购单，商品数目总量
		$cgdInfo['cgaa04'] = 0;
		for($i = 0; $i < $cgdInfo['cgaa11']; $i ++){
			if($cgkh[$i] != ''){
				$cpacInfo['cgac02'] = $cgdInfo['cgaa01'];
				$cpacInfo['cgac03'] = $cgkh[$i];
				$cpacInfo['cgac09'] = $cghh[$i];
				$cpacInfo['cgac04'] = $cgmc[$i];
				$cpacInfo['cgac05'] = $cgjhj[$i] != '' ? $cgjhj[$i] : 0;
				$cpacInfo['cgac06'] = $cgsl[$i] != '' ? $cgsl[$i] : 0;	
				$cpacInfo['cgac07'] = $cpacInfo['cgac05'] * $cpacInfo['cgac06'];

				if(empty($cpacInfo['cgac05']) || empty($cpacInfo['cgac06'])){
					return array('res'=>'false','msg'=>'所有进货价以及采购量都不能为空');
				}

				$cpsxArr = explode(';', $cgsx[$i]);
				if(empty($cpsxArr[0])){
					$cpacInfo['cgac08'] = '';
					$cpacInfo['cgac11'] = $count;
					$cgdInfo['cgaa03'] += $cpacInfo['cgac07'];
					$cgdInfo['cgaa04'] += $cpacInfo['cgac06'];
					cgacDAO::getInstance()->insert($cpacInfo,true);
					$count ++;
				}else{
					$level = count($cpsxArr);
					while($level > 2){
						$finalStr = "";
						$str1 = explode("|",$cpsxArr[0]);
						$str2 = explode("|",$cpsxArr[1]);
						foreach ($str1 as $value1) {
							foreach($str2 as $value2){
								if(!empty($value1) && !empty($value2)){
									$finalStr .= $value1.",".$value2."|";
								}
							}
						}
						$cpsxArr[0] = $finalStr;
						array_splice($cpsxArr,1,1);
						$level = count($cpsxArr);
					}
					$str = explode('|', $cpsxArr[0]);

					for($j = 0; $j < count($str)-1; $j ++){
						$cpacInfo['cgac08'] = $str[$j];
						$cpacInfo['cgac11'] = $j + $count;
						$cgdInfo['cgaa03'] += $cpacInfo['cgac07'];
						$cgdInfo['cgaa04'] += $cpacInfo['cgac06'];
						cgacDAO::getInstance()->insert($cpacInfo,true);
					}
					$count += $j;
				}
			}
		}
		$finalResult = cgaaDAO::getInstance()->updateByPk($cgdInfo['cgaa01'],$cgdInfo);
	
		if(empty($finalResult)){
			return array('res'=>'false','msg'=>'修改总价错误');
		}
		return array('res'=>'success','msg'=>'下单成功');
	}

	/**
	 * @desc 添加额外的项目
	 * @param array $totalInfo 采购单明细信息总汇
	 * @param int $count 项目数
	 * @param int $number 上传的项目数
	 * @param string $id 采购单号
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function addExtraCgd($totalInfo,$number,$count,$id){
		if(empty($totalInfo) || empty($count) || empty($id)){
			return array('res'=>'error','msg'=>'信息出错');
		}

		//采购单明细信息
		$cgkh = explode(',',$totalInfo['cgkh']);
		$cgmc = explode(',',$totalInfo['cgmc']);
		$cghh = explode(',',$totalInfo['cghh']);
		$cgjhj = explode(',',$totalInfo['cgjhj']);
		$cgsl = explode(',',$totalInfo['cgsl']);
		$cgsx = explode(',',$totalInfo['cgsx']);
		//每一项进货价是否为空
		foreach ($cgjhj as  $value) {
			if(empty($value)){
				return array('res'=>'false','msg'=>'所有进货价以及采购量都不能为空');
			}
		}
		//每一项采购量是否为空	
		foreach ($cgsl as  $value) {
			if(empty($value)){
				return array('res'=>'false','msg'=>'所有进货价以及采购量都不能为空');
			}
		}

		$priceAndNum = $this->getTotalPriceAndNum($id);
		//采购单，商品总进货价
		$cgdInfo['cgaa03'] = $priceAndNum['cgaa03'];
		//采购单，商品数目总量
		$cgdInfo['cgaa04'] = $priceAndNum['cgaa04'];
		for($i = 0; $i < $number; $i ++){
			if($cgkh[$i] != ''){
				$cpacInfo['cgac02'] = $id;
				$cpacInfo['cgac03'] = $cgkh[$i];
				$cpacInfo['cgac09'] = $cghh[$i];
				$cpacInfo['cgac04'] = $cgmc[$i];
				$cpacInfo['cgac05'] = $cgjhj[$i] != '' ? $cgjhj[$i] : 0;
				$cpacInfo['cgac06'] = $cgsl[$i] != '' ? $cgsl[$i] : 0;	
				$cpacInfo['cgac07'] = $cpacInfo['cgac05'] * $cpacInfo['cgac06'];

				$cpsxArr = explode(';', $cgsx[$i]);
				if(empty($cpsxArr[0])){
					$cpacInfo['cgac08'] = '';
					$cpacInfo['cgac11'] = $count;
					$cgdInfo['cgaa03'] += $cpacInfo['cgac07'];
					$cgdInfo['cgaa04'] += $cpacInfo['cgac06'];
					cgacDAO::getInstance()->insert($cpacInfo,true);
					$count ++;
				}else{
					$level = count($cpsxArr);
					while($level > 2){
						$finalStr = "";
						$str1 = explode("|",$cpsxArr[0]);
						$str2 = explode("|",$cpsxArr[1]);
						foreach ($str1 as $value1) {
							foreach($str2 as $value2){
								if(!empty($value1) && !empty($value2)){
									$finalStr .= $value1.",".$value2."|";
								}
							}
						}
						$cpsxArr[0] = $finalStr;
						array_splice($cpsxArr,1,1);
						$level = count($cpsxArr);
					}
					$str = explode('|', $cpsxArr[0]);

					for($j = 0; $j < count($str)-1; $j ++){
						$cpacInfo['cgac08'] = $str[$j];
						$cpacInfo['cgac11'] = $j + $count;
						$cgdInfo['cgaa03'] += $cpacInfo['cgac07'];
						$cgdInfo['cgaa04'] += $cpacInfo['cgac06'];
						cgacDAO::getInstance()->insert($cpacInfo,true);
					}
					$count += $j;
				}
			}
		}
		$finalResult = cgaaDAO::getInstance()->updateByPk($id,$cgdInfo);
		if(empty($finalResult)){
			return array('res'=>'false','msg'=>'修改总价错误');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 获取采购单总价以及总数量
	 * @param string $id 采购单号
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getTotalPriceAndNum($id){
		$result = cgaaDAO::getInstance()->getTotalPriceAndNum($id);
		return $result;
	}

	/**
	 * @desc 获取采购单信息（供应商，预计到货时间，邮费）
	 * @param string $id 采购单号
	 * @return array $result 当前采购单信息
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function getSingleCgd($id){
		$result = cgaaDAO::getInstance()->findByAttributes(array('cgaa01'=>$id));
		if(empty($result)){
			return array('res' => 'error','msg' => '获取采购单失败');
		}
		return $result;
	}

	/**
	 * @desc 获取最大项目数
	 * @param string $id 采购单号
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function getMaxCount($id){
		if(empty($id)){
			return array('res'=>'error');
		}
		$result = cgaaDAO::getInstance()->getMaxCount($id);
		if(empty($result)){
			return array('res'=>'false');
		}
		return $result;
		var_dump($result);
	}

	/**
	 * @desc 更新采购单信息（供应商，运费，预计到货时间）
	 * @param string $id 采购单号
	 * @param array $cgdInfo 采购单信息
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function updateSomeCgd($id,$cgdInfo){
		if(empty($id) || empty($cgdInfo)){
			return array('res'=>'error','mes'=>'数据不全，出错');
		}
		$result = cgaaDAO::getInstance()->update(array('cgaa01'=>$id),$cgdInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'更新失败');
		}
		return $result;
	}

	/**
	 * @desc 更新采购单的总金额
	 * @param string $id 采购单号
	 * @param int $sum 总金额
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-10
	 */
	public function updateCgdSum($id,$sum){
		if(empty($id) || empty($sum)){
			return array('res'=>'error','mes'=>'数据不全，出错');
		}
		$result = cgaaDAO::getInstance()->update(array('cgaa01'=>$id),array('cgaa22'=>$sum));
		
		if(empty($result)){
			return array('res'=>'false','mes'=>'更新失败');
		}
		return array('res'=>'success','mes'=>'更新成功');
	}

	/**
	 * @desc 审核采购单
	 * @param string $id 采购单号
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function auditingCgd($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}
		$result = cgaaDAO::getInstance()->update(array('cgaa01'=>$id),array('cgaa02'=>'已审核'));
		if(empty($result)){
			return array('res'=>'false','msg'=>'审核失败');
		}
		return array('res'=>'success','msg'=>'审核成功');
	}

	/**
	 * @desc 撤销审核采购单
	 * @param string $id 采购单号
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function unauditingCgd($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}
		$result = cgaaDAO::getInstance()->update(array('cgaa01'=>$id),array('cgaa02'=>'未审核'));
		if(empty($result)){
			return array('res'=>'false','msg'=>'撤销失败');
		}
		return array('res'=>'success','msg'=>'撤销成功');
	}

	/**
	 * @desc 给采购单过账
	 * @param string $id 采购单号
	 * @param int $postMoney 过账金额
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-10
	 */
	public function postCgd($id,$postMoney){
		if(empty($id)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}
		$demoList = cgacDAO::getInstance()->selectGetAndStock($id);
		if($demoList['has'] != $demoList['stock']){
			return array('res'=>'false','msg'=>'采购商品尚未入库');
		}
		$result = cgaaDAO::getInstance()->update(array('cgaa01'=>$id),array('cgaa12'=>'已打款','cgaa22'=>$postMoney));
		if(empty($result)){
			return array('res'=>'false','msg'=>'过账失败');
		}
		return array('res'=>'success','msg'=>'过账成功');
	}

	/**
	 * @desc 根据条件获取采购单
	 * @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @param array $cgdInfo 查询条件
	 * @return array $result 采购单结果信息
	 * @author huayan
	 * @date 2015-11-12
	 */
	public function getCgdByCond($page,$psize,$cgdInfo){
		$result = array();
		$cgdList = cgacDAO::getInstance()->getCgdByCond($page,$psize,$cgdInfo);
		//判断是否查询到有数据
		if(!empty($cgdList['info']) && is_array($cgdList['info'])){
			$result['result'] = 'success';
			$result['list'] = $cgdList['info'];
			$result['count'] = $cgdList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;	
	}

	/**
	 * @desc 根据查询条件获取已审核的采购单(退货总数 != 采购量)
	 * @param array $orderInfo 采购单查询条件
	 * @author WuJunhua
	 * @date 2015-12-14
	 * @modify 2016-03-18 WuJunhua 增加：获取商品编号的最新入库库位
	 */
	public function getAuditedPostedOrder($orderInfo){
		$orderStatusArr = [];
		$orderStatusArr['audited'] = '已审核';
		$orderData = cgaaDAO::getInstance()->getAuditedPostedOrder($orderInfo,$orderStatusArr);
		if(empty($orderData)){
			return array('res'=>'error','msg'=>'获取采购单信息失败');
		}
		//获取该采购单号下商品编号的库存量，最新入库库位、条码
		foreach($orderData as $key => $value){
			$result = cpaeDAO::getInstance()->getNewestLocation($value['cgac03']);
			$stockNumArr = cpaeDAO::getInstance()->findByAttributes(['cpae20' => $orderInfo['purchaseNo'],'cpae02' => $value['cgac03'] ],['cpae03']);
			$orderData[$key]['cpae03'] = $stockNumArr['cpae03'];
			$orderData[$key]['cpae06'] = $result['cpae06'];
			$orderData[$key]['cpae18'] = $result['cpae18'];
			$orderData[$key]['cpae22'] = $result['cpae22'];
		}
		return $orderData;
	}

	/**
	 * @desc 获取退货供应商的采购单[要入库、采购总额>退货金额且不等于已入账]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $CondList 查询条件
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function getReturnSuppliersOrder($page,$psize,$CondList){
		$result = [];  //获取列表数据的结果
		$orderStatus = [];
		$orderStatus['haveMoney'] = cgglConst::$WhetherPlayMoney[1]; //已打款
		$orderList = cgaaDAO::getInstance()->getReturnSuppliersOrder($page,$psize,$CondList,$orderStatus);

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
	 * @desc 获取已审核且未全部入库的采购单 [入库类型为采购单入库]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $CondList 查询条件
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function getAuditedPaidOrder($page,$psize,$CondList){
		$result = [];  //获取列表数据的结果
		$orderStatusArr = [];
		$orderStatusArr['audited'] = cgglConst::$WhetherToAudit[1]; //已审核
		$orderStatusArr['warehousing'] = cgglConst::$PurchaseOrderStatus[3]; //已全部入库
		$orderStatusArr['purchaseStorage'] = cgglConst::$PurchaseOrderType[1]; //采购单入库
		$orderStatusArr['directStorage'] = cgglConst::$PurchaseOrderType[2]; //直接入库
		$orderList = cgaaDAO::getInstance()->getAuditedPaidOrder($page,$psize,$CondList,$orderStatusArr);

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
	 * @desc 根据采购单号来获取采购单的相关明细信息
	 * @param string $purchaseNo 采购单号
	 * @author WuJunhua
	 * @date 2015-11-24
	 */
	public function getPurchaseOrderInfo($purchaseNo){
		$orderData = cgaaDAO::getInstance()->getPurchaseOrderInfo($purchaseNo);
		if(empty($orderData)){
			return array('res'=>'error','msg'=>'获取采购单明细信息失败');
		}
		foreach($orderData as $key => $value){
			$warehousingNum = cpaeDAO::getInstance()->findByAttributes([ 'cpae20' => $purchaseNo,'cpae02' => $value['cgac03'] ],['cpae03']);
			$orderData[$key]['cpae03'] = $warehousingNum['cpae03'];
		}
		return $orderData;
	}

	/**
	 * @desc 退货供应商(仓退)
	 * @param array $purchaseNo 采购单号
	 * @param array $goodItems 商品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-03-11
	 */
	public function returnSuppliers($purchaseNo,$goodItems){		
		//处理单个或多个商品信息
		$goodItemsArr = array_chunk($goodItems, 2);
		$goodsArr = []; //退货商品信息
		if(!empty($goodItemsArr)){
			//采购单明细相关字段
			$batchSelections = ['cgac12','cgac14','cgac05'];
			foreach($goodItemsArr as $val){
				$goods['cgac03'] = $val[0];
				$batchArr = cgacDAO::getInstance()->findByAttributes([ 'cgac02' => $purchaseNo,'cgac03' => $goods['cgac03'] ],$batchSelections);
				$returnNum = (float)$val[1];
				if($returnNum == 0 || empty($returnNum)){
					return array('res'=>'tips','msg'=>'款号'.$goods['cgac03'].'的退货数量不能为0');
				}
				$goods['cgac14'] = $batchArr['cgac14'] + $returnNum;
				if($goods['cgac14'] > $batchArr['cgac12']){
					return array('res'=>'tips','msg'=>'款号'.$goods['cgac03'].'的退货总数不能大于已入库数量');
				}
				$goods['cgac13'] = $goods['cgac14'] * $batchArr['cgac05']; //退货金额
				$goods['cgac15'] = date('Y-m-d H:i:s'); //退货时间
				$goods['cgac16'] = $returnNum; //每次退货数
				$goodsArr[] = $goods;
			}
		}

		$purchaseInfo = []; //采购单信息
		$purchaseInfo['cgaa17'] = Yii::app()->session['account']; //操作人(退货供应商操作人)
		$purchaseInfo['cgaa18'] = date('Y-m-d H:i:s'); //操作时间 
		$purchaseInfo['cgaa15'] = 0; //采购单退货总额
		$purchaseInfo['cgaa19'] = '是'; //是否已退货供应商
		$purchaseInfo['cgaa16'] = 0; //采购单商品退货总数
		foreach($goodsArr as $val){
			$res = cgacDAO::getInstance()->findByAttributes(array('cgac02' => $purchaseNo,'cgac03' => $val['cgac03']),array('cgac13','cgac14'));
			$purchaseInfo['cgaa15'] += $res['cgac13'];
			$purchaseInfo['cgaa16'] += $res['cgac14']; 
		}

		$productInfo = []; 
		$productInfoArr = []; //产品库存信息
		$selections = array('cpae01','cpae02','sum(cpae03) as cpae03','cpae06','cpae13','cpae20');
		foreach($goodsArr as $val){
			$productInfo[] = cpaeDAO::getInstance()->findAllByAttributes(array('cpae20' => $purchaseNo,'cpae02'=> $val['cgac03']),$selections);
		}
		if(empty($productInfo)){
			return array('res'=>'tips','msg'=>'获取产品库存信息失败');
		}
		foreach($productInfo as $value){
			foreach($value as $v){
				$productInfoArr[] = $v;
			}
		}

		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			//更新采购单明细的商品退货数量和退货总额
			foreach($goodsArr as $value){
				/**** 这里的查询条件暂时缺少属性 'cgac08' => $value['cgac08'],后面要加上 *****/
				$goodResult = cgacDAO::getInstance()->update(array('cgac02' => $purchaseNo,'cgac03' => $value['cgac03']),$value);
			}
			//采购单表更新相关数据
			$orderResult = cgaaDAO::getInstance()->update(array('cgaa01' => $purchaseNo),$purchaseInfo);
			if(empty($orderResult) || empty($goodResult)){
				return array('res'=>'error','msg'=>'退货供应商失败');
			}

			$InventoryDetail = []; //库存明细
			$InventoryDetail['cpaf15'] = '1'; //退货供应商为负数
			$InventoryDetail['cpaf07'] = date('Y-m-d H:i:s'); //异动日期(退货入仓日期)
			$InventoryDetail['cpaf09'] = cpglConst::$StockTransactionType[10]; //异动类型
			$InventoryDetail['cpaf16'] = Yii::app()->session['account']; //操作工号
			$InventoryDetail['cpaf11'] = $purchaseNo; //出库单号
			//处理退货入仓
			foreach($productInfoArr as $k=>$val){
				$spl = $goodsArr[$k]['cgac16']; 
				$kcl = $val['cpae03'];
				$thze = $goodsArr[$k]['cgac13'];
				if($kcl - $spl < 0){
					return array('res'=>'tips','msg'=>'款号'.$val['cpae02'].'的库存量不足以退货');
				}
				if($kcl - $spl > 0){
					$updateResult = cpaeDAO::getInstance()->update(array('cpae20' => $val['cpae20'],'cpae02' => $val['cpae02']),array('cpae03' => $kcl - $spl,'cpae13' => $val['cpae13'] - $thze));
				}
				if($kcl - $spl == 0){
					$updateResult = cpaeDAO::getInstance()->update(array('cpae20' => $val['cpae20'],'cpae02' => $val['cpae02']),array('cpae03' => $kcl - $kcl,'cpae13' => 0));
				}
				$InventoryDetail['cpaf02'] = $val['cpae01']; //批次
				$InventoryDetail['cpaf03'] = $val['cpae02']; //产品编号
				$InventoryDetail['cpaf05'] = $val['cpae06']; //仓位
				$InventoryDetail['cpaf08'] = $spl; //异动数量
				//插入库存明细
				$detailResult = cpafDAO::getInstance()->insert($InventoryDetail);
			}

			if(empty($updateResult) || empty($detailResult)){
				return array('res'=>'error','msg'=>'退货供应商失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}

		return array('res'=>'success','msg'=>'退货供应商成功');
	}

	/**
	 * @desc 获取退货供应商记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $CondList 查询条件
	 * @param int $sign 导出excel标识
	 * @return array $result 退货供应商记录列表信息
	 * @author WuJunhua
	 * @date 2016-03-11
	 */
	public function getReturnSupplierRecordList($page,$psize,$CondList,$sign){
		$result = [];  //获取列表数据的结果
		$orderStatus = [];
		$orderStatus['finished'] = '是';
		$orderList = cgaaDAO::getInstance()->getReturnSupplierRecordList($page,$psize,$orderStatus,$CondList);

		if($sign == 1){
			//导出供应商记录excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[20]); //导出供应商记录excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = cgaaDAO::getInstance()->getReturnSupplierRecordList($page,$psize,$orderStatus,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '退货供应商记录';
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
	
}


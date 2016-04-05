<?php
/**
 * @desc 订单表相关操作类
 * @author WuJunhua
 * @date 2015-10-28
 */
class xsaaModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回xsaaModel对象
	 * @return xsaaModel
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取订单类型的选项卡信息
	 * @return array $result 工号所在组选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getOrderType($ddlx){
		$result = array();  //工号所在组选项卡的结果信息
		$OrderTypeList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $ddlx));
		if(empty($OrderTypeList)){
			return false;
		}
		foreach($OrderTypeList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取支付方式选项卡信息
	 * @return array $result 支付方式选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getPaymentMethod($zffs){
		$result = array();  //支付方式选项卡的结果信息
		$PaymentMethodList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $zffs));
		if(empty($PaymentMethodList)){
			return false;
		}
		foreach($PaymentMethodList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取快递公司选项卡信息
	 * @return array $result 快递公司选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 * @modify WuJunhua 2015-12-24 修改快递公司表的获取路径
	 */
	public function getDeliveryCompany(){
		$result = array();  //快递公司选项卡的结果信息
		$status = 'T';
		$DeliveryCompanyList = sykdgssetDAO::getInstance()->findAllByAttributes(array('ifuse' => $status),array('kdgsid','kdgstext'));
		if(empty($DeliveryCompanyList)){
			return false;
		}
		foreach($DeliveryCompanyList as $val){
			$result[$val['kdgsid']] = $val['kdgstext'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取发票类型选项卡信息
	 * @return array $result 发票类型选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getInvoiceType($fplx){
		$result = array();  //发票类型选项卡的结果信息
		$InvoiceTypeList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $fplx));
		if(empty($InvoiceTypeList)){
			return false;
		}
		foreach($InvoiceTypeList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取有无快递费选项卡信息
	 * @return array $result 有无快递费类型选项卡的结果信息
	 * @author huyan
	 * @date 2015-12-23
	 */
	public function getExpressFee($ywkdf){
		$result = array();  //有无快递费类型选项卡的结果信息
		$ExpressFeeTypeList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $ywkdf));
		if(empty($ExpressFeeTypeList)){
			return false;
		}
		foreach($ExpressFeeTypeList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	
	/**
	 * @desc 获取是否记账选项卡信息
	 * @return array $result 是否记账选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getWhetherAccounting($sfjz){
		$result = array();  //是否记账选项卡的结果信息
		$WhetherAccountingList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $sfjz));
		if(empty($WhetherAccountingList)){
			return false;
		}
		foreach($WhetherAccountingList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取审核状态选项卡信息
	 * @return array $result 审核状态选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getAuditStatus($shzt){
		$result = array();  //审核状态选项卡的结果信息
		$AuditStatusList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $shzt));
		if(empty($AuditStatusList)){
			return false;
		}
		foreach($AuditStatusList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取订单状态选项卡信息
	 * @return array $result 发票类型选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getOrderStatus($ddzt){
		$result = array();  //发票类型选项卡的结果信息
		$OrderStatusList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $ddzt));
		if(empty($OrderStatusList)){
			return false;
		}
		foreach($OrderStatusList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取客户的订单列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $sequence 顺序或倒序(ASC/DESC)
	 * @param string $order 根据order排序
	 * @param array $CondList 查询条件
	 * @param array $addrInfo 地址信息
	 * @param int $sign 导出excel标识
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-10-28
	 */
	public function getClientOrder($page,$psize,$sequence,$order,$CondList,$addrInfo,$sign){
		$result = array();  //获取列表数据的结果
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['khsf']),array('pname'));
		$addrInfo['khsf']=$province['pname'];
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['city']),array('cname'));
		$addrInfo['city']=$city['cname'];
		$orderList = xsaaDAO::getInstance()->getClientOrders($page,$psize,$sequence,$order,$CondList,$addrInfo);

		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[4]); //导出客户订单excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getClientOrders($page,$psize,$sequence,$order,$CondList,$addrInfo,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '客户订单';
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
	 * @desc 添加订单
	 * @param array $orderInfo 订单资料
	 * @param array $addrInfo 地址信息
	 * @param array $goodItems 商品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-10-30
	 * @modify WuJunhua 2015-11-12 新增下单时不能有重复的订单号判断，下单时把商品信息也一同插入到订单明细表
	 * @modify huyan  2015-12-01 保存订单时累计客户消费金额和购买次数
	 */
	public function addOrder($orderInfo,$addrInfo,$goodItems,$ddyj,$kuanhao){
		if(empty($orderInfo['xsaa04'])){
			return array('res'=>'tips','msg'=>'客户编号不能为空');
		}
		if(empty($orderInfo['xsaa05'])){
			return array('res'=>'tips','msg'=>'客户姓名不能为空');
		}
		if(empty($orderInfo['xsaa06'])){
			return array('res'=>'tips','msg'=>'客户手机不能为空');
		}

		if(empty($orderInfo)){
			return array('res'=>'error','msg'=>'添加失败');
		}
		$clientMsg = khaaDAO::getInstance()->findByAttributes(array('khaa02' => $orderInfo['xsaa04']),array('khaa22','khaa25'));  
		$orderInfo['xsaa08'] = $clientMsg['khaa25'];
		$orderInfo['xsaa60'] = $clientMsg['khaa22'];

		//生成订单号
		$orderList = xsaaDAO::getInstance()->getMaxOrderNumber();
		if(!empty($orderList)){
			$date = substr($orderList['xsaa02'],2,4);
			if($date == date('ym')){
				$id = substr($orderList['xsaa02'],-4,4);
				$id += 1;
				$orderId = sprintf("%04d",$id);
				$orderNo = 'XS'.date('ym').$orderId;
			}else{
				$id = '1';
				$orderId = sprintf("%04d",$id);
				$orderNo = 'XS'.date('ym').$orderId;
			}
		}else{
			$id = '1';
			$orderId = sprintf("%04d",$id);
			$orderNo = 'XS'.date('ym').$orderId;
		}
		$orderInfo['xsaa02'] = $orderNo;

		//处理单个或多个商品信息
		$orderkuanh = count($kuanhao);
		for($a = 0;$a < $orderkuanh;$a++){
			$NaN='NaN';
			if ($kuanhao[$a]==$NaN) {
				return array('res'=>'error','msg'=>'请先删除空的商品行');
			}
		}

		$goodItemsArr = array_chunk($goodItems, 6);
		if(!empty($goodItemsArr)){
			$arr2 = array_unique($kuanhao);
    	    $num2 = count($arr2);
    	    if($orderkuanh > $num2){
    	        return array('res'=>'error','msg'=>'已选择相同商品,请先删除重复商品,然后修改购买数量');
    	    }else{
    	    	$goodName = ''; //库存量为0的商品
    	    	$InventoryShortage = ''; //库存量不足的商品
			    foreach($goodItemsArr as $val){
				    $goods['xsab01'] = $orderNo;
				    $goods['xsab03'] = $val[0];
	    	    	$conditionNumber = array('cpaa01' => $val[0]);
	    	    	$testGoodNumber = cpaaDAO::getInstance()->isExists($conditionNumber);
					if(empty($testGoodNumber)){
						return array('res'=>'tips','msg'=>'输入的商品款号不存在，请重新输入！');
					}
				    $goods['xsab02'] = $val[1];
	    	    	$conditionName = array('cpaa02' => $val[1]);
	    	    	$testGoodName = cpaaDAO::getInstance()->isExists($conditionName);
					if(empty($testGoodName)){
						return array('res'=>'tips','msg'=>'输入的商品名称不存在，请重新输入！');
					}

				    if(empty($goods['xsab02'])){
				    	return array('res'=>'tips','msg'=>'商品名称不能为空');
				    }

				    $hqjhj=cpaeDAO::getInstance()->getBuyingPrice($val[0]);
				    if (floatval($val[2])<floatval($hqjhj['cpjhj'])) {
				    	$chanpkh='款号'.$val[0].'的成本价为'.$hqjhj['cpjhj'].'&nbsp;&nbsp;&nbsp;';
				    	return array('res'=>'tips','msg'=>$chanpkh.'商品单价不能低于成本价');
				    }

				    $goods['xsab06'] = $goods['xsab05'] = $val[2];
				    $goods['xsab04'] = $val[3];
				    if(empty($goods['xsab04'])){
				    	return array('res'=>'tips','msg'=>'商品数量不能为空');
				    }
				    $goods['xsab08'] = $goods['xsab07'] = $val[4];
				   /* if(empty($val[5])){
				    	$goodName .= $val[1].'、';
				    	//return array('res'=>'tips','msg'=>'不能添加库存量为0的商品');
				    }
				    if((int)$val[3] > (int)$val[5]){
				    	$InventoryShortage .= $val[1].'、';
				    	//return array('res'=>'tips','msg'=>'所选商品库存量不足');
				    }*/
				    $goodsArr[] = $goods;
			    }
		    }
		}
		
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['provinceid']),array('pname'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['cityid']),array('cname'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aid'=>$addrInfo['areaid']),array('aname'));
		//拼接联系地址
		$orderInfo['xsaa09'] = $province['pname'].','.$city['cname'].','.$area['aname'].','.$addrInfo['deaddress'];
		//客户意向
		$customerIntention = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$orderInfo['xsaa04']),array('khaa25'));
		$orderInfo['xsaa08'] = $customerIntention['khaa25'];

		//分业绩处理
		$domain = strstr($ddyj, '*'); //判断单人还是多人
		$arr1 = explode('*', $ddyj);
		$arr1Length = count($arr1);
		//业绩只有一个人时
		if(empty($domain)){
			for($i=0;$i<$arr1Length;$i++){
				$arr2 = explode(':', $arr1[$i]);
			}
			$arr2Length = count($arr2);
			if($arr2Length > 0 && $arr2Length <=2){
				$performanceInfo['xsac01'] = $orderNo;
				$performanceInfo['xsac02'] = $arr2[0];
				$performanceInfo['xsac04'] = 1;
				$performanceInfo['xsac05'] = $performanceInfo['xsac04'] * $orderInfo['xsaa19'];
			}
			$performanceRes = xsacDAO::getInstance()->insert($performanceInfo,true);
		//业绩分多人时
		}else{
			for($i=0;$i<$arr1Length;$i++){
				$arr2[] = explode(':', $arr1[$i]);
			}
			foreach($arr2 as $key=>$value){
				$performanceArr[$key]['xsac01'] = $orderNo;
				$performanceArr[$key]['xsac02'] = $value[0];
				$performanceArr[$key]['xsac04'] = $value[1];
				$performanceArr[$key]['xsac05'] = $performanceArr[$key]['xsac04'] * $orderInfo['xsaa19'];
			}
			//多人分业绩遍历插入到订单分业绩表
			foreach($performanceArr as $val){
				$performanceRes = xsacDAO::getInstance()->insert($val,true);
			}
		}
		/*if(empty($performanceRes)){
			return array('res'=>'error','msg'=>'订单分业绩失败,请重新操作');
		}*/

		$condition1 = array('xsaa02' => $orderNo);
		$orderResult = xsaaDAO::getInstance()->isExists($condition1);
		//下单时不能有重复的订单号
		if($orderResult){
			return array('res'=>'error','msg'=>'下单失败,已有该订单号,请重新下单');
		}
		$res = xsaaDAO::getInstance()->insert($orderInfo);
		//遍历把商品信息插入到订单明细表
		foreach($goodsArr as $val){
			$result = xsabDAO::getInstance()->insert($val,true);
		}

		//购买产品相关处理
		$customerBuyProduct = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$orderInfo['xsaa04']),array('khaa34'));
		foreach ($goodsArr as $key => $value) {
			$arra2[]=$value['xsab02'];
		}
		$str = '';
		foreach ($arra2 as $k => $v) {
			$str.=$v.',';
		}
		$customerBuyProduct['khaa34'].=$str;
		$newstr=substr($customerBuyProduct['khaa34'],0,strlen($customerBuyProduct['khaa34'])-1);
		$arr=explode(',',$newstr);
		$DelDup=array_unique($arr);
		$khgmcp='';
		foreach ($DelDup as $ke => $val) {
			$khgmcp.=$val.',';
		}
		//更新客户购买产品
	    $TimeReceipt = khaaDAO::getInstance()->update(array('khaa02'=>$orderInfo['xsaa04']),array('khaa34'=>$khgmcp));

		if(empty($res)){
			return array('res'=>'error','msg'=>'添加失败');
		}

		unset($addrInfo);
		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res'=>'success','msg'=>'添加成功','orderno'=>$orderNo);
	}

	/**
	 * @desc 获取订单详情
	 * @param string $orderNo 订单编号
	 * @return array $orderDetails 订单信息
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function getOrderDetails($ordernum,$symbol){
		if(empty($ordernum) || empty($symbol)){
			return array('res' => 'error','msg' => '获取订单详情失败');
		}
		//上一单、下一单判定
		if($symbol == '<'){
			$order = 'DESC';
		}
		if($symbol == '>' || $symbol == '='){
			$order = 'ASC';
		}
		$orderDetails = xsaaDAO::getInstance()->findOrderDetail($ordernum,$symbol,$order);
		if(empty($orderDetails)){
			return array('res' => 'error','msg' => '获取订单详情失败');
		}

		$maxOrder = xsaaDAO::getInstance()->findMaxOrder();	//序号最大的订单
		$minOrder = xsaaDAO::getInstance()->findMinOrder(); //序号最小的订单
		if($orderDetails['xsaa01'] == $maxOrder['xsaa01']){
			$orderDetails['maxorder'] = $orderDetails['xsaa01'];
		}
		if($orderDetails['xsaa01'] == $minOrder['xsaa01']){
			$orderDetails['minorder'] = $orderDetails['xsaa01'];
		}
		if(!empty($orderDetails['xsaa09'])){
			$addrStr = $orderDetails['xsaa09'];
			$addrArr = explode(',', $addrStr);
		}
		if(!empty($orderDetails['xsaa10'])){
			$orderDetails['postcode'] = $orderDetails['xsaa10'];
		}
		if(!empty($addrArr)){
			$orderDetails['province'] = $addrArr[0];
			$orderDetails['city'] = $addrArr[1];
			$orderDetails['area'] = $addrArr[2];
			$orderDetails['addrdetail'] = $addrArr[3];
		}
		//获取省市区唯一id
		$province = approvinceDAO::getInstance()->findByAttributes(array('pname'=>$orderDetails['province']),array('pid'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cname'=>$orderDetails['city']),array('cid'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aname'=>$orderDetails['area']),array('aid'));
		$orderDetails['provinceid'] = $province['pid'];
		$orderDetails['cityid'] = $city['cid'];
		$orderDetails['areaid'] = $area['aid'];
		return $orderDetails;
	}

	/**
	 * @desc 修改订单信息
	 * @param string $orderNo 订单编号
	 * @param array $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function updateOrderMsg($orderNo,$orderInfo,$addrInfo){
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['provinceid']),array('pname'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['cityid']),array('cname'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aid'=>$addrInfo['areaid']),array('aname'));
		//拼接联系地址
		$orderInfo['xsaa09'] = $province['pname'].','.$city['cname'].','.$area['aname'].','.$addrInfo['deaddress'];
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderNo),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '保存失败');
		}
		
		//分业绩处理
		$domain = strstr($orderInfo['xsaa33'], '*'); //判断单人还是多人
		$arr1 = explode('*', $orderInfo['xsaa33']);
		$arr1Length = count($arr1);
		//业绩只有一个人时
		if(empty($domain)){
			for($i=0;$i<$arr1Length;$i++){
				$arr2 = explode(':', $arr1[$i]);
			}
			$arr2Length = count($arr2);
			if($arr2Length > 0 && $arr2Length <=2){
				$performanceInfo['xsac01'] = $orderNo;
				$performanceInfo['xsac02'] = $arr2[0];
				$performanceInfo['xsac04'] = 1;
				$performanceInfo['xsac05'] = $performanceInfo['xsac04'] * $orderInfo['xsaa19'];
			}
			xsacDAO::getInstance()->delete(array('xsac01' => $orderNo));
			$performanceRes = xsacDAO::getInstance()->insert($performanceInfo,true);
		//业绩分多人时
		}else{
			for($i=0;$i<$arr1Length;$i++){
				$arr2[] = explode(':', $arr1[$i]);
			}
			foreach($arr2 as $key=>$value){
				$performanceArr[$key]['xsac01'] = $orderNo;
				$performanceArr[$key]['xsac02'] = $value[0];
				$performanceArr[$key]['xsac04'] = $value[1];
				$performanceArr[$key]['xsac05'] = $performanceArr[$key]['xsac04'] * $orderInfo['xsaa19'];
			}
			xsacDAO::getInstance()->delete(array('xsac01' => $orderNo));
			//多人分业绩遍历插入到订单分业绩表
			foreach($performanceArr as $val){
				$performanceRes = xsacDAO::getInstance()->insert($val,true);
			}
		}
		if(empty($performanceRes)){
			return array('res'=>'error','msg'=>'订单分业绩失败,请重新操作');
		}

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '保存成功');
	}

	/**
	 * @desc 把订单设为作废
	 * @param string $orderNo 订单编号
	 * @param string $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function setOrderUseless($orderNo,$orderInfo){
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderNo),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '该订单设为作废操作有误');
		}
		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '该订单设为作废成功');
	}

	/**
	 * @desc 删除订单
	 * @param string $orderNo 订单编号
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function deleteOrderData($orderNo){
		$deleteResult = xsaaDAO::getInstance()->delete(array('xsaa02'=>$orderNo));
		xsabDAO::getInstance()->delete(array('xsab01'=>$orderNo));
		xsacDAO::getInstance()->delete(array('xsac01'=>$orderNo));
		xsadDAO::getInstance()->delete(array('xsad01'=>$orderNo));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}

	/**
	 * @desc 系统设置->数据清理->删除订单
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function DelCustomerOrder($searchType,$xdsjq,$xdsjz,$zfdd,$wqrdd){
		//查询要删除的订单id
		$result = xsaaDAO::getInstance()->getOrderToBeDel($searchType,$xdsjq,$xdsjz,$zfdd,$wqrdd);
		if (empty($result)){
			return array('res' => 'error','msg' => '没有查询到符合条件的订单');
		}
		if (!empty($result)){
			$ddidArr = array();
		    foreach($result as $value){
			    $ddidArr[] = $value['xsaa02'];
		    }
		    $orderNum = count($ddidArr);
			for($i = 0;$i < $orderNum;$i++){
			    $deleteResult = xsaaDAO::getInstance()->delete(array('xsaa02'=>$ddidArr[$i]));
			    xsabDAO::getInstance()->delete(array('xsab01'=>$ddidArr[$i]));
		        xsacDAO::getInstance()->delete(array('xsac01'=>$ddidArr[$i]));
		        xsadDAO::getInstance()->delete(array('xsad01'=>$ddidArr[$i]));
			}
			return array('res' => 'success','msg' => '删除成功');
		}
		/*if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}*/
		
	}

	/**
	 * @desc 判断该客户3天内有没重复下单
	 * @param string $clientNo 客户编号
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-03
	 */
	public function checkClientOrder($clientNo){
		$result = array();
		$paramArr = array('xsaa04' => $clientNo);
		$fieldArr = array('xsaa23','xsaa02','xsaa19','xsaa29','xsaa48','xsaa01');
		$orderResult = xsaaDAO::getInstance()->isExists($paramArr);
		if($orderResult){
			$orderData = xsaaDAO::getInstance()->findAllByAttributes($paramArr,$fieldArr);
			if(!empty($orderData)){
				$nowtime = time();  //当前时间戳
				foreach($orderData as $value){
					$createtime = strtotime($value['xsaa23']); //订单创建时间戳
					$threeDayLater = $createtime + 24*60*60*3;  //订单创建3天后的时间戳
					if($nowtime >= $createtime && $nowtime <= $threeDayLater){
						$result[] = $value;
					}
				}
				return $result;
			}
		}
	}

	/**
	 * @desc 根据不同的订单状态获取订单列表
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $orderStatus 订单状态
	 * @param string $sequence 顺序或倒序(ASC/DESC)
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	public function getOrderList($page,$psize,$sequence,$order,$orderStatus){
		$result = array();  //获取列表数据的结果
		$orderList = xsaaDAO::getInstance()->getOrderList($page,$psize,$sequence,$order,$orderStatus);
		//判断是否查询到有数据
		if(!empty($orderList['info']) && is_array($orderList['info'])){
			$result['result'] = 'success';
			$result['list'] = $orderList['info'];
			$result['count'] = $orderList['count'];
			//顺序、倒序需要返回页码和条数
			$result['page'] = $page;
			$result['psize'] = $psize;
			//未确认、已支付的订单状态做标识处理
			if($orderStatus == ddglConst::$OrderStatus[3] || $orderStatus == ddglConst::$OrderStatus[6]){
				$result['status'] = 1;
			}
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 订单审核列表显示[只显示订单状态为已确认、已支付订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $orderStatus 订单状态
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function getCheckingOrder($page,$psize,$CondList,$sign,$addrInfo){
		$result = [];  //获取列表数据的结果
		$orderStatusArr = array();
		$orderStatusArr['confirmed'] = ddglConst::$OrderStatus[5];
		$orderStatusArr['paid'] = ddglConst::$OrderStatus[6];
		$orderStatusArr['checked'] = ddglConst::$ApprovalStatus[1]; //已确认到审单(已确认)
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['khsf']),array('pname'));
		$addrInfo['khsf']=$province['pname'];
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['city']),array('cname'));
		$addrInfo['city']=$city['cname'];
		$orderList = xsaaDAO::getInstance()->getCheckingOrder($page,$psize,$orderStatusArr,$CondList,$addrInfo);

		if($sign == 1){
			//导出订单审核excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[4]); //导出订单审核excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getCheckingOrder($page,$psize,$orderStatusArr,$CondList,$addrInfo,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '订单审核';
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
	 * @desc 单个/批量提审订单【客审】
	 * @param string $orderno 订单编号
	 * @param string $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function deliverOrders($orderno,$orderInfo){
		if(empty($orderno) || empty($orderInfo)){
			return array('res' => 'error','msg' => '操作有误,请重新提审');
		}
		$orderNum = count($orderno); //提审订单数
		//核实订单金额与商品总价是否相等
		for($b = 0;$b < $orderNum;$b++){
			$result = xsaaDAO::getInstance()->verifyOrderMoney($orderno[$b]);
			if($result['xsaa19'] != $result['xsab08']){
				return array('res' => 'error','msg' => '订单'.$orderno[$b].'的订单总价与商品总价不相等,请重新核实');
			}
		}

		//货到付款订单且已收定金为0时，才会由已确认状态变为待发货状态 [已收定金不为0，都要经过财审]
		for($a = 0;$a < $orderNum;$a++){
			$res = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderno[$a]),array('xsaa13','xsaa29','xsaa20'));
			if($res['xsaa13'] == ddglConst::$PayWay[4] && $res['xsaa29'] == ddglConst::$OrderStatus[5] && $res['xsaa20'] == 0){
				$orderInfo['xsaa29'] = ddglConst::$OrderStatus[7]; //待发货状态
			}
			//根据订单号找到客户id和订单总价(一条记录)
            $Customerid = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderno[$a]),array('xsaa04','xsaa19'));
            //根据订单号获取产品名称(多条记录)
            $getProductName=xsabDAO::getInstance()->findAllByAttributes(array('xsab01'=>$orderno[$a]),array('xsab02'));

            //根据客户id查询当前用户历史消费金额和购买次数
            $ddresult = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$Customerid['xsaa04']),array('khaa28','khaa35','khaa34'));

            //用‘,’拼接购买产品名称
            $topicid='';
            foreach($getProductName as $val){
                $topicid.=$val['xsab02'].',';
            }
            $ProName='';
            $ProName=$ddresult['khaa34'];
            $ProMosaic=$ProName.$topicid;

			 //购买次数
		    $PurchaseNumber=1;
		    if ($ddresult['khaa35']==0) {
		    	//更新消费总金额
		        $Consump=khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa28'=>$Customerid['xsaa19']));
		        //更新购买次数
		        $PurNumber=khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa35'=>$PurchaseNumber));
		        //购买产品
		        $BuyProduct = khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa34'=>$topicid));
		    }
		    if($ddresult['khaa35']>0) {
		    	//历史订单金额+当前订单金额
		        $TotalAmount=$ddresult['khaa28']+$Customerid['xsaa19'];
		        //历史购买次数+当前购买次数
		        //更新消费总金额
		        $ConsumpInfo=khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa28'=>$ddresult['khaa28']+$Customerid['xsaa19']));
		        //更新购买次数
		        $PurNumberResult=khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa35'=>$ddresult['khaa35']+$PurchaseNumber));
		        //购买产品
		        $BuyProduct = khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa34'=>$ProMosaic));
		    }
        }

		for($i = 0;$i < $orderNum;$i++){
			$deliverResult = xsaaDAO::getInstance()->update(array('xsaa02' => $orderno[$i]),$orderInfo);
		}
		if(empty($deliverResult)){
			return array('res' => 'error','msg' => '提审失败');
		}

		//插入订单跟进记录
		$followInfo = array();
		for($i = 0;$i < $orderNum;$i++){
			$followInfo['xsad01'] = $orderno[$i];
			$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
			$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
			$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
			$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
			$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
			$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
			$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		}
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '提审成功');
	}
	
	/**
	 * @desc 单个/批量确认到审单
	 * @param string $orderno 订单编号
	 * @param string $orderInfo 订单状态
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function confirmToDeliverOrders($orderno,$orderInfo){
		if(empty($orderno) || empty($orderInfo)){
			return array('res' => 'error','msg' => '操作有误,请重新确认');
		}
		$orderNum = count($orderno); //确认审单数
		//货到付款订单才会由未确认状态变为已确认状态
		for($a = 0;$a < $orderNum;$a++){
			$res = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderno[$a]),array('xsaa13','xsaa29'));
			if($res['xsaa13'] == ddglConst::$PayWay[4] && $res['xsaa29'] == ddglConst::$OrderStatus[3]){
				$orderInfo['xsaa29'] = ddglConst::$OrderStatus[5]; //已确认状态
			}
		}
		//核实订单金额与商品总价是否相等
		for($i = 0;$i < $orderNum;$i++){
			$result = xsaaDAO::getInstance()->verifyOrderMoney($orderno[$i]);
			if($result['xsaa19'] != $result['xsab08']){
				return array('res' => 'error','msg' => '订单'.$orderno[$i].'的订单金额与商品总价不相等,请重新核实');
			}
		}
		for($b = 0;$b < $orderNum;$b++){
			$deliverResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno[$b]),$orderInfo);
		}
		if(empty($deliverResult)){
			return array('res' => 'error','msg' => '确认审单失败');
		}

		//插入订单跟进记录
		$followInfo = array();
		for($i = 0;$i < $orderNum;$i++){
			$followInfo['xsad01'] = $orderno[$i];
			$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
			$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
			$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
			$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
			$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
			$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
			$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		}
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '确认审单成功');
	}

	/**
	 * @desc 获取订单审核详情
	 * @param string $orderNo 订单编号
	 * @return array $orderDetails 订单信息
	 * @author WuJunhua
	 * @date 2015-11-06
	 */
	public function getOrderCheckDetails($ordernum,$symbol){
		$orderStatusArr = array();
		$orderStatusArr['confirmed'] = ddglConst::$OrderStatus[5];
		$orderStatusArr['paid'] = ddglConst::$OrderStatus[6];
		$orderDetails = xsaaDAO::getInstance()->findCheckingOrderDetail($ordernum,$symbol,$orderStatusArr);
		$maxOrder = xsaaDAO::getInstance()->findMaxCheckingOrder($orderStatusArr);	//订单审核序号最大的订单
		$minOrder = xsaaDAO::getInstance()->findMinCheckingOrder($orderStatusArr); //订单审核序号最小的订单
		if(empty($orderDetails)){
			return array('res' => 'error','msg' => '获取订单审核详情失败');
		}
		if($orderDetails['xsaa01'] == $maxOrder['xsaa01']){
			$orderDetails['maxorder'] = $orderDetails['xsaa01'];
		}
		if($orderDetails['xsaa01'] == $minOrder['xsaa01']){
			$orderDetails['minorder'] = $orderDetails['xsaa01'];
		}
		if(!empty($orderDetails['xsaa09'])){
			$addrStr = $orderDetails['xsaa09'];
			$addrArr = explode(',', $addrStr);
		}
		if(!empty($orderDetails['xsaa10'])){
			$orderDetails['postcode'] = $orderDetails['xsaa10'];
		}
		if(!empty($addrArr)){
			$orderDetails['province'] = $addrArr[0];
			$orderDetails['city'] = $addrArr[1];
			$orderDetails['area'] = $addrArr[2];
			$orderDetails['addrdetail'] = $addrArr[3];
		}
		//获取省市区唯一id
		$province = approvinceDAO::getInstance()->findByAttributes(array('pname'=>$orderDetails['province']),array('pid'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cname'=>$orderDetails['city']),array('cid'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aname'=>$orderDetails['area']),array('aid'));
		$orderDetails['provinceid'] = $province['pid'];
		$orderDetails['cityid'] = $city['cid'];
		$orderDetails['areaid'] = $area['aid'];
		return $orderDetails;
	}

	/**
	 * @desc 修改订单收货人信息[客审/财审审核详情]
	 * @param string $orderNo 订单编号
	 * @param array $orderInfo 订单信息
	 * @param array $addrInfo 地址信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-09
	 */
	public function saveOrderMsg($orderNo,$orderInfo,$addrInfo){
		if(empty($orderInfo) || empty($addrInfo)){
			return array('res'=>'error','msg'=>'保存失败');
		}
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['provinceid']),array('pname'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['cityid']),array('cname'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aid'=>$addrInfo['areaid']),array('aname'));
		//拼接联系地址
		$orderInfo['xsaa09'] = $province['pname'].','.$city['cname'].','.$area['aname'].','.$addrInfo['deaddress']; 
		
		//释放无用变量
		unset($addrInfo['provinceid']);
		unset($addrInfo['cityid']);
		unset($addrInfo['areaid']);
		unset($addrInfo['deaddress']);
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderNo),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '保存失败');
		}

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res'=>'success','msg'=>'保存成功');
	}

	/**
	 * @desc 修改订单类型[客审/财审的审核详情]
	 * @param string $orderNo 订单编号
	 * @param array $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2016-03-21
	 */
	public function changeOrderType($orderNo,$orderInfo){
		if(empty($orderInfo)){
			return array('res'=>'error','msg'=>'保存失败');
		}
		$orderTypeArr = xsaaDAO::getInstance()->findByAttributes(array('xsaa02' => $orderNo),array('xsaa11'));
		if($orderTypeArr['xsaa11'] == $orderInfo['xsaa11']){
			return array('res' => 'error','msg' => '没有作任何改变');
		}
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02' => $orderNo),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '保存失败');
		}

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res'=>'success','msg'=>'保存成功');
	}

	/**
	 * @desc 订单审核详情的撤回修改[已确认状态改为未确认状态]
	 * @param string $orderno 订单编号
	 * @param string $orderInfo 订单状态
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-09
	 * modify huyan 2016-01-07 减去消费金额和购买次数
	 */
	public function orderWithdrawalModify($orderno,$orderInfo){
		if(empty($orderno) || empty($orderInfo)){
			return array('res' => 'error','msg' => '操作有误,请重新操作');
		}
		//货到付款订单才会由已确认状态改为未确认状态
		$res = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderno),array('xsaa13','xsaa29'));
		if($res['xsaa13'] == ddglConst::$PayWay[4] && $res['xsaa29'] == ddglConst::$OrderStatus[5]){
			$orderInfo['xsaa29'] = ddglConst::$OrderStatus[3]; //未确认状态
		}

		$result = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno),$orderInfo);
		if(empty($result)){
			return array('res' => 'error','msg' => '撤回失败');
		}

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderno;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '撤回成功');
	}

	/**
	 * @desc 确认收货
	 * @param string $orderNo 订单编号
	 * @param string $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-09
	 * modify huyan 2016-01-06 跟新客户表最前签收时间
	 */
	public function confirmReceiving($orderno,$orderInfo){
		if(empty($orderno) || empty($orderInfo)){
			return array('res' => 'error','msg' => '操作有误,请重新操作');
		}
		$result = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno),$orderInfo);
		if(empty($result)){
			return array('res' => 'error','msg' => '确认收货失败');
		}

		//根据订单号找到客户id
		$Customerid = xsaaDAO::getInstance()->getCustomerid($orderno);
		//更新客户表最新签收时间
		$TimeReceipt = khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa20'=>$orderInfo['xsaa28'],'khaa38' => '已成交'));

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderno;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '确认收货成功');
	}

	/**
	 * @desc 获取订单(审核)详情的商品信息
	 * @param string $orderNo 订单编号
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function getOrderDetailGoodsMsg($orderNo){
		$orderDetails = xsaaDAO::getInstance()->getOrderDetailGoodsMsg($orderNo);
		//print_r($orderDetails);die;
		if(empty($orderDetails)){
			return array('res'=>'error','msg'=>'获取订单明细失败');
		}
		return $orderDetails;
	}

	/**
	 * @desc 获取物流发货列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 物流发货列表信息
	 * @author WuJunhua
	 * @date 2015-11-17
	 */
	public function getLogisticsDeliveryList($page,$psize,$sequence,$order,$CondList,$sign){
		$result = array();  //获取列表数据的结果
		$orderStatus = ddglConst::$OrderStatus[7];
		$orderList = xsaaDAO::getInstance()->getLogisticsDeliveryList($page,$psize,$sequence,$order,$orderStatus,$CondList);
		
		if($sign == 1){
			//导出待发货订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[5]); //导出待发货订单excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getLogisticsDeliveryList($page,$psize,$sequence,$order,$orderStatus,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '待发货订单';
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
	 * @desc 单个/批量确认发货
	 * @param string $orderno 订单编号
	 * @param string $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-17
	 * @modify WuJunhua 2015-11-26 修复产品出库bug   //产品出库时的库存明细还有点问题  
	 */
	public function confirmShipped($orderno,$orderInfo){
		if(empty($orderno) || empty($orderInfo)){
			return array('res' => 'error','msg' => '操作有误,请重新点击发货按钮');
		}
		$orderNum = count($orderno); //确认发货的订单数
		$goodItemsArr = [];  //单个或多个订单的商品信息
		$goodsBatchArr = []; //商品的批次和数量
		$goodsArr = []; //订单的商品信息
		for($a = 0;$a < $orderNum;$a++){
			$goodItemsArr[] = xsabDAO::getInstance()->findAllByAttributes(array('xsab01'=>$orderno[$a]),array('xsab03','xsab04','xsab01'));
		}
		//订单的商品信息
		foreach($goodItemsArr as $value){
			foreach($value as $v){
				$goodsArr[] = $v;
			}
		}

		//处理产品出库
		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {	
			foreach($goodsArr as $val){
				//初始化数组
				$goodsBatchArr = []; 
				//商品的批次和数量
				$goodsBatchArr[] = cpaeDAO::getInstance()->findAllByAttributes(array('cpae02' => $val['xsab03'],'cpae03'.'>'=>0),array('cpae01','cpae03','cpae02','cpae06','cpae07'));
				foreach($goodsBatchArr as $value){
					foreach($value as $v){
						$spl = &$val['xsab04']+0;
						$kcl = (float)$v['cpae03'];
						$productInfo['cpaf15'] = '1'; //出库为负数
						$productInfo['cpaf07'] = date('Y-m-d H:i:s'); //异动日期(出库日期)
						$productInfo['cpaf09'] = cpglConst::$StockTransactionType[3]; //异动类型
						$productInfo['cpaf16'] = Yii::app()->session['account']; //操作工号

						//先进先出,后进后出【产品出库的原则】
						if($kcl - $spl >= 0){
							//库存表数据变化
							$updateResult = cpaeDAO::getInstance()->update(array('cpae01'=>$v['cpae01'],'cpae02'=>$v['cpae02']),array('cpae03' => $kcl - $spl,'cpae13' => ($kcl - $spl) * $v['cpae07'] ));
							//库存明细表
							$productInfo['cpaf02'] = $v['cpae01']; //批次
							$productInfo['cpaf03'] = $v['cpae02']; //产品编号
							$productInfo['cpaf05'] = $v['cpae06']; //仓位
							$productInfo['cpaf08'] = $spl; //异动数量
							$detailResult = cpafDAO::getInstance()->insert($productInfo);
							//确定订单商品的批次
							$orderItems = xsabDAO::getInstance()->update(array('xsab01'=>$val['xsab01'],'xsab03'=>$val['xsab03']),array('xsab13'=>$v['cpae01']));
							break; //一个批次的库存量足够出库时,出库完就终止循环

						}else{
							//库存表数据变化
							$updateResult = cpaeDAO::getInstance()->update(array('cpae01'=>$v['cpae01'],'cpae02'=>$v['cpae02']),array('cpae03' => $kcl - $kcl,'cpae13' => 0));
							//库存明细表
							$productInfo['cpaf02'] = $v['cpae01']; //批次
							$productInfo['cpaf03'] = $v['cpae02']; //产品编号
							$productInfo['cpaf05'] = $v['cpae06']; //仓位
							$productInfo['cpaf08'] = $spl; //异动数量
							$detailResult = cpafDAO::getInstance()->insert($productInfo);
							$spl -= $kcl; //库存量减完以后 引用传值回下一个循环
							//确定订单商品的批次
							$orderItems = xsabDAO::getInstance()->update(array('xsab01'=>$val['xsab01'],'xsab03'=>$val['xsab03']),array('xsab13'=>$v['cpae01']));
							continue; //一个批次的库存量不够出库时,出库完就跳出当前循环,查找下个批次进行出库

						}

					}
				}

			}
			if(empty($updateResult) || empty($orderItems)){
				return array('res'=>'error','msg'=>'库存不足,发货失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}
		
		//改变订单状态为已发货状态
		for($i = 0;$i < $orderNum;$i++){
			$result = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno[$i]),$orderInfo);

		}
		if(empty($result)){
			return array('res' => 'error','msg' => '发货失败');
		}

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		for($i = 0;$i < $orderNum;$i++){
			$followInfo['xsad01'] = $orderno[$i];
			$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		}
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		
		return array('res' => 'success','msg' => '发货成功');
	}
	

	/**
	 * @desc 拒收订单(标识作用)
	 * @param string $orderNo 订单编号
	 * @param string $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function rejectOrders($orderNo,$orderInfo){
		$goodStatus = ddglConst::$WhetherReturns[2]; //未退换货
		$result = xsabDAO::getInstance()->update(array('xsab01'=>$orderNo),array('xsab20'=>$goodStatus));
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderNo),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '把订单设为拒收失败');
		}
		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '该订单设为拒收成功');
	}
	
	/**
	 * @desc 撤销退货/撤销收货(把拒收状态/交易成功状态改为已发货状态)
	 * @param string $orderNo 订单编号
	 * @param string $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function revocationReturn($orderNo,$orderInfo){
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderNo),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '改为已发货状态失败');
		}
		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = ddglConst::$OrderDynamic[13]; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '改为已发货状态成功');
	}

	/**
	 * @desc 获取订单发货详情
	 * @param string $orderNo 订单编号
	 * @return array $orderDetails 订单信息
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function getDeliverOrderDetails($ordernum,$symbol){
		$orderStatusArr = array();
		$orderStatusArr['shipping'] = ddglConst::$OrderStatus[7];
		//上一单、下一单判定
		if($symbol == '<'){
			$order = 'DESC';
		}
		if($symbol == '>' || $symbol == '='){
			$order = 'ASC';
		}
		$orderDetails = xsaaDAO::getInstance()->findDeliverOrderDetail($ordernum,$symbol,$orderStatusArr,$order);
		$maxOrder = xsaaDAO::getInstance()->findMaxDeliverOrder($orderStatusArr);	//订单发货序号最大的订单
		$minOrder = xsaaDAO::getInstance()->findMinDeliverOrder($orderStatusArr); //订单发货序号最小的订单

		if($orderDetails['xsaa01'] == $maxOrder['xsaa01']){
			$orderDetails['maxorder'] = $orderDetails['xsaa01'];
		}
		if($orderDetails['xsaa01'] == $minOrder['xsaa01']){
			$orderDetails['minorder'] = $orderDetails['xsaa01'];
		}
		if(empty($orderDetails)){
			return array('res' => 'error','msg' => '获取订单发货详情失败');
		}
		if(!empty($orderDetails['xsaa09'])){
			$addrStr = $orderDetails['xsaa09'];
			$addrArr = explode(',', $addrStr);
		}
		if(!empty($orderDetails['xsaa10'])){
			$orderDetails['postcode'] = $orderDetails['xsaa10'];
		}
		if(!empty($addrArr)){
			$orderDetails['province'] = $addrArr[0];
			$orderDetails['city'] = $addrArr[1];
			$orderDetails['area'] = $addrArr[2];
			$orderDetails['addrdetail'] = $addrArr[3];
		}

		//获取省市区唯一id
		$province = approvinceDAO::getInstance()->findByAttributes(array('pname'=>$orderDetails['province']),array('pid'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cname'=>$orderDetails['city']),array('cid'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aname'=>$orderDetails['area']),array('aid'));
		$orderDetails['provinceid'] = $province['pid'];
		$orderDetails['cityid'] = $city['cid'];
		$orderDetails['areaid'] = $area['aid'];
		return $orderDetails;
	}

	/**
	 * @desc 物流发货详情的撤回修改[货到付款的订单:待发货状态改为未确认状态;非货到付款的订单:待发货状态改为已支付状态;]
	 * @param string $orderno 订单编号
	 * @param string $orderInfo 订单状态
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function orderBackToUnConfirm($orderno,$orderInfo,$backReason){
		if(empty($orderno) || empty($orderInfo)){
			return array('res' => 'error','msg' => '操作有误,请重新操作');
		}
		//货到付款订单会由待发货状态改为未确认状态
		$res = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderno),array('xsaa13','xsaa29'));
		if($res['xsaa13'] == ddglConst::$PayWay[4] && $res['xsaa29'] == ddglConst::$OrderStatus[7]){
			$orderInfo['xsaa29'] = ddglConst::$OrderStatus[3]; //未确认状态
		}
		//非货到付款订单才会由待发货状态改为已支付状态
		if($res['xsaa13'] != ddglConst::$PayWay[4] && $res['xsaa29'] == ddglConst::$OrderStatus[7]){
			$orderInfo['xsaa29'] = ddglConst::$OrderStatus[6]; //已支付状态
		}
		//根据订单号找到客户id和订单总价
        $Customerid = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderno),array('xsaa04','xsaa19'));
        //根据客户id查询当前用户历史消费金额和购买次数
        $ddresult = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$Customerid['xsaa04']),array('khaa28','khaa35'));
        //购买次数
		$PurchaseNumber=1;
        if($ddresult['khaa28']>0) {
        	//历史订单金额-当前订单金额
		    $TotalAmount=$ddresult['khaa28']-$Customerid['xsaa19'];
	        //历史购买次数+当前购买次数
	        $PurNumber=$ddresult['khaa35'];
	        $PurNumber=$PurNumber-$PurchaseNumber;
		    //更新消费总金额
	        $ConsumpInfo=khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa28'=>$ddresult['khaa28']-$Customerid['xsaa19']));
	        //更新购买次数
	        $PurNumberResult=khaaDAO::getInstance()->update(array('khaa02'=>$Customerid['xsaa04']),array('khaa35'=>$PurNumber-$PurchaseNumber));
        }
        
		$result = xsaaDAO::getInstance()->update(array('xsaa02' => $orderno),$orderInfo);
		if(empty($result)){
			return array('res' => 'error','msg' => '撤回失败');
		}
		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderno;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40'].ddglConst::$LogisticsCancelReasons[$backReason]; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '撤回成功');
	}

	/**
	 * @desc 添加待办事项
	 * @param array $followInfo 待办事项信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-24
	 */
	public function addToDoThings($clientno,$followInfo){
		if(empty($followInfo)){
			return array('res'=>'error','msg'=>'添加待办事项有误');
		}
		if(!empty($followInfo['xsad02']) && !empty($followInfo['xsad05']) && !empty($followInfo['xsad09'])){
			$clientFollowInfo = array();  //客户跟进记录
			$clientFollowInfo['khae01'] = $clientno;
			$clientFollowInfo['khae02'] = '订单跟进';  
			$clientFollowInfo['khae03'] = '订单ID '.$followInfo['xsad01'].'：'.$followInfo['xsad06'];
			$clientFollowInfo['khae04'] = Yii::app()->session['account'];
			$clientFollowInfo['khae05'] = Yii::app()->session['name'];
			$clientFollowInfo['khae06'] = $followInfo['xsad02'];
			$clientFollowInfo['khae07'] = $followInfo['xsad03'];
			$clientFollowInfo['khae08'] = $followInfo['xsad04'];
			$clientFollowInfo['khae09'] = $followInfo['xsad05'];
			$clientFollowInfo['khae10'] = '未完成';
			$clientFollowInfo['khae11'] = $followInfo['xsad09'];
			//添加客户跟进记录
			$clientFollowResult = khaeDAO::getInstance()->insert($clientFollowInfo,true);
			if(empty($clientFollowResult)){
				return array('res'=>'error','msg'=>'添加客户跟进记录失败');
			}
			$result = xsadDAO::getInstance()->insert($followInfo,true);
		}else{
			$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
			$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
			$result = xsadDAO::getInstance()->insert($followInfo,true);
		}

		unset($followInfo);
		unset($clientFollowInfo);
		if(empty($result)){
			return array('res'=>'error','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 根据订单编号来确认获取已拒收/确定退换货订单
	 * @param string $orderNo 订单编号
	 * @author WuJunhua
	 * @date 2015-11-24
	 */
	public function getRejectedOrder($orderNo,$expressNo){
		if(!empty($orderNo) && empty($expressNo)){
			$orderStatus = xsaaDAO::getInstance()->findByAttributes(array('xsaa02' => $orderNo),array('xsaa49'));
		}
		if(empty($orderNo) && !empty($expressNo)){
			$orderStatus = xsaaDAO::getInstance()->findByAttributes(array('xsaa03' => $expressNo),array('xsaa49'));
		}
		if(!empty($orderNo) && !empty($expressNo)){
			$orderStatus = xsaaDAO::getInstance()->findByAttributes(array('xsaa02' => $orderNo,'xsaa03' => $expressNo),array('xsaa49'));
		}

		if($orderStatus['xsaa49'] == ddglConst::$GoodsReturnsLogo[1] || $orderStatus['xsaa49'] == ddglConst::$GoodsReturnsLogo[2]){
			$selections = array('xsab02','xsab03','xsab04','xsab06','xsab08');
			$goodStatus = ddglConst::$WhetherReturns[2]; //退货未入仓状态
			if(!empty($orderNo) && empty($expressNo)){
				$orderData = xsabDAO::getInstance()->findAllByAttributes(array('xsab01' => $orderNo,'xsab20' => $goodStatus),$selections);
			}
			if(empty($orderNo) && !empty($expressNo)){
				$orderData = xsabDAO::getInstance()->findAllByAttributes(array('xsab21' => $expressNo,'xsab20' => $goodStatus),$selections);
			}
			if(!empty($orderNo) && !empty($expressNo)){
				$orderData = xsabDAO::getInstance()->findAllByAttributes(array('xsab01' => $orderNo,'xsab21' => $expressNo,'xsab20' => $goodStatus),$selections);
			}
			
			if(empty($orderData)){
				return array('res'=>'error','msg'=>'获取订单失败');
			}		
		}else{
			return array('res'=>'error','msg'=>'获取订单失败');
		}
		return $orderData;
	}

	/**
	 * @desc 退货入仓(销退)
	 * @param array $orderNo 订单编号
	 * @param array $goodItems 商品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-25
	 */
	public function returnWarehousing($orderNo,$goodItems){		
		//处理单个或多个商品信息
		$goodItemsArr = array_chunk($goodItems, 3);
		$goodsArr = []; //退货商品信息
		//处理单个或多个产品信息
		if(!empty($goodItemsArr)){
			$goods['xsab20'] = ddglConst::$WhetherReturns[3]; //已退换货(已入仓)
			foreach($goodItemsArr as $val){
				$goods['xsab01'] = $orderNo;
				$goods['xsab03'] = $val[0];
				$goods['xsab06'] = (float)$val[1];
				$goods['xsab14'] = (float)$val[2]; //退货数量
				$goods['xsab15'] = $goods['xsab06'] * $goods['xsab14']; //商品退货总额
				$goods['xsab12'] = cpglConst::$ReturnWarehousingStatus[2]; //退货已入仓状态
				$goods['xsab16'] = '退货入仓'; //备注：退货入仓
				$goods['xsab17'] = date('Y-m-d H:i:s'); //操作时间(退货入仓操作时间)
				//插入商品退货数量和退货总额
				$goodsResult = xsabDAO::getInstance()->update(array('xsab01'=>$goods['xsab01'],'xsab03'=>$goods['xsab03']),array('xsab14'=> $goods['xsab14'],'xsab15'=>$goods['xsab15'],'xsab12'=>$goods['xsab12'],'xsab16'=>$goods['xsab16'],'xsab17'=>$goods['xsab17'],'xsab20'=>$goods['xsab20']));
				$goodsArr[] = $goods;
			}
		}
		if(empty($goodsResult)){
			return array('res'=>'error','msg'=>'退货入仓失败');
		}

		$orderInfo = []; //订单信息
		$orderInfo['xsaa02'] = $orderNo;
		$orderInfo['xsaa22'] = Yii::app()->session['account']; //操作人(退货入仓操作人)
		$orderInfo['xsaa43'] = date('Y-m-d H:i:s'); //入库时间 
		$orderInfo['xsaa44'] = 0; //订单退货金额
		$orderInfo['xsaa45'] = '是'; //是否已退货入仓
		$orderInfo['xsaa46'] = 0; //订单商品退货总数
		foreach($goodsArr as $val){
			$orderInfo['xsaa44'] += $val['xsab15']; 
			$orderInfo['xsaa46'] += $val['xsab14']; 
		}
		//和已入仓的数量或金额相加
		$items = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderInfo['xsaa02']),array('xsaa44','xsaa46'));
		$orderInfo['xsaa44'] += $items['xsaa44'];
		$orderInfo['xsaa46'] += $items['xsaa46'];

		$goodsInfo = [];  
		$goodsInfoArr = [];  //产品明细的批次等信息
		$selections = array('xsab03','xsab04','xsab13');
		foreach($goodsArr as $val){
			$goodsInfo[] = xsabDAO::getInstance()->findAllByAttributes(array('xsab01' => $val['xsab01'],'xsab03'=> $val['xsab03']),$selections);
		}
		foreach($goodsInfo as $value){
			foreach($value as $v){
				$goodsInfoArr[] = $v;
			}
		}
		if(empty($goodsInfoArr)){
			return array('res'=>'error','msg'=>'获取产品明细信息失败');
		}

		$productInfo = []; 
		$productInfoArr = []; //产品库存信息
		foreach($goodsInfo as $value){
			foreach($value as $val){
				$productInfo[] = cpaeDAO::getInstance()->findAllByAttributes(array('cpae01' => $val['xsab13'],'cpae02'=> $val['xsab03']),array('cpae01','cpae02','cpae03','cpae06','cpae07'));
			}
		}
		foreach($productInfo as $value){
			foreach($value as $v){
				$productInfoArr[] = $v;
			}
		}
		if(empty($goodsInfoArr)){
			return array('res'=>'error','msg'=>'获取产品库存信息失败');
		}

		$InventoryDetail = []; //库存明细
		$InventoryDetail['cpaf15'] = '0'; //退货入仓为正数
		$InventoryDetail['cpaf07'] = date('Y-m-d H:i:s'); //异动日期(退货入仓日期)
		$InventoryDetail['cpaf09'] = cpglConst::$StockTransactionType[4]; //异动类型
		$InventoryDetail['cpaf16'] = Yii::app()->session['account']; //操作工号

		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			//订单表插入相关数据
			$orderResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderInfo['xsaa02']),array('xsaa43'=> $orderInfo['xsaa43'],'xsaa44'=>$orderInfo['xsaa44'],'xsaa45'=>$orderInfo['xsaa45'],'xsaa46'=>$orderInfo['xsaa46'],'xsaa22'=>$orderInfo['xsaa22']));
			//处理退货入仓
			foreach($productInfoArr as $k=>$val){
				$spl = (float)$goodsInfoArr[$k]['xsab04']; 
				$kcl = $val['cpae03'];
				$updateResult = cpaeDAO::getInstance()->update(array('cpae01'=>$val['cpae01'],'cpae02'=>$val['cpae02']),array('cpae03'=> $spl+$kcl,'cpae13' => ($spl + $kcl) * $val['cpae07']));
				$InventoryDetail['cpaf02'] = $val['cpae01']; //批次
				$InventoryDetail['cpaf03'] = $val['cpae02']; //产品编号
				$InventoryDetail['cpaf05'] = $val['cpae06']; //仓位
				$InventoryDetail['cpaf08'] = $spl; //异动数量
				//插入库存明细
				$detailResult = cpafDAO::getInstance()->insert($InventoryDetail);
			}	
			if(empty($orderResult) || empty($updateResult) || empty($detailResult)){
				return array('res'=>'error','msg'=>'退货入仓失败');
			}

			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}

		return array('res'=>'success','msg'=>'退货入仓成功');
	}

	/**
	 * @desc 终止退货入仓
	 * @param array $orderNo 订单编号
	 * @param array $goodItems 商品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-11-25
	 */
	public function endWarehousing($orderNo,$goodItems){		
		//处理单个或多个商品信息
		$goodItemsArr = array_chunk($goodItems, 3);
		$goodsArr = []; //退货商品信息
		if(!empty($goodItemsArr)){
			$goods['xsab20'] = ddglConst::$WhetherReturns[4]; //终止退货入仓
			foreach($goodItemsArr as $val){
				$goods['xsab01'] = $orderNo;
				$goods['xsab03'] = $val[0];
				$goods['xsab06'] = (float)$val[1];
				$goods['xsab14'] = (float)$val[2]; //终止退货入仓的数量
				$goods['xsab15'] = $goods['xsab06'] * $goods['xsab14']; //终止退货入仓的退货总额
				$goods['xsab12'] = cpglConst::$ReturnWarehousingStatus[3]; //终止退货入仓
				$goods['xsab16'] = '终止退货入仓'; //备注：
				$goods['xsab17'] = date('Y-m-d H:i:s'); //操作时间(终止退货入仓操作时间)
				$goods['xsab09'] = 'T'; //已作废
				//插入商品退货数量和退货总额
				$goodsResult = xsabDAO::getInstance()->update(array('xsab01'=>$goods['xsab01'],'xsab03'=>$goods['xsab03']),array('xsab14'=> $goods['xsab14'],'xsab15'=>$goods['xsab15'],'xsab12'=>$goods['xsab12'],'xsab16'=>$goods['xsab16'],'xsab17'=>$goods['xsab17'],'xsab20'=>$goods['xsab20'],'xsab09'=>$goods['xsab09']));
				$goodsArr[] = $goods;
			}
		}
		if(empty($goodsResult)){
			return array('res'=>'error','msg'=>'终止退货入仓失败');
		}

		$orderInfo = []; //订单信息
		$orderInfo['xsaa02'] = $orderNo;
		$orderInfo['xsaa22'] = Yii::app()->session['account']; //操作人(终止退货入仓操作人)
		$orderInfo['xsaa43'] = date('Y-m-d H:i:s'); //入库时间 
		$orderInfo['xsaa44'] = 0; //订单退货金额
		$orderInfo['xsaa45'] = '止'; //是否已退货入仓
		$orderInfo['xsaa46'] = 0; //订单商品退货总数
		foreach($goodsArr as $val){
			$orderInfo['xsaa44'] += $val['xsab15']; 
			$orderInfo['xsaa46'] += $val['xsab14']; 
		}
		//和已入仓的数量或金额相加
		$items = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderInfo['xsaa02']),array('xsaa44','xsaa46'));
		$orderInfo['xsaa44'] += $items['xsaa44'];
		$orderInfo['xsaa46'] += $items['xsaa46'];

		$goodsInfo = [];  
		$goodsInfoArr = [];  //产品明细的批次等信息
		$selections = array('xsab03','xsab04','xsab13');
		foreach($goodsArr as $val){
			$goodsInfo[] = xsabDAO::getInstance()->findAllByAttributes(array('xsab01' => $val['xsab01'],'xsab03'=> $val['xsab03']),$selections);
		}
		foreach($goodsInfo as $value){
			foreach($value as $v){
				$goodsInfoArr[] = $v;
			}
		}
		if(empty($goodsInfoArr)){
			return array('res'=>'error','msg'=>'获取产品明细信息失败');
		}

		$productInfo = []; 
		$productInfoArr = []; //产品库存信息
		foreach($goodsInfo as $value){
			foreach($value as $val){
				$productInfo[] = cpaeDAO::getInstance()->findAllByAttributes(array('cpae01' => $val['xsab13'],'cpae02'=> $val['xsab03']),array('cpae01','cpae02','cpae03','cpae06'));
			}
		}
		foreach($productInfo as $value){
			foreach($value as $v){
				$productInfoArr[] = $v;
			}
		}
		if(empty($goodsInfoArr)){
			return array('res'=>'error','msg'=>'获取产品库存信息失败');
		}

		$InventoryDetail = []; //库存明细
		$InventoryDetail['cpaf15'] = '-'; //终止退货入仓
		$InventoryDetail['cpaf07'] = date('Y-m-d H:i:s'); //异动日期(终止退货入仓日期)
		$InventoryDetail['cpaf09'] = cpglConst::$StockTransactionType[9]; //异动类型
		$InventoryDetail['cpaf16'] = Yii::app()->session['account']; //操作工号

		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			//订单表插入相关数据
			$orderResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderInfo['xsaa02']),array('xsaa43'=> $orderInfo['xsaa43'],'xsaa44'=>$orderInfo['xsaa44'],'xsaa45'=>$orderInfo['xsaa45'],'xsaa46'=>$orderInfo['xsaa46'],'xsaa22'=>$orderInfo['xsaa22']));
			//处理退货入仓
			foreach($productInfoArr as $k=>$val){
				$spl = (float)$goodsInfoArr[$k]['xsab04']; 
				//$kcl = (float)$val['cpae03'];
				//$updateResult = cpaeDAO::getInstance()->update(array('cpae01'=>$val['cpae01'],'cpae02'=>$val['cpae02']),array('cpae03'=> $spl+$kcl));
				$InventoryDetail['cpaf02'] = $val['cpae01']; //批次
				$InventoryDetail['cpaf03'] = $val['cpae02']; //产品编号
				$InventoryDetail['cpaf05'] = $val['cpae06']; //仓位
				$InventoryDetail['cpaf08'] = $spl; //异动数量
				//插入库存明细
				$detailResult = cpafDAO::getInstance()->insert($InventoryDetail);
			}	

			if(empty($orderResult) || empty($detailResult)){
				return array('res'=>'error','msg'=>'终止退货入仓失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}

		return array('res'=>'success','msg'=>'终止退货入仓成功');
	}

	/**
	 * @desc 获取退货订单记录列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $sequence 顺序/倒序
	 * @param string $order 按照什么排序
	 * @return array $result 退货订单记录列表信息
	 * @author WuJunhua
	 * @date 2015-11-25
	 */
	public function getReturnOrderRecordList($page,$psize,$sequence,$order,$CondList,$sign){
		$result = array();  //获取列表数据的结果
		$orderStatus = [];
		$orderStatus['ddzt'] = ddglConst::$OrderStatus[9];
		$orderStatus['jycg'] = ddglConst::$OrderStatus[2];
		$orderStatus['thrkzt'] = '是';
		$orderList = xsaaDAO::getInstance()->getReturnOrderRecordList($page,$psize,$orderStatus,$sequence,$order,$CondList);

		if($sign == 1){
			//导出退货订单记录excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[7]); //导出退货订单记录excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getReturnOrderRecordList($page,$psize,$orderStatus,$sequence,$order,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '退货订单记录';
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
	 * @desc 获取部分退换货订单详情
	 * @param string $orderNo 订单编号
	 * @return array $orderDetails 订单信息
	 * @author WuJunhua
	 * @date 2015-12-03
	 */
	public function OrderSectionReturns($orderNo){
		if(empty($orderNo)){
			return array('res' => 'error','msg' => '获取部分退换货订单详情失败');
		}
		$orderDetails = xsaaDAO::getInstance()->OrderSectionReturns($orderNo);
		if(empty($orderDetails)){
			return array('res' => 'error','msg' => '获取订单详情失败');
		}
		return $orderDetails;
	}

	/**
	 * @desc 确定退货/确定换货(标识作用)
	 * @param string $orderNo 订单编号
	 * @param string $orderInfo 订单信息
	 * @param string $goodItems 商品信息
	 * @param string $returnReason 退换货原因
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-04
	 */
	public function OrderConfirmReturn($orderNo,$orderInfo,$goodItems,$returnReason){
		$res = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderNo),array('xsaa49'));
		if($res['xsaa49'] == ddglConst::$GoodsReturnsLogo[1] || $res['xsaa49'] == ddglConst::$GoodsReturnsLogo[2]){
			return array('res' => 'error','msg' => '提交操作过，不能重复操作');
		}
		//退款且退换货
		if(!empty($goodItems)){
			$goods['xsab20'] = ddglConst::$WhetherReturns[2]; //未退换货
			//处理单个或多个商品信息
			$goodsName = '';
			$goodItemsArr = array_chunk($goodItems, 5);
			if(!empty($goodItemsArr)){
				foreach($goodItemsArr as $val){
					$goods['xsab01'] = $orderNo;
					$goods['xsab03'] = $val[0];
					$goodsName = $goodsName.$val[1].',';
					$goodsArr[] = $goods;
				}
			}
			$newGoodsName = substr($goodsName,0,strlen($goodsName)-1);

			//确定退货的跟进记录
			if($orderInfo['xsaa49'] == ddglConst::$GoodsReturnsLogo[1]){
				$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[17].$newGoodsName.'。退货金额：'.$orderInfo['xsaa44'].'元。原因：'.$returnReason;
			}
			//确定换货的跟进记录
			if($orderInfo['xsaa49'] == ddglConst::$GoodsReturnsLogo[2]){
				$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[18].$newGoodsName.'。换货金额：'.$orderInfo['xsaa44'].'元。原因：'.$returnReason;
			}
			//遍历把商品信息更新到订单明细表
			foreach($goodsArr as $val){
				$result = xsabDAO::getInstance()->update(array('xsab01'=>$val['xsab01'],'xsab03'=>$val['xsab03']),array('xsab20'=>$val['xsab20']));
			}
		}

		//退款不退货
		if(empty($goodItems) && $orderInfo['xsaa49'] == ddglConst::$GoodsReturnsLogo[1]){
			$orderInfo['xsaa40'] = '退款，退换金额：'.$orderInfo['xsaa44'].'元。原因：'.$returnReason;
		}
		//退款不换货
		if(empty($goodItems) && $orderInfo['xsaa49'] == ddglConst::$GoodsReturnsLogo[2]){
			$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[18].'。换货金额：'.$orderInfo['xsaa44'].'元。原因：'.$returnReason;
		}

		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderNo),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '操作失败');
		}

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '操作成功');
	}

	/**
	 * @desc 订单详情页面分业绩操作
	 * @param string $orderNo 订单编号
	 * @param string $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function orderTurnPerformance($orderNo,$orderInfo){
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderNo),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '该订单分业绩操作有误');
		}

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '该订单分业绩成功');
	}

	/**
	 * @desc 订单财务审核列表显示[默认显示订单状态已支付且已客审和已确认且已客审且已收定金不为0的订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $CondList 查询条件
	 * @param int $sign 导出excel标识
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-12-08
	 * @modify huyan  2015-12-11 修改查询条件
	 */
	public function getFinanceCheckingOrder($page,$psize,$sequence,$order,$CondList,$sign){
		$result = array();  //获取列表数据的结果
		$orderStatusArr = array();
		$orderStatusArr['confirmed'] = ddglConst::$OrderStatus[5];
		$orderStatusArr['paid'] = ddglConst::$OrderStatus[6];
		$orderStatusArr['trading_success'] = ddglConst::$OrderStatus[2];
		$orderStatusArr['shipping'] = ddglConst::$OrderStatus[7];
		$orderStatusArr['shipped'] = ddglConst::$OrderStatus[8];
		$orderStatusArr['rejected'] = ddglConst::$OrderStatus[9];
		$orderStatusArr['checked'] = ddglConst::$ApprovalStatus[2]; //已客审
		$orderStatusArr['finchecked'] = ddglConst::$ApprovalStatus[3]; //已财审

		$orderList = xsaaDAO::getInstance()->getFinanceCheckingOrder($page,$psize,$sequence,$order,$orderStatusArr,$CondList);

		if($sign == 1){
			//导出财务审核excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[4]); //导出财务审核excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getFinanceCheckingOrder($page,$psize,$sequence,$order,$orderStatusArr,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '财务审核';
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
	 * @desc 单个/批量提审订单【财审】
	 * @param string $orderno 订单编号
	 * @param string $orderInfo 订单信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-08
	 * @modify 2016-03-07 WuJunhua 添加结算明细和收款明细操作
	 */
	public function financeDeliverOrders($orderno,$orderInfo){
		if(empty($orderno) || empty($orderInfo)){
			return array('res' => 'error','msg' => '操作有误,请重新提审');
		}
		$billingInfo = []; //结算明细信息
		$receivablesInfo = []; //收款明细信息
		$selections = array('xsaa04','xsaa13','xsaa16','xsaa19','xsaa48');
		$billingInfo['cwaa09'] = cwglConst::$FinancialOrderCategory[1]; //出货订单
		$receivablesInfo['cwab07'] = $billingInfo['cwaa10'] = date('Y-m-d H:i:s');
		$receivablesInfo['cwab03'] = $receivablesInfo['cwab09'] = $billingInfo['cwaa11'] = Yii::app()->session['account']; //操作人工号
		$receivablesInfo['cwab10'] = $billingInfo['cwaa12'] = Yii::app()->session['name']; //操作人姓名
		$receivablesInfo['cwab06'] = cwglConst::$FinancialOperationType[7]; //收客户金额
		$receivablesInfo['cwab08'] = '有效'; //收款是否有效
		$orderNum = count($orderno); //提审订单数
		//核实订单金额与商品总价是否相等
		for($b = 0;$b < $orderNum;$b++){
			$result = xsaaDAO::getInstance()->verifyOrderMoney($orderno[$b]);
			if($result['xsaa19'] != $result['xsab08']){
				return array('res' => 'error','msg' => '订单'.$orderno[$b].'的订单总价与商品总价不相等,请重新核实');
			}
		}

		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			for($i = 0;$i < $orderNum;$i++){
				//生成结算单号
				$orderList = cwaaDAO::getInstance()->getMaxBillingNumber();
				if(!empty($orderList)){
					$date = substr($orderList['cwaa01'],2,4);
					if($date == date('ym')){
						$id = substr($orderList['cwaa01'],-4,4);
						$id += 1;
						$orderId = sprintf("%04d",$id);
						$billingNo = 'JS'.date('ym').$orderId;
					}else{
						$id = '1';
						$orderId = sprintf("%04d",$id);
						$billingNo = 'JS'.date('ym').$orderId;
					}
				}else{
					$id = '1';
					$orderId = sprintf("%04d",$id);
					$billingNo = 'JS'.date('ym').$orderId;
				}

				$billingInfo['cwaa01'] = $receivablesInfo['cwab02'] = $billingNo;
				$billingInfo['cwaa02'] = $orderno[$i];
				$orderItems = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderno[$i]),$selections);
				$billingInfo['cwaa03'] = $orderItems['xsaa04'];
				$billingInfo['cwaa04'] = $orderItems['xsaa13'];
				$receivablesInfo['cwab05'] = $billingInfo['cwaa05'] = $orderItems['xsaa19'];
				$billingInfo['cwaa06'] = $orderItems['xsaa16'];
				$billingInfo['cwaa08'] = $orderItems['xsaa48'];
				$deliverResult = xsaaDAO::getInstance()->update(array('xsaa02' => $orderno[$i]),$orderInfo);
				$insertResult = cwaaDAO::getInstance()->insert($billingInfo,true);
				$receiveResult = cwabDAO::getInstance()->insert($receivablesInfo);

			}
			if(empty($deliverResult) || empty($insertResult) || empty($receiveResult)){
				return array('res' => 'error','msg' => '提审失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}	

		//插入订单跟进记录
		$followInfo = [];
		for($i = 0;$i < $orderNum;$i++){
			$followInfo['xsad01'] = $orderno[$i];
			$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
			$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
			$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
			$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
			$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
			$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
			$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		}
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '提审成功');
	}

	/**
	 * @desc 获取订单财务审核详情
	 * @param string $ordernum 订单序号
	 * @return string $symbol 上一单、下一单标识
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function getOrderFinanceCheckDetails($ordernum,$symbol){
		$orderStatusArr = array();
		$orderStatusArr['confirmed'] = ddglConst::$OrderStatus[5];
		$orderStatusArr['paid'] = ddglConst::$OrderStatus[6];
		$orderStatusArr['shipping'] = ddglConst::$OrderStatus[7];
		$orderStatusArr['shipped'] = ddglConst::$OrderStatus[8];
		$orderStatusArr['trading_success'] = ddglConst::$OrderStatus[2];
		$orderStatusArr['rejected'] = ddglConst::$OrderStatus[9];
		$orderStatusArr['checked'] = ddglConst::$ApprovalStatus[2]; //已客审
		$orderStatusArr['fiscalChecked'] = ddglConst::$ApprovalStatus[3]; //已财审
		$orderStatusArr['shipping'] = ddglConst::$OrderStatus[7];

		$orderDetails = xsaaDAO::getInstance()->findFinanceCheckingOrderDetail($ordernum,$symbol,$orderStatusArr);
		$maxOrder = xsaaDAO::getInstance()->findMaxFinanceCheckingOrder($orderStatusArr);	//订单财务审核序号最大的订单
		$minOrder = xsaaDAO::getInstance()->findMinFinanceCheckingOrder($orderStatusArr); //订单财务审核序号最小的订单
		if(empty($orderDetails)){
			return array('res' => 'error','msg' => '获取订单财务审核详情失败');
		}
		if($orderDetails['xsaa01'] == $maxOrder['xsaa01']){
			$orderDetails['maxorder'] = $orderDetails['xsaa01'];
		}
		if($orderDetails['xsaa01'] == $minOrder['xsaa01']){
			$orderDetails['minorder'] = $orderDetails['xsaa01'];
		}

		if(!empty($orderDetails['xsaa09'])){
			$addrStr = $orderDetails['xsaa09'];
			$addrArr = explode(',', $addrStr);
		}
		if(!empty($orderDetails['xsaa10'])){
			$orderDetails['postcode'] = $orderDetails['xsaa10'];
		}
		if(!empty($addrArr)){
			$orderDetails['province'] = $addrArr[0];
			$orderDetails['city'] = $addrArr[1];
			$orderDetails['area'] = $addrArr[2];
			$orderDetails['addrdetail'] = $addrArr[3];
		}
		//获取省市区唯一id
		$province = approvinceDAO::getInstance()->findByAttributes(array('pname'=>$orderDetails['province']),array('pid'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cname'=>$orderDetails['city']),array('cid'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aname'=>$orderDetails['area']),array('aid'));
		$orderDetails['provinceid'] = $province['pid'];
		$orderDetails['cityid'] = $city['cid'];
		$orderDetails['areaid'] = $area['aid'];
		return $orderDetails;
	}

	/**
	 * @desc 财务审核详情的撤回修改[货到付款的订单:已确认状态改为未确认状态;非货到付款的订单:已支付状态改为等待支付状态]
	 * @param string $orderno 订单编号
	 * @param string $orderInfo 订单状态
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-08
	 * @modify 2016-03-07 WuJunhua 删除已财审的结算明细和收款明细记录
	 */
	public function financeOrderBackToUnConfirm($orderno,$orderInfo){
		if(empty($orderno) || empty($orderInfo)){
			return array('res' => 'error','msg' => '操作有误,请重新操作');
		}
		//货到付款的订单:已确认状态改为未确认状态;非货到付款的订单:已支付状态改为等待支付状态
		$res = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderno),array('xsaa13','xsaa29'));
		if($res['xsaa13'] == ddglConst::$PayWay[4] && $res['xsaa29'] == ddglConst::$OrderStatus[5]){
			$orderInfo['xsaa29'] = ddglConst::$OrderStatus[3]; //未确认状态
		}else{
			$orderInfo['xsaa29'] = ddglConst::$OrderStatus[4]; //等待支付状态
		}

		$billingArr = cwaaDAO::getInstance()->findByAttributes(array('cwaa02' => $orderno),'cwaa01');
		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			$result = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno),$orderInfo);
			if(!empty($billingArr)){
				$deleteBillingResult = cwaaDAO::getInstance()->delete(array('cwaa01' => $billingArr['cwaa01']));
				$deleteReciveResult = cwabDAO::getInstance()->delete(array('cwab02' => $billingArr['cwaa01']));
			}
			if(empty($result)){
				return array('res' => 'error','msg' => '撤回失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}

		//插入订单跟进记录
		$followInfo = array();
		$followInfo['xsad01'] = $orderno;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = $orderInfo['xsaa40']; //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
		return array('res' => 'success','msg' => '撤回成功');
	}

	/**
	 * @desc 出货订单列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function getShipmentOrderList($page,$psize,$sign,$CondList){
		$result = array();  //获取列表数据的结果
		$orderStatusArr = array();
		$orderStatusArr['tradingSuccess'] = ddglConst::$OrderStatus[2]; //交易成功
		$orderStatusArr['shipped'] = ddglConst::$OrderStatus[8]; //已发货
		$orderStatusArr['rejected'] = ddglConst::$OrderStatus[9]; //拒收
		$orderList = xsaaDAO::getInstance()->getShipmentOrderList($page,$psize,$orderStatusArr,$CondList);

		if($sign == 1){
			//导出出货订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[13]); //导出出货订单excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getShipmentOrderList($page,$psize,$orderStatusArr,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '出货订单';
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
	 * @desc 记账或撤销记账[标识]
	 * @param string $orderno 订单编号
	 * @param string $sign 记账或撤销记账的标识
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-09
	 * @modify 2016-03-08 WuJunhua 添加收款明细信息
	 */
	public function orderAccounting($orderno,$sign){
		$orderItems = []; //订单信息
		$financeInfo = []; //财务明细信息
		$orderNum = count($orderno); //订单数
		for($i = 0;$i < $orderNum;$i++){
			$orderItems[] = xsaaDAO::getInstance()->getBilingInfo($orderno[$i]);
		}
		if(empty($orderItems[0])){
			return array('res' => 'error','msg' => '该订单是货到付款的订单,且没有收到任何金额,不能进行该操作！');
		}
		foreach($orderItems as $key => $value){
			$financeInfo[$key]['cwab02'] = $value['cwaa01'];
			$financeInfo[$key]['cwab03'] = $financeInfo[$key]['cwab09'] = Yii::app()->session['account']; //操作人工号
			$financeInfo[$key]['cwab07'] = date('Y-m-d H:i:s');
			$financeInfo[$key]['cwab10'] = Yii::app()->session['name']; //操作人姓名
			//记1、记2、撤1、撤2操作
			switch ($sign) {
				case 1:
					$orderInfo['xsaa54'] = '是'; //已记账1
					$orderInfo['xsaa52'] = date('Y-m-d H:i:s'); //记账1时间
					$financeInfo[$key]['cwab08'] = '有效'; //是否有效
					$financeInfo[$key]['cwab05'] = $value['xsaa57'];
					$financeInfo[$key]['cwab06'] = cwglConst::$FinancialOperationType[1]; //操作类型：记1
					break;
				case 2:
					$orderInfo['xsaa55'] = '是'; //已记账2
					$orderInfo['xsaa53'] = date('Y-m-d H:i:s'); //记账2时间
					$financeInfo[$key]['cwab08'] = '有效'; //是否有效
					$financeInfo[$key]['cwab05'] = $value['xsaa58'] + $value['xsaa59'];
					$financeInfo[$key]['cwab06'] = cwglConst::$FinancialOperationType[2]; //操作类型：记2
					break;
				case 3:
					$orderInfo['xsaa54'] = '否'; //撤销记账1
					$financeInfo[$key]['cwab08'] = '无效'; //是否有效
					$financeInfo[$key]['cwab05'] = $value['xsaa57'];
					$financeInfo[$key]['cwab06'] = cwglConst::$FinancialOperationType[3]; //操作类型：撤1
					break;
				case 4:
					$orderInfo['xsaa55'] = '否'; //撤销记账2
					$financeInfo[$key]['cwab08'] = '无效'; //是否有效
					$financeInfo[$key]['cwab05'] = $value['xsaa58'] + $value['xsaa59'];
					$financeInfo[$key]['cwab06'] = cwglConst::$FinancialOperationType[4]; //操作类型：撤2
					break;
				default:
					return array('res' => 'error','msg' => '操作有误');
					break;
			}
		}
		
		for($i = 0;$i < $orderNum;$i++){
			$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno[$i]),$orderInfo);
		}
		for($a = 0;$a < $orderNum;$a++){
			$insertResult = cwabDAO::getInstance()->insert($financeInfo[$a],true);
		}
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '操作失败,请重新操作');
		}
		return array('res' => 'success','msg' => '操作成功');
	}

	/**
	 * @desc 修改快递费、服务费
	 * @param string $orderno 订单编号
	 * @param string $orderInfo 快递费、服务费
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-09
	 */
	public function orderCourierFees($orderno,$orderInfo){
		$judge = xsaaDAO::getInstance()->findByAttributes(array('xsaa02' => $orderno),array('xsaa57','xsaa58'));
		if($judge['xsaa57'] == $orderInfo['xsaa57'] && $judge['xsaa58'] == $orderInfo['xsaa58']){
			return array('res' => 'error','msg' => '没有作任何改变,请重新操作');
		}
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02' => $orderno),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '保存失败');
		}
		return array('res' => 'success','msg' => '保存成功');
	}

	/**
	 * @desc 退换货订单汇总列表显示[只显示订单状态交易成功或拒收且退货换标识不为空]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function getReturnOrderList($page,$psize,$sequence,$order,$CondList,$sign){
		$result = [];  //获取列表数据的结果
		$orderStatusArr = [];
		$orderStatusArr['tradingSuccess'] = ddglConst::$OrderStatus[2]; //交易成功
		$orderStatusArr['rejected'] = ddglConst::$OrderStatus[9]; //拒收
		$orderStatusArr['return'] = ddglConst::$GoodsReturnsLogo[1]; //退货标识
		$orderStatusArr['exchanges'] = ddglConst::$GoodsReturnsLogo[2]; //换货标识
		$orderList = xsaaDAO::getInstance()->getReturnOrderList($page,$psize,$sequence,$order,$CondList,$orderStatusArr);

		if($sign == 1){
			//导出退换货订单汇总excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[16]); //导出退换货订单汇总excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getReturnOrderList($page,$psize,$sequence,$order,$CondList,$orderStatusArr,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '退换货订单汇总';
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
	 * @desc 退款[标识]
	 * @param string $orderno 订单编号
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 * @modify 2016-03-08 WuJunhua 添加收款明细信息
	 */
	public function orderRefund($orderno){
		$orderInfo = []; //订单信息
		$financeInfo = []; //收款明细信息
		$orderInfo['xsaa56'] = '是'; //已退款
		$orderItems = xsaaDAO::getInstance()->getBilingInfo($orderno);
		if($orderItems['xsaa44'] == 0.00){
			return array('res' => 'error','msg' => '该订单的退款金额为0,不能进行退款操作！');
		}
		
		$financeInfo['cwab02'] = $orderItems['cwaa01'];
		$financeInfo['cwab03'] = $financeInfo['cwab09'] = Yii::app()->session['account']; //操作人工号
		$financeInfo['cwab05'] = $orderInfo['xsaa44'] = $orderItems['xsaa44'];
		$financeInfo['cwab06'] = cwglConst::$FinancialOperationType[5]; //操作类型：退款
		$financeInfo['cwab07'] = $orderInfo['xsaa62'] = date('Y-m-d H:i:s'); //退款时间
		$financeInfo['cwab08'] = '有效'; //是否有效
		$financeInfo['cwab10'] = Yii::app()->session['name']; //操作人姓名
		unset($orderItems);
		
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02' => $orderno),$orderInfo);
		$insertResult = cwabDAO::getInstance()->insert($financeInfo,true);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '退款失败,请重新操作');
		}
		return array('res' => 'success','msg' => '退款成功');
	}

	/**
	 * @desc 退换货订单明细列表显示[只显示订单状态交易成功或拒收且退货换标识不为空]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function getReturnOrderDetailsList($page,$psize,$sign,$CondList){
		$result = array();  //获取列表数据的结果
		$orderStatusArr = array();
		$orderStatusArr['tradingSuccess'] = ddglConst::$OrderStatus[2]; //交易成功
		$orderStatusArr['rejected'] = ddglConst::$OrderStatus[9]; //拒收
		$orderStatusArr['return'] = ddglConst::$GoodsReturnsLogo[1]; //退货标识
		$orderStatusArr['exchanges'] = ddglConst::$GoodsReturnsLogo[2]; //换货标识
		$orderList = xsaaDAO::getInstance()->getReturnOrderDetailsList($page,$psize,$orderStatusArr,$CondList);

		if($sign == 1){
			//导出退换货订单明细excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[17]); //导出退换货订单明细excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getReturnOrderDetailsList($page,$psize,$orderStatusArr,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '退换货订单明细';
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
	 * @desc 出货款号汇总列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function getShipmentGoodsList($page,$psize,$sign,$CondList){
		$result = array();  //获取列表数据的结果
		$orderStatusArr = array();
		$orderStatusArr['tradingSuccess'] = ddglConst::$OrderStatus[2]; //交易成功
		$orderStatusArr['shipped'] = ddglConst::$OrderStatus[8]; //已发货
		$orderStatusArr['rejected'] = ddglConst::$OrderStatus[9]; //拒收
		$orderList = xsaaDAO::getInstance()->getShipmentGoodsList($page,$psize,$orderStatusArr,$CondList);

		if($sign == 1){
			//导出出货款号汇总excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[14]); //导出出货款号汇总excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getShipmentGoodsList($page,$psize,$orderStatusArr,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '出货款号汇总';
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
	 * @desc 出货款号明细列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function getShipmentGoodsDetailsList($page,$psize,$sign,$CondList){
		$result = array();  //获取列表数据的结果
		$orderStatusArr = array();
		$orderStatusArr['tradingSuccess'] = ddglConst::$OrderStatus[2]; //交易成功
		$orderStatusArr['shipped'] = ddglConst::$OrderStatus[8]; //已发货
		$orderStatusArr['rejected'] = ddglConst::$OrderStatus[9]; //拒收
		$orderList = xsaaDAO::getInstance()->getShipmentGoodsDetailsList($page,$psize,$orderStatusArr,$CondList);

		if($sign == 1){
			//导出出货款号明细excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[15]); //导出出货款号明细excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getShipmentGoodsDetailsList($page,$psize,$orderStatusArr,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '出货款号明细';
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
	 * @desc 获取出货或退换货订单详情
	 * @param string $orderno 订单编号
	 * @return array $orderDetails 订单信息
	 * @author WuJunhua
	 * @date 2015-12-11
	 */
	public function getOrderShipmentOrReturnsDetails($orderno){
		$orderDetails = xsaaDAO::getInstance()->getOrderShipmentOrReturnsDetails($orderno);
		if(empty($orderDetails)){
			return array('res' => 'error','msg' => '获取订单详情失败');
		}
		return $orderDetails;
	}

	/**
	 * @desc 修改订单金额或已收金额
	 * @param string $orderno 订单编号
	 * @param int $sign 订单金额或已收金额的标识
	 * @param array $moneyInfo 订单金额信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-11
	 */
	public function changeOrderMoney($orderno,$sign,$moneyInfo){
		$orderInfo = []; //订单信息
		$followInfo = []; //订单跟进记录
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		switch ($sign) {
			//修改订单金额
			case 1:
				$orderInfo['xsaa19'] = $moneyInfo['money'];
				$orderInfo['xsaa21'] = $moneyInfo['money'] - $moneyInfo['oldReceivedMoney'];
				$followInfo['xsad06'] = '订单总价'.$moneyInfo['oldOrderMoney'].'改为：'.$moneyInfo['money']; //跟进记录
				break;
			//修改已收金额
			case 2:
				$orderInfo['xsaa20'] = $moneyInfo['money'];
				$orderInfo['xsaa21'] = $moneyInfo['oldOrderMoney'] - $moneyInfo['money'];
				$followInfo['xsad06'] = '已收金额'.$moneyInfo['oldReceivedMoney'].'改为：'.$moneyInfo['money']; //跟进记录
				break;
			default:
				return array('res' => 'error','msg' => '操作有误');
				break;
		}
		$updateResult = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno),$orderInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '操作失败,请重新操作');
		}

		//插入订单跟进记录
		$followInfo['xsad01'] = $orderno;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}

		return array('res' => 'success','msg' => '操作成功');
	}

	/**
	 * @desc 获取客户订单记录
	 * @param string $clientno 客户编号
	 * @return array $result 客户跟进记录信息
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function GetOrderRecord($clientno){
		$result = khaeDAO::getInstance()->GetOrderRecord($clientno);
		if(empty($result)){
			return array('res'=>'error','msg'=>'获取客户跟进记录失败');
		}
		return $result;
	}

	/**
	 * @desc 获取客户的订单列表信息
	 * @param string $clientno 客户编号
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2016-01-21
	 */
	public function getClientOrderRecord($clientno,$page,$psize){
		$result = array();  //获取列表数据的结果
		$orderList = xsaaDAO::getInstance()->getClientOrderRecord($clientno,$page,$psize);
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
	 * @desc 获取退货订单[拒收状态的订单且订单总额>退货金额]
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $CondList 查询条件
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2016-03-09
	 */
	public function getReturnOrder($page,$psize,$CondList){
		$result = [];  //获取列表数据的结果
		$orderStatusArr = [];
		$orderStatusArr['rejected'] = ddglConst::$OrderStatus[9]; //拒收
		$orderList = xsaaDAO::getInstance()->getReturnOrder($page,$psize,$orderStatusArr,$CondList);

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
	 * @desc 从Excel添加订单
	 * @param array $orderInfo 订单（快递单）资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-11
	 */
	public function addOrderFromExcel($orderInfo){
		if(empty($orderInfo)){
			return array('res'=>'error','msg'=>'修改出错');
		}
		if(empty($orderInfo['xsaa02']) && empty($orderInfo['xsaa03']) && empty($orderInfo['xsaa41']) && empty($orderInfo['xsaa36'])){
			return null;
		}
		if(empty($orderInfo['xsaa02']) || empty($orderInfo['xsaa03'])){
			return array('res'=>'error','msg'=>'订单号或快递单号为空');
		}
		$order = xsaaDAO::getInstance()->findByAttributes(array('xsaa02'=>$orderInfo['xsaa02']));
		if(empty($order)){
			return array('res'=>'none','msg'=>'当前订单号不存在');
		}
		$result = xsaaDAO::getInstance()->updateByPk($order['xsaa01'],$orderInfo);

		if(empty($result)){
			return array('res'=>'false','msg'=>'修改失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}

	/**
	 * @desc 获取订单信息
	 * @param string $username 用户工号
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function getOrderMessage($username){
		$cond['username'] = $username;
		$cond['beginDate'] = date('Y-m-01');
		$cond['endDate'] = date('Y-m-d');
		$result['xdmes'] = xsaaDAO::getInstance()->getOrderMessage($cond,"'未确认'");
		$result['shmes'] = xsaaDAO::getInstance()->getOrderMessage($cond,"'已确认'");
		$result['wcmes'] = xsaaDAO::getInstance()->getOrderMessage($cond,"'交易成功'");
		return $result;
	}

	/**
	 * @desc 首页当中获取最近七天业绩
	 * @param string $date 当前年月日
	 * @param string $account 当前登录的工号
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function getSevenDetails($date,$account){
		$result = array();
		$cond['username'] = $account;
		for($i = 0; $i < 7; $i ++){
			$cond['date'] = date("Y-m-d" ,strtotime($date.' -'.$i.' day '));
			$dateStr = explode('-', $cond['date']);
			$result[$i]['displayDate'] = $dateStr[1].'-'.$dateStr[2];
			$result[$i]['count'] = xsaaDAO::getInstance()->getSevenDetails($cond);
		}
		return $result;
	}

	/**
	 * @desc 获取今天下单数
	 * @param string $date 当前年月日
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function getTodayOrders($date){
		$result = xsaaDAO::getInstance()->getTodayOrders($date);
		return $result;
	}


	/**
	 * @desc 获取今天完结单数
	 * @param string $date 当前年月日
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function getTodayFinishedOrders($date){
		$result = xsaaDAO::getInstance()->getTodayFinishedOrders($date);
		return $result;
	}

	/**
	 * @desc 获取财务人员工作提示
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function getCwryMessage(){
		$result = xsaaDAO::getInstance()->getCwryMessage();
		return $result;
	}

	/**
	 * @desc 获取物流人员工作提示
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function getWlryMessage(){
		$result = xsaaDAO::getInstance()->getWlryMessage();
		return $result;
	}
}


<?php
/**
 * @desc 物流管理模块控制器操作类
 * @author HuYan
 * @date 2015-10-27
 */
class wlglController extends Controller{
	/**
	 * @desc 物流发货模板显示
	 * @author HuYan
	 * @date 2015-10-27
	 */
	public function actionGetWlfhHtml(){
		//接收历史浏览页码和每页显示的条数
		$page = CInputFilter::getInt('page',0);  //获取页码
		$psize = CInputFilter::getInt('psize', 0);  //获取每页显示的条数
		//分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//快递公司
	    $kdgs='A011';
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany($kdgs);
	    //客户意向选项卡
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
	    //订单类型
		$ddlx='A002';
	    $OrderTypeOptions = xsaaModel::model()->getOrderType($ddlx);

		$OrderStatus=array();
		$OrderStatus['shipping'] = ddglConst::$OrderStatus[7]; //待发货状态
		$OrderStatus['shipped'] = ddglConst::$OrderStatus[8]; //已发货状态
		$OrderStatus['rejected'] = ddglConst::$OrderStatus[9]; //拒收状态

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('PaymentMethodOptions',$PaymentMethodOptions);
		$this->assign('OrderTypeOptions',$OrderTypeOptions);
		$this->assign('OrderStatus',$OrderStatus);
		$this->assign('page',$page);
		$this->assign('psize',$psize);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('wlgl/wlfh.html');
	}
	
	/**
	 * @desc 产品入库的采购单入库模板显示
	 * @author HuYan
	 * @date 2015-10-27
	 */
	public function actionGetCprkHtml(){
		//供应商
		$SupplierOptions = cgabModel::model()->getGys();
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('SupplierOptions',$SupplierOptions['list']);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('wlgl/cgdrk.html');

	}

	/**
	 * @desc 库存明细模板显示
	 * @author HuYan
	 * @date 2015-10-27
	 */
	public function actionGetKcmxHtml(){
		//符号(> = <)
		$kcs='A009';
		$InventoryNumberOptions = syssetModel::model()->getInventoryNumber($kcs);
		//上架下架
		$sjxj='A027';
		$UpperLowerFrameOptions = syssetModel::model()->getUpperLowerFrame($sjxj);

		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('InventoryNumberOptions',$InventoryNumberOptions);
		$this->assign('UpperLowerFrameOptions',$UpperLowerFrameOptions);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('wlgl/kcmx.html');
	}


	/**
	 * @desc 退货订单记录模板显示
	 * @author HuYan
	 * @date 2015-10-27
	 */
	public function actionGetThrcHtml(){
		//支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
	    //分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//快递公司
	    $kdgs='A011';
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany($kdgs);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('PaymentMethodOptions',$PaymentMethodOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('wlgl/thddjl.html');
	}

	/**
	 * @desc 退货款号汇总模板显示
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function actionGetThkhhzHtml(){
		//支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
	    //分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//快递公司
	    $kdgs='A011';
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany($kdgs);

		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('PaymentMethodOptions',$PaymentMethodOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('wlgl/thkhhz.html');
	}

	/**
	 * @desc 退货入仓模板显示
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function actionGetCpthrcHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('wlgl/thrc.html');
	}

	/**
	 * @desc 库存异动明细模板显示
	 * @author WuJunhua
	 * @date 2015-12-31
	 */
	public function actionGetKcydmxlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('wlgl/kcydmx.html');
	}

	/**
	 * @desc 退货供应商模板显示
	 * @author WuJunhua
	 * @date 2016-03-08
	 */
	public function actionGetThgysHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('wlgl/thgys.html');
	}

	/**
	 * @desc 退货供应商记录模板显示
	 * @author WuJunhua
	 * @date 2015-12-31
	 */
	public function actionGetThgysxqHtml(){
		//供应商
		$SupplierOptions=cgabModel::model()->getSupplierOptions();
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->assign('SupplierOptions',$SupplierOptions);
		$this->display('wlgl/thgysxq.html');
	}

	/**
	 * @desc 仓库报废模板显示
	 * @author WuJunhua
	 * @date 2016-03-08
	 */
	public function actionGetCkbfHtml(){
		//符号(> = <)
		$kcs='A009';
		$InventoryNumberOptions = syssetModel::model()->getInventoryNumber($kcs);
		//上架下架
		$sjxj='A027';
		$UpperLowerFrameOptions = syssetModel::model()->getUpperLowerFrame($sjxj);
		
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('InventoryNumberOptions',$InventoryNumberOptions);
		$this->assign('UpperLowerFrameOptions',$UpperLowerFrameOptions);
		$this->display('wlgl/ckbf.html');
	}

	/**
	 * @desc 打印条形码模板显示
	 * @author HuYan
	 * @date 2015-10-27
	 */
	public function actionGetDytxmHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('wlgl/dytxm.html');
	}

	/**
	 * @desc 加载库存盘点模板(生成盘点单号)
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	public function actionGetScpddhHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('wlgl/kcpd_scpddh.html');
	}

	/**
	 * @desc 加载库存盘点模板(盘点明细)
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	public function actionGetPddhlbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('wlgl/kcpd_pdmx.html');
	}

	/**
	 * @desc 加载库存盘点模板(录入盘点数量)
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	public function actionGetLrpdslHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('wlgl/kcpd_drpdsl.html');
	}

	/**
	 * @desc 加载库存盘点模板(生成盘差报表)
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	public function actionGetScpcbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('wlgl/kcpd_scpcbb.html');
	}

	/**
	 * @desc 加载库存盘点模板(初始化盘点)
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	public function actionGetCshpdHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('wlgl/kcpd_cshpd.html');
	}

	/**
	 * @desc 加载库存盘点记录模板
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	public function actionGetKcpdjlHtml(){
		$cpfl =cpabModel::model()->getAllCpfl();
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('cpfl', $cpfl);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('wlgl/kcpdjl.html');
	}

	/**
	 * @desc 加载导入订单处理模板
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	public function actionGetDrddclHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('wlgl/drddcl.html');
	}

	/**
	 * @desc 加载调仓记录模板
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	/*public function actionGetTcjlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('wlgl/tcjl.html');
	}*/

	/**
	 * @desc 加载产品直接入库
	 * @author WuJunhua
	 * @date 2015-11-12
	 * @modify huyan 2016-01-12 添加供应商列表
	 */
	public function actionGetCpzjrkHtml(){
		//供应商
		$SupplierOptions = cgabModel::model()->getGys();
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('SupplierOptions',$SupplierOptions['list']);
		$this->display('wlgl/zjrk.html');
	}

	/**
	 * @desc 加载退货订单记录详情
	 * @author WuJunhua
	 * @date 2015-11-26
	 */
	public function actionGetThddjlxqHtml(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('orderno', $orderno);
		$this->display('wlgl/thddjlxq.html');
	}

	/**
	 * @desc 获取物流发货列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-11-17
	 * @modify  huyan 2015-12-11
	 */
	public function actionGetLogisticsDeliveryList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
		$CondList['wlddh'] = CInputFilter::getString('wlddh');
		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';
		$CondList['kddh'] = CInputFilter::getString('kddh');
		$CondList['khid'] = CInputFilter::getString('khid');
		$CondList['khname'] = CInputFilter::getString('khname');
		$CondList['kdgs'] = CInputFilter::getString('kdgs');
		$CondList['zffs'] = CInputFilter::getString('zffs');
		$CondList['szz'] = CInputFilter::getString('szz');
		$CondList['khyx'] = CInputFilter::getString('khyx');
		$CondList['ddlx'] = CInputFilter::getString('ddlx');
		$CondList['ddfhzt'] = CInputFilter::getString('ddfhzt');

		$sequence = !empty(CInputFilter::getString('sequence')) ? CInputFilter::getString('sequence') : 'DESC';
		$order = !empty(CInputFilter::getString('order')) ? CInputFilter::getString('order') : 'xsaa02';
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = xsaaModel::model()->getLogisticsDeliveryList($page,$psize,$sequence,$order,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 单个或批量确认发货
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-11-17
	 */
	public function actionConfirmShipped(){
		//确认发货的订单编号
		$orderno = CInputFilter::getArray('orderno','string');
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$orderInfo['xsaa29'] = ddglConst::$OrderStatus[8]; //已发货状态
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa27'] = date('Y-m-d H:i:s'); //订单发货时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[11]; //动作说明(发货)
		$result = xsaaModel::model()->confirmShipped($orderno,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 加载物流发货的订单详情
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function actionOrderDetails(){
		$orderNo = CInputFilter::getString('orderno');
		$ordernum = CInputFilter::getInt('ordernum');
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		if(empty($orderNo) || empty($ordernum)){
			return false;
		}
		//上一单、下一单标识
		$symbol = CInputFilter::getString('symbol');
		if($symbol == 'before'){
			$symbol = '<';
		}
		if($symbol == 'next'){
			$symbol = '>';
		}
		if($symbol == ''){
			$symbol = '=';
		}
	    //快递公司
	    $kdgs='A011';
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany($kdgs);
	    //工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
		//工号所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('page',$page);
		$this->assign('psize',$psize);
		$orderDetails = xsaaModel::model()->getDeliverOrderDetails($ordernum,$symbol);
		if(!empty($orderDetails)){
			//号码屏蔽
			$mobile = '';
			if(!empty($orderDetails['xsaa06'])){
				$result = syssetModel::model()->handleNumberShield($orderDetails['xsaa06']);
				if(!is_array($result)){
					$mobile = $result;
				}
			}
			$this->assign('orderno',$orderDetails);
			$this->assign('mobile',$mobile);
			$this->display('wlgl/wlfhxq.html');
		}
	}

	/**
	 * @desc 检测获取已拒收/退货换订单
	 * @author WuJunhua
	 * @date 2015-11-24
	 */
	public function actionGetRejectedOrder(){
		$orderNo = CInputFilter::getString('orderno');
		$expressNo = CInputFilter::getString('expressno');
		if(empty($orderNo) && empty($expressNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$result = xsaaModel::model()->getRejectedOrder($orderNo,$expressNo);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取已拒收订单失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 退货入仓(销退)
	 * @author WuJunhua
	 * @date 2015-11-25
	 */
	public function actionReturnWarehousing(){
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		//单个或多个商品信息
		$goodItems = CInputFilter::getArray('goodItems','string');

		if(!empty($goodItems)){
			$result = xsaaModel::model()->returnWarehousing($orderNo,$goodItems);
		}else{
			$this->renderJson(array('res'=>'error','msg'=>'退货的商品不能为空'));

		}
		$this->renderJson($result);
	}

	/**
	 * @desc 终止退货入仓
	 * @author WuJunhua
	 * @date 2015-11-25
	 */
	public function actionEndWarehousing(){
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		//单个或多个商品信息
		$goodItems = CInputFilter::getArray('goodItems','string');

		if(!empty($goodItems)){
			$result = xsaaModel::model()->endWarehousing($orderNo,$goodItems);
		}else{
			$this->renderJson(array('res'=>'error','msg'=>'终止退货入仓的商品不能为空'));

		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货订单记录列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-11-25
	 */
	public function actionGetReturnOrderRecordList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$sequence = CInputFilter::getString("sequence");
		$order = CInputFilter::getString("order");
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
		$CondList['ddbh'] = CInputFilter::getString('ddbh');
		$CondList['ddsjq'] = CInputFilter::getString('ddsjq');
		$CondList['ddsjz'] = CInputFilter::getString('ddsjz');
		$CondList['ddsjz'] = !empty($CondList['ddsjz']) ? $CondList['ddsjz'].DEFAULT_END_TIME : '';
		$CondList['rcsjq'] = CInputFilter::getString('rcsjq');
		$CondList['rcsjz'] = CInputFilter::getString('rcsjz');
		$CondList['rcsjz'] = !empty($CondList['rcsjz']) ? $CondList['rcsjz'].DEFAULT_END_TIME : '';
		$CondList['zffs'] = CInputFilter::getString('zffs');
		$CondList['syz'] = CInputFilter::getString('syz');
		$CondList['kdgs'] = CInputFilter::getString('kdgs');

		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = xsaaModel::model()->getReturnOrderRecordList($page,$psize,$sequence,$order,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}
	
	/**
	 * @desc 获取退货订单记录详情的商品信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 */
	public function actionGetReturnOrderDetails(){
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$result = xsabModel::model()->getReturnOrderDetails($orderNo);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取退货订单记录详情失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货款号汇总列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 * modify huyan 修改查询条件
	 */
	public function actionGetReturnGoodsSummaryList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$sequence = CInputFilter::getString('sequence');
		$order = CInputFilter::getString('order');
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
		$CondList['cpmc'] = CInputFilter::getString('cpmc');
		$CondList['cpkh'] = CInputFilter::getString('cpkh');
		$CondList['rcsjq'] = CInputFilter::getString('rcsjq');
		$CondList['rcsjz'] = CInputFilter::getString('rcsjz');
		$CondList['rcsjz'] = !empty($CondList['rcsjz']) ? $CondList['rcsjz'].DEFAULT_END_TIME : '';
		$CondList['ddid'] = CInputFilter::getString('ddid');
		//$CondList['gysid'] = CInputFilter::getString('gysid');
		$CondList['kdgs'] = CInputFilter::getString('kdgs');
		$CondList['zffs'] = CInputFilter::getString('zffs');
		$CondList['syz'] = CInputFilter::getString('syz');

		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = xsabModel::model()->getReturnGoodsSummaryList($page,$psize,$sequence,$order,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货款号汇明细列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 */
	public function actionGetReturnGoodsDetailsList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
		$CondList['cpmc'] = CInputFilter::getString('cpmc');
		$CondList['cpkh'] = CInputFilter::getString('cpkh');
		$CondList['rcsjq'] = CInputFilter::getString('rcsjq');
		$CondList['rcsjz'] = CInputFilter::getString('rcsjz');
		$CondList['rcsjz'] = !empty($CondList['rcsjz']) ? $CondList['rcsjz'].DEFAULT_END_TIME : '';
		$CondList['ddid'] = CInputFilter::getString('ddid');
		//$CondList['gysid'] = CInputFilter::getString('gysid');
		$CondList['kdgs'] = CInputFilter::getString('kdgs');
		$CondList['zffs'] = CInputFilter::getString('zffs');
		$CondList['syz'] = CInputFilter::getString('syz');

		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = xsabModel::model()->getReturnGoodsDetailsList($page,$psize,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取库存盘点列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-11-30
	 */
	public function actionGetInventoryCheckList(){
		$result = array();  //列表信息结果
		$goodName = CInputFilter::getString('goodName');
		$result = cpaeModel::model()->getInventoryCheckList($goodName);
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'获取库存盘点列表信息失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 生成盘点单号
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public function actionGenerateInventoryOrder(){
		//单个或多个商品信息
		$goodItems = CInputFilter::getArray('goodsItems','string');
		if(empty($goodItems)){
			$this->renderJson(array('res'=>'error','msg'=>'操作失败'));
		}
		$result = pdaaModel::model()->generateInventoryOrder($goodItems);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取盘点明细列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public function actionGetInventoryOrderList(){
		$result = array();  //列表信息结果
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = pdaaModel::model()->getInventoryOrderList($sign);
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'获取盘点单号列表信息失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 盘点时根据批次号、商品编号获取商品信息
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function actionGetGoodById(){
		$goodId = CInputFilter::getInt('goodid');
		$batchId = CInputFilter::getString('batchid');
		$result = cpaaModel::model()->getGoodById($goodId,$batchId);
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'获取商品信息失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 录入盘点数量
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function actionEntryCountQuantity(){
		//单个或多个产品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		if(empty($goodItems)){
			$this->renderJson(array('res'=>'error','msg'=>'获取商品信息失败'));
		}
		$result = pdabModel::model()->entryCountQuantity($goodItems);
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'录入盘点数量失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取盘差列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function actionGenerateDifferenceForm(){
		$result = array();  //列表信息结果
		$result = pdaaModel::model()->generateDifferenceForm();
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'获取盘差列表信息失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 商品入账(盘盈、盘亏)
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function actionGoodsRecorded(){
		//单个或多个产品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		if(empty($goodItems)){
			$this->renderJson(array('res'=>'error','msg'=>'获取商品信息失败'));
		}
		$result = cpaeModel::model()->goodsRecorded($goodItems);
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'商品入账失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取库存盘点流水记录列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-03
	 */
	public function actionGetInventoryFlowRecordList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
		$CondList['cpmc'] = CInputFilter::getString('cpmc');
		$CondList['cpkh'] = CInputFilter::getString('cpkh');
		$CondList['pdczr'] = CInputFilter::getString('pdczr');
		$CondList['pdtxm'] = CInputFilter::getString('pdtxm');
		$CondList['pdsjq'] = CInputFilter::getString('pdsjq');
		$CondList['pdsjz'] = CInputFilter::getString('pdsjz');
		$CondList['pdsjz'] = !empty($CondList['pdsjz']) ? $CondList['pdsjz'].DEFAULT_END_TIME : '';
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = cpaaModel::model()->getInventoryFlowRecordList($page,$psize,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取库存异动明细记录列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-31
	 * @modify 2015-12-31 huyan 添加查询条件
	 */
	public function actionGetProductWarehousingRecording(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数

		$CondList = array();
		$CondList['rkpc'] = CInputFilter::getString('rkpc');
		$CondList['rkgys'] = CInputFilter::getString('rkgys');
		$CondList['scrqq'] = CInputFilter::getString('scrqq');
		$CondList['scrqz'] = CInputFilter::getString('scrqz');
		$CondList['scrqz'] = !empty($CondList['scrqz']) ? $CondList['scrqz'].DEFAULT_END_TIME : '';
		$CondList['dqsjq'] = CInputFilter::getString('dqsjq');
		$CondList['dqsjz'] = CInputFilter::getString('dqsjz');
		$CondList['dqsjz'] = !empty($CondList['dqsjz']) ? $CondList['dqsjz'].DEFAULT_END_TIME : '';
		$CondList['rcsjq'] = CInputFilter::getString('rcsjq');
		$CondList['rcsjz'] = CInputFilter::getString('rcsjz');
		$CondList['rcsjz'] = !empty($CondList['rcsjz']) ? $CondList['rcsjz'].DEFAULT_END_TIME : '';
		$CondList['rkcw'] = CInputFilter::getString('rkcw');
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$result = cpaaModel::model()->getProductWarehousingRecording($page,$psize,$sign,$CondList);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 系统设置->数据清理->删除库存盘点记录
	 * @author huyan
	 * @date 2016-02-19
	 */
	public function actionDelStockInventory(){
		$CurrentTime= date('Y-m-d H:i'); 
		$pdsjq = CInputFilter::getString('pdsjq');
		$pdsjz = CInputFilter::getString('pdsjz');
		$dqsj=(strtotime($CurrentTime));
		$ddsjq=(strtotime($pdsjq));
		$diff = (int)(($dqsj-$ddsjq)/(24*3600));
		if (!empty($pdsjq)&&empty($pdsjz)) {
			if ($diff<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的盘点记录'));
		    }
		}
		$rksjz=(strtotime($pdsjz));
		$diff1 = (int)(($dqsj-$rksjz)/(24*3600));
		if (empty($pdsjq)&&!empty($pdsjz)) {
			if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的盘点记录'));
		    }
		}
		if (!empty($pdsjq)&&!empty($pdsjz)) {
            if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的盘点记录'));
		    }
		}
		
		$pdsjz = !empty($pdsjz) ? $pdsjz.DEFAULT_END_TIME : '';
		$result = pdaaModel::model()->DelStockInventory($pdsjq,$pdsjz);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取采购单的相关明细信息
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function actionGetPurchaseOrderInfo(){
		$purchaseNo = CInputFilter::getString('orderno');
		if(empty($purchaseNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$result = cgaaModel::model()->getPurchaseOrderInfo($purchaseNo);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取采购单信息失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 退货供应商(仓退)
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function actionReturnSuppliers(){
		$purchaseNo = CInputFilter::getString('orderno');
		if(empty($purchaseNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		//单个或多个商品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		if(!empty($goodItems)){
			$result = cgaaModel::model()->returnSuppliers($purchaseNo,$goodItems);
		}else{
			$this->renderJson(array('res'=>'error','msg'=>'退货的商品不能为空'));

		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货供应商记录列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2016-03-11
	 */
	public function actionGetReturnSupplierRecordList(){
		$result = [];  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$CondList = [];
		$CondList['cgdh'] = CInputFilter::getString('cgdh');
		$CondList['ddsjq'] = CInputFilter::getString('ddsjq');
		$CondList['ddsjz'] = CInputFilter::getString('ddsjz');
		$CondList['ddsjz'] = !empty($CondList['ddsjz']) ? $CondList['ddsjz'].DEFAULT_END_TIME : '';
		$CondList['rcsjq'] = CInputFilter::getString('rcsjq');
		$CondList['rcsjz'] = CInputFilter::getString('rcsjz');
		$CondList['rcsjz'] = !empty($CondList['rcsjz']) ? $CondList['rcsjz'].DEFAULT_END_TIME : '';
		$CondList['gys'] = CInputFilter::getString('gys');

		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = cgaaModel::model()->getReturnSupplierRecordList($page,$psize,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 退货供应商记录详情
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function actionGetThgysjlxqHtml(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('orderno', $orderno);
		$this->display('wlgl/thgysjlxq.html');
	}

	/**
	 * @desc 获取退货退货供应商记录商品详情
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function actionReturnSupplierOrder(){
		$result = [];  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$orderNo = CInputFilter::getString('orderno');
		$result = cgacModel::model()->ReturnSupplierOrder($page,$psize,$orderNo);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 仓库报废
	 * @author WuJunhua
	 * @date 2016-03-17
	 */
	public function actionWarehouseScrapped(){
		$productInfo = []; //产品库存信息
		$inventoryDetail = []; //库存明细信息
		$productInfo['cpae01'] = $inventoryDetail['cpaf02'] = CInputFilter::getString('batch');
		$productInfo['cpae02'] = $inventoryDetail['cpaf03'] = CInputFilter::getString('styleNum');
		$authentic = CInputFilter::getInt('authentic');
		if(empty($productInfo['cpae01'] ) || empty($productInfo['cpae02'] )){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		if(empty($authentic)){
			$this->renderJson(array('res' => 'error','msg' => '正品报废数不能为空'));
		}
		$result = cpaeModel::model()->warehouseScrapped($productInfo,$authentic,$inventoryDetail);
		$this->renderJson($result);
	}

}
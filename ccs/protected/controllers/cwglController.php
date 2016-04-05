<?php
/**
 * @desc 财务管理控制器操作类
 * @author DengShaocong
 * @date 2015-10-27
 */	
class cwglController extends Controller{
	/**
	 * @desc 财务审核模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetCwshHtml(){
		//订单审核状态
		$ddshzt='A026';
		$OrderAuditStatusOptions = syssetModel::model()->getAuditStatus($ddshzt);
		//分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->assign('OrderAuditStatusOptions',$OrderAuditStatusOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->display('cwgl/cwsh.html');
	}
	/**
	 * @desc 出货订单模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetChddHtml(){
		//接收历史浏览页码和每页显示的条数
		$page = CInputFilter::getInt('page',0);  //获取页码
		$psize = CInputFilter::getInt('psize', 0);  //获取每页显示的条数
		$address = CInputFilter::getString('address');
		//分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
	    //订单类型
		$ddlx='A002';
	    $OrderTypeOptions = xsaaModel::model()->getOrderType($ddlx);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		//快递公司
	    $kdgs='A011';
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany($kdgs);
	    //是否记账
	    $sfjz='A020';
	    $WhetherAccountingOptions= xsaaModel::model()->getWhetherAccounting($sfjz);
	    //发票类型
	    $fplx='A004';
	    $InvoiceTypeOptions= xsaaModel::model()->getInvoiceType($fplx);

	     //有无快递费
	    $ywkdf='A032';
	    $ExpressFeeOptions= xsaaModel::model()->getExpressFee($ywkdf);

	    $OrderStatus=array();
		$OrderStatus['returrngoods'] = ddglConst::$OrderStatus[11]; //已退货
		$OrderStatus['shipped'] = ddglConst::$OrderStatus[8]; //已发货
		$OrderStatus['trading_success'] = ddglConst::$OrderStatus[2]; //交易成功

		$sessionInfo = $this->getSessionInfo();
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('PaymentMethodOptions',$PaymentMethodOptions);
		$this->assign('OrderTypeOptions',$OrderTypeOptions);
		$this->assign('ClientSourceOptions',$ClientSourceOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('WhetherAccountingOptions',$WhetherAccountingOptions);
		$this->assign('InvoiceTypeOptions',$InvoiceTypeOptions);
        $this->assign('ExpressFeeOptions',$ExpressFeeOptions);
        $this->assign('OrderStatus',$OrderStatus);
        $this->assign('page',$page);
        $this->assign('psize',$psize);
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('cwgl/chdd.html');
	}
	/**
	 * @desc 款号出货汇总模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetKhchhzHtml(){
		//供应商选项卡
		$gyslb = 'A025';
		$SuppliersOptions = syssetModel::model()->getSuppliers($gyslb);
		//订单状态
		$OrderStatus=array();
		$OrderStatus['returrngoods'] = ddglConst::$OrderStatus[11]; //已退货
		$OrderStatus['shipped'] = ddglConst::$OrderStatus[8]; //已发货
		$OrderStatus['trading_success'] = ddglConst::$OrderStatus[2]; //交易成功
		$GirardNum=array();
		$GirardNum['khreturndgoogs'] = ddglConst::$GirardNumber[1]; //已退货
		$GirardNum['khhaveareplacement'] = ddglConst::$GirardNumber[2]; //已换货
		$GirardNum['khreceiving']= ddglConst::$GirardNumber[3]; //已收货
		//分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);

		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('SuppliersOptions', $SuppliersOptions);
		$this->assign('OrderStatus', $OrderStatus);
		$this->assign('GroupsTypeOptions', $GroupsTypeOptions);
		$this->assign('GirardNum', $GirardNum);
		$this->assign('ClientSourceOptions', $ClientSourceOptions);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('cwgl/khchhz.html');
	}
	
	/**
	 * @desc 供应商往来明细模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetGyswlmxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cwgl/gyswlmx.html');
	}
	/**
	 * @desc 每月进销存模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetMyjxcHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$cgwyList = rylistModel::model()->getCgwyList();
		$this->assign('cgwy',$cgwyList['list']);
		$cpfl =cpabModel::model()->getAllCpfl();
		$this->assign('cpfl',$cpfl);
		$date = explode('-',date('Y-m'));
		$this->assign('year',$date[0]);
		$this->assign('month',$date[1]);
		$this->display('cwgl/mykhjxc.html');
	}
	/**
	 * @desc 进销存模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetKhjxcHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$cgwyList = rylistModel::model()->getCgwyList();
		$this->assign('cgwy',$cgwyList['list']);
		$cpfl =cpabModel::model()->getAllCpfl();
		$this->assign('cpfl',$cpfl);
		$this->display('cwgl/khjxc.html');
	}
	/**
	 * @desc 每月供应商进销存模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetMygysjxcHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$cgwyList = rylistModel::model()->getCgwyList();
		$this->assign('cgwy',$cgwyList['list']);
		$cpfl =cpabModel::model()->getAllCpfl();
		$this->assign('cpfl',$cpfl);
		$date = explode('-',date('Y-m'));
		$this->assign('year',$date[0]);
		$this->assign('month',$date[1]);
		$this->display('cwgl/mygysjxc.html');
	}
	/**
	 * @desc 供应商进销存模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetGysjxcHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$cgwyList = rylistModel::model()->getCgwyList();
		$cgzyList = rylistModel::model()->getCgzyList();
		$this->assign('cgwy',$cgwyList['list']);
		$this->assign('cgzy',$cgzyList['list']);
		$cpfl =cpabModel::model()->getAllCpfl();
		$this->assign('cpfl',$cpfl);
		$date = explode('-',date('Y-m'));
		$this->assign('year',$date[0]);
		$this->assign('month',$date[1]);
		$this->display('cwgl/gysjxc.html');
	}
	/**
	 * @desc 每月盘点报表模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetMypdbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cwgl/mypdbb.html');
	}
	/**
	 * @desc 手动添加供应商往来明细模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetTjgyswlmxjlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cwgl/tjgyswlmxjl.html');
	}

	/**
	 * @desc 赠品统计报表模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetZptjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cwgl/zptjbb.html');
	}

	/**
	 * @desc 退换货订单模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetThhddHtml(){
		 //支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
	    //快递公司
	    $kdgs='A011';
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany($kdgs);
	    //分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);

		//订单状态
		$OrderStatus=array();
		
		$OrderStatus['rejected'] = ddglConst::$OrderStatus[9]; //拒收
		$OrderStatus['trading_success'] = ddglConst::$OrderStatus[2]; //交易成功

		$PutStorage=array();
		$PutStorage['khreturndgoogs'] = ddglConst::$PutStorage[1]; //已入库
		$PutStorage['khhaveareplacement'] = ddglConst::$PutStorage[2]; //未入库

		$Returnorder=array();
		$Returnorder['backorder'] = ddglConst::$Returnorder[1]; //退订单
		$Returnorder['changeorder'] = ddglConst::$Returnorder[2]; //换订单

		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('PaymentMethodOptions', $PaymentMethodOptions);
		$this->assign('DeliveryCompanyOptions', $DeliveryCompanyOptions);
		$this->assign('GroupsTypeOptions', $GroupsTypeOptions);
		$this->assign('OrderStatus', $OrderStatus);
		$this->assign('PutStorage', $PutStorage);
		$this->assign('Returnorder', $Returnorder);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('cwgl/thhdd.html');
	}

	/**
	 * @desc 订单财务审核列表显示[默认显示订单状态已支付且已客审和已确认且已客审且已收定金不为0的订单]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-08
	 * @modify huyan 2015-12-11 修改查询条件
	 */
	public function actionGetFinanceCheckingOrder(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
		$sequence = !empty(CInputFilter::getString('sequence')) ? CInputFilter::getString('sequence') : 'DESC';
		$order = !empty(CInputFilter::getString('order')) ? CInputFilter::getString('order') : 'xsaa02';
		$CondList['shddid'] = CInputFilter::getString('shddid');
		$CondList['shkhid'] = CInputFilter::getString('shkhid');
		$CondList['shzt'] = CInputFilter::getString('shzt');
		$CondList['shszz'] = CInputFilter::getString('shszz');
		$CondList['shsjq']= CInputFilter::getString('shsjq');
		$CondList['shsjz']= CInputFilter::getString('shsjz');
		$CondList['shsjz'] = !empty($CondList['shsjz']) ? $CondList['shsjz'].DEFAULT_END_TIME : '';

		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = xsaaModel::model()->getFinanceCheckingOrder($page,$psize,$sequence,$order,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 单个/批量提审订单【财审】
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function actionFinanceDeliverOrders(){
		//提审的订单编号
		$orderno = CInputFilter::getArray('orderno','string');
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa25'] = date('Y-m-d H:i:s'); //订单审核时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[20]; //财务审核通过
		$orderInfo['xsaa30'] = ddglConst::$ApprovalStatus[3]; //已财审
		$orderInfo['xsaa29'] = ddglConst::$OrderStatus[7]; //待发货状态
		$result = xsaaModel::model()->financeDeliverOrders($orderno,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 加载订单财务审核详情
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function actionOrderFinanceCheckDetails(){
		$orderNo = CInputFilter::getString('orderno');
		$ordernum = CInputFilter::getInt('ordernum');
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

		//订单类型
		$ddlx='A002';
	    $OrderTypeOptions = xsaaModel::model()->getOrderType($ddlx);
	    //快递公司
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany();
	    //发票类型
	    $fplx='A004';
	    $InvoiceTypeOptions= xsaaModel::model()->getInvoiceType($fplx);
	    //省份
	    $appprovinceOptions = appprovinceModel::model()->getappprovince();
	    //工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
		//工号所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//手机加拨
		$typeencode = 'A032';
		$DialPhone = syssetModel::model()->getInformation($typeencode);
		
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('OrderTypeOptions',$OrderTypeOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('InvoiceTypeOptions',$InvoiceTypeOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('DialPhone',$DialPhone['338']);
		$orderCheckDetails = xsaaModel::model()->getOrderFinanceCheckDetails($ordernum,$symbol);
		if(!empty($orderCheckDetails)){
			//市
		    $appcityOptions = appCityModel::model()->getCity($orderCheckDetails['provinceid']);
		    //区
		    $appareaOptions = appAreaModel::model()->getArea($orderCheckDetails['cityid']);
		    //号码屏蔽
			$mobile = '';
			if(!empty($orderCheckDetails['xsaa06'])){
				$result = syssetModel::model()->handleNumberShield($orderCheckDetails['xsaa06']);
				if(!is_array($result)){
					$mobile = $result;
				}
			}
		    $this->assign('appcityOptions',$appcityOptions);
		    $this->assign('appareaOptions',$appareaOptions);
			$this->assign('orderno',$orderCheckDetails);
			$this->assign('mobile',$mobile);
			$this->display('cwgl/cwshxq.html');
		}
	}

	/**
	 * @desc 财务审核详情的撤回修改[货到付款的订单:已确认状态改为未确认状态;非货到付款的订单:已支付状态改为等待支付状态;]
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function actionFinanceOrderBackToUnConfirm(){
		//撤回修改的订单编号
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[7]; //动作说明(撤回未确认)
		$orderInfo['xsaa50'] = ddglConst::$WhetherConfirmedChecked[2]; //未确认到审单
		$orderInfo['xsaa30'] = ''; //审核状态
		$orderInfo['xsaa20'] = 0.00; //已收金额
		$orderInfo['xsaa21'] = 0.00; //代收金额
		$result = xsaaModel::model()->financeOrderBackToUnConfirm($orderno,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 出货订单列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-09
	 * @modify huyan 2015-12-23 添加查询条件
	 */
	public function actionGetShipmentOrderList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$CondList = array();
		$CondList['ddid'] = CInputFilter::getString('ddid');
		$CondList['khid'] = CInputFilter::getString('khid');
		$CondList['kddh'] = CInputFilter::getString('kddh');
		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';
		$CondList['fhsjq'] = CInputFilter::getString('fhsjq');
		$CondList['fhsjz'] = CInputFilter::getString('fhsjz');
		$CondList['fhsjz'] = !empty($CondList['fhsjz']) ? $CondList['fhsjz'].DEFAULT_END_TIME : '';
		
		$CondList['shsjq'] = CInputFilter::getString('shsjq');
		$CondList['shsjz'] = CInputFilter::getString('shsjz');
		$CondList['shsjz'] = !empty($CondList['shsjz']) ? $CondList['shsjz'].DEFAULT_END_TIME : '';
		$CondList['jzsj1q'] = CInputFilter::getString('jzsj1q');
		$CondList['jzsj1z'] = CInputFilter::getString('jzsj1z');
		$CondList['jzsj1z'] = !empty($CondList['jzsj1z']) ? $CondList['jzsj1z'].DEFAULT_END_TIME : '';
		$CondList['jzsj2q'] = CInputFilter::getString('jzsj2q');
		$CondList['jzsj2z'] = CInputFilter::getString('jzsj2z');
		$CondList['jzsj2z'] = !empty($CondList['jzsj2z']) ? $CondList['jzsj2z'].DEFAULT_END_TIME : '';

		$CondList['kdgs'] = CInputFilter::getString('kdgs');
		$CondList['ddzt'] = CInputFilter::getString('ddzt');
		$CondList['zffs'] = CInputFilter::getString('zffs');
		$CondList['szz'] = CInputFilter::getString('szz');
		$CondList['fplx'] = CInputFilter::getString('fplx');
		$CondList['sfjz'] = CInputFilter::getString('sfjz');
		$CondList['khly'] = CInputFilter::getString('khly');
		$CondList['ywkdf'] = CInputFilter::getString('ywkdf');
		
		$result = xsaaModel::model()->getShipmentOrderList($page,$psize,$sign,$CondList);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 记账或撤销记账[标识]
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-12-09
	 */
	public function actionOrderAccounting(){
		//订单编号
		$orderno = CInputFilter::getArray('orderno','string');
		$sign = CInputFilter::getInt('sign'); //标识
		if(empty($orderno) || empty($sign)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->orderAccounting($orderno,$sign);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改快递费、服务费
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-12-09
	 */
	public function actionOrderCourierFees(){
		$orderInfo = []; //订单信息
		$orderno = CInputFilter::getString('orderno');
		$orderInfo['xsaa57'] = CInputFilter::getFloat('courier'); //快递费
		$orderInfo['xsaa58'] = CInputFilter::getFloat('fee'); //服务费
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error','msg' => '操作有误'));
		}
		$result = xsaaModel::model()->orderCourierFees($orderno,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 退换货订单汇总列表显示[只显示订单状态交易成功或拒收且退货换标识不为空]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 * @modify huyan 2015-12-25 添加查询条件
	 */
	public function actionGetReturnOrderList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$sequence = !empty(CInputFilter::getString('sequence')) ? CInputFilter::getString('sequence') : 'DESC';
		$order = !empty(CInputFilter::getString('order')) ? CInputFilter::getString('order') : 'xsaa02';

		$CondList = array();
		$CondList['fhsjq'] = CInputFilter::getString('fhsjq');
		$CondList['fhsjz'] = CInputFilter::getString('fhsjz');
		$CondList['fhsjz'] = !empty($CondList['fhsjz']) ? $CondList['fhsjz'].DEFAULT_END_TIME : '';
		$CondList['thsjq'] = CInputFilter::getString('thsjq');
		$CondList['thsjz'] = CInputFilter::getString('thsjz');
		$CondList['thsjz'] = !empty($CondList['thsjz']) ? $CondList['thsjz'].DEFAULT_END_TIME : '';
		$CondList['ddid'] = CInputFilter::getString('ddid');
		$CondList['ddgh'] = CInputFilter::getString('ddgh');
		$CondList['zffs'] = CInputFilter::getString('zffs');
		$CondList['kdgs'] = CInputFilter::getString('kdgs');
		$CondList['thdd'] = CInputFilter::getString('thdd');
		$CondList['sfrk'] = CInputFilter::getString('sfrk');
		$CondList['syz'] = CInputFilter::getString('syz');
		$CondList['qbdd'] = CInputFilter::getString('qbdd');

		$result = xsaaModel::model()->getReturnOrderList($page,$psize,$sequence,$order,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 退款[标识]
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-12-10
	 */
	public function actionOrderRefund(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->orderRefund($orderno);
		$this->renderJson($result);
	}

	/**
	 * @desc 退换货订单明细列表显示[只显示订单状态交易成功或拒收且退货换标识不为空]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 * @modify huyan 2015-12-25 添加查询条件
	 */
	public function actionGetReturnOrderDetailsList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$CondList = array();
		$CondList['fhsjq'] = CInputFilter::getString('fhsjq');
		$CondList['fhsjz'] = CInputFilter::getString('fhsjz');
		$CondList['fhsjz'] = !empty($CondList['fhsjz']) ? $CondList['fhsjz'].DEFAULT_END_TIME : '';
		$CondList['thsjq'] = CInputFilter::getString('thsjq');
		$CondList['thsjz'] = CInputFilter::getString('thsjz');
		$CondList['thsjz'] = !empty($CondList['thsjz']) ? $CondList['thsjz'].DEFAULT_END_TIME : '';
		$CondList['ddid'] = CInputFilter::getString('ddid');
		$CondList['ddgh'] = CInputFilter::getString('ddgh');
		$CondList['zffs'] = CInputFilter::getString('zffs');
		$CondList['kdgs'] = CInputFilter::getString('kdgs');
		$CondList['thdd'] = CInputFilter::getString('thdd');
		$CondList['sfrk'] = CInputFilter::getString('sfrk');
		$CondList['syz'] = CInputFilter::getString('syz');
		$CondList['qbdd'] = CInputFilter::getString('qbdd');

		$result = xsaaModel::model()->getReturnOrderDetailsList($page,$psize,$sign,$CondList);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 出货款号汇总列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 * @modify huyan 2015-12-23 添加查询条件
	 */
	public function actionGetShipmentGoodsList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$CondList = array();
		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';

		$CondList['fhsjq'] = CInputFilter::getString('fhsjq');
		$CondList['fhsjz'] = CInputFilter::getString('fhsjz');
		$CondList['fhsjz'] = !empty($CondList['fhsjz']) ? $CondList['fhsjz'].DEFAULT_END_TIME : '';
		
		$CondList['shsjq'] = CInputFilter::getString('shsjq');
		$CondList['shsjz'] = CInputFilter::getString('shsjz');
		$CondList['shsjz'] = !empty($CondList['shsjz']) ? $CondList['shsjz'].DEFAULT_END_TIME : '';

		$CondList['thsjq'] = CInputFilter::getString('thsjq');
		$CondList['thsjz'] = CInputFilter::getString('thsjz');
        $CondList['thsjz'] = !empty($CondList['thsjz']) ? $CondList['thsjz'].DEFAULT_END_TIME : '';

		$CondList['khzt'] = CInputFilter::getString('khzt');
		$CondList['ddzt'] = CInputFilter::getString('ddzt');
		$CondList['gys'] = CInputFilter::getString('gys');
		$CondList['szz'] = CInputFilter::getString('szz');
		$CondList['khly'] = CInputFilter::getString('khly');
		$CondList['cpkh'] = CInputFilter::getString('cpkh');
		$CondList['ddid'] = CInputFilter::getString('ddid');
		$CondList['ddgh'] = CInputFilter::getString('ddgh');

		$result = xsaaModel::model()->getShipmentGoodsList($page,$psize,$sign,$CondList);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 出货款号明细列表显示[只显示订单状态已发货、拒收、交易成功订单]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-12-10
	 * @modify huyan 2015-12-23 添加查询条件
	 */
	public function actionGetShipmentGoodsDetailsList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$CondList = array();
		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';
		$CondList['fhsjq'] = CInputFilter::getString('fhsjq');
		$CondList['fhsjz'] = CInputFilter::getString('fhsjz');
		$CondList['fhsjz'] = !empty($CondList['fhsjz']) ? $CondList['fhsjz'].DEFAULT_END_TIME : '';
		$CondList['shsjq'] = CInputFilter::getString('shsjq');
		$CondList['shsjz'] = CInputFilter::getString('shsjz');
        $CondList['shsjz'] = !empty($CondList['shsjz']) ? $CondList['shsjz'].DEFAULT_END_TIME : '';
		$CondList['thsjq'] = CInputFilter::getString('thsjq');
		$CondList['thsjz'] = CInputFilter::getString('thsjz');
		$CondList['thsjz'] = !empty($CondList['thsjz']) ? $CondList['thsjz'].DEFAULT_END_TIME : '';

		$CondList['khzt'] = CInputFilter::getString('khzt');
		$CondList['ddzt'] = CInputFilter::getString('ddzt');
		$CondList['gys'] = CInputFilter::getString('gys');
		$CondList['szz'] = CInputFilter::getString('szz');
		$CondList['khly'] = CInputFilter::getString('khly');
		$CondList['cpkh'] = CInputFilter::getString('cpkh');
		$CondList['ddid'] = CInputFilter::getString('ddid');
		$CondList['ddgh'] = CInputFilter::getString('ddgh');

		$result = xsaaModel::model()->getShipmentGoodsDetailsList($page,$psize,$sign,$CondList);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 加载出货或退换货订单详情
	 * @author WuJunhua
	 * @date 2015-12-11
	 */
	public function actionOrderShipmentOrReturnsDetails(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$orderCheckDetails = xsaaModel::model()->getOrderShipmentOrReturnsDetails($orderno);
		if(!empty($orderCheckDetails)){
			$this->assign('orderno',$orderCheckDetails);
			$this->display('cwgl/thhddxq.html');
		}
	}

	/**
	 * @desc 修改订单金额或已收金额
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-12-11
	 */
	public function actionChangeOrderMoney(){
		$orderno = CInputFilter::getString('orderno');
		$sign = CInputFilter::getInt('sign'); //标识
		$moneyInfo['money'] = CInputFilter::getFloat('money'); //订单金额或已收金额
		$moneyInfo['oldOrderMoney'] = CInputFilter::getFloat('oldOrderMoney'); //原来的订单金额
		$moneyInfo['oldReceivedMoney'] = CInputFilter::getFloat('oldReceivedMoney'); //原来的已收金额
		if(empty($orderno) || empty($sign)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->changeOrderMoney($orderno,$sign,$moneyInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取供应商进销存报表信息（按月）
	 * @return json $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-21
	 */
	public function actionGetMygysjxcByCond(){
		$result = array();
		$pageHtml = '';  //分页字符串

		$cond['gysID'] = CInputFilter::getString('gysID');
		$cond['gysName'] = CInputFilter::getString('gysName');
		$cond['cgwy'] = CInputFilter::getString('cgwy');
		$cond['gysfl'] = CInputFilter::getString('gysfl');
		$cond['jkfs'] = CInputFilter::getString('jkfs');
		$time = CInputFilter::getString('time');
		$cond['beginDate'] = $time != '' ? $time.'-01' : date('Y-m-01');
		$cond['endDate'] = date('Y-m-d',strtotime($cond['beginDate'].' +1 month -1 day '));

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数

		$result = cgabModel::model()->getGysjxcByCond($cond,$page,$psize);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}


	/**
	 * @desc 获取供应商进销存报表信息（自由时间）
	 * @return json $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-21
	 */
	public function actionGetGysjxcByCond(){
		$result = array();
		$pageHtml = '';  //分页字符串
		$cond['gysID'] = CInputFilter::getString('gysID');
		$cond['gysName'] = CInputFilter::getString('gysName');
		$cond['cgwy'] = CInputFilter::getString('cgwy');
		$cond['gysfl'] = CInputFilter::getString('gysfl');
		$cond['jkfs'] = CInputFilter::getString('jkfs');
		$cond['beginDate'] = CInputFilter::getString('beginDate');
		$cond['endDate'] = CInputFilter::getString('endDate');

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数

		$result = cgabModel::model()->getGysjxcByCond($cond,$page,$psize);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}


	/**
	 * @desc 获取供应商进销存报表信息（按月）
	 * @return json $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function actionGetMykhjxcByCond(){
		$result = array();
		$pageHtml = '';  //分页字符串

		$cond['cpfl'] = CInputFilter::getString('cpfl');
		$cond['cpzfl'] = CInputFilter::getString('cpzfl');
		$cond['cpkh'] = CInputFilter::getString('cpkh');
		$cond['gysID'] = CInputFilter::getString('gysID');
		$cond['gysName'] = CInputFilter::getString('gysName');
		$cond['cgwy'] = CInputFilter::getString('cgwy');
		$cond['jkfs'] = CInputFilter::getString('jkfs');
		$time = CInputFilter::getString('time');
		$cond['beginDate'] = $time != '' ? $time.'-01' : date('Y-m-01');
		$cond['endDate'] = date('Y-m-d',strtotime($cond['beginDate'].' +1 month -1 day '));
		$cond['SjBeginDate'] = CInputFilter::getString('SjBeginDate');
		$cond['SjEndDate'] = CInputFilter::getString('SjEndDate');

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数

		$result = cpaaModel::model()->getKhjxcByCond($cond,$page,$psize);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 获取供应商进销存报表信息（自由时间）
	 * @return json $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function actionGetKhjxcByCond(){
		$result = array();
		$pageHtml = '';  //分页字符串

		$cond['cpfl'] = CInputFilter::getString('cpfl');
		$cond['cpzfl'] = CInputFilter::getString('cpzfl');
		$cond['cpkh'] = CInputFilter::getString('cpkh');
		$cond['gysID'] = CInputFilter::getString('gysID');
		$cond['gysName'] = CInputFilter::getString('gysName');
		$cond['cgwy'] = CInputFilter::getString('cgwy');
		$cond['jkfs'] = CInputFilter::getString('jkfs');
		$cond['beginDate'] = CInputFilter::getString('beginDate');
		$cond['endDate'] = CInputFilter::getString('endDate');

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数

		$result = cpaaModel::model()->getKhjxcByCond($cond,$page,$psize);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}
	
}

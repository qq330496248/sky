<?php
/**
 * @desc 订单管理模块控制器操作类
 * @author WuJunhua
 * @date 2015-10-20
 */
class ddglController extends Controller{
	/**
	 * @desc 添加订单模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetTjddHtml(){
		$clientno = CInputFilter::getString('clientno');
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
		if(empty($clientno)){
			return ['res'=>'error','msg'=>'加载添加订单模板失败'];
		}
		$sign = CInputFilter::getString('sign');
		$clientData = khaaModel::model()->findCurrentClientData($symbol,$clientno,$sign);

		//下单时，读取设置的默认地址 (系统默认为广东广州)
		$defaultArea = syssetModel::model()->getDeafultAddr();
		if(empty($defaultArea)){
			return ['res'=>'error','msg'=>'获取默认地址信息失败'];
		}
		if($defaultArea['openOrClose'] == '开'){
			$provinceid = $defaultArea['provinceID'];
			$cityid = $defaultArea['cityID'];
			$areaid = $defaultArea['areaID'];
		}else{
			$provinceid = 0;
			$cityid = 0;
			$areaid = 0;
		}
		//若客户资料没有填写地址信息,则下单时读取系统默认地址
		if(!empty($clientData[0]['provinceid'])){
		    $appcityOptions = appCityModel::model()->getCity($clientData[0]['provinceid']);
		}else{
			$clientData[0]['provinceid'] = $provinceid; //默认省
			$appcityOptions = appCityModel::model()->getCity($provinceid); 
		}
		if(!empty($clientData[0]['cityid'])){
		    $appareaOptions = appAreaModel::model()->getArea($clientData[0]['cityid']);
		}else{
			$clientData[0]['cityid'] = $cityid; //默认市
			$appareaOptions = appAreaModel::model()->getArea($cityid);
		}
		if(empty($clientData[0]['areaid'])){
			$clientData[0]['areaid'] = $areaid; //默认区
		}

		//订单类型
		$ddlx='A002';
	    $OrderTypeOptions = xsaaModel::model()->getOrderType($ddlx);
	    //支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
	    //快递公司
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany();
	    //发票类型
	    $fplx='A004';
	    $InvoiceTypeOptions= xsaaModel::model()->getInvoiceType($fplx);
	    //省份
	    $appprovinceOptions = appprovinceModel::model()->getappprovince();
	    
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('clientData',$clientData[0]);
		$this->assign('OrderTypeOptions',$OrderTypeOptions);
		$this->assign('PaymentMethodOptions',$PaymentMethodOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('InvoiceTypeOptions',$InvoiceTypeOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->assign('appcityOptions',$appcityOptions);
		$this->assign('appareaOptions',$appareaOptions);
		$this->display('ddgl/tjdd.html');
	}

	/**
	 * @desc 下属客户添加订单模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	/*public function actionGetxskhTjddHtml(){
		$clientno = CInputFilter::getString('clientno');
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
		if(empty($clientno)){
			return array('res'=>'error','msg'=>'加载添加订单模板失败');
		}
		$clientData = khaaModel::model()->findCustomersDetailsData($symbol,$clientno);
		//订单类型
		$ddlx='A002';
	    $OrderTypeOptions = xsaaModel::model()->getOrderType($ddlx);
	    //支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
	    //快递公司
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany();
	    //发票类型
	    $fplx='A004';
	    $InvoiceTypeOptions= xsaaModel::model()->getInvoiceType($fplx);
	    //省份
	    $appprovinceOptions = appprovinceModel::model()->getappprovince();
	    
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('clientData',$clientData[0]);
		$this->assign('OrderTypeOptions',$OrderTypeOptions);
		$this->assign('PaymentMethodOptions',$PaymentMethodOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('InvoiceTypeOptions',$InvoiceTypeOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('ddgl/tjdd.html');
	}*/

	/**
	 * @desc 客户订单模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetKhddHtml(){
		//订单状态
		$ddzt='A003';
	    $OrderStatusOptions = xsaaModel::model()->getOrderStatus($ddzt);
	    //进线方式选项卡
		$jxfs='A008';
		$IntoLineOptions = syssetModel::model()->getIntoLine($jxfs);
		//分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
	    //订单类型
		$ddlx='A002';
	    $OrderTypeOptions = xsaaModel::model()->getOrderType($ddlx);
	    //客户意向选项卡
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		//快递公司
	    $DeliveryCompanyOptions= xsaaModel::model()->getDeliveryCompany();
	    //是否记账
	    $sfjz='A020';
	    $WhetherAccountingOptions= xsaaModel::model()->getWhetherAccounting($sfjz);
	    //审核状态
	    $shzt='A022';
	    $AuditStatusOptions= xsaaModel::model()->getAuditStatus($shzt);

	     //工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
	     //省份
	    $appprovinceOptions = appprovinceModel::model()->getappprovince();

	    //smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('OrderStatusOptions',$OrderStatusOptions);
		$this->assign('IntoLineOptions',$IntoLineOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('PaymentMethodOptions',$PaymentMethodOptions);
		$this->assign('OrderTypeOptions',$OrderTypeOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('ClientSourceOptions',$ClientSourceOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('WhetherAccountingOptions',$WhetherAccountingOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('AuditStatusOptions',$AuditStatusOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);

		$this->display('ddgl/khdd.html');
	}

	/**
	 * @desc 订单审核模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetDdshHtml(){
		//分组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//订单类型
		$ddlx='A002';
	    $OrderTypeOptions = xsaaModel::model()->getOrderType($ddlx);
	    //客户意向选项卡
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//省份
	    $appprovinceOptions = appprovinceModel::model()->getappprovince();
	    //订单审核状态
		$ddshzt='A026';
		$OrderAuditStatusOptions = syssetModel::model()->getAuditStatus($ddshzt);

	    $sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
	    $this->assign('GroupsTypeOptions',$GroupsTypeOptions);
	    $this->assign('OrderTypeOptions',$OrderTypeOptions);
	    $this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
	    $this->assign('appprovinceOptions',$appprovinceOptions);
	    $this->assign('OrderAuditStatusOptions',$OrderAuditStatusOptions);
	    $this->assign('defaultStartTime',DEFAULT_START_TIME);
	    $this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);

		$this->display('ddgl/ddsh.html');
	}
	
	/**
	 * @desc 处理省份发送过来的参数，并返回该省份下城市的数据
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionCity(){
		$provinceId = CInputFilter::getString('provinceId');
		if(empty($provinceId)){
			return false;
		}
		$city = appCityModel::model()->getCity($provinceId);
		if(empty($city)){
			return false;
		}
		$this->renderJson(array('result' => 'success','cities' => $city));
	}

	/**
	 * @desc 处理城市发送过来的参数，并返回该城市下区县的数据
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionArea(){
		$cityId = CInputFilter::getString('cityId');
		if(empty($cityId)){
			return false;
		}
		$area = appAreaModel::model()->getArea($cityId);
		if(empty($area)){
			return false;
		}
		$this->renderJson(array('result' => 'success','areas' => $area));
	}

	/**
	 * @desc 获取客户订单列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-10-28
	 */
	public function actionGetClientOrder(){
		$result = [];  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		//订单列表顺序倒序输出
		$sequence = CInputFilter::getString('sequence') != "" ? CInputFilter::getString('sequence') : "DESC";
		$order = CInputFilter::getString('order') != "" ? CInputFilter::getString('order') : "xsaa01";
		
		$CondList = array();
		$CondList['jefwd'] = CInputFilter::getString('jefwd');
		$CondList['jefwx'] = CInputFilter::getString('jefwx');
		$CondList['sdsjq'] = CInputFilter::getString('sdsjq');
		$CondList['sdsjz'] = CInputFilter::getString('sdsjz');
		$CondList['sdsjz'] = !empty($CondList['sdsjz']) ? $CondList['sdsjz'].DEFAULT_END_TIME : '';

		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';

		$CondList['fhsjq'] = CInputFilter::getString('fhsjq');
		$CondList['fhsjz'] = CInputFilter::getString('fhsjz');
		$CondList['fhsjz'] = !empty($CondList['fhsjz']) ? $CondList['fhsjz'].DEFAULT_END_TIME : '';

		$CondList['qssjq'] = CInputFilter::getString('qssjq');
		$CondList['qssjz'] = CInputFilter::getString('qssjz');
		$CondList['qssjz'] = !empty($CondList['qssjz']) ? $CondList['qssjz'].DEFAULT_END_TIME : '';

		$CondList['ddid'] = CInputFilter::getString('ddid');
		$CondList['ddkh'] = CInputFilter::getString('ddkh');
		$CondList['cpmc'] = CInputFilter::getString('cpmc');
		$CondList['khid'] = CInputFilter::getString('khid');
		$CondList['khxm'] = CInputFilter::getString('khxm');
		$CondList['phone'] = CInputFilter::getString('phone');
		$CondList['kddh'] = CInputFilter::getString('kddh');
		$CondList['ddwqs'] = CInputFilter::getString('ddwqs');
		$CondList['shgh'] = CInputFilter::getString('shgh');
		$CondList['ddzt'] = CInputFilter::getString('ddzt');

		$CondList['jxfs'] = CInputFilter::getString('jxfs');
		$CondList['khfz'] = CInputFilter::getString('khfz');
		$CondList['ddlx'] = CInputFilter::getString('ddlx');
		$CondList['khly'] = CInputFilter::getString('khly');
		$CondList['khyx'] = CInputFilter::getString('khyx');
		$CondList['kdgs'] = CInputFilter::getString('kdgs');
		$CondList['sfjz'] = CInputFilter::getString('sfjz');
		$CondList['zffs'] = CInputFilter::getString('zffs');
		$CondList['shzt'] = CInputFilter::getString('shzt');
		/*$workNumber=CInputFilter::getString('ddgsgh');
		$workNumberArr = explode(':',$workNumber);
		$CondList['jobnum']=$workNumberArr[0];*/

		$addrInfo = array();
		$addrInfo['khsf']= CInputFilter::getString('khsf');
		$addrInfo['city']= CInputFilter::getString('city');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = xsaaModel::model()->getClientOrder($page,$psize,$sequence,$order,$CondList,$addrInfo,$sign);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$result['sequence'] = $sequence;
		$result['order'] = $order;
		$this->renderJson($result);
	}

	/**
	 * @desc 添加订单
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function actionAddOrder(){
		$orderInfo = array();
		$addrInfo = array();
		$orderInfo['xsaa37'] = CInputFilter::getString('gsgh');//归属工号
		$orderInfo['xsaa38'] = CInputFilter::getString('dlxm');//登录姓名
		$orderInfo['xsaa04'] = CInputFilter::getString('clientno');//客户编号
		$orderInfo['xsaa05'] = CInputFilter::getString('khname');//客户姓名
		$orderInfo['xsaa06'] = CInputFilter::getString('khphone'); //客户手机
		$orderInfo['xsaa07'] = CInputFilter::getString('telphone'); //客户电话
		$addrInfo['provinceid'] = CInputFilter::getString('province');//省份
		$addrInfo['cityid'] = CInputFilter::getString('city');//城市
		$addrInfo['areaid'] = CInputFilter::getString('area');//区县
		$addrInfo['deaddress'] = CInputFilter::getString('deaddress');//地址
		$orderInfo['xsaa10'] = CInputFilter::getString('postcode');//邮编
		$orderInfo['xsaa48'] = Yii::app()->session['account']; //下单人(销售工号)

		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[1]; //动作说明(跟进记录)
		$orderInfo['xsaa16'] = CInputFilter::getFloat('ddyf'); //运费
		$orderInfo['xsaa20'] = CInputFilter::getFloat('ysdj'); //已收定金
		$orderInfo['xsaa11'] = CInputFilter::getString('ddlx'); //订单类型
		$orderInfo['xsaa13'] = CInputFilter::getString('zffs'); //支付方式
		$orderInfo['xsaa17'] = CInputFilter::getFloat('goodTotalPrice'); //商品总价(订单总额)
		$orderInfo['xsaa42'] = CInputFilter::getFloat('goodTotalNum'); //商品总数
		$orderInfo['xsaa19'] = CInputFilter::getFloat('ddsszj'); //应收金额(实收金额，减免金额为0时;订单总额=实收金额)
		$orderInfo['xsaa33'] = CInputFilter::getString('ddyj'); //订单业绩
		$ddyj = CInputFilter::getString('ddyj'); //订单业绩

		$kuanhao = CInputFilter::getArray('goodkuanhao','string');

		//付款方式为货到付款时，订单状态只能是未确认
		if($orderInfo['xsaa13'] == ddglConst::$PayWay[4]){
			$orderInfo['xsaa29'] = ddglConst::$OrderStatus[3]; //订单状态[新增订单时设为未确认]
		}else{
			if($orderInfo['xsaa20'] == $orderInfo['xsaa19']){
				$orderInfo['xsaa29'] = ddglConst::$OrderStatus[6];   //已收定金等于实收金额，订单状态为已支付
			}
			$orderInfo['xsaa21'] = $orderInfo['xsaa19'] - $orderInfo['xsaa20']; //代收金额
			if($orderInfo['xsaa21'] != 0){
				$orderInfo['xsaa29'] = ddglConst::$OrderStatus[4];   //已收定金不等于订单总额，订单状态为等待支付
			}
		}
		$orderInfo['xsaa41'] = CInputFilter::getString('kdgs'); //快递公司
		$orderInfo['xsaa14'] = CInputFilter::getString('fplx'); //发票类型
		$orderInfo['xsaa39'] = $orderInfo['xsaa23'] = date('Y-m-d H:i:s'); //订单创建时间
		$orderInfo['xsaa61'] = date('Y-m-d'); //下单年月日(业绩分组)
		//单个或多个商品信息
		$goodItems = CInputFilter::getArray('goodItems','string');

		$result = xsaaModel::model()->addOrder($orderInfo,$addrInfo,$goodItems,$ddyj,$kuanhao);
		$this->renderJson($result);
	}

	/**
	 * @desc 加载订单详情
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function actionOrderDetails(){
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
		//支付方式
	    $zffs='A024';
	    $PaymentMethodOptions= xsaaModel::model()->getPaymentMethod($zffs);
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
		//拒收原因
		$RejectReasons = xsaeModel::model()->getAllRejectReasons();
		//拒收原因对应的选项
		$rejectId = '1';
		$RejectContent = xsafModel::model()->getAllRejectContent($rejectId);
		//手机加拨
		$typeencode = 'A032';
		$DialPhone = syssetModel::model()->getInformation($typeencode);
		
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('PaymentMethodOptions',$PaymentMethodOptions);
		$this->assign('DeliveryCompanyOptions',$DeliveryCompanyOptions);
		$this->assign('InvoiceTypeOptions',$InvoiceTypeOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('RejectReasons',$RejectReasons);
		$this->assign('RejectContent',$RejectContent);
		$this->assign('DialPhone',$DialPhone['338']);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$orderDetails = xsaaModel::model()->getOrderDetails($ordernum,$symbol);

		if(!empty($orderDetails)){
			//市
		    $appcityOptions = appCityModel::model()->getCity($orderDetails['provinceid']);
		    //区
		    $appareaOptions = appAreaModel::model()->getArea($orderDetails['cityid']);
		    //号码屏蔽
		    $mobile = '';
		    if(!empty($orderDetails['xsaa06'])){
				$result = syssetModel::model()->handleNumberShield($orderDetails['xsaa06']);
				if(!is_array($result)){
					$mobile = $result;
				}
		    }
		    $this->assign('appcityOptions',$appcityOptions);
		    $this->assign('appareaOptions',$appareaOptions);
			$this->assign('orderno',$orderDetails);
			$this->assign('mobile',$mobile);
			$this->display('ddgl/ddxq.html');
		}
	}

	/**
	 * @desc 修改订单信息
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function actionUpdateOrderMsg(){
		$orderInfo = array();
		$addrInfo = array();
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误'));
		}
		//$orderInfo['xsaa38'] = CInputFilter::getString('xdr'); //下单人
		//$orderInfo['xsaa37'] = CInputFilter::getString('yjfp'); //业绩分配工号
		$orderInfo['xsaa05'] = CInputFilter::getString('khname'); //客户姓名
		$orderInfo['xsaa06'] = CInputFilter::getString('khphone');//客户手机
		$orderInfo['xsaa07'] = CInputFilter::getString('telphone');//客户电话
		$addrInfo['provinceid'] = CInputFilter::getString('province');//省份
		$addrInfo['cityid'] = CInputFilter::getString('city');//城市
		$addrInfo['areaid'] = CInputFilter::getString('area');//区县
		$addrInfo['deaddress'] = CInputFilter::getString('deaddress');//地址
		$orderInfo['xsaa10'] = CInputFilter::getString('postcode');//邮编
		$orderInfo['xsaa03'] = CInputFilter::getString('kddh');//快递单号
		$orderMoney = CInputFilter::getFloat('ddje'); //订单金额
		$orderInfo['xsaa19'] = $orderMoney; //订单实收金额
		$orderInfo['xsaa20'] = CInputFilter::getFloat('khysdj');//已收定金
		$orderInfo['xsaa21'] = CInputFilter::getFloat('dsje');//代收金额
		$orderInfo['xsaa16'] = CInputFilter::getFloat('khddyf');//已收运费
		$orderInfo['xsaa36'] = CInputFilter::getString('khddbz');//已收备注
		$orderInfo['xsaa14'] = CInputFilter::getString('khfplx');//发票类型
		$orderInfo['xsaa13'] = CInputFilter::getString('ddzffs');//支付方式
		$orderInfo['xsaa41'] = CInputFilter::getString('ddkdgs');//快递公司
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[2].$orderInfo['xsaa20']; //动作说明(跟进标签)
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa33'] = CInputFilter::getString('yjfp'); //订单业绩
		
		//支付方式是货到付款时，订单状态只能是未确认状态
		if($orderInfo['xsaa13'] == ddglConst::$PayWay[4]){
			$orderInfo['xsaa29'] = ddglConst::$OrderStatus[3];
		}
		if($orderInfo['xsaa13'] != ddglConst::$PayWay[4]){
			if($orderMoney == $orderInfo['xsaa20']){
				$orderInfo['xsaa29'] = ddglConst::$OrderStatus[6]; //已收定金等于订单总额，订单状态为已支付
			}else{
				$orderInfo['xsaa29'] = ddglConst::$OrderStatus[4]; //已收定金不等于订单总额，订单状态为等待支付
			}
		}
		$orderInfo['xsaa21'] = $orderMoney - $orderInfo['xsaa20']; //代收金额
		$result = xsaaModel::model()->updateOrderMsg($orderNo,$orderInfo,$addrInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 把订单设为作废
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function actionSetOrderUseless(){
		$orderNo = CInputFilter::getString('orderno');
		$orderInfo['xsaa29'] = ddglConst::$OrderStatus[10]; //已作废
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[6]; //动作说明(跟进标签)
		if(empty($orderNo)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->setOrderUseless($orderNo,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除订单信息
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function actionDeleteOrderData(){
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误'));
		}
		$result = xsaaModel::model()->deleteOrderData($orderNo);
		$this->renderJson($result);
	}

	/**
	 * @desc 系统设置->数据清理->删除订单
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function actionDelCustomerOrder(){
		$zfdd='已作废';
		$wqrdd='未确认';
		$searchType = CInputFilter::getInt('searchtype');
		$xdsjq = CInputFilter::getString('xdsjq');
		$xdsjz = CInputFilter::getString('xdsjz');
		$xdsjz = !empty($xdsjz) ? $xdsjz.DEFAULT_END_TIME : '';
		$result = xsaaModel::model()->DelCustomerOrder($searchType,$xdsjq,$xdsjz,$zfdd,$wqrdd);
		$this->renderJson($result);
	}

	/**
	 * @desc 判断该客户3天内有没重复下单
	 * @author WuJunhua
	 * @date 2015-11-03
	 */
	public function actionCheckClientOrder(){
		$clientNo = CInputFilter::getString('clientno');
		if(empty($clientNo)){
			return false;
		}
		$result = xsaaModel::model()->checkClientOrder($clientNo);
		$this->renderJson($result);
	}

	/**
	 * @desc 加载客户订单不同状态的页面
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	public function actionGetKhztddHtml(){
		$status = CInputFilter::getInt('status');
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('status',$status);
		$this->display('ddgl/khdd_ztlb.html');
	}

	/**
	 * @desc 根据不同的订单状态来获取订单列表
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	public function actionGetOrderList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		//订单列表顺序倒序输出
		$sequence = CInputFilter::getString('sequence') != "" ? CInputFilter::getString('sequence') : "DESC";
		$order = CInputFilter::getString('order') != "" ? CInputFilter::getString('order') : "xsaa01";

		//获取订单状态
		$status = CInputFilter::getInt('orderstatus');  
		$orderStatus = ddglConst::$OrderStatus[$status];
		$result = xsaaModel::model()->getOrderList($page,$psize,$sequence,$order,$orderStatus);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 订单审核列表显示[只显示订单状态为已确认、已支付订单]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function actionGetCheckingOrder(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数

		$CondList = array();
		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';
		$CondList['ddid'] = CInputFilter::getString('ddid');
		$CondList['khid'] = CInputFilter::getString('khid');
		$CondList['kddh'] = CInputFilter::getString('kddh');
		$CondList['ddshzt'] = CInputFilter::getString('ddshzt');
		$CondList['khfz'] = CInputFilter::getString('khfz');
		$CondList['khyx'] = CInputFilter::getString('khyx');
		$CondList['ddlx'] = CInputFilter::getString('ddlx');
		$addrInfo = array();
		$addrInfo['khsf']= CInputFilter::getString('khsf');
		$addrInfo['city']= CInputFilter::getString('city');

		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = xsaaModel::model()->getCheckingOrder($page,$psize,$CondList,$sign,$addrInfo);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 单个/批量提审订单【客审】
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function actionDeliverOrders(){
		//提审的订单编号
		$orderno = CInputFilter::getArray('orderno','string');
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa25'] = date('Y-m-d H:i:s'); //订单审核时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[5]; //动作说明(跟进标签)
		$orderInfo['xsaa30'] = ddglConst::$ApprovalStatus[2]; //已客审
		$result = xsaaModel::model()->deliverOrders($orderno,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 单个/批量确认到审单
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function actionConfirmToDeliverOrders(){
		//提审的订单编号
		$orderno = CInputFilter::getArray('orderno','string');
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error','msg' => '操作有误'));
		}
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa30'] = ddglConst::$ApprovalStatus[1]; //审核状态为已确认
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[4]; //动作说明(跟进标签)
		$orderInfo['xsaa50'] = ddglConst::$WhetherConfirmedChecked[1]; //已确认到审单
		$result = xsaaModel::model()->confirmToDeliverOrders($orderno,$orderInfo);
		$this->renderJson($result);
	}
	
	/**
	 * @desc 加载订单审核详情
	 * @author WuJunhua
	 * @date 2015-11-06
	 */
	public function actionOrderCheckDetails(){
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
		
		$orderCheckDetails = xsaaModel::model()->getOrderCheckDetails($ordernum,$symbol);
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
			$this->display('ddgl/ddshxq.html');
		}
	}

	/**
	 * @desc 修改订单收货人信息[客审/财审的审核详情]
	 * @author WuJunhua
	 * @date 2015-11-09
	 */
	public function actionSaveOrderMsg(){
		$orderInfo = [];
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('res'=>'error','msg'=>'操作有误,请联系系统管理员'));
		}
		$orderInfo['xsaa05'] = CInputFilter::getString('khname'); //收货人姓名
		$orderInfo['xsaa06'] = CInputFilter::getString('khphone'); //收货人手机
		$orderInfo['xsaa07'] = CInputFilter::getString('telphone'); //收货人电话
		$orderInfo['xsaa36'] = CInputFilter::getString('khddbz'); //订单备注
		$orderInfo['xsaa14'] = CInputFilter::getString('khfplx'); //发票类型
		$orderInfo['xsaa41'] = CInputFilter::getString('ddkdgs'); //快递公司
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单跟新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[9]; //动作说明(跟进标签)
		$addrInfo['provinceid'] = CInputFilter::getString('province');//省份
		$addrInfo['cityid'] = CInputFilter::getString('city');//城市
		$addrInfo['areaid'] = CInputFilter::getString('area');//区县
		$addrInfo['deaddress'] = CInputFilter::getString('deaddress');//地址
		$orderInfo['xsaa10'] = CInputFilter::getString('postcode');//邮编
		
		$result = xsaaModel::model()->saveOrderMsg($orderNo,$orderInfo,$addrInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改订单类型[客审/财审的审核详情]
	 * @author WuJunhua
	 * @date 2016-03-21
	 */
	public function actionChangeOrderType(){
		$orderInfo = [];
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('res'=>'error','msg'=>'操作有误,请联系系统管理员'));
		}
		$orderInfo['xsaa11'] = CInputFilter::getString('ddlx');//订单类型
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单跟新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[21].$orderInfo['xsaa11']; //动作说明(跟进标签)
		$result = xsaaModel::model()->changeOrderType($orderNo,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 订单审核详情的撤回修改[已确认状态改为未确认状态;已确认到提审改为未确认到提审]
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-11-09
	 */
	public function actionOrderWithdrawalModify(){
		//撤回修改的订单编号
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			$this->renderJson(array('res'=>'error','msg'=>'操作有误,请联系系统管理员'));
		}
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[7]; //动作说明(撤回未确认)
		$orderInfo['xsaa50'] = ddglConst::$WhetherConfirmedChecked[2]; //未确认到审单
		$orderInfo['xsaa30'] = ''; //审核状态
		$result = xsaaModel::model()->orderWithdrawalModify($orderno,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 确认收货
	 * @author WuJunhua
	 * @date 2015-11-09
	 */
	public function actionConfirmReceiving(){
		$orderNo = CInputFilter::getString('orderno');
		$orderInfo['xsaa29'] = ddglConst::$OrderStatus[2]; //交易成功
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa28'] = date('Y-m-d H:i:s'); //订单签收时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[10]; //动作说明(确认收货)
		if(empty($orderNo)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->confirmReceiving($orderNo,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取订单(审核)详情的商品信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function actionGetOrderDetailGoodsMsg(){
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$result = xsaaModel::model()->getOrderDetailGoodsMsg($orderNo);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取订单明细失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取订单跟进记录
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function actionGetOrderFollowRecording(){
		$orderNo = CInputFilter::getString('orderno');
	    $pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		if(empty($orderNo)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$result = xsadModel::model()->getOrderFollowRecording($page,$psize,$orderNo);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取拒收原因选择项
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function actionGetRejectionContent(){
		$rejectId = CInputFilter::getString('rejectid');
		if(empty($rejectId)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$result = xsafModel::model()->getAllRejectContent($rejectId);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取拒收原因对应的选项列表失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 拒收订单
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function actionRejectOrders(){
		$orderNo = CInputFilter::getString('orderno');
		$rejectContent = CInputFilter::getString('jsyynr');
		$orderInfo['xsaa36'] = CInputFilter::getString('thbz'); //退货备注
		$orderInfo['xsaa29'] = ddglConst::$OrderStatus[9]; //拒收
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa51'] = date('Y-m-d H:i:s'); //退货换时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[12].$rejectContent; //拒收原因
		$orderInfo['xsaa49'] = ddglConst::$GoodsReturnsLogo[1]; //退货标识
		$orderInfo['xsaa44'] = CInputFilter::getString('thje') != '' ? CInputFilter::getString('thje') : 0; //退货金额
		if(empty($orderNo)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->rejectOrders($orderNo,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 撤销退货(撤销拒收)
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function actionRevocationReturn(){
		$orderNo = CInputFilter::getString('orderno');
		$orderInfo['xsaa29'] = ddglConst::$OrderStatus[8]; //已发货
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[15]; //撤销拒收(动作说明)
		$orderInfo['xsaa49'] = ''; //订单更新时间
		if(empty($orderNo)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->revocationReturn($orderNo,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 撤销收货
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function actionRevocationReceiving(){
		$orderNo = CInputFilter::getString('orderno');
		$orderInfo['xsaa29'] = ddglConst::$OrderStatus[8]; //已发货
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[16]; //撤销收货(动作说明)
		$orderInfo['xsaa49'] = '';
		if(empty($orderNo)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->revocationReturn($orderNo,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 物流发货详情的撤回修改[货到付款的订单:待发货状态改为未确认状态;非货到付款的订单:待发货状态改为已支付状态;]
	 * @return json $result 操作的结果
	 * @author WuJunhua
	 * @date 2015-11-23
	 */
	public function actionOrderBackToUnConfirm(){
		//撤回修改的订单编号
		$orderno = CInputFilter::getString('orderno');
		$backReason = CInputFilter::getString('backReason');
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[14]; //动作说明(物流撤销)
		$orderInfo['xsaa50'] = ddglConst::$WhetherConfirmedChecked[2]; //未确认到审单
		$orderInfo['xsaa30'] = ''; //审核状态
		$result = xsaaModel::model()->orderBackToUnConfirm($orderno,$orderInfo,$backReason);
		$this->renderJson($result);
	}

	/**
	 * @desc 添加待办事项
	 * @author WuJunhua
	 * @date 2015-11-24
	 */
	public function actionAddToDoThings(){
		$followInfo = array();
		$clientno = CInputFilter::getString('clientno'); //客户编号
		$followInfo['xsad01'] = CInputFilter::getString('orderno');//订单号
		$followPerson = CInputFilter::getString('gjr'); //跟进人
		$followPersonArr = explode(':', $followPerson);
		if(!empty($followPerson)){
			$followInfo['xsad02'] = $followPersonArr[0];//跟进人工号
			$followInfo['xsad03'] = $followPersonArr[1];//跟进人姓名
			$followInfo['xsad11'] = '是';//是否为待办事项
		}
		$followInfo['xsad04'] = date('Y-m-d H:i:s');//跟进时间：当前操作时间
		$followInfo['xsad05'] = CInputFilter::getString('dbsj') != '' ? CInputFilter::getString('dbsj') : date('Y-m-d H:i:s'); //待办时间，默认设置为当前时间
		$followInfo['xsad06'] = CInputFilter::getString('content'); //跟进记录
		$followInfo['xsad07'] = Yii::app()->session['account'];//安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name'];//安排人姓名
		$followInfo['xsad09'] = CInputFilter::getString('fz');//分组

		if(!empty($followInfo['xsad01'])){
			$result = xsaaModel::model()->addToDoThings($clientno,$followInfo);
		}else{
			$this->renderJson(array('res'=>'error','msg'=>'操作有误,请重新操作'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 加载部分退换货页面
	 * @author WuJunhua
	 * @date 2015-12-03
	 */
	public function actionOrderSectionReturns(){
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			return false;
		}
		//拒收原因
		$RejectReasons = xsaeModel::model()->getAllRejectReasons();
		//拒收原因对应的选项
		$rejectId = '1';
		$RejectContent = xsafModel::model()->getAllRejectContent($rejectId);

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('RejectReasons', $RejectReasons);
		$this->assign('RejectContent', $RejectContent);
		$orderDetails = xsaaModel::model()->OrderSectionReturns($orderNo);
		if(!empty($orderDetails)){
			$this->assign('orderno',$orderDetails);
			$this->display('ddgl/bfthh.html');
		}
	}

	/**
	 * @desc 交易成功后的订单确定退货(标识作用)
	 * @author WuJunhua
	 * @date 2015-12-04
	 */
	public function actionOrderConfirmReturn(){
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('result' => 'error','msg' => '操作有误'));
		}
		//单个或多个商品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		$orderInfo['xsaa49'] = ddglConst::$GoodsReturnsLogo[1]; //退货标识
		$returnReason = CInputFilter::getString('jsyynr');
		$orderInfo['xsaa44'] = CInputFilter::getString('thje'); //退换货金额
		$orderInfo['xsaa36'] = CInputFilter::getString('remark'); 
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa51'] = date('Y-m-d H:i:s'); //退货换时间
		$result = xsaaModel::model()->OrderConfirmReturn($orderNo,$orderInfo,$goodItems,$returnReason);
		$this->renderJson($result);
	}

	/**
	 * @desc 交易成功后的订单确定换货(标识作用)
	 * @author WuJunhua
	 * @date 2015-12-04
	 */
	public function actionOrderConfirmExchange(){
		$orderNo = CInputFilter::getString('orderno');
		if(empty($orderNo)){
			$this->renderJson(array('result' => 'error','msg' => '操作有误'));
		}
		//单个或多个商品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		$orderInfo['xsaa49'] = ddglConst::$GoodsReturnsLogo[2]; //换货标识
		$returnReason = CInputFilter::getString('jsyynr');
		$orderInfo['xsaa44'] = CInputFilter::getString('thje'); //退换货金额
		$orderInfo['xsaa36'] = CInputFilter::getString('remark'); 
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa51'] = date('Y-m-d H:i:s'); //退货换时间
		$result = xsaaModel::model()->OrderConfirmReturn($orderNo,$orderInfo,$goodItems,$returnReason);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取所有工号信息
	 * @author WuJunhua
	 * @date 2015-12-07
	 */
	public function actionGetAllWorkNumber(){
		$result = rylistModel::model()->getWorkNumber();
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'获取工号信息有误'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 下单分业绩时根据工号id获取工号信息
	 * @author WuJunhua
	 * @date 2015-12-07
	 */
	public function actionGetWorkNumberList(){
		$workId = CInputFilter::getInt('workid');
		$result = rylistModel::model()->getNumberList($workId);
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'获取工号信息有误'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 订单详情页面分业绩操作
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	public function actionOrderTurnPerformance(){
		$orderNo = CInputFilter::getString('orderno');
		$orderInfo['xsaa33'] = CInputFilter::getString('yjfp');
		$orderInfo['xsaa39'] = date('Y-m-d H:i:s'); //订单更新时间
		$orderInfo['xsaa40'] = ddglConst::$OrderDynamic[19].$orderInfo['xsaa33']; //动作说明(分配业绩)
		if(empty($orderNo)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = xsaaModel::model()->orderTurnPerformance($orderNo,$orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 根据订单号获取订单列表
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-12-14
	 */
	public function actiongetObtainorderdetails(){
		$result = array();  //列表信息结果
		$orderNo = CInputFilter::getString('orderno');
		$result = xsabModel::model()->getObtainorderdetails($orderNo);
		$this->renderJson($result);
	}

	/**
	 * @desc 添加（修改）订单商品
	 * @author huyan
	 * @date 2015-12-15
	 */
	public function actionChangeOrderAudit(){
		$orderInfo = array();
		$orderInfo['xsab01'] = CInputFilter::getString('orderno');//订单号
		//$orderInfo['xsab03']=CInputFilter::getString('styleNum');//款号
		$orderInfo['xsab07'] = CInputFilter::getFloat('goodTotalPrice'); //商品总价(订单总额)
		$orderInfo['xsab04'] = CInputFilter::getFloat('goodTotalNum'); //商品总数
		//要删除的商品详情款号
		$ordernomx = CInputFilter::getArray('ordernomx','string');
		//单个或多个商品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		$kuanhao = CInputFilter::getArray('goodkuanhao','string');
		$result = xsabModel::model()->ChangeOrderAudit($orderInfo,$goodItems,$ordernomx,$kuanhao);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改商品价格
	 * @author huyan
	 * @date 2015-12-29
	 */
	public function actionChangeOrderprice(){
		$orderInfo = array();
		$orderno= CInputFilter::getString('orderno');//订单号
		//$orderInfo['xsab05'] = CInputFilter::getFloat('spjg'); //商品价格
		$spsl = CInputFilter::getFloat('spsl'); //商品数量
		$orderInfo['xsab06'] = CInputFilter::getFloat('spjg'); //折后售价
		$orderInfo['xsab08']=CInputFilter::getFloat('xiaoji'); //折后总价
		$kuanhao=CInputFilter::getFloat('goodNum'); //商品款号
		$orderInfo['xsab07']=CInputFilter::getFloat('xiaoji'); //商品小计
		$result = xsabModel::model()->ChangeOrderprice($orderInfo,$orderno,$kuanhao,$spsl);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改商品数量
	 * @author huyan
	 * @date 2015-12-29
	 */
	public function actionChangeOrderNumber(){
		$orderInfo = array();
		$orderno= CInputFilter::getString('orderno');//订单号
		$orderInfo['xsab04'] = CInputFilter::getFloat('spsl'); //商品数量
		$orderInfo['xsab08']=CInputFilter::getFloat('xiaoji'); //折后总价
		$kuanhao=CInputFilter::getFloat('goodNum'); //商品款号
		$orderInfo['xsab07']=CInputFilter::getFloat('xiaoji'); //商品小计
		$result = xsabModel::model()->ChangeOrderNumber($orderInfo,$orderno,$kuanhao);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除商品
	 * @author huyan
	 * @date 2015-12-29
	 */
	public function actionDeleteCommodity(){
		$orderno = CInputFilter::getString('orderno');//订单号
		//要删除的商品款号
		$ordernomx = CInputFilter::getArray('ordernomx','string');
		$result = xsabModel::model()->DeleteCommodity($orderno,$ordernomx);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除订单跟进记录
	 * @author WuJunhua
	 * @date 2015-12-30
	 */
	public function actionDeleteOrderFollowRecording(){
		$followId = CInputFilter::getInt('followid');
		if(empty($followId)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误'));
		}
		$result = xsadModel::model()->deleteOrderFollowRecording($followId);
		$this->renderJson($result);
	}

	/**
	 * @desc 系统设置->数据清理->删除订单跟进记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function actionDelOrderFollowRecords(){
		$CurrentTime= date('Y-m-d H:i'); 
		$ddsjq = CInputFilter::getString('ddsjq');
		$ddsjz = CInputFilter::getString('ddsjz');
		$dqsj=(strtotime($CurrentTime));
		$gjsj=(strtotime($ddsjq));
		$diff = (int)(($dqsj-$gjsj)/(24*3600));
		if (!empty($ddsjq)&&empty($ddsjz)) {
			if ($diff<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的订单跟进记录'));
		    }
		}
		$rksjz=(strtotime($ddsjz));
		$diff1 = (int)(($dqsj-$rksjz)/(24*3600));
		if (empty($ddsjq)&&!empty($ddsjz)) {
			if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的订单跟进记录'));
		    }
		}
		if (!empty($ddsjq)&&!empty($ddsjz)) {
            if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的订单跟进记录'));
		    }
		}
		$ddsjz = !empty($ddsjz) ? $ddsjz.DEFAULT_END_TIME : '';
		$result = xsadModel::model()->DelOrderFollow($ddsjq,$ddsjz);
		$this->renderJson($result);
	}

	/**
	 * @desc 客户的订单历史交易记录模板显示
	 * @author WuJunhua
	 * @date 2016-01-21
	 */
	public function actionGetDdcjjlHtml(){
		$clientno = CInputFilter::getString('clientno');
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('clientno',$clientno);
		$this->display('ddgl/ddcjjl.html');
	}

	/**
	 * @desc 获取客户的订单交易历史记录列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2016-01-21
	 */
	public function actionGetClientOrderRecord(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$clientno = CInputFilter::getString('clientno');
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = xsaaModel::model()->getClientOrderRecord($clientno,$page,$psize);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货订单[拒收状态的订单且订单总额>退货金额]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2016-03-09
	 */
	public function actionGetReturnOrder(){
		$result = [];  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		//查询条件
		$CondList = [];
		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';

		$result = xsaaModel::model()->getReturnOrder($page,$psize,$CondList);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

}
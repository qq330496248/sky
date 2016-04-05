<?php
/**
 * @desc 客户管理模块控制器操作类
 * @author WuJunhua
 * @date 2015-10-27
 */
class khglController extends Controller{
	/**
	 * @desc 添加客户资料模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 * @modify huyan 2015-11-02
	 */
	public function actionGetTjkhzlHtml(){
		//工号所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//手机类型选项卡
		$sjlx ='A023';
		$PhoneTypeOptions = syssetModel::model()->getPhoneType($sjlx);
		//客户等级选项卡
		$khdj = 'A012';
		$CustomerLevelOptions = syssetModel::model()->getCustomerLevel($khdj);
		//客户意向选项
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//进线方式选项卡
		$jxfs='A008';
		$IntoLineOptions = syssetModel::model()->getIntoLine($jxfs);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		//学历选项卡
		$khxl='A015';
		$EducationOptions = syssetModel::model()->getEducation($khxl);
		//职业选项卡
		$khzy='A017';
		$OccupationOptions = syssetModel::model()->getOccupation($khzy);
		//收入选项卡
		$khsr='A014';
		$IncomeOptions = syssetModel::model()->getIncome($khsr);
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('PhoneTypeOptions',$PhoneTypeOptions);
		$this->assign('CustomerLevelOptions',$CustomerLevelOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('IntoLineOptions',$IntoLineOptions);
		$this->assign('ClientSourceOptions',$ClientSourceOptions);
		$this->assign('EducationOptions',$EducationOptions);
		$this->assign('OccupationOptions',$OccupationOptions);
		$this->assign('IncomeOptions',$IncomeOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->display('khgl/tjkhzl.html');
	}
	
	/**
	 * @desc 查询客户资料模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetCxkhzlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('khgl/cxkhzl.html');
	}

	/**
	 * @desc 我的客户资料模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 *modify huyan 2015-11-02
	 */
	public function actionGetWdkhzlHtml(){

		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		$CurrentTime= date('Y-m-d H:i');//当前时间
		//客户等级选项卡
		$khdj = 'A012';
		$CustomerLevelOptions = syssetModel::model()->getCustomerLevel($khdj);
		//客户意向选项卡
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//跟进标签选项卡
		$gjbq='A006';
		$FollowLabelOptions = syssetModel::model()->getkehuIntoLine($gjbq);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		//进线方式选项卡(注册方式)
		$jxfs='A008';
		$IntoLineOptions = syssetModel::model()->getIntoLine($jxfs);
		//收入选项卡
		$khsr='A014';
		$IncomeOptions = syssetModel::model()->getIncome($khsr);
		//购买次数
		$gmcs='A007';
		$PurchaseNumberOptions = syssetModel::model()->getPurchaseNumber($gmcs);
		//是否成交
		$sfcj='A018';
		$WhetherNotOptions = syssetModel::model()->getWhetherNot($sfcj);
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$GetSexStatus=array();
		$GetSexStatus['Male'] = khglConst::$CustomerGender[0]; //男
		$GetSexStatus['Female'] = khglConst::$CustomerGender[1]; //女
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('JobNuber',$JobNuber);
		$this->assign('CurrentTime',$CurrentTime);
		$this->assign('CustomerLevelOptions',$CustomerLevelOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('FollowLabelOptions',$FollowLabelOptions);
		$this->assign('ClientSourceOptions',$ClientSourceOptions);
		$this->assign('IntoLineOptions',$IntoLineOptions);
		$this->assign('IncomeOptions',$IncomeOptions);
		$this->assign('PurchaseNumberOptions',$PurchaseNumberOptions);
		$this->assign('WhetherNotOptions',$WhetherNotOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('GetSexStatus',$GetSexStatus);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);

		$this->display('khgl/wdkhzl.html');
	}

	/**
	 * @desc 下属客户资料模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 *modify huyan 2015-11-02
	 */
	public function actionGetXskhzlHtml(){
		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		//客户等级选项卡
		$khdj = 'A012';
		$CustomerLevelOptions = syssetModel::model()->getCustomerLevel($khdj);
		//客户意向选项卡
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//跟进标签选项卡
		$gjbq='A006';
		$FollowLabelOptions = syssetModel::model()->getkehuIntoLine($gjbq);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		//进线方式选项卡(注册方式)
		$jxfs='A008';
		$IntoLineOptions = syssetModel::model()->getIntoLine($jxfs);
		//收入选项卡
		$khsr='A014';
		$IncomeOptions = syssetModel::model()->getIncome($khsr);
		//购买次数
		$gmcs='A007';
		$PurchaseNumberOptions = syssetModel::model()->getPurchaseNumber($gmcs);
		//是否成交
		$sfcj='A018';
		$WhetherNotOptions = syssetModel::model()->getWhetherNot($sfcj);
		//所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();

		//工号
		$XsWorkNumberOptions = rylistModel::model()->getSuborWorkNumber($JobNuber);
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
	
		$GetSexStatus=array();
		$GetSexStatus['Male'] = khglConst::$CustomerGender[0]; //男
		$GetSexStatus['Female'] = khglConst::$CustomerGender[1]; //女
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('JobNuber',$JobNuber);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('CustomerLevelOptions',$CustomerLevelOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('FollowLabelOptions',$FollowLabelOptions);
		$this->assign('ClientSourceOptions',$ClientSourceOptions);
		$this->assign('IntoLineOptions',$IntoLineOptions);
		$this->assign('IncomeOptions',$IncomeOptions);
		$this->assign('PurchaseNumberOptions',$PurchaseNumberOptions);
		$this->assign('WhetherNotOptions',$WhetherNotOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('GetSexStatus',$GetSexStatus);
		if(!empty($XsWorkNumberOptions)){
			$this->assign('XsWorkNumberOptions',$XsWorkNumberOptions);
		}
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('khgl/xskhzl.html');
	}

	/**
	 * @desc 未分配客户资料模板显示
	 * @author huyan
	 * @date 2016-04-01
	 */
	public function actionGetWfpkhHtml(){

		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		$CurrentTime= date('Y-m-d H:i');//当前时间
		//客户等级选项卡
		$khdj = 'A012';
		$CustomerLevelOptions = syssetModel::model()->getCustomerLevel($khdj);
		//客户意向选项卡
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//跟进标签选项卡
		$gjbq='A006';
		$FollowLabelOptions = syssetModel::model()->getkehuIntoLine($gjbq);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		//进线方式选项卡(注册方式)
		$jxfs='A008';
		$IntoLineOptions = syssetModel::model()->getIntoLine($jxfs);
		//收入选项卡
		$khsr='A014';
		$IncomeOptions = syssetModel::model()->getIncome($khsr);
		//购买次数
		$gmcs='A007';
		$PurchaseNumberOptions = syssetModel::model()->getPurchaseNumber($gmcs);
		//是否成交
		$sfcj='A018';
		$WhetherNotOptions = syssetModel::model()->getWhetherNot($sfcj);
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$GetSexStatus=array();
		$GetSexStatus['Male'] = khglConst::$CustomerGender[0]; //男
		$GetSexStatus['Female'] = khglConst::$CustomerGender[1]; //女
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('JobNuber',$JobNuber);
		$this->assign('CurrentTime',$CurrentTime);
		$this->assign('CustomerLevelOptions',$CustomerLevelOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('FollowLabelOptions',$FollowLabelOptions);
		$this->assign('ClientSourceOptions',$ClientSourceOptions);
		$this->assign('IntoLineOptions',$IntoLineOptions);
		$this->assign('IncomeOptions',$IncomeOptions);
		$this->assign('PurchaseNumberOptions',$PurchaseNumberOptions);
		$this->assign('WhetherNotOptions',$WhetherNotOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('GetSexStatus',$GetSexStatus);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);

		$this->display('khgl/wfpkh.html');
	}


	/**
	 * @desc 客户跟进记录模板显示
	 * @author huyan
	 * @date 2015-11-01
	 * @modify huyan 2015-11-02
	 */
	public function actionGetKhgjjlHtml(){
		//是否完成
		$sfwc='A021';
		$IsCompleteOptions = syssetModel::model()->getIsComplete($sfwc);
		//所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//跟进标签选项卡
		$gjbq='A006';
		$FollowLabelOptions = syssetModel::model()->getkehuIntoLine($gjbq);
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
		
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('IsCompleteOptions',$IsCompleteOptions);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('FollowLabelOptions',$FollowLabelOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('khgl/khgjjl.html');
	}

	/**
	 * @desc 客户短信模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 *modify huyan 2015-11-02
	 */
	public function actionGetKhdxHtml(){
		//所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//手机类型选项卡

		//smarty赋值
		$status = CInputFilter::getInt('status');
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('status',$status);
		$this->display('khgl/khdx.html');
	}

	/**
	 * @desc 客户投诉模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 *modify huyan 2015-11-02
	 */
	public function actionGetKhtsHtml(){
		//投诉类型
		$TypecomOptions=khadModel::model()->getTypecompOptions();
		//是否处理
		$sfcl='A019';
		$IsFinishingOptions = syssetModel::model()->getIsFinishing($sfcl);

		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('IsFinishingOptions',$IsFinishingOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('TypecomOptions',$TypecomOptions);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('khgl/khts.html');
	}

	/**
	 * @desc 添加投诉类型模板显示
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function actionGettjKhtsHtml(){
	   //投诉类型
		$TypeComplaintOptions = khadModel::model()->TypeCompOptions();
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('TypeComplaintOptions',$TypeComplaintOptions);
		$this->display('khgl/tjtslx.html');
	}


	/**
	 * @desc 添加投诉模板显示
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function actionGettjKhtsymxsHtml(){
		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		//客户id
		$CustomerNumberOptions=khaaModel::model()->getCustomerNumberOptions($JobNuber);
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
		//处理结果
		$cljg='A031';
		$ProcessingOptions = syssetModel::model()->getProcessing($cljg);
		//投诉类型
		$TypecomOptions=khadModel::model()->getTypecompOptions();

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('ProcessingOptions',$ProcessingOptions);
		$this->assign('TypecomOptions',$TypecomOptions);
		$this->assign('CustomerNumberOptions',$CustomerNumberOptions);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('khgl/tjts.html');
	}
	/**
	 * @desc 添加投诉详情模板显示
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function actionGettjtsHtml(){
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
		//处理结果
		$cljg='A031';
		$ProcessingOptions = syssetModel::model()->getProcessing($cljg);
		//投诉类型
		$TypecomOptions=khadModel::model()->getTypecompOptions();

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$khid = CInputFilter::getString('khid');
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('ProcessingOptions',$ProcessingOptions);
		$this->assign('TypecomOptions',$TypecomOptions);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		if(empty($khid)){
			return false;
		}
		$currentClientData = khacModel::model()->findCurrentData($khid);
		if(!empty($currentClientData)){
			$this->assign('khid',$currentClientData);
			$this->display('khgl/khtsxq_kh.html');
		}
	}

	/**
	 * @desc 客户黑名单模板显示
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function actionGetkhhmdHtml(){
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('khgl/khhmd.html');
	}

	/**
	 * @desc 添加客户黑名单模板显示
	 * @author huyan
	 * @date 2016-02-19
	 */
	public function actionGettjhmdHtml(){
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('khgl/tjhmd.html');
	}

	/**
	 * @desc 黑名单导入模板显示
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function actionGethmddrHtml(){
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('khgl/hmddr.html');
	}


	/**
	 * @desc 处理省份发送过来的参数，并返回该省份下城市的数据
	 * @author WuJunhua
	 * @date 2015-10-22
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
	 * @date 2015-10-26
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
	 * @desc 新增客户资料
	 * @author WuJunhua
	 * @date 2015-10-28
	 * @modify huyan 2015-11-02 添加条件查询
	 */
	public function actionAddClient(){
		$clientInfo = array();
		$addrInfo = array();
		$workNumber = CInputFilter::getString('khgsgh');//归属工号
		$workNumberArr = explode(':',$workNumber);
		if(!empty($workNumberArr)){
			$clientInfo['khaa32'] = $workNumberArr[0];
			$clientInfo['khaa33'] = $workNumberArr[1];
		}
		$clientInfo['khaa03'] = CInputFilter::getString('clientName');//客户姓名
		$clientInfo['khaa06'] = CInputFilter::getString('khphone'); //客户手机
		$clientInfo['khaa30'] = date('Y-m-d H:i:s'); //注册时间
		$clientInfo['khaa07'] = CInputFilter::getString('khTelephone2');//电话1
		$clientInfo['khaa08'] = CInputFilter::getString('khTelephone3');//电话2
		$clientInfo['khaa36'] = CInputFilter::getString('sglm');//身高
		$clientInfo['khaa37'] = CInputFilter::getString('tzqk');//体重
		$clientInfo['khaa11'] = CInputFilter::getString('dzyxhm');//电子邮箱
		$clientInfo['khaa04'] = CInputFilter::getString('radnan');//性别

		$clientInfo['khaa23'] = CInputFilter::getString('khdj');//客户等级
		$clientInfo['khaa09'] = CInputFilter::getString('khqqhm');//QQ
		$addrInfo['provinceid'] = CInputFilter::getString('province');//省份
		$addrInfo['cityid'] = CInputFilter::getString('city');//城市
		$addrInfo['areaid'] = CInputFilter::getString('area');//区县
		$addrInfo['deaddress'] = CInputFilter::getString('deaddress');//地址
		$addrInfo['khab06'] = CInputFilter::getString('postcode');//邮编
		$clientInfo['khaa40'] = CInputFilter::getString('khszz');//工号所在组
		$clientInfo['khaa25'] = CInputFilter::getString('kehuyx');//客户意向
		$clientInfo['khaa24'] = CInputFilter::getString('jxfs');//进线方式
		$clientInfo['khaa22'] = CInputFilter::getString('khly');//客户来源
		$clientInfo['khaa31'] = CInputFilter::getString('phonetype');//手机类型
		$clientInfo['khaa41'] = CInputFilter::getString('telphonetype');//电话1类型
		$clientInfo['khaa42'] = CInputFilter::getString('teltype');//电话2类型
		$clientInfo['khaa27'] = CInputFilter::getString('khnsr');//年收入
		$clientInfo['khaa26'] = CInputFilter::getString('khzgxl');//学历
		$clientInfo['khaa16'] = CInputFilter::getString('cshy');//职业
		$clientInfo['khaa39'] = CInputFilter::getString('khbz');//备注
		$clientInfo['khaa38'] = '未成交';//是否成交
		$clientInfo['khaa48'] = 'F';//是否分配
	    $csrq = CInputFilter::getString('csrq');//出生日期

		//获取当前时间
		$CurrentTime= date('Y-m-d H:i'); 
		if ($csrq='1900-01-01') {
			//$clientInfo['khaa05'] ='';
			$clientInfo['khaa47']= 0;
		}
		else{
			$clientInfo['khaa05'] =$csrq;
			$clientInfo['khaa47']=$CurrentTime-$clientInfo['khaa05'];
		}
		$JobNumber = Yii::app()->session['account'];  //当前用户工号
		//添加客户资料时姓名和手机是必填项
		if(!empty($clientInfo['khaa03'])  && !empty($clientInfo['khaa06'])){
			$addResult = khaaModel::model()->addClient($clientInfo,$addrInfo,$JobNumber);
		}
		$this->renderJson($addResult);		
	}

	//保存前先判断用户名是否存在
	public function actionQueryUser(){
		$khname = CInputFilter::getString('khname');
		$result = khaaModel::model()->QueryUser($khname);
		$this->renderJson($result);
	}

	/**
	 * @desc 加载客户资料详情
	 * @author WuJunhua
	 * @date 2015-10-29
	 * @modify huyan 2015-11-02
	 */
	public function actionNewClientData(){
		$clientno = CInputFilter::getString('clientno');
		//$ordernum = CInputFilter::getInt('ordernum');
		/*if(empty($clientno)){
			return false;
		}*/
		//上一个、下一个标识
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
		$JobNum = Yii::app()->session['account'];  //当前用户工号
		$sign = CInputFilter::getString('sign');
		//工号所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//手机类型选项卡
		$sjlx ='A023';
		$PhoneTypeOptions = syssetModel::model()->getPhoneType($sjlx);
		//客户等级选项卡
		$khdj = 'A012';
		$CustomerLevelOptions = syssetModel::model()->getCustomerLevel($khdj);
		//客户意向选项卡
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//进线方式选项卡
		$jxfs='A008';
		$IntoLineOptions = syssetModel::model()->getIntoLine($jxfs);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		//学历选项卡
		$khxl='A015';
		$EducationOptions = syssetModel::model()->getEducation($khxl);
		//职业选项卡
		$khzy='A017';
		$OccupationOptions = syssetModel::model()->getOccupation($khzy);
		//收入选项卡
		$khsr='A014';
		$IncomeOptions = syssetModel::model()->getIncome($khsr);
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		//跟进标签选项卡
		$gjbq='A006';
		$FollowLabelOptions = syssetModel::model()->getkehuIntoLine($gjbq);
		//投诉类型
		$TypecomOptions=khadModel::model()->getTypecompOptions();
		//手机加拨
		$typeencode = 'A032';
		$DialPhone = syssetModel::model()->getInformation($typeencode);
		//所有工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();

		//获取下属工号
		$SuborWorkNumberOptions = rylistModel::model()->getSuborWorkNumber($JobNum);
		//smarty赋值
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('PhoneTypeOptions',$PhoneTypeOptions);
		$this->assign('CustomerLevelOptions',$CustomerLevelOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('IntoLineOptions',$IntoLineOptions);
		$this->assign('ClientSourceOptions',$ClientSourceOptions);
		$this->assign('EducationOptions',$EducationOptions);
		$this->assign('OccupationOptions',$OccupationOptions);
		$this->assign('select','selected');
		$this->assign('IncomeOptions',$IncomeOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('FollowLabelOptions',$FollowLabelOptions);
		$this->assign('TypecomOptions',$TypecomOptions);
		$this->assign('DialPhone',$DialPhone['338']);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		/*$this->assign('status',$status);*/
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		
		if(empty($clientno)){
			return false;
		}
		$currentClientData = khaaModel::model()->findCurrentClientData($symbol,$clientno,$sign);
		if(!empty($currentClientData[0])){
			//号码屏蔽
			$mobile = '';
			if(!empty($currentClientData[0]['khaa06'])){
				$result = syssetModel::model()->handleNumberShield($currentClientData[0]['khaa06']);
				if(!is_array($result)){
					$mobile = $result;
				}
			}
			$this->assign('mobile',$mobile);
			$this->assign('clientno',$currentClientData[0]);

			if (!empty($currentClientData[1])) {
				foreach($currentClientData[1] as $value){
			        $OrderArr[] = $value['xsaa02']; 
		        }
				$OrderOptions= $OrderArr;
			    $this->assign('OrderOptions',$OrderOptions);
			}
			if (!empty($currentClientData[2])) {
				if ($currentClientData[2]['khaa32']==$JobNum) {
					$this->assign('WorkNumberOptions',$WorkNumberOptions);
					$this->display('khgl/khzlxq.html');
				}
				if ($currentClientData[2]['khaa32']!=$JobNum) {
					$this->assign('SuborWorkNumberOptions',$SuborWorkNumberOptions);
				    $this->display('khgl/xskhxq.html');
			    }
			}
		}
	}

	/**
	 * @desc 加载下属客户资料详情
	 * @author huyan
	 * @date 2016-03-03
	 */
	/*public function actionCustomersDetailsData(){
		$JobNumber = Yii::app()->session['account'];  //当前用户工号
		$clientno = CInputFilter::getString('clientno');
		//上一个、下一个标识
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
		//工号所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//手机类型选项卡
		$sjlx ='A023';
		$PhoneTypeOptions = syssetModel::model()->getPhoneType($sjlx);
		//客户等级选项卡
		$khdj = 'A012';
		$CustomerLevelOptions = syssetModel::model()->getCustomerLevel($khdj);
		//客户意向选项卡
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//进线方式选项卡
		$jxfs='A008';
		$IntoLineOptions = syssetModel::model()->getIntoLine($jxfs);
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		//学历选项卡
		$khxl='A015';
		$EducationOptions = syssetModel::model()->getEducation($khxl);
		//职业选项卡
		$khzy='A017';
		$OccupationOptions = syssetModel::model()->getOccupation($khzy);
		//收入选项卡
		$khsr='A014';
		$IncomeOptions = syssetModel::model()->getIncome($khsr);
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		//跟进标签选项卡
		$gjbq='A006';
		$FollowLabelOptions = syssetModel::model()->getkehuIntoLine($gjbq);
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();
		//投诉类型
		$TypecomOptions=khadModel::model()->getTypecompOptions();
		//手机加拨
		$typeencode = 'A032';
		$DialPhone = syssetModel::model()->getInformation($typeencode);
		//订单id
		//$OrderOptions=khaaModel::model()->getOrderOptions($clientno);
		
		//smarty赋值
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('PhoneTypeOptions',$PhoneTypeOptions);
		$this->assign('CustomerLevelOptions',$CustomerLevelOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('IntoLineOptions',$IntoLineOptions);
		$this->assign('ClientSourceOptions',$ClientSourceOptions);
		$this->assign('EducationOptions',$EducationOptions);
		$this->assign('OccupationOptions',$OccupationOptions);
		$this->assign('select','selected');
		$this->assign('IncomeOptions',$IncomeOptions);
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('FollowLabelOptions',$FollowLabelOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->assign('TypecomOptions',$TypecomOptions);
		$this->assign('DialPhone',$DialPhone['338']);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		
		if(empty($clientno)){
			return false;
		}
		$currentClientData = khaaModel::model()->findCustomersDetailsData($symbol,$clientno);
		if(!empty($currentClientData[0])){
			$this->assign('clientno',$currentClientData[0]);
			if (!empty($currentClientData[1])) {
				foreach($currentClientData[1] as $value){
			        $OrderArr[] = $value['xsaa02']; 
		        }
				$OrderOptions= $OrderArr;
			    $this->assign('OrderOptions',$OrderOptions);
			}
			
			$this->display('khgl/xskhxq.html');
		}
	}*/

	/**
	 * @desc 获取我的客户列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-10-28
	 * @modify huyan 查询 
	 */
	public function actionGetMyClient(){
		$clientInfo['khaa32'] = Yii::app()->session['account'];  //安排人工号 
		$JobNumber=$clientInfo['khaa32'];
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		
		//客户列表顺序倒序输出
		$sequence = CInputFilter::getString('sequence') == '' ? 'DESC' : CInputFilter::getString('sequence');
		$order = CInputFilter::getString('order') == '' ? 'khaa02' : CInputFilter::getString('order');
		$xskh='F';
		$CondList = array();
		$CondList['khname'] = CInputFilter::getString('khname');
		$CondList['khphone'] = CInputFilter::getString('khphone');
		$CondList['khgmcp'] = CInputFilter::getString('khgmcp');
		$CondList['khnlsq'] = CInputFilter::getString('khnlsq');
		$CondList['khnlsz'] = CInputFilter::getString('khnlsz');
		$CondList['khdj'] = CInputFilter::getString('khdj');

		$CondList['xfjed'] = CInputFilter::getString('xfjed');
		$CondList['xfjex'] = CInputFilter::getString('xfjex');
		$CondList['zcfs'] = CInputFilter::getString('zcfs');
		$CondList['khly'] = CInputFilter::getString('khly');
		$CondList['nsr'] = CInputFilter::getString('nsr');
		$CondList['gjbq'] = CInputFilter::getString('gjbq');
		$CondList['gmcs'] = CInputFilter::getString('gmcs');

		$CondList['zxgjq'] = CInputFilter::getString('zxgjq');
		$CondList['zxgjz'] = CInputFilter::getString('zxgjz');
		$CondList['zxgjz'] = !empty($CondList['zxgjz']) ? $CondList['zxgjz'].DEFAULT_END_TIME : '';

		$CondList['zxzdq'] = CInputFilter::getString('zxzdq');
		$CondList['zxzdz'] = CInputFilter::getString('zxzdz');
		$CondList['zxzdz'] = !empty($CondList['zxzdz']) ? $CondList['zxzdz'].DEFAULT_END_TIME : '';

		$CondList['zxqsq'] = CInputFilter::getString('zxqsq');
		$CondList['zxqsz'] = CInputFilter::getString('zxqsz');
		$CondList['zxqsz'] = !empty($CondList['zxqsz']) ? $CondList['zxqsz'].DEFAULT_END_TIME : '';

		$CondList['zxjsq'] = CInputFilter::getString('zxjsq');
		$CondList['zxjsz'] = CInputFilter::getString('zxjsz');
		$CondList['zxjsz'] = !empty($CondList['zxjsz']) ? $CondList['zxjsz'].DEFAULT_END_TIME : '';

		$CondList['khzcsjq'] = CInputFilter::getString('khzcsjq');
		$CondList['khzcsjz'] = CInputFilter::getString('khzcsjz');
		$CondList['khzcsjz'] = !empty($CondList['khzcsjz']) ? $CondList['khzcsjz'].DEFAULT_END_TIME : '';

		$CondList['khxb'] = CInputFilter::getString('khxb');
		$CondList['khsr']= CInputFilter::getString('khsr');

		$addrInfo = array();
		$addrInfo['khsf']= CInputFilter::getString('khsf');
		$addrInfo['city']= CInputFilter::getString('city');
		$addrInfo['area']= CInputFilter::getString('area');
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$result = khaaModel::model()->GetMyClient($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo,$sign);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 获取未分配客户列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-04-01
	 */
	public function actionGetNoDistribution(){
		$clientInfo['khaa32'] = Yii::app()->session['account'];  //安排人工号 
		$JobNumber=$clientInfo['khaa32'];
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		
		//客户列表顺序倒序输出
		$sequence = CInputFilter::getString('sequence') == '' ? 'DESC' : CInputFilter::getString('sequence');
		$order = CInputFilter::getString('order') == '' ? 'khaa02' : CInputFilter::getString('order');
		$xskh='F';
		$CondList = array();
		$CondList['khname'] = CInputFilter::getString('khname');
		$CondList['khphone'] = CInputFilter::getString('khphone');
		$CondList['khgmcp'] = CInputFilter::getString('khgmcp');
		$CondList['khnlsq'] = CInputFilter::getString('khnlsq');
		$CondList['khnlsz'] = CInputFilter::getString('khnlsz');
		$CondList['khdj'] = CInputFilter::getString('khdj');

		$CondList['xfjed'] = CInputFilter::getString('xfjed');
		$CondList['xfjex'] = CInputFilter::getString('xfjex');
		$CondList['zcfs'] = CInputFilter::getString('zcfs');
		$CondList['khly'] = CInputFilter::getString('khly');
		$CondList['nsr'] = CInputFilter::getString('nsr');
		$CondList['gjbq'] = CInputFilter::getString('gjbq');
		$CondList['gmcs'] = CInputFilter::getString('gmcs');

		$CondList['zxgjq'] = CInputFilter::getString('zxgjq');
		$CondList['zxgjz'] = CInputFilter::getString('zxgjz');
		$CondList['zxgjz'] = !empty($CondList['zxgjz']) ? $CondList['zxgjz'].DEFAULT_END_TIME : '';

		$CondList['zxzdq'] = CInputFilter::getString('zxzdq');
		$CondList['zxzdz'] = CInputFilter::getString('zxzdz');
		$CondList['zxzdz'] = !empty($CondList['zxzdz']) ? $CondList['zxzdz'].DEFAULT_END_TIME : '';

		$CondList['zxqsq'] = CInputFilter::getString('zxqsq');
		$CondList['zxqsz'] = CInputFilter::getString('zxqsz');
		$CondList['zxqsz'] = !empty($CondList['zxqsz']) ? $CondList['zxqsz'].DEFAULT_END_TIME : '';

		$CondList['zxjsq'] = CInputFilter::getString('zxjsq');
		$CondList['zxjsz'] = CInputFilter::getString('zxjsz');
		$CondList['zxjsz'] = !empty($CondList['zxjsz']) ? $CondList['zxjsz'].DEFAULT_END_TIME : '';

		$CondList['khzcsjq'] = CInputFilter::getString('khzcsjq');
		$CondList['khzcsjz'] = CInputFilter::getString('khzcsjz');
		$CondList['khzcsjz'] = !empty($CondList['khzcsjz']) ? $CondList['khzcsjz'].DEFAULT_END_TIME : '';

		$CondList['khxb'] = CInputFilter::getString('khxb');
		$CondList['khsr']= CInputFilter::getString('khsr');

		$addrInfo = array();
		$addrInfo['khsf']= CInputFilter::getString('khsf');
		$addrInfo['city']= CInputFilter::getString('city');
		$addrInfo['area']= CInputFilter::getString('area');
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$result = khaaModel::model()->GetNoDistribution($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo,$sign);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 获取下属客户列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-11-20
	 * @modify 顺序、倒序
	 */
	public function actionSubordinate(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$clientInfo['khaa32'] = Yii::app()->session['account'];  //当前用户工号
		$JobNumber=$clientInfo['khaa32'];
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		//客户列表顺序倒序输出
		$sequence = CInputFilter::getString('sequence');
		$order = CInputFilter::getString('order');
		$CondList = array();
		$CondList['khname'] = CInputFilter::getString('khname');
		$CondList['khphone'] = CInputFilter::getString('khphone');
		$CondList['khgmcp'] = CInputFilter::getString('khgmcp');
		$CondList['khnlsq'] = CInputFilter::getString('khnlsq');
		$CondList['khnlsz'] = CInputFilter::getString('khnlsz');
		$CondList['khdj'] = CInputFilter::getString('khdj');

		$CondList['xfjed'] = CInputFilter::getString('xfjed');
		$CondList['xfjex'] = CInputFilter::getString('xfjex');
		$CondList['zcfs'] = CInputFilter::getString('zcfs');
		$CondList['khly'] = CInputFilter::getString('khly');
		$CondList['nsr'] = CInputFilter::getString('nsr');
		$CondList['gjbq'] = CInputFilter::getString('gjbq');
		$CondList['gmcs'] = CInputFilter::getString('gmcs');
		$workNumber = CInputFilter::getString('khgsgh');
		$workNumberArr = explode(':',$workNumber);
        $CondList['khgsgh'] = $workNumberArr[0];
		$CondList['zxgjq'] = CInputFilter::getString('zxgjq');
		$CondList['zxgjz'] = CInputFilter::getString('zxgjz');
		$CondList['zxgjz'] = !empty($CondList['zxgjz']) ? $CondList['zxgjz'].DEFAULT_END_TIME : '';

		$CondList['zxzdq'] = CInputFilter::getString('zxzdq');
		$CondList['zxzdz'] = CInputFilter::getString('zxzdz');
		$CondList['zxzdz'] = !empty($CondList['zxzdz']) ? $CondList['zxzdz'].DEFAULT_END_TIME : '';

		$CondList['zxqsq'] = CInputFilter::getString('zxqsq');
		$CondList['zxqsz'] = CInputFilter::getString('zxqsz');
		$CondList['zxqsz'] = !empty($CondList['zxqsz']) ? $CondList['zxqsz'].DEFAULT_END_TIME : '';

		$CondList['zxjsq'] = CInputFilter::getString('zxjsq');
		$CondList['zxjsz'] = CInputFilter::getString('zxjsz');
		$CondList['zxjsz'] = !empty($CondList['zxjsz']) ? $CondList['zxjsz'].DEFAULT_END_TIME : '';

		$CondList['khzcsjq'] = CInputFilter::getString('khzcsjq');
		$CondList['khzcsjz'] = CInputFilter::getString('khzcsjz');
		$CondList['khzcsjz'] = !empty($CondList['khzcsjz']) ? $CondList['khzcsjz'].DEFAULT_END_TIME : '';

		$CondList['khxb'] = CInputFilter::getString('khxb');
		$CondList['khsr']= CInputFilter::getString('khsr');

		$addrInfo = array();
		$addrInfo['khsf']= CInputFilter::getString('khsf');
		$addrInfo['city']= CInputFilter::getString('city');
		$addrInfo['area']= CInputFilter::getString('area');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = khaaModel::model()->Subordinate($page,$psize,$JobNumber,$order,$CondList,$addrInfo,$sign);
		if (empty($result)) {
			$this->renderJson(array('res'=>'error','msg'=>'没有数据'));
		}
		else{
			$pageHtml = Utility::getPage($result['count']);
		    $pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';					
		    $result['pageHtml'] = $pageHtml;
		    $this->renderJson($result);
		}
	}

	/**
	 * @desc 修改客户资料
	 * @author WuJunhua
	 * @date 2015-10-29
	 * @modify huyan 2015-11-02
	 */
	public function actionUpdateClientData(){
		$clientInfo = array();
		$addrInfo = array();
		$clientNo = CInputFilter::getString('clientno');
		if(empty($clientNo)){
			return false;
		}
		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		$JobNane  = Yii::app()->session['name'];  //当前用户姓名
		$workNumber = CInputFilter::getString('khgsgh');//客户资料详情归属工号
		$workNumberArr = explode(':',$workNumber);
		if(!empty($workNumberArr)){
			$clientInfo['khaa32'] = $workNumberArr[0];
			$clientInfo['khaa33'] = $workNumberArr[1];
		}
	/*    if ($JobNuber!=$ddgsgh) {
	        $this->renderJson(array('res'=>'error','msg'=>'不能修改归属工号'));
	    }*/
		$clientInfo['khaa03'] = CInputFilter::getString('clientName');//客户姓名
		$clientInfo['khaa06'] = CInputFilter::getString('khphone'); //客户手机
		$clientInfo['khaa07'] = CInputFilter::getString('khTelephone2');//电话1
		$clientInfo['khaa08'] = CInputFilter::getString('khTelephone3');//电话2
		$clientInfo['khaa05'] = CInputFilter::getString('csrq');//出生日期
		$clientInfo['khaa36'] = CInputFilter::getString('sglm');//身高
		$clientInfo['khaa37'] = CInputFilter::getString('tzqk');//体重
		$clientInfo['khaa11'] = CInputFilter::getString('dzyxhm');//电子邮箱
		$clientInfo['khaa04'] = CInputFilter::getString('radnan');//性别
		$clientInfo['khaa23'] = CInputFilter::getString('khdj');//客户等级

		$clientInfo['khaa09'] = CInputFilter::getString('khqqhm');//QQ
		$clientInfo['khaa12'] = CInputFilter::getString('deaddress');//地址
		$clientInfo['khaa40'] = CInputFilter::getString('khszz');//工号所在组
		$clientInfo['khaa25'] = CInputFilter::getString('kehuyx');//客户意向
		$clientInfo['khaa24'] = CInputFilter::getString('jxfs');//进线方式
		$clientInfo['khaa22'] = CInputFilter::getString('khly');//客户来源
		$clientInfo['khaa31'] = CInputFilter::getString('phonetype');//手机类型
		$clientInfo['khaa27'] = CInputFilter::getString('khnsr');//年收入
		$clientInfo['khaa26'] = CInputFilter::getString('khzgxl');//学历
		$clientInfo['khaa16'] = CInputFilter::getString('cshy');//职业
		$clientInfo['khaa39'] = CInputFilter::getString('khbz');//备注
		$addrInfo['provinceid'] = CInputFilter::getInt('province');//省份
		$addrInfo['cityid'] = CInputFilter::getInt('city');//城市
		$addrInfo['areaid'] = CInputFilter::getInt('area');//区县
		$addrInfo['deaddress'] = CInputFilter::getString('deaddress');//地址
		$addrInfo['khab06'] = CInputFilter::getString('postcode');//邮编
		$clientInfo['khaa41'] = CInputFilter::getString('telphonetype');//电话1类型
		$clientInfo['khaa42'] = CInputFilter::getString('teltype');//电话2类型

		$clientInfo['khaa05'] = CInputFilter::getString('csrq');//出生日期
		$csrq = $clientInfo['khaa05'];

		//获取当前时间
		$CurrentTime= date('Y-m-d H:i'); 
		if ($csrq='1900-01-01') {
			//$clientInfo['khaa05'] ='';
			$clientInfo['khaa47']= 0;
		}
		else{
			$clientInfo['khaa05'] =$csrq;
			$clientInfo['khaa47']=$CurrentTime-$clientInfo['khaa05'];
		}

		if(!empty($clientInfo['khaa03']) || !empty($clientInfo['khaa06'])){
			$result = khaaModel::model()->updateClientData($clientNo,$clientInfo,$addrInfo);
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 删除客户资料
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function actionDeleteClientData(){
		$clientNo = CInputFilter::getString('clientno');
		if(empty($clientNo)){
			return false;
		}
		$result = khaaModel::model()->deleteClientData($clientNo);
		$this->renderJson($result);
	}

	/**
	 * @desc 系统设置->数据清理->删除客户资料
	 * @author huyan
	 * @date 2016-02-18
	 */
	public function actionDelCustomerClient(){
		$CondList = array();
		$CondList['zcsjq'] = CInputFilter::getString('zcsjq');
		$CondList['zcsjz'] = CInputFilter::getString('zcsjz');
		$CondList['zcsjz'] = !empty($CondList['zcsjz']) ? $CondList['zcsjz'].DEFAULT_END_TIME : '';
		$CondList['gjsjq'] = CInputFilter::getString('gjsjq');
		$CondList['gjsjz'] = CInputFilter::getString('gjsjz');
		$CondList['gjsjz'] = !empty($CondList['gjsjz']) ? $CondList['gjsjz'].DEFAULT_END_TIME : '';
		$CondList['khdj'] = CInputFilter::getString('khdj');
		$CondList['kehuyx'] = CInputFilter::getString('kehuyx');
		$CondList['khgh'] = CInputFilter::getString('khgh');
		$result = khaaModel::model()->DelCustomerClient($CondList);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除跟进记录
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function actionDeleteRecords(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		$result = khaeModel::model()->DeleteRecords($orderno);
		$this->renderJson($result);
	}

	/**
	 * @desc 系统设置->数据清理->删除客户跟进记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function actionDelFollowRecord(){
		$CurrentTime= date('Y-m-d H:i'); 
		$gjsjq = CInputFilter::getString('gjsjq');
		$gjsjz = CInputFilter::getString('gjsjz');
		$dqsj=(strtotime($CurrentTime));
		$gjsj=(strtotime($gjsjq));
		$diff = (int)(($dqsj-$gjsj)/(24*3600));
		if (!empty($gjsjq)&&empty($gjsjz)) {
			if ($diff<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的客户跟进记录'));
		    }
		}
		$rksjz=(strtotime($gjsjz));
		$diff1 = (int)(($dqsj-$rksjz)/(24*3600));
		if (empty($gjsjq)&&!empty($gjsjz)) {
			if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的客户跟进记录'));
		    }
		}
		if (!empty($gjsjq)&&!empty($gjsjz)) {
            if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的客户跟进记录'));
		    }
		}
		$gjsjz = !empty($gjsjz) ? $gjsjz.DEFAULT_END_TIME : '';
		$result = khaeModel::model()->DelFollowRecord($gjsjq,$gjsjz);
		$this->renderJson($result);
	}
	/**
	 * @desc 查询客户资料
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public function actionSearchClientData(){
		$searchType = '';  		//获取查询搜索类型
		$keyword 	= '';  		//获取查询搜索关键字
		$page 		= CInputFilter::getInt('page',1);  //获取页码
		$psize 		= CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$searchType = CInputFilter::getInt('searchtype');
		$keyword = CInputFilter::getString('keyword');
		$result = khaaModel::model()->searchClientData($page,$psize,$searchType,$keyword);
		$pageHtml 	= Utility::getPage($result['count'],$psize);
		$pageHtml 	= isset($pageHtml['html']) ? $pageHtml['html'] : '';
		$result['pageHtml']  = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 倒序获取我的客户列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-11-04
	 */
	public function actionDESCGetMyClient(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = khaaModel::model()->DESCGetMyClient($page,$psize);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取客户跟进记录列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-11-10
	 */
	public function actiongetFollowing(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数

		$CondList = array();
		$CondList['khid'] = CInputFilter::getString('khid');
		$CondList['gjsjq'] = CInputFilter::getString('gjsjq');
		$CondList['gjsjz'] = CInputFilter::getString('gjsjz');
		$CondList['gjsjz'] = !empty($CondList['gjsjz']) ? $CondList['gjsjz'].DEFAULT_END_TIME : '';
		$CondList['khszz'] = CInputFilter::getString('khszz');
		$CondList['gjbq'] = CInputFilter::getString('gjbq');
		$CondList['sfwc'] = CInputFilter::getString('sfwc');
		/*$CondList['khapr'] = CInputFilter::getString('khapr');
		$CondList['khgjr'] = CInputFilter::getString('khgjr');*/

		$khapr = CInputFilter::getString('khapr');//获取安排人工号
		$khaprArr = explode(':',$khapr);
	    $gjjlapr = $khaprArr[0];
	    $khgjr = CInputFilter::getString('khgjr');//获取安排人工号
		$khgjrArr = explode(':',$khgjr);
	    $gjjlgjr = $khgjrArr[0];
	    $CondList['khapr']= $gjjlapr;
        $CondList['khgjr']= $gjjlgjr;
        $JobNuber = Yii::app()->session['account'];  //当前用户工号
        $sign = CInputFilter::getInt('sign');  //导出excel标识

		$result = khaeModel::model()->getFollowing($page,$psize,$CondList,$sign,$JobNuber);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取客户短信列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function actiongetMessage(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$khyfdx='F';
		$result = khafModel::model()->getMessage($page,$psize,$khyfdx);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 客户短信查询
	 * @author huyan
	 * @date 2015-11-16 
	 */
	public function actionSMSQuery(){
		$clientInfo = array();
		$page 	= CInputFilter::getInt('page',1);  //获取页码
		$psize 	= CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$gsgh = CInputFilter::getString('gsgh');
		//$gsgh = CInputFilter::getString('khgsgh');//归属工号（工号+姓名）
		$khphone = CInputFilter::getString('khphone');
		$kssj = CInputFilter::getString('kssj');
		$jssj = CInputFilter::getString('jssj');
		$khszz = CInputFilter::getString('khszz');
		$result = khafModel::model()->SMSQuery($page,$psize,$gsgh,$khphone,$kssj,$jssj,$khszz);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';
		$result['pageHtml']  = $pageHtml;
		$this->renderJson($result);

	}

	/**
	 * @desc 获取客户跟进记录
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function actionGetFollowRecording(){
		$clientno = CInputFilter::getString('clientno');
		
		if(empty($clientno)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$result = khaeModel::model()->GetFollowRecording($clientno);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取客户跟进记录失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取客户订单记录
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function actionGetOrderRecord(){
		$clientno = CInputFilter::getString('clientno');
		if(empty($clientno)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = khaaModel::model()->GetOrderRecord($clientno,$page,$psize);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取客户订单记录失败'));
		}
		$this->renderJson($result);

	}

	/**
	 * @desc 添加跟进记录
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function actionAddFollowRecord(){
		$clientInfo = array();
		$workNumber = CInputFilter::getString('gjr');//跟进人工号
		$workNumberArr = explode(':',$workNumber);
		if(!empty($workNumberArr)){
			$clientInfo['khae06'] = $workNumberArr[0];
			$clientInfo['khae07'] = $workNumberArr[1];
		}
		$clientInfo['khae01'] = CInputFilter::getString('clientno');//客户编号
		$clientInfo['khae03'] = CInputFilter::getString('gjnr');//内容
		$clientInfo['khae09'] = CInputFilter::getString('dbsj');//待办时间
		$clientInfo['khae11'] = CInputFilter::getString('gjfz');//分组
		$clientInfo['khae02'] = CInputFilter::getString('gjbq');//跟进标签
		$clientInfo['khae08'] = date('Y-m-d H:i'); //记录时间
		$clientInfo['khae04'] = Yii::app()->session['account'];  //安排人工号 
		$clientInfo['khae05'] = Yii::app()->session['name']; // 安排人姓名
		/*$clientInfo['khae06'] = Yii::app()->session['account'];//跟进人工号
		$clientInfo['khae07'] = Yii::app()->session['name']; //跟进人姓名*/
		if(!empty($clientInfo['khae03'])){
			$result = khaeModel::model()->AddFollowRecord($clientInfo);
		}
		$this->renderJson($result);	
	}

	/**
	 * @desc 合并客户资料查询客户
	 * @author huyan
	 * @date 2015-11-17
	 */
	public function actionGetCustomer(){
		$searchType = '';  		//获取查询搜索类型
		$keyword 	= '';  		//获取查询搜索关键字
		$searchType = CInputFilter::getInt('searchtype');
		$keyword = CInputFilter::getString('keyword');
		$clientno=CInputFilter::getString('clientno');
		$result = khaaModel::model()->getCustomer($searchType,$keyword,$clientno);
		$this->renderJson($result);
	}

	/**
	 * @desc 提交合并客户资料
	 * @author huyan
	 * @date 2015-11-18
	 */
	public function actionCommitMerger(){
		$clientInfo = array();
		$clientno = CInputFilter::getString('clientno');
		$searchtype = CInputFilter::getString('searchtype');
		$keyword = CInputFilter::getString('keyword');
		$retaintype = CInputFilter::getString('retaintype');
        $khzl1 = CInputFilter::getString('khzl1');
		$khzl2 = CInputFilter::getString('khzl2');
		$result = khaaModel::model()->CommitMerger($clientno,$clientInfo,$searchtype,$keyword,$retaintype,$khzl1,$khzl2);
		$this->renderJson($result);
	}

	/**
	 * @desc 客户详情页面转客户资料
	 * @author huyan
	 * @date 2015-11-20
	 */
	public function actionTurnCustomer(){
		$clientInfo = array();
		$addrInfo = array();
		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		$JobName = Yii::app()->session['name']; // 当前用户姓名

	    $workNumber = CInputFilter::getString('khgsgh');//要转给的客户工号+姓名
		$workNumberArr = explode(':',$workNumber);
	    $zckhgh = $workNumberArr[0];//工号
	    $zckhxm = $workNumberArr[1];//姓名
	    /* if ($JobNuber==$zckhgh) {
	    	$this->renderJson(array('res'=>'error','msg'=>'相同工号不能互相转'));

	    }*/
	    $clientInfo['khaa32'] = $zckhgh;
	    $clientInfo['khaa33'] = $zckhxm;
		$clientno = CInputFilter::getString('clientno');//客户id
		$clientInfo['khaa03'] = CInputFilter::getString('clientName');//客户姓名
		$clientInfo['khaa06'] = CInputFilter::getString('khphone'); //客户手机
		$clientInfo['khaa30'] = date('Y-m-d H:i:s'); //注册时间
		$clientInfo['khaa07'] = CInputFilter::getString('khTelephone2');//电话1
		$clientInfo['khaa08'] = CInputFilter::getString('khTelephone3');//电话2
		$clientInfo['khaa05'] = CInputFilter::getString('csrq');//出生日期
		$clientInfo['khaa36'] = CInputFilter::getString('sglm');//身高
		$clientInfo['khaa37'] = CInputFilter::getString('tzqk');//体重
		$clientInfo['khaa11'] = CInputFilter::getString('dzyxhm');//电子邮箱
		$clientInfo['khaa04'] = CInputFilter::getString('radnan');//性别
		$clientInfo['khaa23'] = CInputFilter::getString('khdj');//客户等级
		$clientInfo['khaa09'] = CInputFilter::getString('khqqhm');//QQ

		$addrInfo['provinceid'] = CInputFilter::getString('province');//省份
		$addrInfo['cityid'] = CInputFilter::getString('city');//城市
		$addrInfo['areaid'] = CInputFilter::getString('area');//区县
		$addrInfo['deaddress'] = CInputFilter::getString('deaddress');//地址
		$addrInfo['khab06'] = CInputFilter::getString('postcode');//邮编
		$clientInfo['khaa40'] = CInputFilter::getString('khszz');//工号所在组
		$clientInfo['khaa25'] = CInputFilter::getString('kehuyx');//客户意向
		$clientInfo['khaa24'] = CInputFilter::getString('jxfs');//进线方式
		$clientInfo['khaa22'] = CInputFilter::getString('khly');//客户来源
		$clientInfo['khaa31'] = CInputFilter::getString('phonetype');//手机类型
		$clientInfo['khaa41'] = CInputFilter::getString('telphonetype');//电话1类型
		$clientInfo['khaa42'] = CInputFilter::getString('teltype');//电话2类型
		$clientInfo['khaa27'] = CInputFilter::getString('khnsr');//年收入
		$clientInfo['khaa26'] = CInputFilter::getString('khzgxl');//学历
		$clientInfo['khaa16'] = CInputFilter::getString('cshy');//职业
		$clientInfo['khaa39'] = CInputFilter::getString('khbz');//备注

		$addResult = khaaModel::model()->TurnCustomer($clientno,$clientInfo,$addrInfo);
		$this->renderJson($addResult);	
	}

	/**
	 * @desc 根据不同的短信来获取短信列表
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-11-23
	 */
	public function actionGetShortMessage(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$status = CInputFilter::getInt('orderstatus');
		//获取短信状态  
		$ShortMessage = khglConst::$ShortMessage[$status];
		$CondList = array();
		$CondList['gsgh'] = CInputFilter::getString('gsgh');
		$CondList['khphone'] = CInputFilter::getString('khphone');
		$CondList['kssj'] = CInputFilter::getString('kssj');
		$CondList['jssj'] = CInputFilter::getString('jssj');
		$CondList['khszz'] = CInputFilter::getString('khszz');
		$result = khafModel::model()->getShortMessage($page,$psize,$ShortMessage,$CondList);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}


	/**
	 * @desc 获取工号姓名
	 * @return json $reslut 列表信息
	 * @author hyan
	 * @date 2015-11-23
	 * modify huyan 2015-12-30 分页
	 */
	public function actiongetNamNumber(){
		$result = array();  //列表信息结果
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['gh'] = CInputFilter::getString('gh');
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = rylistModel::model()->getNamNumber($cond,$page,$psize);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}


	/**
	 * @desc 发内部短信工号查询
	 * @author huyan
	 * @date 2015-11-17
	 */
	public function actiongetUserNumber(){
		$searchType = '';  		//获取查询搜索类型
		$keyword 	= '';  		//获取查询搜索关键字
		$searchtype = CInputFilter::getInt('searchtype');
		$keyword = CInputFilter::getString('keyword');
		$result = rylistModel::model()->getUserNumber($searchtype,$keyword);
		$this->renderJson($result);
	}

	/**
	 * @desc 确定：发送短信
	 * @author huyan
	 * @date 2015-11-24
	 */
	public function actionSendMessages(){
		$clientInfo = array();
		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		$clientInfo['khag03'] = CInputFilter::getString('sxyh');//接收人工号
		if ($JobNuber==$clientInfo['khag03']) {
			$this->renderJson(array('res'=>'error','msg'=>'不能给自己发短信'));
		}
        $clientInfo['khag05']= CInputFilter::getString('dxbt');//标题
		$clientInfo['khag06'] = CInputFilter::getString('dxnr');//内容
		$clientInfo['khag01'] = Yii::app()->session['account'];  //发送人工号 
		$clientInfo['khag02'] = Yii::app()->session['name']; // 发送人姓名
		$clientInfo['khag07'] = date('Y-m-d H:i'); //发送时间
		$clientInfo['khag08']="发送";
		/*$clientInfo['khae06'] = Yii::app()->session['account'];//收信人工号
		$clientInfo['khae07'] = Yii::app()->session['name']; //收信人姓名*/

		$pitchon=CInputFilter::getString('sfqf');//是否群发
		
		$HistoryGirard= rylistModel::model()->getnameAndNumber();
		//转成一维数组
		$NameAndNumber = array_column($HistoryGirard, 'username');

		if(!empty($clientInfo['khag06'])){
			$ClientResult = khagModel::model()->SendMessages($clientInfo,$NameAndNumber,$pitchon);
		}
		$this->renderJson($ClientResult);	
	}

	/**
	 * @desc 获取客户投诉列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function actionGetComplaint(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$JobNuber = Yii::app()->session['account'];  //归属工号
		$CondList = array();
		$CondList['gjgh'] = CInputFilter::getString('gjgh');
		$CondList['tssjq'] = CInputFilter::getString('tssjq');
		$CondList['tssjz'] = CInputFilter::getString('tssjz');
		$CondList['tssjz'] = !empty($CondList['tssjz']) ? $CondList['tssjz'].DEFAULT_END_TIME : '';
		$CondList['tsxm'] = CInputFilter::getString('tsxm');
		$CondList['khtsgh'] = CInputFilter::getString('khtsgh');
		$CondList['sfcl'] = CInputFilter::getString('sfcl');
		$CondList['khtslx'] = CInputFilter::getString('khtslx');
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$result = khacModel::model()->GetComplaint($page,$psize,$JobNuber,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 添加投诉
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function actionAddCustomerComplaints(){
		$clientInfo = array();
		$JobNuber = Yii::app()->session['account'];  //归属工号
		$JobName  = Yii::app()->session['name'];  //归属姓名

		//$clientInfo['khac01'] = CInputFilter::getString('khid');//客户id
		$clientInfo['khac13'] = CInputFilter::getString('khxm');//客户姓名
		$clientInfo['khac05'] = CInputFilter::getString('ddbh'); //订单
		$clientInfo['khac10'] = date('Y-m-d H:i:s'); //提交时间
		$clientInfo['khac07'] = CInputFilter::getString('tsbz');//备注
		/*$clientInfo['khac03'] = $tsNumber;//投诉工号
		$clientInfo['khac04'] = $gjNumber;//跟进工号*/
		$clientInfo['khac03']=CInputFilter::getString('khtsgh');//投诉工号
		$clientInfo['khac04']=CInputFilter::getString('tsgjgh');//跟进工号
		$clientInfo['khac08'] = CInputFilter::getString('tscljg');//处理结果
		$clientInfo['khac06'] = CInputFilter::getString('tscp');//投诉产品
		$clientInfo['khac02'] = CInputFilter::getString('khwt');//客户问题
		$clientInfo['khac09'] =$JobNuber; //归属工号
		$clientInfo['khac11'] =date('Y-m-d H:i:s'); //处理时间时间
		if (!empty($clientInfo['khac08'])) {
			$clientInfo['khac12']='已处理';
		}
		 if(empty($clientInfo['khac08'])){
			$clientInfo['khac12']='未处理';
		}
		//客户id  投诉问题不能为空
		if(!empty($clientInfo['khac02'])){
			$ComplaintsResult = khacModel::model()->AddCustomerComplaints($clientInfo);
		}
		$this->renderJson($ComplaintsResult);		
	}

	/**
	 * @desc 客户详情添加投诉
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function actionDetailsComplaints(){
		$clientInfo = array();
		$JobNuber = Yii::app()->session['account'];  //归属工号
		$JobName  = Yii::app()->session['name'];  //归属姓名
		$clientInfo['khac01'] = CInputFilter::getString('clientno');//客户id
		$clientInfo['khac13'] = CInputFilter::getString('khname');//客户姓名
		$clientInfo['khac05'] = CInputFilter::getString('ddbh'); //订单
		$clientInfo['khac10'] = date('Y-m-d H:i:s'); //提交时间
		$clientInfo['khac07'] = CInputFilter::getString('tsbz');//备注
		$clientInfo['khac03']=CInputFilter::getString('khtsgh');//投诉工号
		$clientInfo['khac06'] = CInputFilter::getString('tscp');//投诉产品
		$clientInfo['khac02'] = CInputFilter::getString('khwt');//客户问题
		$clientInfo['khac09'] =$JobNuber; //归属工号
		$clientInfo['khac11'] =date('Y-m-d H:i:s'); //处理时间
		if (!empty($clientInfo['khac08'])) {
			$clientInfo['khac12']='已处理';
		}
		else{
			$clientInfo['khac12']='未处理';
		}
	/*	if ($clientInfo['khac05']=='error'||$clientInfo['khac05']=='没有订单') {
			$this->renderJson(array('res'=>'error','msg'=>'没有订单不能添加投诉'));
		}*/
		//投诉问题不能为空
		if(!empty($clientInfo['khac02'])){
			$CompResult = khacModel::model()->DetailsComplaints($clientInfo);
		}
		$this->renderJson($CompResult);		
	}


	/**
	 * @desc 删除一条投诉记录
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function actionDeleteComplaint(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		$result = khacModel::model()->DeleteComplaint($orderno);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改客户投诉
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function actionUpdateCustomerComplaints(){
		$clientInfo = array();
		$workNumber = CInputFilter::getString('khtsgh');//投诉工号
		$NumberArr = explode(':',$workNumber);
		$tsNumber=$NumberArr[0];

		$work = CInputFilter::getString('tsgjgh');//归属工号
		$Number = explode(':',$workNumber);
		$gjNumber=$Number[0];
		$clientInfo['khac01'] = CInputFilter::getString('khid');//客户id
		$clientInfo['khac13'] = CInputFilter::getString('khxm');//客户姓名
		$clientInfo['khac05'] = CInputFilter::getString('ddbh'); //订单
		//$clientInfo['khac10'] = date('Y-m-d H:i:s'); //提交时间
		$clientInfo['khac11'] = date('Y-m-d H:i:s'); //处理时间
		$clientInfo['khac07'] = CInputFilter::getString('tsbz');//备注
		/*$clientInfo['khac03'] = $tsNumber;//投诉工号
		$clientInfo['khac04'] = $gjNumber;//跟进工号*/
		$clientInfo['khac03']=CInputFilter::getString('khtsgh');//投诉工号
		$clientInfo['khac04']=CInputFilter::getString('tsgjgh');//跟进工号
		$clientInfo['khac08'] = CInputFilter::getString('tscljg');//处理结果
		$clientInfo['khac06'] = CInputFilter::getString('tscp');//投诉产品
		$clientInfo['khac02'] = CInputFilter::getString('khwt');//客户问题
		$clientNo=CInputFilter::getString('clientno');///客户投诉自增id
		if (!empty($clientInfo['khac08'])) {
			$clientInfo['khac12']='已处理';
		}
		else{
			$clientInfo['khac12']='未处理';
		}
		//投诉问题不能为空
		if(!empty($clientInfo['khac02'])){
			$ComplaintsResult = khacModel::model()->UpdateCustomerComplaints($clientInfo,$clientNo);
		}
		$this->renderJson($ComplaintsResult);
	}

	/**
	 * @desc 添加投诉类型（大分类）
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function actionAddTypeComplaint(){
		$clientInfo = array();
		$clientInfo['khad02'] = CInputFilter::getString('lxmc');//类型名称
		$ComplaintsResult = khadModel::model()->AddTypeComplaint($clientInfo);
		
		$this->renderJson($ComplaintsResult);		
	}
	/**
	 * @desc 添加投诉类型(小分类)
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function actionAddSmallTypeComplaint(){
		$clientInfo = array();
		$client= CInputFilter::getString('lxmc');//类型名称
		$a="&nbsp;&nbsp";
		$clientInfo['khad02']=$a.$client;
		$tssjfl= CInputFilter::getString('tssjfl');//上级分类
		$ComplaintsResult = khadModel::model()->AddSmallTypeComplaint($clientInfo,$tssjfl);
		$this->renderJson($ComplaintsResult);		
	}

	/**
	 * @desc 投诉类型列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function actiongetComplaintTypeList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = khadModel::model()->getComplaintTypeList($page,$psize);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 删除投诉类型
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function actionDeleteTypeComplaint(){
		$orderno = CInputFilter::getString('orderno');
		$oderlist= CInputFilter::getString('orderedit');
		if(empty($orderno)){
			return false;
		}
		$result = khadModel::model()->DeleteTypeComplaint($orderno,$oderlist);
		$this->renderJson($result);
	}

	/**
	 * @desc 添加黑名单
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function actionAddBlacklist(){
		$clientInfo = array();
		$clientInfo['khai03'] = CInputFilter::getString('khphone');//手机号
        $ComplaintsResult = khaiModel::model()->AddBlacklist($clientInfo);
		$this->renderJson($ComplaintsResult);		
	}

	/**
	 * @desc 删除一个黑名单电话
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function actionDeleteCustomerBlack(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		$result = khaiModel::model()->DeleteCustomerBlack($orderno);
		$this->renderJson($result);
	}


	/**
	 * @desc 获取黑名单列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function actiongetCustomerBlacklist(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$phone = CInputFilter::getString('phone');
		$result = khaiModel::model()->getCustomerBlacklist($page,$psize,$phone);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}
	/**
	 * @desc 修改黑名单
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function actionModifyEditBlackList(){
		$clientInfo = array();
		$clientInfo['khai03'] = CInputFilter::getString('khphone'); //电话
		//$orderNo=CInputFilter::getString('orderno'); //黑名单编号
		$ComplaintsResult = khaiModel::model()->ModifyEditBlackList($clientInfo);
	
		$this->renderJson($ComplaintsResult);
	}

	/**
	 * @desc 点击编辑获取黑名单电话
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function actiongetEditBlackList(){
		$searchType = '';  		//获取查询搜索类型
		$keyword 	= '';  		//获取查询搜索关键字
		$orderNo = CInputFilter::getString('orderedit');
		$result = khaiModel::model()->getEditBlackList($orderNo);
		$this->renderJson($result);
	}

	/**
	 * @desc 单个或批量转投诉记录
	 * @return json $result 操作的结果
	 * @author huyan
	 * @date 2015-12-09
	 */
	public function actionTurnOutComplaints(){
		$clientInfo = array();
		//确认要转的编号
		$orderno = CInputFilter::getArray('orderno','string');
		
		$workNumber = CInputFilter::getString('zgtsgh');//要转给的客户工号
		$workNumberArr = explode(':',$workNumber);
	    $tsgsgh = $workNumberArr[0];

	    $JobNuber = Yii::app()->session['account'];  //当前用户工号
	    if ($JobNuber==$tsgsgh) {
	    	$this->renderJson(array('res'=>'error','msg'=>'相同工号不能互相转'));
	    }
	    $clientInfo['khac09'] = $tsgsgh;

		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = khacModel::model()->TurnOutComplaints($orderno,$clientInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 单个或批量转客户资料
	 * @return json $result 操作的结果
	 * @author huyan
	 * @date 2015-12-09
	 */
	public function actiongetTurnOutCustomer(){
		$clientInfo = array();
		//确认要转的客户编号
		$orderno = CInputFilter::getArray('orderno','string');
		$workNumber = CInputFilter::getString('zgtsgh');//要转给的客户工号+姓名
		$workNumberArr = explode(':',$workNumber);
	    $zckhgh = $workNumberArr[0];//工号
	    $zckhxm = $workNumberArr[1];//姓名
	    $JobNuber = Yii::app()->session['account'];  //当前用户工号
	    if ($JobNuber==$zckhgh) {
	    	$this->renderJson(array('res'=>'error','msg'=>'相同工号不能互相转'));
	    }
	    $clientInfo['khaa32'] = $zckhgh;
	    $clientInfo['khaa33'] = $zckhxm;
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = khaaModel::model()->getTurnOutCustomer($orderno,$clientInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 分配客户资料
	 * @return json $result 操作的结果
	 * @author huyan
	 * @date 2016-04-01
	 */
	public function actionDistributionCustomer(){
		$clientInfo = array();
		//确认要转的客户编号
		$orderno = CInputFilter::getArray('orderno','string');
		$workNumber = CInputFilter::getString('zgtsgh');//要分配给的客户工号+姓名
		$workNumberArr = explode(':',$workNumber);
	    $zckhgh = $workNumberArr[0];//工号
	    $zckhxm = $workNumberArr[1];//姓名
	    $JobNuber = Yii::app()->session['account'];  //当前用户工号
	    /*if ($JobNuber==$zckhgh) {
	    	$this->renderJson(array('res'=>'error','msg'=>'相同工号不能互相转'));
	    }*/
	    $clientInfo['khaa32'] = $zckhgh;
	    $clientInfo['khaa33'] = $zckhxm;
	    $clientInfo['khaa48'] = "T";
		if(empty($orderno)){
			$this->renderJson(array('result' => 'error'));
		}
		$result = khaaModel::model()->DistributionCustomer($orderno,$clientInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 系统设置->数据清理->数据资料转移
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function actionDataTransfer(){
		$khgh1 = CInputFilter::getString('khgh1');//工号1
		$khgh2 = CInputFilter::getString('khgh2');//工号2
		
		/*$workNumberArr = explode(':',$workNumber);
	    $zckhgh = $workNumberArr[0];//工号
	    $zckhxm = $workNumberArr[1];//姓名*/

	    if ($khgh1==$khgh2) {
	    	$this->renderJson(array('res'=>'error','msg'=>'相同工号不能互转'));
	    }
		$result = khaaModel::model()->DataTransfer($khgh1,$khgh2);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取客户id  姓名
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-01-07
	 */
	public function actiongetNameAndId(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		$result = khaaModel::model()->getNameAndId($page,$psize,$JobNuber);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 添加投诉客户id 姓名查询
	 * @author huyan
	 * @date 2016-01-07
	 */
	public function actionQueryNameOrdId(){
		$searchType = '';  		//获取查询搜索类型
		$keyword 	= '';  		//获取查询搜索关键字
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		$searchtype = CInputFilter::getInt('searchtype');
		$keyword = CInputFilter::getString('keyword');
		$result = khaaModel::model()->QueryNameOrdId($page,$psize,$searchtype,$keyword,$JobNuber);
		$this->renderJson($result);
	}

	/**
	 * @desc 根据呼入号码来获取客户资料
	 * @author WuJunhua
	 * @date 2016-01-20
	 */
	public function actionGetClientDetailByNumber(){
		$callerId = CInputFilter::getString('Callerid');
		$result = khaaModel::model()->getClientDetailByNumber($callerId);
		$this->renderJson($result);
	}

}
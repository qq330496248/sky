<?php
/**
 * @desc 弹窗控制器操作类
 * @author DengShaocong
 * @date 2016-01-14
 */	
class dialogController extends Controller{

	/**
	 * @desc 添加城市以及区号模板显示
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionGetAddCityAndCodeHtml(){
		$sessionInfo = $this->getSessionInfo();
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/addCityAndCode.html');
	}

	/**
	 * @desc 修改城市以及区号模板显示
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionGetUpdateCityAndCodeHtml(){
		$id = CInputFilter::getString('id');
		$city = appCityModel::model()->getSingleCity($id);
		$sessionInfo = $this->getSessionInfo();
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('city',$city[0]);
		$this->display('dialog/updateCityAndCode.html');
	}

	/**
	 * @desc 添加区县信息模板显示
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionGetAddAreaHtml(){
		$sessionInfo = $this->getSessionInfo();
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/addArea.html');
	}

	/**
	 * @desc 修改区县信息模板显示
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionGetUpdateAreaHtml(){
		$id = CInputFilter::getString('id');
		$area = appAreaModel::model()->getSingleArea($id);
		$sessionInfo = $this->getSessionInfo();
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('area',$area);
		$this->display('dialog/updateArea.html');
	}

	/**
	 * @desc 电话转移模板显示
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionGetDhzyHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/dhzy.html');
	}

	/**
	 * @desc 发送内部短信——选择用户模板显示
	 * @author DengShaocong
	 * @date 2016-01-21
	 */
	public function actionGetXzyhHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getAllDept();
		$this->assign('dept',$deptList['list']);
		$this->display('dialog/xzyh.html');
	}

    /**
	 * @desc 提交投诉——选择投诉工号模板显示
	 * @author huyan
	 * @date 2016-03-22
	 */
	public function actionGetXztsghHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getAllDept();
		$this->assign('dept',$deptList['list']);
		$this->display('dialog/xztsgh.html');
	}

	/**
	 * @desc 提交投诉——选择跟进工号模板显示
	 * @author huyan
	 * @date 2016-03-22
	 */
	public function actionGetXzgjghHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getAllDept();
		$this->assign('dept',$deptList['list']);
		$this->display('dialog/xzgjgh.html');
	}

	/**
	 * @desc 提交投诉——选择投诉产品模板显示
	 * @author huyan
	 * @date 2016-03-22
	 */
	public function actionGettscpHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getAllDept();
		$this->assign('dept',$deptList['list']);
		$this->display('dialog/xztscp.html');
	}

	/**
	 * @desc 提交投诉——选择投诉产品模板显示
	 * @author huyan
	 * @date 2016-03-22
	 */
	public function actionGetyddxHtml(){
		$batch = CInputFilter::getString('batch');
		$dxbt = CInputFilter::getString('dxbt');
		$dxnr = CInputFilter::getString('dxnr');
		$dxxh = CInputFilter::getString('dxxh');
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);

		$result = khagModel::model()->GetModifyMessage($dxxh);
		$this->assign('batch', $batch);
		$this->assign('dxbt', $dxbt);
		$this->assign('dxnr', $dxnr);
		$deptList = deptsetModel::model()->getAllDept();
		$this->assign('dept',$deptList['list']);
		$this->display('dialog/yddx.html');
	}


	/**
	 * @desc 客户资料详情——添加跟进记录模板显示
	 * @author DengShaocong
	 * @date 2016-01-21
	 */
	public function actionGetTjgjjlHtml(){
		//工号所在组选项卡
		$ghszz = 'A005';
		$GroupsTypeOptions = syssetModel::model()->getGroupsType($ghszz);
		//跟进标签选项卡
		$gjbq='A006';
		$FollowLabelOptions = syssetModel::model()->getkehuIntoLine($gjbq);
		//工号
		$WorkNumberOptions = rylistModel::model()->getAllWorkNumber();

		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('GroupsTypeOptions',$GroupsTypeOptions);
		$this->assign('FollowLabelOptions',$FollowLabelOptions);
		$this->assign('WorkNumberOptions',$WorkNumberOptions);
		$this->display('dialog/tjgjjl.html');
	}

	/**
	 * @desc 客户资料详情——合并客户资料模板显示
	 * @author DengShaocong
	 * @date 2016-01-21
	 */
	public function actionGetHbkhzlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/hbkhzl.html');
	}

	/**
	 * @desc 客户投诉——查找模板显示
	 * @author DengShaocong
	 * @date 2016-01-21
	 */
	public function actionGetCzkhxmHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/czkhxm.html');
	}

	/**
	 * @desc 订单详情——修改订单显示
	 * @author DengShaocong
	 * @date 2016-01-21
	 */
	public function actionGetDdgdHtml(){
		$orderNo = CInputFilter::getString('orderno');
		$ordernum = CInputFilter::getInt('ordernum');
		$goodprice = CInputFilter::getString('goodprice');
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
		$orderDetails = xsaaModel::model()->getOrderDetails($ordernum,$symbol);
		$this->assign('orderno',$orderDetails);
		$this->assign('goodprice',$goodprice);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/ddgd.html');
	}


	/**
	 * @desc 订单详情——分业绩显示
	 * @author DengShaocong
	 * @date 2016-01-21
	 */
	public function actionGetDdfyjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/ddfyj.html');
	}


	/**
	 * @desc 添加订单——分业绩显示
	 * @author DengShaocong
	 * @date 2016-01-23
	 */
	public function actionGetTjddfyjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/tjddfyj.html');
	}

	/**
	 * @desc 添加订单——商品详情显示
	 * @author DengShaocong
	 * @date 2016-01-23
	 */
	public function actionGetSpxqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$goodId = CInputFilter::getString('goodId');
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('goodId',$goodId);
		$this->display('dialog/spxq.html');
	}

	/**
	 * @desc 各个Excel模板显示
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function actionGetExcelmbHtml(){
		$type = CInputFilter::getString('type');
		$str = '';
		if($type == 'khzl'){
			$str = '客户资料';
		}
		if($type == 'hmddr'){
			$str = '黑名单导入';
		}
		$allCol = syssetModel::model()->getDBInfo($type);
		$this->assign('allCol',$allCol);
		$this->assign('type',$type);
		$this->assign('str',$str);
		$this->display('dialog/excelmb.html');
	}

	/**
	 * @desc 获取一个公告信息
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function actionGetAnnHtml(){
		$id = CInputFilter::getString('id');
		$result = annsetModel::model()->getSingleAnn($id);
		$this->assign('id',$result['id']);
		$this->assign('title',$result['title']);
		$this->assign('anntype',$result['anntype']);
		$this->assign('content',$result['content']);
		$this->assign('iftop',$result['iftop']);
		$this->display('dialog/ggxq.html');
	}

	/**
	 * @desc 通讯录——添加联系人
	 * @author DengShaocong
	 * @date 2016-02-16
	 */
	public function actionGetTjlxrHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/tjlxr.html');
	}

	/**
	 * @desc 通讯录——修改联系人
	 * @author DengShaocong
	 * @date 2016-02-16
	 */
	public function actionGetXglxrHtml(){
		$id = CInputFilter::getString('id');
		$result = contactsetModel::model()->getSingleUser($id);

		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign($result);
		$this->display('dialog/xglxr.html');
	}

	/**
	 * @desc 通讯录模板显示
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function actionGetTxlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('dialog/txl.html');
	}

	/**
	 * @desc 默认省市区信息模板显示
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function actionGetDeafultAddrHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$deafultAddr = syssetModel::model()->getDeafultAddr();
		if(!empty($deafultAddr)){
			if(!empty($deafultAddr['provinceID'])){
				//市
			    $appcityOptions = appCityModel::model()->getCity($deafultAddr['provinceID']);
			    $this->assign('appcityOptions',$appcityOptions);
			}
			if(!empty($deafultAddr['cityID'])){
			    //区
			    $appareaOptions = appAreaModel::model()->getArea($deafultAddr['cityID']);
			    $this->assign('appareaOptions',$appareaOptions);
			}
		}
		$this->assign('deafultAddr',$deafultAddr);
		$this->display('dialog/deafultAddr.html');
	}

	/**
	 * @desc 退货入仓——查找模板显示
	 * @author WuJunhua
	 * @date 2016-03-09
	 */
	public function actionGetCzThddHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('dialog/czthdd.html');
	}

	/**
	 * @desc 退货供应商——查找模板显示
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function actionGetCzCgdhHtml(){
		//供应商
		$SupplierOptions=cgabModel::model()->getSupplierOptions();
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->assign('SupplierOptions',$SupplierOptions);
		$this->display('dialog/czcgdh.html');
	}

	/**
	 * @desc 采购单入库——查找模板显示
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function actionGetCzCgdrkdhHtml(){
		//供应商
		$SupplierOptions=cgabModel::model()->getSupplierOptions();
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->assign('SupplierOptions',$SupplierOptions);
		$this->display('dialog/czcgdrkdh.html');
	}
	/**
	 * @desc 库存明细-弹窗模板显示
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function actionGettckcydmxHtml(){
		//异动原因选项卡
		$ydyy = 'A035';
		$ReasonOptions = syssetModel::model()->getReasonOptions($ydyy);
		$batch = CInputFilter::getString('batch');
		$styleNum = CInputFilter::getString('styleNum');
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->assign('batch',$batch);
		$this->assign('styleNum',$styleNum);
		$this->assign('ReasonOptions',$ReasonOptions);
		$this->display('dialog/kcydmx.html');
	}
	/**
	 * @desc 添加服务器——服务器模板显示
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetTjserverHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/tjserver.html');
	}

	/**
	 * @desc 修改服务器——服务器模板显示
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetXgserverHtml(){
		$id = CInputFilter::getString('id');
		$this->assign('id',$id);
		$result = sysserverModel::model()->getSingleServer($id);
		$this->assign('refSigns',$result['refSigns']);
		$this->assign('serverIp',$result['serverIp']);
		$this->assign('dbName',$result['dbName']);
		$this->assign('dbAccount',$result['dbAccount']);
		$this->assign('dbPwd',$result['dbPwd']);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/xgserver.html');
	}
}

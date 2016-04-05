<?php
/**
 * @desc 系统设置控制器操作类
 * @author DengShaocong
 * @date 2015-10-27
 */	
class xtszController extends Controller{
	/**
	 * @desc 待办事项模板显示
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function actionGetBacklogHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/backlog.html');
	}

	/**
	 * @desc 添加服务器模板显示
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetTjfwqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dialog/tjserver.html');
	}

	/**
	 * @desc 退货原因模板显示
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetThyyHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/thyy.html');
	}

	/**
	 * @desc 退货子（详细）原因模板显示
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetThzyyHtml(){
		$parent = CInputFilter::getString('parent');
		$this->assign('parent',$parent);
		$message = xsaeModel::model()->getSingleReason($parent);
		$this->assign('name',$message['xsae02']);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/thzyy.html');
	}

	/**
	 * @desc 添加退货原因模板显示
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetTjthyyHtml(){
		$sessionInfo = $this->getSessionInfo();
		$parent = CInputFilter::getString("parent");
		$this->assign('parent',$parent);
		$this->assign('sessioninfo', $sessionInfo);
		$thyy = xsaeModel::model()->getAllRejectReasons();
		$this->assign('thyy',$thyy);
		$this->display('xtsz/tjthyy.html');
	}

	/**
	 * @desc 侧边栏模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetLeftHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('index/left.html');
	}

	/**
	 * @desc 右边主页模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetRightHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		//最近七天的业绩查询并显示
		$account = Yii::app()->session['account'];
		$date = date('Y-m-d');
		$result = xsaaModel::model()->getSevenDetails($date,$account);
		$this->assign('result',$result);
		//在线人数
		$people = rylistModel::model()->getOnlinePeopleNum();
		$this->assign('people',$people);
		//今日下单数
		$orders = xsaaModel::model()->getTodayOrders($date);
		$this->assign('orders',$orders);
		//今日完结数
		$finishedOrders = xsaaModel::model()->getTodayFinishedOrders($date);
		$this->assign('finishedOrders',$finishedOrders);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('index/welcome.html');
	}

	/**
	 * @desc 员工考核模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetYgkhHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
	    $this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('xtsz/ygkh.html');
	}

	/** 
	 * @desc 工号管理模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetGhglHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$role = groupRightModel::model()->getGroupRight();
		$this->assign('role',$role['list']);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->display('xtsz/ghgl.html');
	}

	/**
	 * @desc 修改密码模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetXgmmHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xgmm.html');
	}

	/**
	 * @desc 客户资料导入模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetKhzldrHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/khzldr.html');
	}

	/**
	 * @desc 发布公告模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetFbggHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('xtsz/fbgg.html');
	}

	/**
	 * @desc 发布公告模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetFbxggHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/fbxgg.html');
	}

	/**
	 * @desc 数据清理模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetSjqlHtml(){
		//客户等级选项卡
		$khdj = 'A012';
		$CustomerLevelOptions = syssetModel::model()->getCustomerLevel($khdj);
		//客户意向选项
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);

		$Thelibrary=array();
		$Thelibrary['THELIBRARY'] = ddglConst::$Thelibrary[1]; //出库
		$Thelibrary['STORAGRLIBRARY'] = ddglConst::$Thelibrary[2]; //入库

		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('CustomerLevelOptions',$CustomerLevelOptions);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('Thelibrary',$Thelibrary);
		$this->display('xtsz/sjql.html');
	}

	/**
	 * @desc 数据备份与还原模板显示
	 * @author WuJunhua
	 * @date 2016-02-14
	 */
	public function actionGetSjbfyhyHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/sjbfyhy.html');
	}

	/**
	 * @desc 操作记录模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetCzjlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$rylist = rylistModel::model()->getRylistForSelect();
		$this->assign('rylist',$rylist['list']);
		$this->display('xtsz/czjl.html');
	}

	/**
	 * @desc 添加考核项目模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjkhxmHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/tjkhxm.html');
	}

	/**
	 * @desc 添加考核记录模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjkhjlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/tjkhjl.html');
	}

	/**
	 * @desc 添加工号模板显示（获取权限角色并且传递）
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjghHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$role = groupRightModel::model()->getGroupRight();
		$dept = deptsetModel::model()->getAllDept();
		$rylist = rylistModel::model()->getRylistForSelect();
		$this->assign('role',$role['list']);
		$this->assign('dept',$dept['list']);
		$this->assign('rylist',$rylist['list']);
		$this->display('xtsz/tjgh.html');
	}

	/**
	 * @desc 权限角色模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetQxjsHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/qxjs.html');
	}

	/**
	 * @desc 部门管理模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetBmglHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/bmgl.html');
	}

	/**
	 * @desc 添加部门模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjbmHtml(){
		$higherlevel = CInputFilter::getString('higher');
		$sessionInfo = $this->getSessionInfo();
		$this->assign('higher',$higherlevel);
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/tjbm.html');
	}

	/**
	 * @desc 修改部门模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetXgbmHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xgbm.html');
	}

	/**
	 * @desc 添加权限角色模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjqxjsHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/tjqxjs.html');
	}

	/**
	 * @desc 系统设置——400电话设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGet400dhHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xxsz/xxsz_400dh.html');
	}

	/**
	 * @desc 系统设置——公司信息设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetGsxxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$companyInfo = sycompanysetModel::model()->getGsxx();
		$this->assign('companyInfo',$companyInfo);
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/gsxx.html');
	}

	/**
	 * @desc 系统设置——电话黑名单模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetDhhmdHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xxsz/xxsz_dhhmd.html');
	}

	/**
	 * @desc 系统设置——单据格式设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetDjgsHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xxsz/xxsz_djgs.html');
	}

	/**
	 * @desc 系统设置——地区设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetDqHtml(){
		$sessionInfo = $this->getSessionInfo();
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('xtsz/xxsz/xxsz_dq.html');
	}

	/**
	 * @desc 号码屏蔽模板显示
	 * @author WuJunhua
	 * @date 2016-03-31
	 */
	public function actionGetHmpbHtml(){
		$typeencode = 'A036';
		$numberShieldInfo = syssetModel::model()->getNumberShieldMsg($typeencode);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('numberShieldInfo', $numberShieldInfo);
		$this->display('xtsz/xxsz/xxsz_hmpb.html');
	}

	/**
	 * @desc 系统设置——短信关键字屏蔽模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetDxgjzpbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$gjz = $this->actionGetDxgjz();
		$this->assign('gjz',$gjz);
		$this->display('xtsz/xxsz/xxsz_dxgjzpb.html');
	}

	/**
	 * @desc 系统设置——服务器设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetFwqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('xtsz/xxsz/xxsz_fwq.html');
	}

	/**
	 * @desc 系统设置——会员等级设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetHydjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xxsz/xxsz_hydj.html');
	}

	/**
	 * @desc 系统设置——快递公司设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetKdgsHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xxsz/xxsz_kdgs.html');
	}

	/**
	 * @desc 系统设置——客户跟进标签模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetKhgjbqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xxsz/xxsz_khgjbq.html');
	}

	/**
	 * @desc 系统设置——客户意向设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetKhyxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xxsz/xxsz_khyx.html');
	}

	/**
	 * @desc 系统设置——其他设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetQtHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/xxsz/xxsz_qt.html');
	}

	/**
	 * @desc 系统设置——自定义字段模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetDhjbHtml(){
		$number = syssetModel::model()->getDhjb();
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('number',$number['valuetype1']);
		$this->display('xtsz/xxsz/xxsz_dhjb.html');
	}

	/**
	 * @desc 系统设置——职业设置模板显示
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetZyHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$zy = $this->actionGetZy();
		$this->assign('zy',$zy);
		$this->display('xtsz/xxsz/xxsz_zy.html');
	}

	/**
	 * @desc 系统设置——区号设置模板显示
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function actionGetDqqhHtml(){
		$sessionInfo = $this->getSessionInfo();
		//省份
		$appprovinceOptions = appprovinceModel::model()->getappprovince();
		$this->assign('appprovinceOptions',$appprovinceOptions);
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('xtsz/xxsz/xxsz_dqqh.html');
	}

	/**
	 * @desc 库位管理模板显示
	 * @author DengShaocong
	 * @date 2016-01-13
	 */
	public function actionGetKwglHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/kwgl.html');
	}

	/**
	 * @desc 添加权限角色类型
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public function actionAddGroupRight(){
		$grInfo = array();
		$result = array();
		$qxjs = CInputFilter::getString('groupname');
		$qxjsInfo['groupname'] = $qxjs;
		//接收菜单信息
		$rightInfo = array();
		$right = CInputFilter::getString('rightset');
		//获取前端传入的字符串后，拆开获取数组，然后逐个放入rightInfo
		$list = explode('&',$right);
		foreach ($list as $value) {
			array_push($rightInfo, explode('=',$value)[1]);
		}
		$addResult = groupRightModel::model()->addGroupRight($qxjsInfo);
		if($addResult['res'] == 'success'){
			$result = appRightListModel::model()->addRight($rightInfo,$qxjs);
		}else{
			$result = $addResult;
		}
		$this->renderJson($result);
	}

	
	/**
	 * @desc 获取权限角色信息
	 * @return json $reslut 列表信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function actionGetGroupRight(){
		$result = array();  //列表信息结果
		$result = groupRightModel::model()->getGroupRight();				
		$this->renderJson($result);
	}

	/**
	 * @desc 检查权限角色名字是否重复
	 * @return json $reslut 列表信息
	 * @author DengShaocong
	 * @date 2015-12-22
	 */
	public function actionCheckGroupRightExist(){
		$name = CInputFilter::getString('groupname');
		$result = groupRightModel::model()->checkGroupRightExist($name);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除一个权限角色
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function actionDeleteGroupRight(){
		$groupbh = CInputFilter::getString('groupbh');
		$qxjs = groupRightModel::model()->getSingleGroupRight($groupbh);
		$opeInfo['type'] = '删除权限角色';
		$opeInfo['thingid'] = $qxjs['groupbh'];
		$opeInfo['difference'] = $qxjs['groupname'];
		$opeInfo['ry'] = Yii::app()->session['account'].':'.Yii::app()->session['name'];
		$opeInfo['opetime'] = date('Y-m-d h:i:s');
		$delResult = groupRightModel::model()->deleteGroupRight($groupbh);	
		if($delResult['res'] == 'success'){
			$result = sysopesetModel::model()->addOpeSet($opeInfo);
		}	
		$this->renderJson($delResult);
	}

	/**
	 * @desc 获取一个权限角色的信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function actionGetSingleGroupRight(){
		$groupbh = CInputFilter::getString('groupbh');
		$qxjs = groupRightModel::model()->getSingleGroupRight($groupbh);
		$this->assign('groupbh',$qxjs['groupbh']);
		$this->assign('groupname',$qxjs['groupname']);
		//$this->assign('role',$role['list']);
		$this->display('xtsz/xgqxjs.html');
	}

	/**
	 * @desc 获取一个权限角色的权限位
	 * @return json $result 列表信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function actionGetSingleAppRightList(){
		$result = array();
		$groupbh = CInputFilter::getString('groupbh');
		$result = appRightListModel::model()->getSingleAppRightList($groupbh);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改一个权限角色
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function actionUpdateGroupRight(){
		$qxjsInfo = array();
		$groupbh = CInputFilter::getString('groupbh');
		$groupname = CInputFilter::getString('groupname');
		$qxjsInfo['groupname'] = $groupname;
		$qxjsInfo['updatetime'] = date('Y-m-d h:i:s');
		$rightInfo = array();
		$right = CInputFilter::getString('rightset');
		//同添加
		$list = explode('&',$right);
		foreach ($list as $value) {
			array_push($rightInfo, explode('=',$value)[1]);
		}
		$updateResult = groupRightModel::model()->updateGroupRight($groupbh,$qxjsInfo,$rightInfo);
		if($updateResult['res'] =='success'){
			rylistModel::model()->updatePostMess($groupbh,$groupname);
		}
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 添加员工工号
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function actionAddRylist(){
		$ghInfo = array();
		//员工信息
		$ghInfo['username'] = CInputFilter::getString('username');
		$ghInfo['personname'] = CInputFilter::getString('personname');
		$ghInfo['pwd'] = md5(CInputFilter::getString('pwd'));
		$ghInfo['post'] = CInputFilter::getString('groupname');
		$ghInfo['postID'] = CInputFilter::getString('groupbh');
		$ghInfo['department'] = CInputFilter::getString('department');
		$ghInfo['fenji'] = CInputFilter::getString('fenji');
		$ghInfo['telephone'] = CInputFilter::getString('telephone');
		$ghInfo['phone'] = CInputFilter::getString('phone');
		$ghInfo['managerPower'] = CinputFilter::getString('mangerPower');
		$ghInfo['limitIp'] = CInputFilter::getString('IPlimit');
		$ghInfo['limitMAC'] = CInputFilter::getString('MAClimit');
		$ghInfo['enabled'] = CInputFilter::getString('ban');
		$ghInfo['opetime'] = date('Y-m-d H:i:s');	
		$ghInfo['zctime'] = date('Y-m-d H:i:s');	
		$ghInfo['higherlevel'] = CInputFilter::getString('higherlevel');
		//通讯录
		$contact['personname'] = CInputFilter::getString('personname');
		$contact['phone'] = CInputFilter::getString('phone');
		$contact['fenji'] = CInputFilter::getString('fenji');
		$contact['telephone'] = CInputFilter::getString('telephone');
		$contact['department'] = CInputFilter::getString('department');
		$contact['username'] = CInputFilter::getString('username');

		contactsetModel::model()->addUser($contact);
		$addResult = rylistModel::model()->addGh($ghInfo);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 修改当前登录工号的密码
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionChangePwd(){
		$id = Yii::app()->session['id'];
		$oldpwd = md5(CInputFilter::getString("oldpwd"));
		$newpwd = md5(CInputFilter::getString("newpwd"));

		$updateResult = rylistModel::model()->updatePwd($id,$oldpwd,$newpwd);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 查找工号是否存在（用于添加工号的时候的验证）
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function actionCheckExist(){
		$username = CInputFilter::getString('username');
		$result = rylistModel::model()->checkExist($username);
		$this->renderJson($result);
	}

	/**
	 * @desc 根据条件获取员工工号
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetRylistByCond(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$ryInfo = array();
		$ryInfo['username'] = CInputFilter::getString('username');
		$ryInfo['personname'] = CInputFilter::getString('personname');
		$ryInfo['groupbh'] = CInputFilter::getString('groupbh');
		$ryInfo['dept'] = CInputFilter::getString('dept');
		$ryInfo['isonline'] = CInputFilter::getString('isonline');
		$ryInfo['enabled'] = CInputFilter::getString('enabled');

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = rylistModel::model()->getRylistByCond($page,$psize,$ryInfo,$sign);

		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 获取员工工号列表信息（用于select）
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function actionGetRylistForSelect(){
		$result = array();  //列表信息结果
		$result = rylistModel::model()->getRylistForSelect();

		$this->renderJson($result);
	}

	/**
	 * @desc 根据权限角色编号获取员工工号列表信息
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function actionGetRylistByGroupbh(){
		$groupbh = CInputFilter::getString('groupbh');
		$result = array();  //列表信息结果
		$result = rylistModel::model()->getRylistByGroupbh($groupbh);				
		$this->renderJson($result);
	}

	/**
	 * @desc 根据部门编号获取员工工号列表信息
	 * @author DengShaocong
	 * @date 2015-12-10
	 */
	public function actionGetRylistByBm(){
		$dept = CInputFilter::getString('dept');
		$result = array();  //列表信息结果
		$result = rylistModel::model()->getRylistByBm($dept);				
		$this->renderJson($result);
	}

	/**
	 * @desc 删除一个员工工号
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function actionDeleteRylist(){
		$id = CInputFilter::getString('id');
		//添加操作记录
		$gh = rylistModel::model()->getSingleRylist($id);
		$opeInfo['type'] = '删除员工工号';
		$opeInfo['thingid'] = $gh['username'];
		$opeInfo['difference'] = $gh['personname'];
		$opeInfo['ry'] = Yii::app()->session['account'].':'.Yii::app()->session['name'];
		$opeInfo['opetime'] = date('Y-m-d h:i:s');

		$delResult = rylistModel::model()->deleteRylist($id);

		if($delResult['res'] == 'suucess'){
			sysopesetModel::addOpeSet($opeInfo);
		}
		$this->actionGetRylistByCond();
	}
	/**
	 * @desc 获取一个员工工号的信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function actionGetSingleRylist(){
		$id = CInputFilter::getString('id');
		$gh = rylistModel::model()->getSingleRylist($id);
		$this->assign('id',$gh['id']);
		$this->assign('username',$gh['username']);
		$this->assign('pwd',$gh['pwd']);
		$this->assign('post',$gh['postID'].':'.$gh['post']);
		$this->assign('department',$gh['department']);
		$this->assign('higherlevel',$gh['higherlevel']);
		$this->assign('telephone',$gh['telephone']);
		$this->assign('phone',$gh['phone']);
		$this->assign('fenji',$gh['fenji']);
		$this->assign('limitIp',$gh['limitIp']);
		$this->assign('limitMAC',$gh['limitMAC']);
		$this->assign('personname',$gh['personname']);
		$this->assign('enabled',$gh['enabled']);

		$role = groupRightModel::model()->getGroupRight();
		$dept = deptsetModel::model()->getAllDept();
		$rylist = rylistModel::model()->getRylistForSelect();
		$this->assign('role',$role['list']);
		$this->assign('dept',$dept['list']);
		$this->assign('rylist',$rylist['list']);
		$this->display('xtsz/xggh.html');
	}
	/**
	 * @desc 修改一个员工信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function actionUpdateRylist(){
		$ghInfo = array();
		//员工ID以及信息
		$id = CInputFilter::getString('id');
		$hqgh = CInputFilter::getString('hqgh');
		$ghInfo['personname'] = CInputFilter::getString('personname');
		
		$pwd = CInputFilter::getString('pwd');
		if(!empty($pwd)){
			$ghInfo['pwd'] = md5($pwd);
		}else{
			$ghInfo['pwd'] = CInputFilter::getString('oldpwd');
		}
		$ghInfo['postID'] = CInputFilter::getString('groupbh');
		$ghInfo['post'] = CInputFilter::getString('groupname');
		$ghInfo['department'] = CInputFilter::getString('department');
		$ghInfo['telephone'] = CInputFilter::getString('telephone');
		$ghInfo['phone'] = CInputFilter::getString('phone');
		$ghInfo['fenji'] = CInputFilter::getString('fenji');
		$ghInfo['limitIp'] = CInputFilter::getString('IPlimit');
		$ghInfo['limitMAC'] = CInputFilter::getString('MAClimit');
		$ghInfo['enabled'] = CInputFilter::getString('ban');	
		$ghInfo['opetime'] = date('Y-m-d H:i:s');	
		$ghInfo['higherlevel'] = CInputFilter::getString('higherlevel');
		//通讯录
		$contact['personname'] = CInputFilter::getString('personname');
		$contact['role'] = CInputFilter::getString('groupbh');
		$contact['phone'] = CInputFilter::getString('phone');
		$contact['fenji'] = CInputFilter::getString('fenji');
		$contact['telephone'] = CInputFilter::getString('telephone');
		$contact['department'] = CInputFilter::getString('department');
		$contact['opetime'] = date('Y-m-d H:i:s');

		$updateResult = rylistModel::model()->updateRylist($id,$ghInfo,$contact,$hqgh);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 添加员工考核项目
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public function actionAddKhxm(){
		$ygkhInfo = array();
		$ygkhInfo['khxm'] = CInputFilter::getString('khxm');
		$ygkhInfo['type'] = CInputFilter::getString('type');
		$ygkhInfo['score'] = CInputFilter::getString('score');
		$addResult = ygkhModel::model()->addKhxm($ygkhInfo);

		$this->renderJson($addResult);
	}
	
	/**
	 * @desc 获取考核项目信息
	 * @return json $reslut 列表信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function actionGetAllXm(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = ygkhModel::model()->getAllXm($page,$psize);
		
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}
	
	
	/**
	 * @desc 删除一个考核项目
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function actionDeleteXm(){
		$id = CInputFilter::getString('id');
		$delResult = ygkhModel::model()->deleteXm($id);
		$this->renderJson($delResult);
	}

	/**
	 * @desc 获取一个考核项目的信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function actionGetUpdateXm(){
		$id = CInputFilter::getString('id');
		$result = ygkhModel::model()->getSingleXm($id);
		$this->assign('id',$result['id']);
		$this->assign('khxm',$result['khxm']);
		$this->assign('type',$result['type']);
		$this->assign('score',$result['score']);
		$this->display('xtsz/xgkhxm.html');
	}
	/**
	 * @desc 修改一个考核项目
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function actionUpdateXm(){
		$xmInfo = array();
		$id = CInputFilter::getString('id');
		$xmInfo['khxm'] = CInputFilter::getString('khxm');
		$xmInfo['type'] = CInputFilter::getString('type');
		$xmInfo['score'] = CInputFilter::getString('score');
		$updateResult = ygkhModel::model()->updateXm($id,$xmInfo);
		$this->renderJson($updateResult);
	}
	
	/**
	 * @desc 获取客户意向
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetKhyx(){
		$result = array();  //列表信息结果
		$result = syssetModel::model()->getKhyx();
		$this->renderJson($result);
	}

	/**
	 * @desc 添加客户意向
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionAddKhyx(){
		$khyxInfo = array();
		$khyxInfo['typeencode'] = "A016";
		$khyxInfo['valuetype1'] = CInputFilter::getString('khyx');
		$khyxInfo['valuetype2'] = CInputFilter::getString('isPub');
		$addResult = syssetModel::model()->addKhyx($khyxInfo);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 更新一个客户意向
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionUpdateKhyx(){
		$id = CInputFilter::getString("id");
		$khyxInfo = array();
		$khyxInfo['valuetype1'] = CInputFilter::getString('khyx');
		$khyxInfo['valuetype2'] = CInputFilter::getString('isPub');
		$updateResult = syssetModel::model()->updateKhyx($id,$khyxInfo);	
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 删除一个客户意向
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionDeleteKhyx(){
		$id = CInputFilter::getString("id");
		$deleteResult = syssetModel::model()->deleteKhyx($id);
		$this->renderJson($deleteResult);
	}

	/**
	 * @desc 获取会员等级
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetHydj(){
		$result = array();  //列表信息结果
		$result = syssetModel::model()->getHydj();
		$this->renderJson($result);
	}
	/**
	 * @desc 添加会员等级
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionAddHydj(){
		$hydjInfo = array();
		$hydjInfo['typeencode'] = "A012";
		$hydjInfo['valuetype1'] = CInputFilter::getString('hydj');
		$addResult = syssetModel::model()->addHydj($hydjInfo);
		$this->renderJson($addResult);
	}
	/**
	 * @desc 更新一个会员等级
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionUpdateHydj(){
		$id = CInputFilter::getString("id");
		$hydjInfo = array();
		$hydjInfo['valuetype1'] = CInputFilter::getString('hydj');
		$updateResult = syssetModel::model()->updateHydj($id,$hydjInfo);
		$this->renderJson($updateResult);
	}
	/**
	 * @desc 删除一个会员等级
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionDeleteHydj(){
		$id = CInputFilter::getString("id");
		$deleteResult = syssetModel::model()->deleteHydj($id);
		$this->renderJson($deleteResult);
	}

	/**
	 * @desc 获取客户跟进标签
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetKhgjbq(){
		$result = array();  //列表信息结果
		$result = syssetModel::model()->getKhgjbq();
		$this->renderJson($result);
	}
	/**
	 * @desc 添加客户跟进标签
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionAddKhgjbq(){
		$khgjbqInfo = array();
		$khgjbqInfo['typeencode'] = "A006";
		$khgjbqInfo['valuetype1'] = CInputFilter::getString('khgjbq');
		$khgjbqInfo['valuetype3'] = CInputFilter::getString('xh');
		$addResult = syssetModel::model()->addKhgjbq($khgjbqInfo);
		$this->renderJson($addResult);
	}
	/**
	 * @desc 更新一个客户跟进标签
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionUpdateKhgjbq(){
		$id = CInputFilter::getString("id");
		$khgjbqInfo = array();
		$khgjbqInfo['valuetype1'] = CInputFilter::getString('khgjbq');
		$khgjbqInfo['valuetype3'] = CInputFilter::getString('xh');
		$updateResult = syssetModel::model()->updateKhgjbq($id,$khgjbqInfo);	
		$this->renderJson($updateResult);
	}
	/**
	 * @desc 删除一个客户跟进标签
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionDeleteKhgjbq(){
		$id = CInputFilter::getString("id");
		$deleteResult = syssetModel::model()->deleteKhgjbq($id);
		$this->renderJson($deleteResult);
	}

	/**
	 * @desc 获取权限组
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function actionGetDept(){
		$result = array();  //列表信息结果
		$result = deptsetModel::model()->getDeptList();
//		print_r($result);
		$this->renderJson($result);
	}


	public function actionGetBmByHigher(){
		$result = array();  //列表信息结果
		$highid = CInputFilter::getString("id");
		$result = deptsetModel::model()->getBmByHigher($highid);
		$this->renderJson($result);
	}

	/**
	 * @desc 添加部门
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function actionAddDept(){
		$deptInfo = array();
		$deptInfo['depttext'] = CInputFilter::getString('bmmc');
		$deptInfo['ifmarket'] = CInputFilter::getString('ifmarket');
		$deptInfo['higherlevel'] = CInputFilter::getString('higherlevel');
		$deptInfo['level'] = CInputFilter::getString('level');
		$addResult = deptsetModel::model()->addDept($deptInfo);

		$this->renderJson($addResult);
	}
	/**
	 * @desc 获取一个部门信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function actionGetSingleDept(){
		$id = CInputFilter::getString("id");
		$deptInfo = deptsetModel::model()->getSingleDept($id);
		$this->assign('deptid',$deptInfo['deptID']);
		$this->assign('depttext',$deptInfo['depttext']);
		$this->assign('higherlevel',$deptInfo['higherlevel']);
		$this->assign('ifmarket',$deptInfo['ifmarket']);

		$this->display('xtsz/xgbm.html');
	}
	/**
	 * @desc 修改部门
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function actionUpdateDept(){
		$id = CInputFilter::getString("id");
		$deptInfo = array();
		$deptInfo['depttext'] = CInputFilter::getString('depttext');
		$deptInfo['ifmarket'] = CInputFilter::getString('ifmarket');
		$deptInfo['higherlevel'] = CInputFilter::getString('higherlevel');
		$deptInfo['level'] = CInputFilter::getString('level');
		$updateResult = deptsetModel::model()->updateDept($id,$deptInfo);
	
		$this->renderJson($updateResult);
	}
	/**
	 * @desc 删除一个部门
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionDeleteDept(){
		$id = CInputFilter::getString("id");
		$deleteResult = deptsetModel::model()->deleteDept($id);
		$this->renderJson($deleteResult);
	}

	/**
	 * @desc 获取快递公司
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function actionGetKdgs(){
		$result = array();  //列表信息结果
		$result = sykdgssetModel::model()->getAllKdgs();
		$this->renderJson($result);
	}
	/**
	 * @desc 添加快递公司
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function actionAddKdgs(){
		$kdgsInfo = array();
		$kdgsInfo['kdgstext'] = CInputFilter::getString('kdgs');
		$addResult = sykdgssetModel::model()->addKdgs($kdgsInfo);
		$this->renderJson($addResult);
	}
	/**
	 * @desc 启用快递公司
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function actionStartKdgs(){
		$id = CInputFilter::getString("id");
		$kdgsInfo = array();
		$kdgsInfo['ifuse'] = "T";
		$updateResult = sykdgssetModel::model()->updateKdgs($id,$kdgsInfo);	
		$this->actionGetKdgs();
	}
	/**
	 * @desc 停用快递公司
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function actionStopKdgs(){
		$id = CInputFilter::getString("id");
		$kdgsInfo = array();
		$kdgsInfo['ifuse'] = "F";
		$updateResult = sykdgssetModel::model()->updateKdgs($id,$kdgsInfo);	
		$this->actionGetKdgs();
	}

	/**
	 * @desc 停用快递公司
	 * @author DengShaocong
	 * @date 2015-11-15
	 */
	public function actionDeleteKdgs(){
		$id = CInputFilter::getString("id");
		$deleteResult = sykdgssetModel::model()->deleteKdgs($id);	
		$this->renderJson($deleteResult);
	}
	/**
	 * @desc 添加员工考核记录
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function actionAddKhjl(){
		$khjlInfo = array();
		$khjlInfo['xmid'] = CInputFilter::getString("khxm");
		$khjlInfo['ryid'] = CInputFilter::getString("ryid");
		$khjlInfo['khdate'] = CInputFilter::getString("khdate");
		$khjlInfo['remark'] = CInputFilter::getString("bz");
		$khjlInfo['lrdate'] = date('Y-m-d');
		$khjlInfo['setter'] = Yii::app()->session['account'];
		$addResult = examineModel::model()->addKhjl($khjlInfo);
		$this->renderJson($addResult);
	}
	/**
	 * @desc 根据条件查找员工考核记录
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function actionGetKhjlByCond(){
		$khjlInfo = array();
		$khjlInfo['type'] = CInputFilter::getString("type");	
		$khjlInfo['xmid'] = CInputFilter::getString("xmid");
		$khjlInfo['username'] = CInputFilter::getString("username");
		$khjlInfo['begindate'] = CInputFilter::getString("begindate");
		$khjlInfo['enddate'] = CInputFilter::getString("enddate");
		$khjlInfo['enddate'] = !empty($khjlInfo['enddate']) ? $khjlInfo['enddate'].DEFAULT_END_TIME : '';

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$result = examineModel::model()->getKhjlByCond($page,$psize,$khjlInfo);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}
	/**
	 * @desc 删除员工考核记录
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function actionDeleteKhjl(){
		$id = CInputFilter::getString("id");
		$deleteResult = examineModel::model()->deleteKhjl($id);

		$this->actionGetKhjlByCond();
	}
	/**
	 * @desc 获取单个员工考核记录，并跳转修改页面
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function actionGetUpdateKhjl(){
		$id = CInputFilter::getString('id');
		$result = examineModel::model()->getSingleKhjl($id);

		$this->assign('id',$result['id']);
		$this->assign('xmid',$result['xmid']);
		$this->assign('ryid',$result['ryid']);
		$this->assign('khdate',$result['khdate']);
		$this->assign('bz',$result['remark']);

		$this->display('xtsz/xgkhjl.html');
	}
	/**
	 * @desc 更新员工考核记录
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function actionUpdateKhjl(){
		$id = CInputFilter::getString('id');
		$khjlInfo = array();
		$khjlInfo['xmid'] = CInputFilter::getString("khxm");
		$khjlInfo['ryid'] = CInputFilter::getString("ryid");
		$khjlInfo['khdate'] = CInputFilter::getString("khdate");
		$khjlInfo['remark'] = CInputFilter::getString("bz");
		$khjlInfo['lrdate'] = date('Y-m-d');
		$khjlInfo['setter'] = Yii::app()->session['account'];
		$updateResult = examineModel::model()->updateKhjl($id,$khjlInfo);
	
		$this->renderJson($updateResult);
	}
	/**
	 * @desc 获取菜单
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function actionGetMenu(){
		$result = array();  //列表信息结果
		$result = menuModel::model()->getMenu();
		$this->renderJson($result);
	}

	/**
	 * @desc 根据工号获取一个员工的权限位
	 * @return json $result 列表信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function actionGetRyRight(){
		$result = array();
		$groupbh = Yii::app()->session['groupbh'];
		$result = appRightListModel::model()->getRyRight($groupbh);
		$this->renderJson($result);
	}
	/**
	 * @desc 获取400电话
	 * @author DengShaocong
	 * @date 2015-11-13
	 */
	public function actionGet400Dh(){
		$result = array();  //列表信息结果
		$result = sy400dhsetModel::model()->getAll400Dh();
		$this->renderJson($result);
	}
	/**
	 * @desc 添加400电话
	 * @author DengShaocong
	 * @date 2015-11-13
	 */
	public function actionAdd400Dh(){
		$dhInfo = array();
		$dhInfo['orphone'] = CInputFilter::getString('orphone');
		$dhInfo['realphone'] = CInputFilter::getString('realphone');
		$addResult = sy400dhsetModel::model()->add400Dh($dhInfo);
		$this->renderJson($addResult);
	}
	/**
	 * @desc 修改400电话
	 * @author DengShaocong
	 * @date 2015-11-13
	 */
	public function actionUpdate400Dh(){
		$id = CInputFilter::getString("id");
		$dhInfo = array();
		$dhInfo['orphone'] = CInputFilter::getString('orphone');
		$dhInfo['realphone'] = CInputFilter::getString('realphone');
		$updateResult = sy400dhsetModel::model()->update400Dh($id,$dhInfo);	
		$this->actionGet400Dh();
	}
	/**
	 * @desc 删除一个400电话
	 * @author DengShaocong
	 * @date 2015-11-13
	 */
	public function actionDelete400Dh(){
		$id = CInputFilter::getString("id");
		$deleteResult = sy400dhsetModel::model()->delete400Dh($id);
		$this->actionGet400Dh();
	}

	/**
	 * @desc 新增一个公告
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function actionAddAnn(){
		$annInfo = array();
		$annInfo['title'] = trim(CInputFilter::getString('title'));
		$annInfo['iftop'] = trim(CInputFilter::getString('iftop'));
		$annInfo['anntype'] = trim(CInputFilter::getString('anntype'));
		$annInfo['content'] = trim(CInputFilter::getString('content'));
		$annInfo['anndate'] = date('Y-m-d H:i:s');
		$annInfo['ryid'] = trim(Yii::app()->session['id']);
		$addResult = annsetModel::model()->addAnn($annInfo);
		$this->actionGetFbggHtml();
	}
	/**
	 * @desc 获取公告
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function actionGetAnnByCond(){
		$ryid = Yii::app()->session['id'];

		$annCond = array();
		$annCond['ryid'] = $ryid;
		$annCond['anntype'] = CInputFilter::getString("anntype");	
		$annCond['begindate'] = CInputFilter::getString("begindate");
		$annCond['enddate'] = CInputFilter::getString("enddate");
		$annCond['enddate'] = !empty($annCond['enddate']) ? $annCond['enddate'].DEFAULT_END_TIME : '';

		$result = array();  //列表信息结果
		$result = annsetModel::model()->getAnn($annCond);
		$this->renderJson($result);
	}
	/**
	 * @desc 获取公告
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function actionGetAnnForIndex(){
		$annCond = array();
		$result = array();  //列表信息结果
		$result = annsetModel::model()->getAnn($annCond);
		$this->renderJson($result);
	}
	/**
	 * @desc 删除公告
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function actionDeleteAnn(){
		$result = array();  //列表信息结果
		$id = CInputFilter::getString('id');
		$result = annsetModel::model()->deleteAnn($id);
		$this->actionGetFbggHtml();
	}
	/**
	 * @desc 获取一个公告信息
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function actionGetSingleAnn(){
		$id = CInputFilter::getString('id');
		$result = annsetModel::model()->getSingleAnn($id);
		$this->assign('id',$result['id']);
		$this->assign('title',$result['title']);
		$this->assign('anntype',$result['anntype']);
		$this->assign('content',$result['content']);
		$this->assign('iftop',$result['iftop']);

		$this->display('xtsz/xggg.html');
	}

	/**
	 * @desc 获取一个公告信息
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function actionGetAnn(){
		$id = CInputFilter::getString('id');
		$result = annsetModel::model()->getSingleAnn($id);
		$this->assign('id',$result['id']);
		$this->assign('title',$result['title']);
		$this->assign('anntype',$result['anntype']);
		$this->assign('content',$result['content']);
		$this->assign('iftop',$result['iftop']);

		$this->display('xtsz/ggxq.html');
	}

	/**
	 * @desc 更新一个公告信息
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function actionUpdateAnn(){
		$annInfo = array();
		$id = CInputFilter::getString('id');
		$annInfo['title'] = trim(CInputFilter::getString('title'));
		$annInfo['iftop'] = trim(CInputFilter::getString('iftop'));
		$annInfo['anntype'] = trim(CInputFilter::getString('anntype'));
		$annInfo['content'] = trim(CInputFilter::getString('content'));
		$updateResult = annsetModel::model()->UpdateAnn($id,$annInfo);
		$this->actionGetFbggHtml();
	}

	/**
	 * @desc 获取电话黑名单
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function actionGetDhhmd(){
		$result = array();  //列表信息结果
		$result = syssetModel::model()->getDhhmd();
		$this->renderJson($result);
	}

	/**
	 * @desc 添加电话黑名单
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function actionAddDhhmd(){
		$dhhmdInfo = [];
		$dhhmdInfo['typeencode'] = 'A028';
		$dhhmdInfo['valuetype1'] = CInputFilter::getString('phone');
		$dhhmdInfo['valuetype4'] = Yii::app()->session['account'];
		$dhhmdInfo['valuetype5'] = date('Y-m-d H:i:s');
		$result = syssetModel::model()->addDhhmd($dhhmdInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除黑名单电话
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function actionDeleteDhhmd(){
		$id = CInputFilter::getString("id");
		$result= syssetModel::model()->deleteDhhmd($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 更新职业
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function actionUpdateZy(){
		$zy = CInputFilter::getString("zy");
		$zyInfo = explode("\n", $zy);
		$result = syssetModel::model()->updateZy($zyInfo);
		$this->renderJson($result);
	}
	/**
	 * @desc 获取职业
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function actionGetZy(){
		$result = array();
		$result = syssetModel::model()->getZy();
		$str = "";
		foreach($result['list'] as $value){
			$str .= $value['valuetype1'].'&#10;';
		}
		return $str;
	}

	/**
	 * @desc 获取session的某些值
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function actionGetSess(){
		$result = array();
		$result['gh'] = Yii::app()->session['account'];
		$result['name'] = Yii::app()->session['name'];
		$result['fenji'] = Yii::app()->session['fenji'];
		$result['post'] = Yii::app()->session['post'];
		$this->renderJson($result);
	}

	/**
	 * @desc 更新屏蔽的短信关键字
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionUpdateDxgjz(){
		$gjz = CInputFilter::getString("gjz");
		$gjzInfo = explode("，", $gjz);
		$result = syssetModel::model()->updateDxgjz($gjzInfo);
		$this->renderJson($result);
	}
	/**
	 * @desc 获取屏蔽的短信关键字
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionGetDxgjz(){
		$result = array();
		$result = syssetModel::model()->getDxgjz();
		$str = "";
		foreach($result['list'] as $value){
			$str .= $value['valuetype1'].'，';
		}
		$str = substr($str,0,-3); //去除最后一个逗号 
		return $str;
	}

	/**
	 * @desc 获取所有操作记录
	 * @author DengShaocong
	 * @date 2015-12-2
	 */
	public function actionGetCzjlByCond(){
		$setCond = array();
		$setCond['type'] = CInputFilter::getString("type");	
		$setCond['ry'] = CInputFilter::getString("ry");
		$setCond['thingid'] = CInputFilter::getString("thingid");
		$setCond['difference'] = CInputFilter::getString("difference");
		$setCond['beginDate'] = CInputFilter::getString("beginDate").' 00:00:00';
		$setCond['endDate'] = CInputFilter::getString("endDate").' 23:59:59';

		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$result = sysopesetModel::model()->getCzjl($setCond,$page,$psize);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * function      上传文件处理函数
	 * date          2015-11-23
	 * author        WuJunhua
	 * param    string     $name      表单的上传文件框的name名称
	 * param    array      $type      限制上传文件的类型
	 * param    int        $size      限制上传文件的大小[君子协定] 单位: 字节[例：2M为2*1024*1024]
	 * return   array                 上传成功返回2个成员，失败返回一个成员
	 **/
    public function uploads($name,$type,$size){
        $file = $_FILES[$name];
        # 1. 判断当前文件是否是post过来的文件  is_uploaded_file();
        if(!is_uploaded_file($file['tmp_name'])){
           return array('上传文件错误!');
        }
        # 2. 上传文件的错误状态判断 只有 error为0 的时候我们才会做文件上传处理
        if($file['error'] == 1 ){
            return array('上传文件太大!');
        }else if($file['error'] == 2 ){
            return array('上传文件太大!');
        }else if($file['error'] == 3 ){
            return array('上传文件不完整!');
        }else if($file['error'] == 4 ){
            return array('没有找到上传文件');
        }else if($file['error'] >4 ){
            return array('上传文件发生了未知错误,请联系网站工作人员!');
        }

        $pre = pathinfo($file['name'],PATHINFO_EXTENSION);
        # 上传文件的类型判断
        if(!in_array( $pre,$type) ){
            return array('上传文件的类型不正确!');
        }
        $path = Yii::app()->params['upload'];    //上传文件的路径


        $tempFile = $file['tmp_name'];
       
        $fileName = iconv("UTF-8", "GB2312", $file["name"]);
        $filetype = pathinfo($fileName, PATHINFO_EXTENSION);

        # 对上传文件大小进行判断
        if ($file['size'] > $size ){
            return array('上传文件太大!');
        }

   		//上传文件新的路径
        $newPath = $path . gmdate('Y') . '/';
        file_exists($newPath) ? null : mkdir($newPath);
        $newPath .= gmdate('m') . '/';
        file_exists($newPath) ? null : mkdir($newPath);
        # 为了防止上传文件的重命名，建议使用 微秒时间戳加上 随机数
        $newPath .= gmdate('d') . gmdate('h') . gmdate('i') . gmdate('s') . rand(10000, 99999) . "." . $filetype;
        $fileUrl = $newPath;

        # 移动上传文件到我们的目录里面去
        # move_uploaded_file();
        $res = move_uploaded_file($file['tmp_name'],$fileUrl);
        if($res){
           return array('上传文件成功',$fileUrl);  //$newname.'.'.$pre
        }else{
           return array('上传文件失败');
        }
    }

	/**
	 * @desc 更新公司信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function actionUpdateGsxx(){
		$id = CInputFilter::getString('id');
		$companyInfo['number'] = CInputFilter::getString('number');
		$companyInfo['name'] = CInputFilter::getString('name');
		$companyInfo['address'] = CInputFilter::getString('address');
		$companyInfo['type'] = CInputFilter::getString('type');
		$companyInfo['email'] = CInputFilter::getString('email');
		$companyInfo['phone'] = CInputFilter::getString('phone');
		$companyInfo['linkman'] = CInputFilter::getString('linkman');
		$companyInfo['summary'] = CInputFilter::getString('summary');

		if($_FILES){
		    #处理多个文件上传就是在循环中对文件分别进行处理
		    $type=array('gif','jpg','png','jpeg');
		    $size=10*1024*1024;

		    foreach($_FILES as $key=>$value){
			    $img=$this->uploads($key,$type,$size);
			    if(!isset($img[1])){  //$img[1]是上传图片的名字
			        //show_msg('图片上传失败');
			    }else{
			    	$companyInfo['logo'] = $img[1];
			    	//$data[$key]='/uploads/product/'.$img[1];
			    }
		    }
		}
		$updateResult = sycompanysetModel::model()->updateGsxx($id,$companyInfo);
		if($updateResult){
			$this->actionGetGsxxHtml();
		}else{
			echo '<script type="text/javascript">alert("信息出错，请检查是否更新成功！")</script>';
		}
	}

	/**
	 * @desc 处理省份发送过来的参数，并返回该省份下城市的数据
	 * @author DengShaocong
	 * @date 2015-12-31
	 */
	public function actionGetCity(){
		$provinceId = CInputFilter::getString('provinceID');
		$result = array();
		if(empty($provinceId)){
			$result['res'] = 'false';
		}
		$city = appCityModel::model()->getCity($provinceId);
		$result['list'] = $city; 
		$result['res'] = 'success';
		if(empty($city)){
			$result['res'] = 'false';
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 处理城市发送过来的参数，并返回该城市下区县的数据
	 * @author DengShaocong
	 * @date 2015-12-31
	 */
	public function actionGetArea(){
		$cityId = CInputFilter::getString('cityID');
		$result = array();
		if(empty($cityId)){
			$result['res'] = 'false';
		}
		$area = appAreaModel::model()->getArea($cityId);
		$result['list'] = $area; 
		$result['res'] = 'success';
		if(empty($area)){
			$result['res'] = 'false';
		}
		$this->renderJson($result);
	}
	
	/**
	 * @desc 获取地区信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function actionGetAllArea(){
		$ids['pid'] = CInputFilter::getString('provinceID');
		$ids['cid'] = CInputFilter::getString('cityID');
		$ids['aid'] = CInputFilter::getString('areaID');

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = appAreaModel::model()->getAllArea($page,$psize,$ids);
		
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}


	/**
	 * @desc 添加联系人
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function actionAddUser(){
		$user['personname'] = CInputFilter::getString('name');
		$user['sex'] = CInputFilter::getString('sex');
		$user['phone'] = CInputFilter::getString('phone');
		$user['fenji'] = CInputFilter::getString('fenji');
		$user['department'] = CInputFilter::getString('department');
		$user['telephone'] = CInputFilter::getString('telephone');
		$user['otherphone'] = CInputFilter::getString('otherphone');
		$user['faxnumber'] = CInputFilter::getString('faxnumber');
		$user['email'] = CInputFilter::getString('email');
		$user['address'] = CInputFilter::getString('address');
		$user['bz'] = CInputFilter::getString('bz');
		$user['role'] = CInputFilter::getString('role');
		$user['ifsystem'] = '否';
		$addResult = contactsetModel::model()->addUser($user);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 获取所有联系人
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function actionGetUser(){
		$condInfo['department'] = CInputFilter::getString('department');
		$condInfo['name'] = CInputFilter::getString('name');
		$result = contactsetModel::model()->getUser($condInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取单个联系人
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function actionGetSingleUser(){
		$id = CInputFilter::getString('id');
		$result = contactsetModel::model()->getSingleUser($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 更新联系人
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function actionUpdateUser(){
		$id = CInputFilter::getString('id');
		$user['personname'] = CInputFilter::getString('name');
		$user['sex'] = CInputFilter::getString('sex');
		$user['phone'] = CInputFilter::getString('phone');
		$user['fenji'] = CInputFilter::getString('fenji');
		$user['department'] = CInputFilter::getString('department');
		$user['telephone'] = CInputFilter::getString('telephone');
		$user['otherphone'] = CInputFilter::getString('otherphone');
		$user['faxnumber'] = CInputFilter::getString('faxnumber');
		$user['email'] = CInputFilter::getString('email');
		$user['address'] = CInputFilter::getString('address');
		$user['bz'] = CInputFilter::getString('bz');
		$user['updatetime'] = date('Y-m-d H:i:s');
		$updateResult = contactsetModel::model()->updateUser($id,$user);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 删除联系人
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function actionDeleteUser(){
		$id = CInputFilter::getString('id');
		$deleteResult = contactsetModel::model()->deleteUser($id);
		$this->renderJson($deleteResult);
	}

	/**
	 * @desc 批量删除联系人
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function actionDeleteMoreUser(){
		$ids = explode(',', CInputFilter::getString('str'));
		foreach ($ids as $value) {
			if(!empty($value)){
				$deleteRusult = contactsetModel::model()->deleteUser($value);
			}
		}
		$this->renderJson($deleteRusult);
	}

	/**
	 * @desc 添加仓库位
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function actionAddWarehouse(){
		$wareInfo['name'] = CInputFilter::getString('name');
		$wareInfo['place'] = CInputFilter::getString('place');
		$wareInfo['ifuse'] = CInputFilter::getString('ifuse');		
		$addResult = warehouseModel::model()->addWarehouse($wareInfo);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 获取仓库位信息
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function actionGetWarehouse(){
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$result = warehouseModel::model()->getWareHouse($page,$psize);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取最新10条仓库位信息
	 * @author WuJunhua
	 * @date 2016-01-21
	 */
	public function actionGetTenWarehouseData(){
		$location = CInputFilter::getString('location');
		$list = warehouseModel::model()->getTenWarehouseData($location);
		$this->renderJson($list);
	}

	/**
	 * @desc 根据仓位id获取单个仓库位信息
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function actionGetSingleWarehouse(){
		$id = CInputFilter::getString('id');
		$result = warehouseModel::model()->getSingleWarehouse($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 更新仓库位
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function actionUpdateWarehouse(){
		$id = CInputFilter::getString('id');
		$wareInfo['name'] = CInputFilter::getString('name');
		$wareInfo['place'] = CInputFilter::getString('place');
		$wareInfo['ifuse'] = CInputFilter::getString('ifuse');
		$updateResult = warehouseModel::model()->updateWarehouse($id,$wareInfo);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 删除仓库位
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function actionDeleteWarehouse(){
		$id = CInputFilter::getString('id');
		$deleteResult = warehouseModel::model()->deleteWarehouse($id);
		$this->renderJson($deleteResult);
	}

	/**
	 * @desc 禁用仓库位
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function actionStopWarehouse(){
		$id = CInputFilter::getString('id');
		$result = warehouseModel::model()->stopWarehouse($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 启用仓库位
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function actionStartWarehouse(){
		$id = CInputFilter::getString('id');
		$result = warehouseModel::model()->startWarehouse($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取所有区号
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionGetAllCode(){
		$condInfo['pid'] = CInputFilter::getString('provinceID');
		$condInfo['name'] = CInputFilter::getString('keyword');
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = appCityModel::model()->getAllCode($page,$psize,$condInfo);
		
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 新增城市信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionAddCode(){
		$cityInfo['pid'] = CInputFilter::getString('pid');
		$cityInfo['cname'] = CInputFilter::getString('name');
		$cityInfo['areaCode'] = CInputFilter::getString('code');
		$result = appCityModel::model()->addCity($cityInfo);
		$this->renderJson($result);
	}
	/**
	 * @desc 更新城市信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionUpdateCode(){
		$id = CInputFilter::getString('cid');
		$cityInfo['pid'] = CInputFilter::getString('pid');
		$cityInfo['cname'] = CInputFilter::getString('name');
		$cityInfo['areaCode'] = CInputFilter::getString('code');
		$result = appCityModel::model()->updateAreaCode($id,$cityInfo);
		$this->renderJson($result);
	}
	/**
	 * @desc 删除城市信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionDeleteCode(){
		$id = CInputFilter::getString('id');
		$result = appCityModel::model()->deleteCity($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 新增区县信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionAddArea(){
		$areaInfo['cid'] = CInputFilter::getString('cid');
		$areaInfo['aname'] = CInputFilter::getString('name');
		$result = appAreaModel::model()->addArea($areaInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改区县信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionUpdateArea(){
		$id = CInputFilter::getString('aid');
		$areaInfo['cid'] = CInputFilter::getString('cid');
		$areaInfo['aname'] = CInputFilter::getString('name');
		$result = appAreaModel::model()->updateArea($id,$areaInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除区县信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function actionDeleteArea(){
		$id = CInputFilter::getString('id');
		$result = appAreaModel::model()->deleteArea($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取电话信息（用于电话转移）
	 * @author DengShaocong
	 * @date 2016-01-15
	 */
	public function actionGetTransfer(){
		$fenji = CInputFilter::getString('fenji');

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = contactsetModel::model()->getTransfer($page,$psize,$fenji);

		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		
		$this->renderJson($result);
	}

	/**
	 * @desc 检查分机号是否重复
	 * @author DengShaocong
	 * @date 2016-01-15
	 */
	public function actionCheckFenji(){
		$fenji = CInputFilter::getString('fenji');
		$result = rylistModel::model()->checkFenji($fenji);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改手机加拨号码
	 * @author DengShaocong
	 * @date 2016-01-22
	 */
	public function actionUpdateDhjb(){
		$info['valuetype1'] = CInputFilter::getString('number');
		$info['valuetype2'] = date('Y-m-d H:i:s');
		$updateResult = syssetModel::model()->updateDhjb($info);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 获取列名信息（导入导出EXCEL）
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function actionGetCol(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$type = CInputFilter::getString("type");
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = syssetModel::model()->getCol($page,$psize,$type);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 修改列名信息（导入导出EXCEL）
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function actionUpdateCol(){
		$id = CInputFilter::getString('id');
		$info['valuetype4'] = CInputFilter::getString('number');
		$result = syssetModel::model()->updateCol($id,$info);
		$this->renderJson($result);
	}

	/**
	 * @desc 清空列名序号（导入导出EXCEL）
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function actionEmptyCol(){
		$id = CInputFilter::getString('id');
		$result = syssetModel::model()->emptyCol($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 清除服务器上导出excel的xls文件
	 * @author WuJunhua
	 * @date 2016-01-27
	 */
	public function actionDeleteExcelFile(){
		$url = CInputFilter::getString('url');
		$result = unlink($url);
		if(empty($result)){
			$this->renderJson(array('res' => 'error'));
		}
		$this->renderJson(array('res' => 'success'));
	}

	/**
	 * @desc 添加列名 
	 * @author DengShaocong
	 * @date 2016-02-01
	 */
	public function actionAddCol(){
		$id = CInputFilter::getString('id');
		$result = syssetModel::model()->addCol($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 检测并把在线状态改为离线的状态(js定时器每1分钟检测一次)
	 * @author WuJunhua
	 * @date 2016-02-25
	 */
	public function actionCheckAndChangeStatus(){
		$account = CInputFilter::getString('account');
		$result = rylistModel::model()->checkAndChangeStatus($account);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改默认省市区地址信息 
	 * @author DengShaocong
	 * @date 2016-03-04
	 */
	public function actionUpdateDeafultAddr(){
		$deafultAddr['valuetype1'] = CInputFilter::getString('str');
		$deafultAddr['valuetype2'] = '开';
		$deafultAddr['valuetype3'] = date('Y-m-d H:i:s');
		$result = syssetModel::model()->updateDeafultAddr($deafultAddr);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改默认省市区地址信息的开关
	 * @author DengShaocong
	 * @date 2016-03-04
	 */
	public function actionOpenOrCloseDeafultAddr(){
		$deafultAddr['valuetype2'] = CInputFilter::getString('str');
		$deafultAddr['valuetype3'] = date('Y-m-d H:i:s');
		$result = syssetModel::model()->updateDeafultAddr($deafultAddr);
		$this->renderJson($result);
	}

	/**
	 * @desc 修改默认省市区地址信息的开关
	 * @author DengShaocong
	 * @date 2016-03-04
	 */
	public function actionGetDeafultAddr(){
		$result = syssetModel::model()->getDeafultAddr();
		$this->renderJson($result);
	}

	/**
	 * @desc 获取客户待办事项信息
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function actionGetClientBacklog(){
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数

		$cond['type'] = CInputFilter::getString('type') == '' ? '未完成' : CInputFilter::getString('type');
		$cond['backlogType'] = CInputFilter::getString('backlogType');
		$cond['khid'] = CInputFilter::getString('khid');
		$cond['khxm'] = CInputFilter::getString('khxm');
		$cond['account'] = Yii::app()->session['account'];

		$result = khaeModel::model()->getClientBacklog($cond);

		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 获取订单待办事项信息
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function actionGetOrderBacklog(){
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数

		$cond['type'] = CInputFilter::getString('type') == '' ? '未完成' : CInputFilter::getString('type');
		$cond['backlogType'] = CInputFilter::getString('backlogType');
		$cond['khid'] = CInputFilter::getString('khid');
		$cond['khxm'] = CInputFilter::getString('khxm');
		$cond['account'] = Yii::app()->session['account'];

		$result = xsadModel::model()->getOrderBacklog($cond);

		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 完成客户待办事项
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function actionFinishClientBacklog(){
		$id = CInputFilter::getString('id');
		$result = khaeModel::model()->finishClientBacklog($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 批量完成客户待办事项
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function actionFinishClientBacklogs(){
		$str = CInputFilter::getString('str');
		$result = khaeModel::model()->finishClientBacklogs($str);
		$this->renderJson($result);
	}

	/**
	 * @desc 完成订单待办事项
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function actionFinishOrderBacklog(){
		$id = CInputFilter::getString('id');
		$result = xsadModel::model()->finishOrderBacklog($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 批量完成订单待办事项
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function actionFinishOrderBacklogs(){
		$str = CInputFilter::getString('str');
		$result = xsadModel::model()->finishOrderBacklogs($str);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货原因（大类）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetThyyHigherByCond(){
		$result = xsaeModel::model()->getAllRejectReasons();
		$this->renderJson($result);
	}

	/**
	 * @desc 添加退货原因
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionAddThyy(){
		$parent = CInputFilter::getString('parent');
		$thyy = CInputFilter::getString('thyy');
		$result = array();
		if($parent != '0'){
			$info['xsaf01'] = $parent;
			$info['xsaf02'] = $thyy;
			$result = xsafModel::model()->addThzyy($info);
		}else{
			$info['xsae02'] = $thyy;
			$result = xsaeModel::model()->addThyy($info);
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货原因（小类）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetThzyyByCond(){
		$parent = CInputFilter::getString('parent');
		$result = xsafModel::model()->getAllRejectContent($parent);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除退货原因（大类）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionDeleteThyy(){
		$id = CInputFilter::getString('id');
		$result = xsaeModel::model()->deleteThyy($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除退货原因（小类）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionDeleteThzyy(){
		$id = CInputFilter::getString('id');
		$result = xsafModel::model()->deleteThzyy($id);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取单个退货原因（大类）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetSingleThyy(){
		$id = CInputFilter::getString('id');
		$result = xsaeModel::model()->getSingleReason($id);
		$this->assign('id',$result['xsae01']);
		$this->assign('thname',$result['xsae02']);
		$thyy = xsaeModel::model()->getAllRejectReasons();
		$this->assign('thyy',$thyy);
		$this->display('xtsz/xgthyy.html');
	}

	/**
	 * @desc 获取单个退货原因（小类）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetSingleThzyy(){
		$id = CInputFilter::getString('id');
		$result = xsafModel::model()->getSingleReason($id);
		$this->assign('id',$result['xsaf03']);
		$this->assign('thname',$result['xsaf02']);
		$this->assign('parent',$result['xsaf01']);
		$thyy = xsaeModel::model()->getAllRejectReasons();
		$this->assign('thyy',$thyy);
		$this->display('xtsz/xgthyy.html');
	}

	/**
	 * @desc 更新退货原因（大小类）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionUpdateThyy(){
		$id = CInputFilter::getString('id');
		$thyy = CInputFilter::getString('thyy');
		$parent = CInputFilter::getString('parent');
		if($parent == 0){
			$info['xsae02'] = $thyy;
			$result = xsaeModel::model()->updateThyy($id,$info);
		}else{
			$info['xsaf01'] = $parent;
			$info['xsaf02'] = $thyy;
			$result = xsafModel::model()->updateThzyy($id,$info);
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 获取订单信息
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetOrderMessage(){
		$username = CInputFilter::getString('username');
		$result = xsaaModel::model()->getOrderMessage($username);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取服务器列表
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionGetServerByCond(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$result = sysserverModel::model()->getServerByCond($page,$psize);

		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 添加服务器
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionAddServer(){
		$info['refSigns'] = CInputFilter::getString('refSigns');
		$info['serverIp'] = CInputFilter::getString('serverIp');
		$info['dbName'] = CInputFilter::getString('dbName');
		$info['dbAccount'] = CInputFilter::getString('dbAccount');
		$info['dbPwd'] = CInputFilter::getString('dbPwd');

		$result = sysserverModel::model()->addServer($info);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除服务器
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionDeleteServer(){
		$id = CInputFilter::getString('id');
		$result = sysserverModel::model()->deleteServer($id);
		$this->renderJson($result);
	}


	/**
	 * @desc 修改服务器
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionUpdateServer(){
		$id = CInputFilter::getString('id');
		$info['refSigns'] = CInputFilter::getString('refSigns');
		$info['serverIp'] = CInputFilter::getString('serverIp');
		$info['dbName'] = CInputFilter::getString('dbName');
		$info['dbAccount'] = CInputFilter::getString('dbAccount');
		$info['dbPwd'] = CInputFilter::getString('dbPwd');
		$result = sysserverModel::model()->updateServer($id,$info);
		$this->renderJson($result);
	}

	/**
	 * @desc 系统初始化
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function actionInitializeSystem(){

	}

	/**
	 * @desc 获取内部未读短信
	 * @author DengShaocong
	 * @date 2016-03-25
	 */
	public function actionGetNoReadMess(){
		$username = CInputFilter::getString('username');
		$result = khagModel::model()->getNoReadMess($username);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取财务人员工作提示
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function actionGetCwryMessage(){
		$result = xsaaModel::model()->getCwryMessage();
		return $result;
	}

	/**
	 * @desc 获取物流人员工作提示
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function actionGetWlryMessage(){
		$result = xsaaModel::model()->getWlryMessage();
		return $result;
	}

	/**
	 * @desc 修改号码屏蔽信息
	 * @author WuJunhua
	 * @date 2016-03-31
	 */
	public function actionUpdateHmpb(){
		$result = []; //结果信息
		$infoArr = []; //号码屏蔽信息
		$id = CInputFilter::getInt('id');
		$infoArr['valuetype1'] = CInputFilter::getString('number');
		$infoArr['valuetype2'] = CInputFilter::getString('shield');
		$infoArr['valuetype3'] = CInputFilter::getString('position');
		$result = syssetModel::model()->updateHmpb($id,$infoArr);
		$this->renderJson($result);
	}


}

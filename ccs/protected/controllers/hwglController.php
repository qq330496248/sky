<?php
/**
 * @desc 话务管理控制器操作类
 * @author WuJunhua
 * @date 2016-01-04
 */	
class hwglController extends Controller{
	/**
	 * @desc 座席状态模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetZxztHtml(){
		//部门
		$dept = deptsetModel::model()->getAllDepartment();
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('dept', $dept);
		$this->display('hwgl/zxzt.html');
	}
	/**
	 * @desc 队列状态模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetDlztHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('hwgl/dlzt.html');
	}
	/**
	 * @desc 队列监控模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetDljkHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('hwgl/dljk.html');
	}
	/**
	 * @desc 今日状态模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetJrdtHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('hwgl/jrdt.html');
	}
	/**
	 * @desc 强制注销模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetQzzxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('hwgl/qzzx.html');
	}

	/**
	 * @desc 强制注销
	 * @author WuJunhua
	 * @date 2016-02-25
	 */
	public function actionForceLogoff(){
		$userInfo = [];
		$sign = CInputFilter::getInt('sign'); //标识
		if($sign == 2){
			$userInfo['username'] = CInputFilter::getString('username'); //用户名
			if(empty($userInfo['username'])){
				$this->renderJson(array('res' => 'tips','msg' => '用户名不能为空'));
			}
		}
		$userInfo['fenji'] = CInputFilter::getString('fenji'); //要强制注销的分机号码
		if(empty($sign) || empty($userInfo['fenji'])){
			$this->renderJson(array('res' => 'error','msg' => '操作有误'));
		}
		$result = rylistModel::model()->forceLogoff($sign,$userInfo);
		$this->renderJson($result);
	}	
}

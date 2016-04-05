<?php
/**
 * @desc 通话管理控制器操作类
 * @author DengShaocong
 * @date 2015-10-27
 */	
class thglController extends Controller{
	/**
	 * @desc 全部通话记录模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetQbthjlHtml(){
		//客户来源选项卡
		$khly='A013';
		$ClientSourceOptions = syssetModel::model()->getClientSource($khly);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('ClientSourceOptions', $ClientSourceOptions);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('thgl/qbthjl.html');
	}

	/**
	 * @desc 分机通话统计报表模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetFjthtjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->display('thgl/fjthtjbb.html');
	}

	/**
	 * @desc 呼损分析报表模板显示
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function actionGetHsfxbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('thgl/hsfxbb.html');
	}

	/**
	 * @desc 根据号码获取通话记录里的客户信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2016-01-28
	 */
	public function actionGetClientInfoByNumber(){
		$result = [];  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$sign = CInputFilter::getInt('sign');  //导出excel标识

		$CondList = array();
		$CondList['khzcsjq'] = CInputFilter::getString('khzcsjq');
		$CondList['khzcsjz'] = CInputFilter::getString('khzcsjz');
		$CondList['khzcsjz'] = !empty($CondList['khzcsjz']) ? $CondList['khzcsjz'].DEFAULT_END_TIME : '';
		$CondList['thgh'] = CInputFilter::getString('thgh');
		$CondList['thfj'] = CInputFilter::getString('thfj');
		$CondList['khid'] = CInputFilter::getString('khid');
		$CondList['zjhm'] = CInputFilter::getString('zjhm');
		$CondList['bjhm'] = CInputFilter::getString('bjhm');
		$CondList['khly'] = CInputFilter::getString('khly');

		$result = thaaModel::model()->getClientInfoByNumber($page,$psize,$sign,$CondList);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 系统设置->数据清理->删除通话记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function actionDelCallRecord(){
		$CurrentTime= date('Y-m-d H:i'); 
		$thsjq = CInputFilter::getString('thsjq');
		$thsjz = CInputFilter::getString('thsjz');
		$dqsj=(strtotime($CurrentTime));
		$gjsj=(strtotime($thsjq));
		$diff = (int)(($dqsj-$gjsj)/(24*3600));
		if (!empty($thsjq)&&empty($thsjz)) {
			if ($diff<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的通话记录'));
		    }
		}
		$thsjd=(strtotime($thsjz));
		$diff1 = (int)(($dqsj-$thsjd)/(24*3600));
		if (empty($thsjq)&&!empty($thsjz)) {
			if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的通话记录'));
		    }
		}
		if (!empty($thsjq)&&!empty($thsjz)) {
            if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的通话记录'));
		    }
		}
		$thsjz = !empty($thsjz) ? $thsjz.DEFAULT_END_TIME : '';
		$result = thaaModel::model()->DelCallRecord($thsjq,$thsjz);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取10.230上的通话记录并插入到我们的系统里 【应该要用定时器来获取，待完善-------------】
	 * @author WuJunhua
	 * @date 2016-02-18
	 */
	public function actionGetCallingRecords(){
		$result = thaaModel::model()->getCallingRecords();
		$this->renderJson($result);
	}

	
	/**
	 * @desc 获取客户通话记录
	 * @author huyan
	 * @date 2016-03-02
	 */
	public function actionGetCallRecords(){
		$khphonecall = CInputFilter::getString('khphonecall');
		if(empty($khphonecall)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = thaaModel::model()->GetCallRecords($khphonecall,$page,$psize);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取客户通话记录失败'));
		}
		$this->renderJson($result);

	}

	/**
	 * @desc 客户详情页面删除通话记录
	 * @author huyan
	 * @date 2016-03-02
	 */
	public function actionDelCallRecords(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		$result = thaaModel::model()->DelCallRecords($orderno);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取分机通话记录报表
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function actionGetFjthtjbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['day'] = CInputFilter::getString('day');
		$result = thaaModel::model()->getFjthtjbbByCond($cond);
		$this->renderJson($result);
	}
}

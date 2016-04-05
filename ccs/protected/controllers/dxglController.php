
<?php
/**
 * @desc 短信管理控制器操作类
 * @author DengShaocong
 * @date 2016-01-06
 */	
class dxglController extends Controller{
	/**
	 * @desc 内部短信-发送内部短信模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetFsnbdxHtml(){
		$JobNuber = Yii::app()->session['account'];  //当前用户工号
		$a='来自';
		$b='的短信';
        $biaoti=$a.$JobNuber.$b;
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('biaoti',$biaoti);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('dxgl/fsnbdx.html');
	}
	/**
	 * @desc 内部短信-已发内部短信模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetYfnbdxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('dxgl/yfnbdx.html');
	}
	/**
	 * @desc 内部短信-已收内部短信模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetYsnbdxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('dxgl/ysnbdx.html');
	}
	/**
	 * @desc 内部短信-内部短信回复查询模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetNbhfcxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dxgl/nbhfcx.html');
	}



	/**
	 * @desc 外部短信-发送外部短信模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetFswbdxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('dxgl/fswbdx.html');
	}
	/**
	 * @desc 外部短信-已发外部短信模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetYfwbdxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('dxgl/yfwbdx.html');
	}
	/**
	 * @desc 外部短信-已收外部短信模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetYswbdxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('dxgl/yswbdx.html');
	}
	/**
	 * @desc 外部短信-回复查询
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetWbhfcxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('dxgl/wbhfcx.html');
	}

	/**
	 * @desc 获取已发内部短信列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-11-10
	 */
	public function actiongetSentMessages(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
		$CondList['fssjq'] = CInputFilter::getString('fssjq');
		$CondList['fssjz'] = CInputFilter::getString('fssjz');
		$CondList['fssjz'] = !empty($CondList['fssjz']) ? $CondList['fssjz'].DEFAULT_END_TIME : '';
		$CondList['jsgh'] = CInputFilter::getString('jsgh');
		$CondList['dxbt'] = CInputFilter::getString('dxbt');
        $JobNuber = Yii::app()->session['account'];  //当前用户工号

		$result = khagModel::model()->getSentMessages($page,$psize,$CondList,$JobNuber);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取已收内部短信列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2015-11-10
	 */
	public function actiongetReceivedMessages(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
		$CondList['fssjq'] = CInputFilter::getString('fssjq');
		$CondList['fssjz'] = CInputFilter::getString('fssjz');
		$CondList['fssjz'] = !empty($CondList['fssjz']) ? $CondList['fssjz'].DEFAULT_END_TIME : '';
		$CondList['jsgh'] = CInputFilter::getString('jsgh');
		$CondList['dxbt'] = CInputFilter::getString('dxbt');
        $JobNuber = Yii::app()->session['account'];  //当前用户工号

		$result = khagModel::model()->getReceivedMessages($page,$psize,$CondList,$JobNuber);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 删除内部短信
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function actionDelSentMessages(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		$result = khagModel::model()->DelSentMessages($orderno);
		$this->renderJson($result);
	}


	/**
	 * @desc 获取客户详情页面短信记录（外部短信）
	 * @author huyan
	 * @date 2016-03-03
	 */
	public function actionGetShortmesRecords(){
		$khphonecall = CInputFilter::getString('khphonecall');
		if(empty($khphonecall)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = khafModel::model()->GetShortmesRecords($khphonecall,$page,$psize);
		if(empty($result)){
			$this->renderJson(array('res' => 'error','msg' => '获取客户短信记录失败'));
		}
		$this->renderJson($result);
	}


    /**
	 * @desc 删除一条客户详情页面短信记录（外部短信）
	 * @author huyan
	 * @date 2016-03-03
	 */
	public function actionDelShortmesRecords(){
		$orderno = CInputFilter::getString('orderno');
		if(empty($orderno)){
			return false;
		}
		$result = khafModel::model()->DelShortmesRecords($orderno);
		$this->renderJson($result);
	}

}
?>
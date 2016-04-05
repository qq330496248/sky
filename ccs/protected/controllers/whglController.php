<?php
/**
 * @desc 外呼管理控制器操作类
 * @author WuJunhua
 * @date 2016-01-06
 */	
class whglController extends Controller{
	/**
	 * @desc 任务列表模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetRwlbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('whgl/rwlb.html');
	}

	/**
	 * @desc 回访任务模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetHfrwHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('whgl/hfrw.html');
	}

	/**
	 * @desc 我的任务模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetWdrwHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('whgl/wdrw.html');
	}

	/**
	 * @desc 问卷列表模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetWjlbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('whgl/wjlb.html');
	}

	/**
	 * @desc 外呼统计模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetWhbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('whgl/whbb.html');
	}

	/**
	 * @desc 外呼明细模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetWhmxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('whgl/whmx.html');
	}

	/**
	 * @desc 问卷统计模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetWjtjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('whgl/wjtj.html');
	}

	/**
	 * @desc 添加问卷模板显示
	 * @author DengShaocong
	 * @date 2016-01-05
	 */
	public function actionGetTjwjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('whgl/tjwj.html');
	}

	/**
	 * @desc 问卷详情
	 * @author WuJunhua
	 * @date 2016-01-08
	 */
	public function actionGetBookDetails(){
		$bookId = CInputFilter::getInt('bookId');
		$bookDetails = whaaModel::model()->getBookDetails($bookId);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('bookDetails', $bookDetails);
		$this->display('whgl/bjwj.html');
	}

	/**
	 * @desc 添加问卷
	 * @author WuJunhua
	 * @date 2016-01-07
	 */
	public function actionAddBook(){
		$bookInfo = array();
		$bookInfo['whaa02'] = CInputFilter::getString('bookName');
		$bookInfo['whaa03'] = CInputFilter::getString('bookIntroduce');
		$bookInfo['whaa04'] = date('Y-m-d H:i:s');
		$bookInfo['whaa05'] = date('Y-m-d H:i:s');
		$bookInfo['whaa06'] = Yii::app()->session['name'];
		$bookInfo['whaa07'] = Yii::app()->session['fenji'];
		$result = whaaModel::model()->addBook($bookInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取问卷列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2016-01-08
	 */
	public function actionGetQuestionnaireList(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$result = whaaModel::model()->getQuestionnaireList($page,$psize);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 修改问卷信息
	 * @author WuJunhua
	 * @date 2016-01-08
	 */
	public function actionUpdateBookMsg(){
		$bookInfo = array();
		$bookId = CInputFilter::getInt('bookId');
		if(empty($bookId)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误'));
		}
		$bookInfo['whaa02'] = CInputFilter::getString('bookName'); 
		$bookInfo['whaa03'] = CInputFilter::getString('bookIntroduce'); 
		$bookInfo['whaa05'] = date('Y-m-d H:i:s'); 
		$result = whaaModel::model()->updateBookMsg($bookId,$bookInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 删除问卷
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	public function actionDeleteBookData(){
		$bookId = CInputFilter::getInt('bookId');
		if(empty($bookId)){
			$this->renderJson(array('res' => 'error','msg' => '操作有误'));
		}
		$result = whaaModel::model()->deleteBookData($bookId);
		$this->renderJson($result);
	}

}

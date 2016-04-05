<?php
/**
 * @desc 报表控制器操作类
 * @author DengShaocong
 * @date 2016-01-19
 */	
class grfController extends Controller{
	/**
	 * @desc 模板显示
	 * @author DengShaocong
	 * @date 2016-01-19
	 */
	public function actionGetTestHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('grfHTML/testShow.html');
	}
}
?>
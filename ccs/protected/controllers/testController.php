<?php
/**
 * @desc 采购管理模块控制器操作类
 * @author Dengshaocong
 * @date 2015-11-12
 */
class testController extends Controller{

	public function actionIndex(){
    
		$info = cdrModel::model()->getCallingRecordsByRemote();
		//$info = khaaModel::model()->test();
	}

}
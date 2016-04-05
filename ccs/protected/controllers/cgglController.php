<?php
/**
 * @desc 采购管理模块控制器操作类
 * @author HuYan
 * @date 2015-11-12
 */
class cgglController extends Controller{
	/**
	* @desc 采购单列表模板显示
    * @author HuYan
	* @date 2015-11-12
	*/
	public function actionGetCgdlbHtml(){
		//供应商选项卡
		$gyslb = 'A025';
		$SuppliersOptions = cgabModel::model()->getGys();
		//所有分类
		$khyx='A016';
		$CustomerIntentionOptions = syssetModel::model()->getCustomerIntention($khyx);
		//是否完成
		$sfwc='A021';
		$IsCompleteOptions = syssetModel::model()->getIsComplete($sfwc);
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('SuppliersOptions',$SuppliersOptions['list']);
		$this->assign('CustomerIntentionOptions',$CustomerIntentionOptions);
		$this->assign('IsCompleteOptions',$IsCompleteOptions);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('cggl/cgdlb.html');
	}
	/**
	 * @desc 下采购单模板显示
	 * @author HuYan
	 * @date 2015-11-11
	 */
	public function actionGetXcgdHtml(){
		$SuppliersOptions = cgabModel::model()->getGys();
		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('SuppliersOptions',$SuppliersOptions['list']);
		$day = date('Y-m-d');
		$this->assign('time',$day);
		$this->assign('cpkh',CInputFilter::getString('cpkh'));
		$this->assign('cpmc',CInputFilter::getString('cpmc'));
		$this->assign('cjhh',CInputFilter::getString('cjhh'));
		$this->display('cggl/xcgd.html');
	}

	/**
	 * @desc 添加供应商——模板显示
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionGetTjgysHtml(){
		$sessionInfo = $this->getSessionInfo();
		$cgwyList = rylistModel::model()->getCgwyList();
		$cgzyList = rylistModel::model()->getCgzyList();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('cgwy',$cgwyList['list']);
		$this->assign('cgzy',$cgzyList['list']);
		$this->display('cggl/tjgys.html');
	}

	/**
	 * @desc 修改采购单模板显示
	 * @author HuYan
	 * @date 2015-11-13
	 */
	public function actionGetCgdxgHtml(){
		//供应商选项卡
		$gyslb = 'A025';
		$SuppliersOptions = cgabModel::model()->getGys();

		//smarty赋值
		$sessionInfo = $this->getSessionInfo();
		$this->assign('SuppliersOptions',$SuppliersOptions['list']);
		$this->assign('sessioninfo', $sessionInfo);
		//$this->display('cggl/cgxdxg.html');
		$id = CInputFilter::getString('id');
		$rseult = cgaaModel::model()->getSingleCgd($id);
		//if(!empty($currentClientData)){
		$this->assign('id',$id);
		$this->assign('dhsj',$rseult['cgaa07']);
		$this->assign('gys',$rseult['cgaa09']);
		$this->assign('yf',$rseult['cgaa08']);
		$this->display('cggl/cgdxg.html');
		//} 
	}

	/**
	 * @desc 供应商列表模板显示
	 * @author HuYan
	 * @date 2015-11-11
	 */
	public function actionGetGyslbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$cgwyList = rylistModel::model()->getCgwyList();
		$post = Yii::app()->session['post']; 
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('cgwy',$cgwyList['list']);
		$this->assign('post',$post);
		$account = Yii::app()->session['account'];
		$this->assign('account',$account);
		$this->display('cggl/gyslb.html');
	}


	/**
	 * @desc 供应商统计报表列表模板显示
	 * @author HuYan
	 * @date 2015-11-11
	 */
	public function actionGetGystjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$cgwyList = rylistModel::model()->getCgwyList();
		$cgzyList = rylistModel::model()->getCgzyList();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('cgwy',$cgwyList['list']);
		$this->assign('cgzy',$cgzyList['list']);
		$this->display('cggl/gystjbb.html');
	}

	/**
	 * @desc 增加额外的采购单模板显示
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function actionGetAddcgdHtml(){
		$id = CInputFilter::getString('id');
		$result = cgacModel::model()->getMaxCount($id);
		$this->assign('id',$id);
		$this->assign('count',$result['cgac11']);
		$this->display('cggl/addcgd.html');
	}

	/**
	 * @desc 修改采购单模板显示
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function actionGetUpdatecgdHtml(){
		$id = CInputFilter::getString('id');
		$count = CInputFilter::getString('count');
		$result = cgacModel::model()->getSingleCgd($id,$count);
		$this->assign('id',$id);
		$this->assign('count',$count);
		$this->assign('cgkh',$result['cgac03']);
		$this->assign('cgmc',$result['cgac04']);
		$this->assign('jhj',$result['cgac05']);
		$this->assign('cgsx',$result['cgac08']);
		$this->assign('cgsl',$result['cgac06']);
		$this->display('cggl/updatecgd.html');
	}
	
	/**
	 * @desc 添加供应商
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionAddGys(){
		$gysInfo = array();
		$gysInfo['cgab02'] = CInputFilter::getString('name');
		$gysInfo['cgab03'] = CInputFilter::getString('address');
		$gysInfo['cgab19'] = CInputFilter::getString('gysfl');
		$gysInfo['cgab14'] = CInputFilter::getString('zh');
		$gysInfo['cgab15'] = CInputFilter::getString('jkfs');
		$gysInfo['cgab04'] = CInputFilter::getString('type');
		$gysInfo['cgab13'] = date('Y-m-d H:i:s');
		$gysInfo['cgab17'] = date('Y-m-d');
		$gysInfo['cgab16'] = CInputFilter::getString('bz');
		$cgwy = explode('-', CInputFilter::getString('cgwy'));

		$gysInfo['cgab20'] = $cgwy[0] != '' ? $cgwy[0] : '';
		$gysInfo['cgab21'] = !empty($cgwy[1]) ? $cgwy[1] : '';

		$addResult = cgabModel::model()->addGys($gysInfo);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 检验供应商名称是否存在
	 * @author DengShaocong
	 * @date 2015-12-18
	 */
	public function actionCheckExist(){
		$name = CInputFilter::getString('name');
		$result = cgabModel::model()->checkExist($name);
		$this->renderJson($result);
	}

	/**
	 * @desc 根据条件获取供应商
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionGetGysByCond(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$post = Yii::app()->session['post'];
		$gysInfo = array();
		//如果当前登录的员工是采购人员，那么只查自己负责的供应商
		if($post == '采购人员'){
			$gysInfo['cgwy'] = Yii::app()->session['id'];
		}else{
			$gysInfo['cgwy'] = CInputFilter::getString('cgwy');
		}
		$gysInfo['id'] = CInputFilter::getString('gysid');
		$gysInfo['name'] = CInputFilter::getString('name');
		$gysInfo['money'] = CInputFilter::getString('money');
		$gysInfo['begindate'] = CInputFilter::getString('begindate');
		$gysInfo['enddate'] = CInputFilter::getString('enddate');
		$gysInfo['enddate'] = !empty($gysInfo['enddate']) ? $gysInfo['enddate'].DEFAULT_END_TIME : '';
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$result = cgabModel::model()->getGysByCond($page,$psize,$gysInfo);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取供应商
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionGetGys(){
		$result = array();  //列表信息结果
		$result = cgabModel::model()->getGys();
		$this->renderJson($result);
	}

	/**
	 * @desc 获取单个供应商
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionGetSingleGys(){
		$id = CInputFilter::getString('id');
		//采购文员，采购专员
		$cgwyList = rylistModel::model()->getCgwyList();
		$this->assign('cgwyList',$cgwyList['list']);
		//供应商信息
		$gysInfo = cgabModel::model()->getSingleGys($id);
		$this->assign('id',$gysInfo['cgab01']);
		$this->assign('name',$gysInfo['cgab02']);
		$this->assign('address',$gysInfo['cgab03']);
		$this->assign('type',$gysInfo['cgab04']);
		$this->assign('account',$gysInfo['cgab14']);
		$this->assign('jkfs',$gysInfo['cgab15']);
		$this->assign('bz',$gysInfo['cgab16']);
		$this->assign('gysfl',$gysInfo['cgab19']);
		$this->assign('cgwy',$gysInfo['cgab20'].'-'.$gysInfo['cgab21']);
		$this->assign('cgzy',$gysInfo['cgab22'].'-'.$gysInfo['cgab23']);
		$this->display("cggl/xggys.html");
	}
	/**
	 * @desc 更新供应商
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionUpdateGys(){
		$id = CInputFilter::getString('id');
		$gysInfo = array();
		$gysInfo['cgab02'] = CInputFilter::getString('name');
		$gysInfo['cgab03'] = CInputFilter::getString('address');
		$gysInfo['cgab19'] = CInputFilter::getString('gysfl');
		$gysInfo['cgab14'] = CInputFilter::getString('zh');
		$gysInfo['cgab15'] = CInputFilter::getString('jkfs');
		$gysInfo['cgab04'] = CInputFilter::getString('type');
		$gysInfo['cgab13'] = date('Y-m-d H:i:s');
		$gysInfo['cgab16'] = CInputFilter::getString('bz');
		$cgwy = explode('-', CInputFilter::getString('cgwy'));

		$gysInfo['cgab20'] = $cgwy[0] != '' ? $cgwy[0] : '';
		$gysInfo['cgab21'] = !empty($cgwy[1]) ? $cgwy[1] : '';

		$updateResult = cgabModel::model()->updateGys($id,$gysInfo);

		$this->renderJson($updateResult);
	}
	/**
	 * @desc 删除供应商
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function actionDeleteGys(){
		$id = CInputFilter::getString('id');
		//操作记录
		$gys = cgabModel::model()->getSingleGys($id);
		$opeInfo['type'] = '删除供应商';
		$opeInfo['thingid'] = $id;
		$opeInfo['difference'] = $gys['cgab02'];
		$opeInfo['ry'] = Yii::app()->session['account'].':'.Yii::app()->session['name'];
		$opeInfo['opetime'] = date('Y-m-d H:i:s');

		$deleteResult = cgabModel::model()->deleteGys($id);
		if($deleteResult['res'] == 'success'){
			sysopesetModel::model()->addOpeSet($opeInfo);
		}
		$this->renderJson($deleteResult);
	}

	/**
	 * @desc 获取某一分类供应商
	 * @author DengShaocong
	 * @date 2015-12-3
	 */
	public function actionGetGysByFl(){
		$cpfl = CInputFilter::getString('cpfl');
		$result = array();  //列表信息结果
		$result = cgabModel::model()->getGysByFl($cpfl);
		$this->renderJson($result);
	}

	/**
	 * @desc 增加采购单
	 * @author DengShaocong
	 * @date 2015-12-7
	 */
	public function actionAddCgd(){
		$cgdInfo = array();
		$cpsxArr = array();
		$finalStr = "";//拼串之后，最后获得的字符串
		
		//需要分割的各项字符串，用于采购单明细
		$totalInfo['cgkh'] = CInputFilter::getString('cgkh');
		$totalInfo['cgmc'] = CInputFilter::getString('cgmc');
		$totalInfo['cghh'] = CInputFilter::getString('cghh');
		$totalInfo['cgjhj'] = CInputFilter::getString('cgjhj');
		$totalInfo['cgsl'] = CInputFilter::getString('cgsl');
		$totalInfo['cgsx'] = CInputFilter::getString('cgsx');

		//用于采购单
		$commonInfo['gys'] = CInputFilter::getString('gys');
		$commonInfo['gysID'] = CInputFilter::getString('gysID');
		$commonInfo['cgyf'] = CInputFilter::getString('cgyf');
		$commonInfo['cgbz'] = CInputFilter::getString('cgbz');
		$commonInfo['dhsj'] = CInputFilter::getString('dhsj');
		$commonInfo['number'] = CInputFilter::getString('number');
		$commonInfo['setter'] = Yii::app()->session['name'];
		$commonInfo['submitdate'] = date('Y-m-d H:i:s');

		$addResult = cgaaModel::model()->addCgd($totalInfo,$commonInfo);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 增加额外采购单
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function actionAddExtraCgd(){
		$result = array();
		$cgdInfo = array();
		$cpsxArr = array();
		$finalStr = "";//拼串之后，最后获得的字符串
		
		//需要分割的各项字符串，用于采购单明细
		$totalInfo['cgkh'] = CInputFilter::getString('cgkh');
		$totalInfo['cgmc'] = CInputFilter::getString('cgmc');
		$totalInfo['cghh'] = CInputFilter::getString('cghh');
		$totalInfo['cgjhj'] = CInputFilter::getString('cgjhj');
		$totalInfo['cgsl'] = CInputFilter::getString('cgsl');
		$totalInfo['cgsx'] = CInputFilter::getString('cgsx');

		$number = CInputFilter::getString('number');
		$count = CInputFilter::getString('count') + 1;//接收原最大项目数，并从这里开始
		$id = CInputFilter::getString('id');
		
		$addResult = cgaaModel::model()->addExtraCgd($totalInfo,$number,$count,$id);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 修改采购单（单个项目的细节，包括单价，数量）
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function actionUpdateCgd(){
		$id = CInputFilter::getString('id');
		$count = CInputFilter::getString('count');
		$cgdInfo['cgac05'] = CInputFilter::getString('cgjhj') != '' ? CInputFilter::getString('cgjhj') : 0;
		$cgdInfo['cgac06'] = CInputFilter::getString('cgsl') != '' ? CInputFilter::getString('cgsl') : 0;
		$cgdInfo['cgac07'] = $cgdInfo['cgac05'] * $cgdInfo['cgac06'];
		$updateResult = cgacModel::model()->updateCgd($id,$count,$cgdInfo);

		$this->renderJson($updateResult);
	}

	/**
	 * @desc 修改采购单（供应商，运费，预计到货时间）
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function actionUpdateSomeCgd(){
		$id = CInputFilter::getString('id');
		$cgdInfo['cgaa09'] = CInputFilter::getString('gys');
		$cgdInfo['cgaa08'] = CInputFilter::getString('cgyf') != '' ? CInputFilter::getString('cgyf') : 0;
		$cgdInfo['cgaa07'] = CInputFilter::getString('dhsj');
		$updateResult = cgaaModel::model()->updateSomeCgd($id,$cgdInfo);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 删除一项采购单
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function actionDeleteCgd(){
		$id = CInputFilter::getString('id');
		$count = CInputFilter::getString('count');
		$deleteResult = cgacModel::model()->deleteCgd($id,$count);
		$this->renderJson($deleteResult);
	}
	/**
	 * @desc 审核采购单
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function actionAuditingCgd(){
		$id = CInputFilter::getString('id');
		$updateResult = cgaaModel::model()->auditingCgd($id);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 撤销审核采购单
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function actionUnauditingCgd(){
		$id = CInputFilter::getString('id');
		$updateResult = cgaaModel::model()->unauditingCgd($id);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 根据条件获取采购单
	 * @author DengShaocong
	 * @date 2015-12-10
	 */
	public function actionGetCgdByCond(){
		$cgdInfo = array();//条件
		$cgdInfo['cpmc'] = CInputFilter::getString('cpmc');
		$cgdInfo['cgkh'] = CInputFilter::getString('cgkh');
		$cgdInfo['cgdh'] = CInputFilter::getString('cgdh');
		$cgdInfo['gys'] = CInputFilter::getString('gys');
		$cgdInfo['begindate'] = CInputFilter::getString('begindate') != '' ? CInputFilter::getString('begindate').' 00:00:00' : '';
		$cgdInfo['enddate'] =CInputFilter::getString('enddate') != '' ? CInputFilter::getString('enddate').' 23:59:59' : '';
		$cgdInfo['enddate'] = !empty($cgdInfo['enddate']) ? $cgdInfo['enddate'].DEFAULT_END_TIME : '';
		$cgdInfo['finish'] = CInputFilter::getString('finish');
		$cgdInfo['check'] = CInputFilter::getString('check');

		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$result = cgaaModel::model()->getCgdByCond($page,$psize,$cgdInfo);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 给采购单过账
	 * @author DengShaocong
	 * @date 2015-12-10
	 */
	public function actionPostCgd(){
		$id = CInputFilter::getString('id');
		$postMoney = CInputFilter::getString('postMoney');
		$updateResult = cgaaModel::model()->postCgd($id,$postMoney);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 获取采购文员列表
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-01-12
	 */
	public function actionGetCgwy(){
		$cgwyList = rylistModel::model()->getCgwyList();
		$this->renderJson($cgwyList);
	}

	/**
	 * @desc 获取采购专员列表
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-01-12
	 */
	public function actionGetCgzy(){
		$cgzyList = rylistModel::model()->getCgzyList();
		$this->renderJson($cgzyList);
	}

	/**
	 * @desc 获取供应商统计报表详情
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-02-03
	 */
	public function actionGetGysForReport(){
		$condInfo['id'] = CInputFilter::getString('id');
		$condInfo['name'] = CInputFilter::getString('name');
		$condInfo['cgwy'] = CInputFilter::getString('cgwy');
		$condInfo['cgzy'] = CInputFilter::getString('cgzy');
		$condInfo['begindate'] = CInputFilter::getString('begindate');
		$condInfo['enddate'] = CInputFilter::getString('enddate');
		$condInfo['enddate'] = !empty($condInfo['enddate']) ? $condInfo['enddate'].DEFAULT_END_TIME : '';

		$result = array();
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$result = cgabModel::model()->getGysForReport($condInfo,$page,$psize);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货供应商的采购单[要入库、采购总额>退货金额且不等于已入账]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function actionGetReturnSuppliersOrder(){
		$result = [];  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		//查询条件
		$CondList = [];
		$CondList['gys'] = CInputFilter::getString('gys');
		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';

		$result = cgaaModel::model()->getReturnSuppliersOrder($page,$psize,$CondList);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取已审核且未全部入库的采购单[入库类型为采购单入库]
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2016-03-10
	 */
	public function actionGetAuditedPaidOrder(){
		$result = [];  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		//查询条件
		$CondList = [];
		$CondList['gys'] = CInputFilter::getString('gys');
		$CondList['xdsjq'] = CInputFilter::getString('xdsjq');
		$CondList['xdsjz'] = CInputFilter::getString('xdsjz');
		$CondList['xdsjz'] = !empty($CondList['xdsjz']) ? $CondList['xdsjz'].DEFAULT_END_TIME : '';
		$CondList['sign'] = CInputFilter::getInt('sign');

		$result = cgaaModel::model()->getAuditedPaidOrder($page,$psize,$CondList);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 检查当前输入款号是否存在，存在则填写
	 * @author DengShaocong
	 * @date 2016-03-15
	 */
	public function actionCheckAndGetCp(){
		$cpkh = CInputFilter::getString('cpkh');
		$result = cpaaModel::model()->checkAndGetCp($cpkh);
		$this->renderJson($result);
	}

}
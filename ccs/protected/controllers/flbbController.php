<?php
/**
 * @desc 分类报表控制器操作类
 * @author DengShaocong
 * @date 2015-10-27
 */	
class flbbController extends Controller{
	/**
	 * @desc 话务明细表-未接来电模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetWjldbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/wjldb.html');
	}
	/**
	 * @desc 话务明细表-语音留言模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetYylyHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/yyly.html');
	}
	/**
	 * @desc 话务明细表-通话记录模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetThjlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/thjl.html');
	}
	/**
	 * @desc 话务明细表-电话监听报表模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetDhjtbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/dhjtbb.html');
	}
	/**
	 * @desc 话务明细表-分机振铃未接听模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetFjzlwjtHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/fjzlwjt.html');
	}
	/**
	 * @desc 话务明细表-分机摘机未接听模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetFjzjwjtHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/fjzjwjt.html');
	}

	/**
	 * @desc 考勤报表-座席考勤模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetZxkqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/zxkq.html');
	}
	/**
	 * @desc 考勤报表-班组考勤模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetBzkqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/bzkq.html');
	}

	/**
	 * @desc 话务量报表-座席话务量模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetZxhwlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/zxhwl.html');
	}
	/**
	 * @desc 话务量报表-班组话务量模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetBzhwlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/bzhwl.html');
	}
	/**
	 * @desc 话务量报表-系统话务量模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetXthwlHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/xthwl.html');
	}
	/**
	 * @desc 话务量报表-系统运营指标报表模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetXtyyzbbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/xtyyzbbb.html');
	}
	
	/**
	 * @desc 队列报表-队列统计模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetDltjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/dltj.html');
	}
	/**
	 * @desc 队列报表-排队等待时长模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetPdddscHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/pdddsc.html');
	}

	/**
	 * @desc 质检报表-客户评价统计模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetKhpjtjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/khpjtj.html');
	}
	/**
	 * @desc 质检报表-客户评价日志模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetKhpjrzHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/khpjrz.html');
	}
	/**
	 * @desc 质检报表-通话质检明细表模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetThzjmxbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/thzjmxb.html');
	}
	/**
	 * @desc 质检报表-通话质检统计表模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetThzjtjbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/thzjtjb.html');
	}

	/**
	 * @desc 通话报表-通话质检统计表模板显示
	 * @author DengShaocong
	 * @date 2016-01-06
	 */
	public function actionGetThbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/thbb.html');
	}

	/**
	 * @desc 工号客户数统计表模板显示
	 * @author DengShaocong
	 * @date 2016-02-03
	 */
	public function actionGetGhkhstjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$yxlist = syssetModel::model()->getKhyx();
		$this->assign('yxlist', $yxlist['list']);
		$levellist = syssetModel::model()->getCustomerLevel('A012');
		$this->assign('level', $levellist);
		$mediaList = mediasetModel::model()->getAllMedia();
		$this->assign('media', $mediaList['list']);
		$this->display('flbb/ghkhstjbb.html');
	}

	/**
	 * @desc 员工业绩统计表模板显示
	 * @author DengShaocong
	 * @date 2016-02-03
	 */
	public function actionGetYgyjtjbbHtml(){
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$mediaList = mediasetModel::model()->getAllMedia();
		$this->assign('media', $mediaList['list']);
		$this->display('flbb/ygyjtjbb.html');
	}

	/**
	 * @desc 分组业绩统计表模板显示
	 * @author DengShaocong
	 * @date 2016-02-03
	 */
	public function actionGetFztjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$yxlist = syssetModel::model()->getKhyx();
		$this->assign('yxlist', $yxlist['list']);
		$this->assign('sessioninfo', $sessionInfo);
		$mediaList = mediasetModel::model()->getAllMedia();
		$this->assign('media', $mediaList['list']);
		$this->display('flbb/fztjbb.html');
	}

	/**
	 * @desc 意向统计表模板显示
	 * @author DengShaocong
	 * @date 2016-02-03
	 */
	public function actionGetYxtjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$deptList = deptsetModel::model()->getSaleDept();
		$inLineMethods = syssetModel::model()->getInLineMethods();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('methods',$inLineMethods);
		$this->assign('dept',$deptList);
		$this->display('flbb/yxtjbb.html');
	}

	/**
	 * @desc 进线时段分析表模板显示
	 * @author DengShaocong
	 * @date 2016-02-03
	 */
	public function actionGetJxsdfxbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$yxlist = syssetModel::model()->getKhyx();
		$this->assign('yxlist', $yxlist['list']);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->display('flbb/jxsdfxbb.html');
	}

	/**
	 * @desc 订单追踪统计模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetDdzztjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/ddzztj.html');
	}

	/**
	 * @desc 投诉统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetTstjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/tstjbb.html');
	}

	/**
	 * @desc 地域统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetDytjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$yxlist = syssetModel::model()->getKhyx();
		$this->assign('yxlist', $yxlist['list']);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->display('flbb/dytjbb.html');
	}

	/**
	 * @desc 进线方式统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetJxfstjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$mediaList = mediasetModel::model()->getAllMedia();
		$this->assign('media', $mediaList['list']);
		$this->display('flbb/jxfstjbb.html');
	}

	/**
	 * @desc 每日出库报表模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetMrckbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/mrckbb.html');
	}	

	/**
	 * @desc 快递拒收统计模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetKdjstjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->display('flbb/kdjstj.html');
	}	

	/**
	 * @desc 产品销售统计模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetCpxstjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$mediaList = mediasetModel::model()->getAllMedia();
		$this->assign('media', $mediaList['list']);
		$this->display('flbb/cpxstj.html');
	}	

	/**
	 * @desc 退货原因统计模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetThyytjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$kdgsList = sykdgssetModel::model()->getAllKdgs()['list'];
		$this->assign('kdgs',$kdgsList);
		$this->display('flbb/thyytj.html');
	}	

	/**
	 * @desc 退货产品统计模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetThcptjHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/thcptj.html');
	}	

	/**
	 * @desc 员工考核统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetYgkhtjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getAllDept()['list'];
		$this->assign('dept',$deptList);
		$this->display('flbb/ygkhtjbb.html');
	}	

	/**
	 * @desc 产品类别统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetCplbtjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$lylist = syssetModel::model()->getCustomerLevel('A013');
		$this->assign('lylist', $lylist);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$mediaList = mediasetModel::model()->getAllMedia();
		$this->assign('media', $mediaList['list']);
		$this->display('flbb/cplbtjbb.html');
	}	

	/**
	 * @desc 接线有效率统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetJxyxlbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->display('flbb/jxyxlbb.html');
	}	

	/**
	 * @desc 接线业绩统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetJxyjbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->display('flbb/jxyjbb.html');
	}	

	/**
	 * @desc 地域统计报表（省份下城市）模板显示
	 * @author DengShaocong
	 * @date 2016-02-18
	 */
	public function actionGetDytjbbCityHtml(){
		//省份名字
		$province = CInputFilter::getString('pro');
		$this->assign('province',$province);
		//省份ID
		$pID = appprovinceModel::model()->getProID($province);
		$this->assign('pID',$pID);
		//省份页面传来的日期
		$beginDate = CInputFilter::getString('begin');
		$this->assign('beginDate',$beginDate);
		$endDate = CInputFilter::getString('end');
		$this->assign('endDate',$endDate);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$yxlist = syssetModel::model()->getKhyx();
		$this->assign('yxlist', $yxlist['list']);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->display('flbb/dytjbbCity.html');
	}

	/**
	 * @desc 员工业绩统计报表图表模板显示
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function actionGetYgyjtjbbChartHtml(){
		$name = CInputFilter::getString('name');
		$this->assign('name',$name);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/ygyjtjbbtb.html');
	}

	/**
	 * @desc 销售分组业绩统计报表图表模板显示
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetFztjbbChartHtml(){
		$dept = CInputFilter::getString('dept');
		$this->assign('dept',$dept);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/fztjbbtb.html');
	}

	/**
	 * @desc 意向统计报表图表模板显示
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetYxtjbbChartHtml(){
		$yx = CInputFilter::getString('yx');
		$this->assign('yx',$yx);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/yxtjbbtb.html');
	}

	/**
	 * @desc 地域统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetDytjbbChartHtml(){
		$pro = CInputFilter::getString('pro');
		$this->assign('pro',$pro);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/dytjbbtb.html');
	}

	/**
	 * @desc 进线方式统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetJxfstjbbChartHtml(){
		$jxfs = CInputFilter::getString('jxfs');
		$this->assign('jxfs',$jxfs);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/jxfstjbbtb.html');
	}

	/**
	 * @desc 产品类别统计报表模板显示
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetCplbtjbbChartHtml(){
		$cplb = CInputFilter::getString('cplb');
		$this->assign('cplb',$cplb);
		$hol = CInputFilter::getString('hol');
		$this->assign('hol',$hol);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('flbb/cplbtjbbtb.html');
	}

	/**
	 * @desc 意向统计报表
	 * @author DengShaocong
	 * @date 2016-02-03
	 */
	public function actionGetYxbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//   CInputFilter::getString('EndDate')
		$cond['endDate'] =  CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$cond['dept'] = CInputFilter::getString('dept');//部门
		$cond['inline'] = CInputFilter::getString('inline');//进线方式
		$cond['type'] = CInputFilter::getString('type');
		$yxbbList = syssetModel::model()->getYxbbByCond($cond);
		$this->renderJson($yxbbList);
	}

	/**
	 * @desc 获取员工业绩统计报表
	 * @author DengShaocong
	 * @date 2016-02-03
	 */
	public function actionGetYgyjtjbb(){
		$cond['orderBeginDate'] = CInputFilter::getString('orderBeginDate') != '' ? CInputFilter::getString('orderBeginDate') : date('Y-m-d');//下单时间order 
		$cond['orderEndDate'] = CInputFilter::getString('orderEndDate') != '' ? CInputFilter::getString('orderEndDate') : date('Y-m-d');
		$cond['accBeginDate'] = CInputFilter::getString('accBeginDate');//签收时间acceptance -> acc
		$cond['accEndDate'] = CInputFilter::getString('accEndDate');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['media'] = CInputFilter::getString('media');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$list = rylistModel::model()->getYgyjtjbbByCond($cond,$sign);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取销售分组业绩统计报表
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function actionGetFzyjtjbb(){
		$cond['orderBeginDate'] = CInputFilter::getString('orderBeginDate') != '' ? CInputFilter::getString('orderBeginDate') : date('Y-m-d');//下单时间order 
		$cond['orderEndDate'] = CInputFilter::getString('orderEndDate') != '' ? CInputFilter::getString('orderEndDate') : date('Y-m-d');
		$cond['accBeginDate'] = CInputFilter::getString('accBeginDate');//签收时间acceptance -> acc
		$cond['accEndDate'] = CInputFilter::getString('accEndDate');
		$cond['khyx'] = CInputFilter::getString('khyx');
		$cond['media'] = CInputFilter::getString('media');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$list = deptsetModel::model()->getFzyjtjbbByCond($cond,$sign);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取进线时段分析报表
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function actionGetJxsdfxbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['khyx'] = CInputFilter::getString('khyx');
		$cond['day'] = CInputFilter::getString('day');
		$list = deptsetModel::model()->getJxsdfxbbByCond($cond);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取订单追踪统计报表
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function actionGetDdzztj(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$list = deptsetModel::model()->getDdzztjByCond($cond,$sign);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取地域统计报表
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function actionGetDytjbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['khyx'] = CInputFilter::getString('khyx');
		$cond['day']= CInputFilter::getString('day');
		$cond['type']= CInputFilter::getString('type');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$list = appprovinceModel::model()->getDytjbbByCond($cond,$sign);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取进线方式统计报表
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function actionGetJxfstjbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['day']= CInputFilter::getString('day');
		$cond['type']= CInputFilter::getString('type');
		$cond['media']= CInputFilter::getString('media');
		$list = syssetModel::model()->getJxfstjbbByCond($cond);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取快递拒收统计
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function actionGetKdjstj(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['day'] = CInputFilter::getString('day');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$list = sykdgssetModel::model()->getKdjstjByCond($cond,$sign);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取产品销售统计
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function actionGetCpxstj(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['cpkh'] = CInputFilter::getString('cpkh');
		$cond['ppmc'] = CInputFilter::getString('ppmc');
		$cond['day'] = CInputFilter::getString('day');
		$cond['media'] = CInputFilter::getString('media');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$list = cpaaModel::model()->getCpxstjByCond($cond,$sign);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取投诉统计
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function actionGetTstjbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$cond['type'] = CInputFilter::getString('type') != '' ? CInputFilter::getString('type') : 'tsgh';
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = khacModel::model()->getTstjbbByCond($cond,$sign);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货产品统计
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function actionGetThcptj(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = cpabModel::model()->getThcptjByCond($cond,$sign);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取退货原因统计
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function actionGetThyytj(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['kdgs'] = CInputFilter::getString('kdgs');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = xsaeModel::model()->getThyytjByCond($cond,$sign);
		$this->renderJson($result);
	}
	
	/**
	 * @desc 获取工号客户数统计报表
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function actionGetGhkhstjbb(){
		$cond['khyx'] = CInputFilter::getString('khyx');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['level'] = CInputFilter::getString('level');
		$cond['media'] = CInputFilter::getString('media');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = rylistModel::model()->getGhkhstjbbByCond($cond,$sign);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取员工考核统计报表
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function actionGetYgkhtjbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$cond['dept'] = CInputFilter::getString('dept');
		$result = rylistModel::model()->getYgkhtjbbByCond($cond);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取产品类别统计报表
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function actionGetCplbtjbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['type'] = CInputFilter::getString('type');
		$cond['hol'] = CInputFilter::getString('hol');
		$cond['media'] = CInputFilter::getString('media');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = cpabModel::model()->getCplbtjbbByCond($cond,$sign);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取每日出库报表
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function actionGetMrckbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['cpkh'] = CInputFilter::getString('cpkh');
		$cond['cpmc'] = CInputFilter::getString('cpmc');
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = cpaaModel::model()->getMrckbbByCond($cond,$sign);
		$this->renderJson($result);
	}


	/**
	 * @desc 获取接线业绩报表
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function actionGetJxyjbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$cond['dept'] = CInputFilter::getString('dept');
		$result = rylistModel::model()->getJxyjbbByCond($cond);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取接线有效率报表
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function actionGetJxyxlbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['day'] = CInputFilter::getString('day');
		$cond['dept'] = CInputFilter::getString('dept');
		$result = rylistModel::model()->getJxyxlbbByCond($cond);
		$this->renderJson($result);
	}


	/**
	 * @desc 获取地域统计报表（省份下的城市）
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function actionGetDytjbbCity(){
		$cond['pro'] = CInputFilter::getString('pid');
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['khyx'] = CInputFilter::getString('khyx');
		$cond['day']= CInputFilter::getString('day');
		$cond['type']= CInputFilter::getString('type');
		$list = appCityModel::model()->getDytjbbCityByCond($cond);
		$this->renderJson($list);
	}











	/**
	 * @desc 获取员工业绩统计报表图表
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function actionGetYgyjtjbbChart(){
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');//下单时间order 
		$cond['day'] = CInputFilter::getString('day') != '' ? CInputFilter::getString('day') : 'days';
		$cond['name'] = CInputFilter::getString('name');
		$list = rylistModel::model()->getYgyjtjbbChart($cond);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取销售分组业绩统计报表图表
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetFztjbbChart(){
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');//下单时间order 
		$cond['day'] = CInputFilter::getString('day') != '' ? CInputFilter::getString('day') : 'days';
		$cond['dept'] = CInputFilter::getString('dept');
		$list = deptsetModel::model()->getFztjbbChart($cond);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取意向统计报表图表
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetYxtjbbChart(){
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');//下单时间order 
		$cond['day'] = CInputFilter::getString('day') != '' ? CInputFilter::getString('day') : 'days';
		$cond['yx'] = CInputFilter::getString('yx');
		$list = syssetModel::model()->getYxtjbbChart($cond);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取意向统计报表图表
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetDytjbbChart(){
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');//下单时间order 
		$cond['day'] = CInputFilter::getString('day') != '' ? CInputFilter::getString('day') : 'days';
		$cond['pro'] = CInputFilter::getString('pro');
		$list = appprovinceModel::model()->getDytjbbChart($cond);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取进线方式统计报表图表
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetJxfstjbbChart(){
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');//下单时间order 
		$cond['day'] = CInputFilter::getString('day') != '' ? CInputFilter::getString('day') : 'days';
		$cond['jxfs'] = CInputFilter::getString('jxfs');
		$list = syssetModel::model()->getJxfstjbbChart($cond);
		$this->renderJson($list);
	}

	/**
	 * @desc 获取产品类别统计报表图表
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function actionGetCplbtjbbChart(){
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');//下单时间order 
		$cond['day'] = CInputFilter::getString('day') != '' ? CInputFilter::getString('day') : 'days';
		$cond['cplb'] = CInputFilter::getString('cplb');
		$cond['hol'] = CInputFilter::getString('hol') != '' ? CInputFilter::getString('hol') : 'higher';
		$list = cpabModel::model()->getCplbtjbbChart($cond);
		$this->renderJson($list);
	}
}
?>
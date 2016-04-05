<?php
/**
 * @desc 媒体管理控制器操作类
 * @author DengShaocong
 * @date 2015-10-27
 */	
class mtglController extends Controller{
	/**
	 * @desc 媒体渠道管理模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetMtqdglHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('mtgl/mtqdgl.html');
	}
	/**
	 * @desc 关键字分析报表模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetGjzfxbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$mediaList = mediasetModel::model()->getAllMedia();
		$this->assign('media',$mediaList['list']);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('mtgl/gjzfxbb.html');
	}
	/**
	 * @desc 广告效果分析报表模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetGgxgfxbbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$deptList = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$deptList);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('mtgl/ggxgfxbb.html');
	}
	/**
	 * @desc 广告投放计划模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetGgtfjhHtml(){
		//媒体列表
		$mediaList =  mediasetModel::model()->getMediaByCond(array());
		$this->assign('mediaList',$mediaList['list']);
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('mtgl/ggtfjh.html');
	}
	/**
	 * @desc 添加广告投放计划模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjgtfjhHtml(){
		$sessionInfo = $this->getSessionInfo();
		//客户意向
		$khyxList = syssetModel::model()->getCustomerIntention('A016');
		//媒体列表
		$mediaList =  mediasetModel::model()->getMediaByCond(array());
		$this->assign('khyxList',$khyxList);
		$this->assign('mediaList',$mediaList['list']);
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('mtgl/tjggtfjh.html');
	}
	/**
	 * @desc 订单历史趋势详情模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetDdlsqsxqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('mtgl/ddlsqsxq.html');
	}
	/**
	 * @desc 订单金额历史趋势详情模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetDdjelsqsxqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('mtgl/ddjelsqsxq.html');
	}

	/**
	 * @desc 根据条件获取媒体渠道资料
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function actionGetMediaByCond(){
		$condInfo['type'] = CInputFilter::getString('type');
		$condInfo['display'] = CInputFilter::getString('display');
		$condInfo['mediatext'] = CInputFilter::getString('mediatext');
		$result = mediasetModel::model()->getMediaByCond($condInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 新增媒体渠道资料
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function actionAddMedia(){
		$mediaInfo['mediatext'] = CInputFilter::getString('newname');
		$mediaInfo['type'] = CInputFilter::getString('newtype');
		$mediaInfo['mtfl'] = CInputFilter::getString('newfl');
		$mediaInfo['phone'] = CInputFilter::getString('newphone');
		$mediaInfo['xh'] = CInputFilter::getString('newpx');
		$mediaInfo['display'] = CInputFilter::getString('newdisplay');

		$addResult = mediasetModel::model()->addMedia($mediaInfo);
		$this->actionGetMediaByCond();
	}

	/**
	 * @desc 修改媒体渠道资料
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function actionUpdateMedia(){
		$id = CInputFilter::getString('id');

		$mediaInfo['mediatext'] = CInputFilter::getString('updatename');
		$mediaInfo['type'] = CInputFilter::getString('updatetype');
		$mediaInfo['mtfl'] = CInputFilter::getString('updatefl');
		$mediaInfo['phone'] = CInputFilter::getString('updatephone');
		$mediaInfo['xh'] = CInputFilter::getString('updatepx');
		$mediaInfo['display'] = CInputFilter::getString('updatedisplay');

		$updateResult = mediasetModel::model()->updateMedia($id,$mediaInfo);

		$this->actionGetMediaByCond();
	}

	/**
	 * @desc 删除媒体渠道资料
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function actionDeleteMedia(){
		$id = CInputFilter::getString('id');
		$delResult = mediasetModel::model()->deleteMedia($id);
		$this->actionGetMediaByCond();
	}

	/**
	 * @desc 根据条件查找广告信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function actionGetAdvertByCond(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串

		$condInfo['adverttext'] = CInputFilter::getString('adverttext');
		$condInfo['begindate'] = CInputFilter::getString('advertBegindate');
		$condInfo['enddate'] = CInputFilter::getString('advertEnddate');
		$condInfo['enddate'] = !empty($condInfo['enddate']) ? $condInfo['enddate'].DEFAULT_END_TIME : '';
		$condInfo['subBegindate'] = CInputFilter::getString('submitBegindate');
		$condInfo['subEnddate'] = CInputFilter::getString('submitEnddate');
		$condInfo['submitEnddate'] = !empty($condInfo['submitEnddate']) ? $condInfo['submitEnddate'].DEFAULT_END_TIME : '';

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数

		$result = advertsetModel::model()->getAdvertByCond($condInfo,$page,$psize);

		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 新增广告信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function actionAddAdvert(){
		$enddate = strtotime(CInputFilter::getString('enddate'));
		$begindate = strtotime(CInputFilter::getString('begindate'));
		$days = ($enddate-$begindate)/86400;
		$adInfo['adverttext'] = CInputFilter::getString('media');
		$adInfo['adverttime'] = CInputFilter::getString('time');
		$adInfo['duration'] = CInputFilter::getString('duration');
		$adInfo['cost'] =CInputFilter::getString('cost');
		$adInfo['adverttype'] = CInputFilter::getString('type');
		$adInfo['setter'] = Yii::app()->session['name'];
		$adInfo['submittime'] = date('Y-m-d H:i:s');
		$count = 0;
		for($i = 0; $i <= ($enddate-$begindate); $i += 86400){
			$adInfo['advertdate'] = date('Y-m-d',($begindate+$i));
			$addResult = advertsetModel::model()->addAdvert($adInfo);
			if($addResult['res'] == 'success'){
				$count ++;
			}
		}
		if($count > 0){
			$this->renderJson(array('res'=>'success','msg'=>'添加成功'));
		}else{
			$this->renderJson(array('res'=>'false','msg'=>'添加失败'));
		}
	}

	/**
	 * @desc 获取单个广告信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function actionGetSingleAdvert(){
		$id = CInputFilter::getString('id');
		$advert = advertsetModel::model()->getSingleAdvert($id);	
		$this->assign('advertid',$advert['advertid']);
		$this->assign('adverttext',$advert['adverttext']);
		$this->assign('advertdate',$advert['advertdate']);
		$this->assign('adverttime',$advert['adverttime']);
		$this->assign('duration',$advert['duration']);
		$this->assign('cost',$advert['cost']);
		$this->assign('adverttype',$advert['adverttype']);

		//媒体列表
		$mediaList =  mediasetModel::model()->getMediaByCond(array());
		$this->assign('mediaList',$mediaList['list']);
		//客户意向
		$khyxList = syssetModel::model()->getCustomerIntention('A016');
		$this->assign('khyxList',$khyxList);

		$this->display('mtgl/xgggtfjh.html');
	}

	/**
	 * @desc 修改广告信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function actionUpdateAdvert(){
		$id = CInputFilter::getString('id');
		$adInfo['adverttext'] = CInputFilter::getString('media');
		$adInfo['advertdate'] = CInputFilter::getString('date');
		$adInfo['adverttime'] = CInputFilter::getString('time');
		$adInfo['duration'] = CInputFilter::getString('duration');
		$adInfo['cost'] =CInputFilter::getString('cost');
		$adInfo['adverttype'] = CInputFilter::getString('type');
		$adInfo['setter'] = Yii::app()->session['name'];
		$adInfo['submittime'] = date('Y-m-d H:i:s');
		$updateResult = advertsetModel::model()->updateAdvert($id,$adInfo);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 删除广告
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function actionDeleteAdvert(){
		$id = CInputFilter::getString('id');
		$delResult = advertsetModel::model()->delAdvert($id);
		$this->actionGetAdvertByCond();
	}

	/**
	 * @desc 获取广告效果分析报表
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function actionGetGgxgfxbb(){
		$cond['beginDate'] = CInputFilter::getString('beginDate') != '' ? CInputFilter::getString('beginDate') : date('Y-m-d');//
		$cond['endDate'] = CInputFilter::getString('endDate') != '' ? CInputFilter::getString('endDate') : date('Y-m-d');
		$cond['dept'] = CInputFilter::getString('dept');
		$cond['day']= CInputFilter::getString('day');
		$cond['type']= CInputFilter::getString('type');
		$result = mediasetModel::model()->getGgxgfxbbByCond($cond);
		$this->renderJson($result);
	}
}
?>
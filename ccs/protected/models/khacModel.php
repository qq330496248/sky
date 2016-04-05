<?php
/**
 * @desc 客户投诉表相关操作类
 * @author huyan
 * @date 2015-12-03
 */
class khacModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khaaModel对象
	 * @return khacModel
	 * @author huyan
	 * @date 2015-12-03
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/*
	 * 获取客户投诉列表
	 * @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function GetComplaint($page,$psize,$JobNuber,$CondList,$sign){
		$result = array();  //获取列表数据的结果
		$clientList = khacDAO::getInstance()->GetComplaint($page,$psize,$JobNuber,$CondList);

		if($sign == 1){
			//导出客户投诉excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[3]); //导出客户投诉excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$clientList = khacDAO::getInstance()->GetComplaint($page,$psize,$JobNuber,$CondList,$selectColumnStr);
				}
			}
			if(!empty($clientList['info']) && is_array($clientList['info'])){
				$data = $clientList['info'];
				$fileName = 'jx';  //MyClientData
				$tableName = '客户投诉';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);
				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['count'] = $clientList['count'];
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['count'] = 0;
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['count'] = 0;
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}
		//判断是否查询到有数据
		if(!empty($clientList['info']) && is_array($clientList['info'])){
			$result['result'] = 'success';
			$result['list'] = $clientList['info'];
			$result['count'] = $clientList['count'];
			$result['page'] = $page;
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 添加客户投诉
	 * @param array $clientInfo 跟进记录
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function AddCustomerComplaints($clientInfo){

		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'投诉信息不能为空');
		}
		/*$iskhid = array('khaa02'=>$clientInfo['khac01']);
		$Customerkhid = khaaDAO::getInstance()->isExists($iskhid);*/
		//不存在的客户id不允许添加
		/*if(!$Customerkhid){
		
			return array('res'=>'error','msg'=>'该客户id不存在,请填写正确');
		}

		$clientNo=$clientInfo['khac01'];

		//根据客户id查找客户姓名
		$khnameResult = khaaDAO::getInstance()->getkhnameResult($clientNo);
		$clientInfo['khac13']= $khnameResult['khaa03'];*/
		
		
		/*//查询该客户有没有订单(返回单个)
		 $OrderInquiryResult = khaaDAO::getInstance()->getComplaintOrder($clientNo);

		if (empty($OrderInquiryResult)) {
			
			return array('res' => 'error','msg' => '该客户没有订单,不能添加投诉');
		}*/

		$isddid = array('khac05'=>$clientInfo['khac05']);
		/*$Customerddid = khacDAO::getInstance()->isExists($isddid);
		//添加投诉时已有投诉记录的订单号不能添加
		if($Customerddid){
			return array('res'=>'error','msg'=>'这个订单已有投诉记录');
		}*/

		//查询订单id查找对应的客户编号
		/*$ddclientNo=$clientInfo['khac05'];
		$ComplaintResult = khaaDAO::getInstance()->OrderComplaint($ddclientNo,$clientNo);
		if (empty($ComplaintResult)) {
			return array('res' => 'error','msg' => '这个订单不属于当前客户,请重新输入订单号');
		}*/

		$judgment = khaaDAO::getInstance()->findByAttributes(array('khaa03'=>$clientInfo['khac13']),array('khaa02'));
		if (!empty($judgment)) {
			$clientInfo['khac01']=$judgment['khaa02'];
		}
		$res = khacDAO::getInstance()->insert($clientInfo,true);//true表示当前这个表没有自增id主键
		return array('res' => 'success','msg' => '保存成功');
		
		
	}


	/**
	 * @desc 客户详情添加投诉
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function DetailsComplaints($clientInfo){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'投诉信息不能为空');
		}
		$clientNo=$clientInfo['khac01'];
		//根据客户id查找客户姓名
		$khnameResult = khaaDAO::getInstance()->getkhnameResult($clientNo);
		$clientInfo['khac13']= $khnameResult['khaa03'];

		$isddid = array('khac05'=>$clientInfo['khac05']);
		$Customerddid = khacDAO::getInstance()->isExists($isddid);
		//添加投诉时已有投诉记录的订单号不能添加
	/*	if($Customerddid){
			return array('res'=>'error','msg'=>'这个订单已有投诉记录');
		}*/
		$res = khacDAO::getInstance()->insert($clientInfo);//($clientInfo,true)true表示当前这个表没有自增id主键
		return array('res' => 'success','msg' => '保存成功');
		
		
	}

	/**
	 * @desc 修改客户投诉
	 * @param string $clientNo 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function UpdateCustomerComplaints($clientInfo,$clientNo){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'投诉信息不能为空');
		}
		/*$iskhid = array('khaa02'=>$clientInfo['khac01']);
		$Customerkhid = khaaDAO::getInstance()->isExists($iskhid);
		//不存在的客户id不允许添加
		if($Customerkhid==0){
		
			return array('res'=>'error','msg'=>'该客户id不存在,请填写正确');
		}

		//查询该客户有没有订单
		$OrderInquiryResult = khaaDAO::getInstance()->OrderInquiry($clientNo);
		if (!empty($OrderInquiryResult)) {
			
			return array('res' => 'error','msg' => '该客户没有订单,不能添加投诉');
		}*/

		/*$isddid = array('xsaa02'=>$clientInfo['khac05']);
		$Customerddid = xsaaDAO::getInstance()->isExists($isddid);
		//不存在的订单id不允许添加
		if($Customerddid==0){
			return array('res'=>'error','msg'=>'该订单id不存在,请填写正确');
		}*/
		$updateResult = khacDAO::getInstance()->update(array('khac14'=>$clientNo),$clientInfo);
		return array('res' => 'success','msg' => '修改成功');
	}

	/**
	 * @desc 删除一条客户投诉
	 * @param string $orderno 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function DeleteComplaint($orderno){
		$deleteResult = khacDAO::getInstance()->delete(array('khac14'=>$orderno));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}

	/**
	 * @desc 获取客户投诉详情
	 * @param string $clientNo 客户编号
	 * @return array $currentClient 当前客户投诉信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function findCurrentData($clientNo){
		$currentClient = khacDAO::getInstance()->findByAttributes(array('khac14'=>$clientNo));
		if(empty($currentClient)){
			return array('res' => 'error','msg' => '获取投诉详情失败');
		}
		return $currentClient;
	}

	/**
	 * @desc 单个/批量转投诉记录
	 * @param string $orderno 投诉客户编号
	 * @param string $orderInfo 投诉信息
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-09
	 */
	public function TurnOutComplaints($orderno,$clientInfo){
		$orderNum = count($orderno); //确认转出的记录数
		//修改投诉表归属工号
		for($i = 0;$i < $orderNum;$i++){
			$result = khacDAO::getInstance()->update(array('khac09'=>$orderno[$i]),$clientInfo);
		}

		if(empty($result)){
			return array('res' => 'error','msg' => '转出失败');
		}
		return array('res' => 'success','msg' => '投诉记录已转');
		
	}

	/**
	 * @desc 获取投诉统计报表——获取投诉内容
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getTstjbbByCond($cond,$sign){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'today':
				$cond['beginDate'] = date('Y-m-d');
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'yesterday':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				break;

			case 'seven':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -7 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'thirty':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -30 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'month':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = $dateList1[0].'-'.$dateList1[1].'-01' ;
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'lastDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
				break;

			case 'nextDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +1 day '));
				break;

			case 'lastSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -7 day '));
				break;

			case 'nextSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +7 day '));
				break;

			case 'lastThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -30 day '));
				break;

			case 'nextThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +30 day '));
				break;

			case 'lastMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' -1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' -1 day '));
				break;

			case 'nextMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' +1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' +2 month -1 day '));
				break;

			default:

				break;
		}
		//根据页面传过来的type，修改查询条件
		switch ($cond['type']) {
			case 'tsgh':
				$cond['type'] = 'khac03';
				break;

			case 'lx':
				$cond['type'] = 'khac02';
				break;

			case 'xlx':
				$cond['type'] = 'khac02';
				break;

			case 'jg':
				$cond['type'] = 'khac08';
				break;

			case 'gjgh':
				$cond['type'] = 'khac04';
				break;
			default:
				$cond['type'] = 'khac03';
				break;
		}

		$result['result'] = 'success';
		$result['list'] = array();
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['complaintNum'] = 0;//总投诉数
		$result['wclCount'] = 0;//总未处理数
		$result['qetkCount'] = 0;//总全额退款数
		$result['bftkCount'] = 0;//总部分退款数
		$result['thCount'] = 0;//总退货数
		$result['hhCount'] = 0;//总换货数
		$result['cpzsCount'] = 0;//总产品赠送数
		$result['zpzsCount'] = 0;//总赠品赠送数
		//根据统计方式，获取相应信息（投诉工号，分类，小类型，结果，跟进工号）
		$complaintList = khacDAO::getInstance()->getMessageForTstjbb($cond);
		$count = count($complaintList);
		for ($i=0; $i < $count; $i++) { 
			$cond['colName'] = $complaintList[$i]['colname'];
			$demoList = $this->getTstjbbDetails($cond);
			$result['list'][$i] = $demoList;
			//各项相加
			$result['complaintNum'] += $demoList['complaintNum'];//总投诉数
			$result['wclCount'] += $demoList['wclNum'];//总未处理数
			$result['qetkCount'] += $demoList['qetkNum'];//总全额退款数
			$result['bftkCount'] += $demoList['bftkNum'];//总部分退款数
			$result['thCount'] += $demoList['thNum'];//总退货数
			$result['hhCount'] += $demoList['hhNum'];//总换货数
			$result['cpzsCount'] += $demoList['cpzsNum'];//总产品赠送数
			$result['zpzsCount'] += $demoList['zpzsNum'];//总赠品赠送数
		}

		if($result['complaintNum'] > 0){
			$count = count($result['list']);
			for($i = 0; $i < $count; $i ++){
				$result['list'][$i]['compRatio'] = sprintf("%.2f",$result['list'][$i]['complaintNum']/$result['complaintNum']*100) .'%';
			}
		}

		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[27]); //导出投诉统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
				$reportList = []; //报表显示信息
				foreach ($result['list'] as $key => $value) {
					$reportList[$key]['colName'] = $value['colName'];
					$reportList[$key]['complaintNum'] = $value['complaintNum'];
					$reportList[$key]['compRatio'] = $value['compRatio'];
					$reportList[$key]['wclNum'] = $value['wclNum'];
					$reportList[$key]['qetkNum'] = $value['qetkNum'];
					$reportList[$key]['bftkNum'] = $value['bftkNum'];
					$reportList[$key]['thNum'] = $value['thNum'];
					$reportList[$key]['hhNum'] = $value['hhNum'];
					$reportList[$key]['cpzsNum'] = $value['cpzsNum'];
					$reportList[$key]['zpzsNum'] = $value['zpzsNum'];
				}
			}
			
			if(!empty($reportList) && is_array($reportList)){
				$data = $reportList;
				$fileName = 'jx';  
				$tableName = '投诉统计报表';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);

				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}

		return $result;
	}

	/**
	 * @desc 获取投诉统计报表——获取报表详情
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getTstjbbDetails($cond){
		$result['colName'] = $cond['colName'];
		$result['compRatio'] = '0%';
		$result['complaintNum'] = khacDAO::getInstance()->getTstjbbByCondZS($cond)['num'];
		$result['wclNum'] = khacDAO::getInstance()->getTstjbbByCond($cond,"'未处理'")['num'];
		$result['qetkNum'] = khacDAO::getInstance()->getTstjbbByCond($cond,"'全额退款'")['num'];
		$result['bftkNum'] = khacDAO::getInstance()->getTstjbbByCond($cond,"'部分退款'")['num'];
		$result['thNum'] = khacDAO::getInstance()->getTstjbbByCond($cond,"'退货'")['num'];
		$result['hhNum'] = khacDAO::getInstance()->getTstjbbByCond($cond,"'换货'")['num'];
		$result['cpzsNum'] = khacDAO::getInstance()->getTstjbbByCond($cond,"'产品赠送'")['num'];
		$result['zpzsNum'] = khacDAO::getInstance()->getTstjbbByCond($cond,"'赠品赠送'")['num'];
		return $result;
	}
}

<?php
/**
 * @desc 省份表相关操作类
 * @author huyan
 * @date 2015-11-02
 */
class appprovinceModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回appCityModel对象
	 * @return appprovinceModel
	 * @author huyan
	 * @date 2015-11-02
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取省份信息
	 * @param string $provinceId 省份ID
	 * @return array $result 省份的结果信息
	 * @author huyan
	 * @date 2015-11-02
	 */
	public function getappprovince(){
		$result = array();  //省份的结果信息
		$cityList = approvinceDAO::getInstance()->getAllpro();
		if(empty($cityList)){
			return false;
		}
		foreach($cityList as $val){
			$result[$val['pid']] = $val['pname'];	//数组重构
		}
		return $result;
	}


	/**
	 * @desc 获取地域统计报表——获取所有地区
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getDytjbbByCond($cond,$sign){
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

		$result['result'] = 'success';
		$result['list'] = array();
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['peopleNum'] = 0;//总客户数
		$result['xdCount'] = 0;//总下单数
		$result['xdMoney'] = 0;//总下单金额
		$result['qrCount'] = 0;//总确认数
		$result['qrMoney'] = 0;//总确认金额
		$result['fhCount'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['qsCount'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额
		$result['jsCount'] = 0;//总签收数
		$result['jsMoney'] = 0;//总签收金额

		$proList = approvinceDAO::getInstance()->getAllpro();
		$resultCount = 0;
		for($i = 0; $i < count($proList); $i ++){
			$cond['pro'] = $proList[$i]['pname'];
			$demoList = $this->getDytjbbDetails($cond);//临时array
			if(!empty($demoList)){
				$result['list'][$resultCount] = $demoList;
				$result['list'][$resultCount]['xdRatio'] = '0%';
				$result['list'][$resultCount]['qrRatio'] = '0%';
				if($demoList['xdOrders'] > 0 && $demoList['qrOrders'] > 0){
					$result['list'][$resultCount]['qrRatio'] = sprintf('%.2f',$demoList['qrOrders']/$demoList['xdOrders']*100).'%';
				}
				$result['peopleNum'] += $demoList['peopleNum'];//总客户数
				$result['xdCount'] += $demoList['xdOrders'];//总下单数
				$result['xdMoney'] += $demoList['xdMoney'];//总下单金额
				$result['qrCount'] += $demoList['qrOrders'];//总确认数
				$result['qrMoney'] += $demoList['qrMoney'];//总确认金额
				$result['fhCount'] += $demoList['fhOrders'];//总发货数
				$result['fhMoney'] += $demoList['fhMoney'];//总发货金额
				$result['qsCount'] += $demoList['qsOrders'];//总签收数
				$result['qsMoney'] += $demoList['qsMoney'];//总签收金额
				$result['jsCount'] += $demoList['jsOrders'];//总签收数
				$result['jsMoney'] += $demoList['jsMoney'];//总签收金额

				$resultCount ++;
			}
		}
		//如果总单数不为0，计算比例
		if($result['xdCount'] > 0){
			for($i = 0; $i < count($result['list']); $i ++){
				//计算比例
				$result['list'][$i]['xdRatio'] = sprintf('%.2f',$result['list'][$i]['xdOrders']/$result['xdCount']*100).'%';
			}
		}

		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[26]); //导出地域统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
				$reportList = []; //报表显示信息
				foreach ($result['list'] as $key => $value) {
					$reportList[$key]['pro'] = $value['pro'];
					$reportList[$key]['peopleNum'] = $value['peopleNum'];
					$reportList[$key]['xdOrders'] = $value['xdOrders'];
					$reportList[$key]['xdMoney'] = $value['xdMoney'];
					$reportList[$key]['xdRatio'] = $value['xdRatio'];
					$reportList[$key]['qrOrders'] = $value['qrOrders'];
					$reportList[$key]['qrMoney'] = $value['qrMoney'];
					$reportList[$key]['qrRatio'] = $value['qrRatio'];
					$reportList[$key]['fhOrders'] = $value['fhOrders'];
					$reportList[$key]['fhMoney'] = $value['fhMoney'];
					$reportList[$key]['jsOrders'] = $value['jsOrders'];
					$reportList[$key]['jsMoney'] = $value['jsMoney'];
					$reportList[$key]['qsOrders'] = $value['qsOrders'];
					$reportList[$key]['qsMoney'] = $value['qsMoney'];
				}		
			}
			
			if(!empty($reportList) && is_array($reportList)){
				$data = $reportList;
				$fileName = 'jx';  
				$tableName = '地域统计报表';
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
	 * @desc 获取地域统计报表——获取报表信息
	 * @param $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getDytjbbDetails($cond){
		$result['pro'] = $cond['pro'];
		$result['peopleNum'] = khaaDAO::getInstance()->getDytjbbByCondRS($cond)['num'];
		$xdList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'未确认','已确认','已发货','拒收','交易成功'");//下单
		$qrList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'已确认','已发货','拒收','交易成功'");//确认
		$fhList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'已发货','拒收','交易成功'");//发货
		$jsList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'拒收'");//拒收
		$qsList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'交易成功'");//签收

		$result['xdOrders'] = $xdList['orders'];
		$result['xdMoney'] = $xdList['money'];
		$result['qrOrders'] = $qrList['orders'];
		$result['qrMoney'] = $qrList['money'];
		$result['fhOrders'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['jsOrders'] = $jsList['orders'];
		$result['jsMoney'] = $jsList['money'];
		$result['qsOrders'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];

		if($result['peopleNum'] == 0 && $result['xdOrders'] == 0){
			return null;
		}
		return $result;
	}

	/**
	 * @desc 获取省份id
	 * @param string $province 省份名
	 * @author DengShaocong
	 * @date 2016-03-04
	 */
	public function getProID($province){
		if(empty($province)){
			return array('res'=>'error','msg'=>'获取错误');
		}
		$pro = approvinceDAO::getInstance()->findByAttributes(array('pname' => $province));
		return $pro['pid'];
	}


	/**
	 * @desc 获取地域统计报表图表
	 * @param $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getDytjbbChart($cond){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'days':
				//日期重置，从今天开始计算
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'weeks':
				//日期重置，从今天开始计算
				$w = date("w" ,strtotime(date('Y-m-d')));
				$cond['endDate'] = date('Y-m-d');
				for ($i=0; $w < 6; $i++) { 
					$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'] . '+1 day '));
					$w = date("w" ,strtotime($cond['endDate']));
				}
				break;
			case 'months':
				//日期重置，从今天开始计算
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime(date('Y-m-d'))).' +1 month -1 day '));
				break;

			case 'lastFifteenDays':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 day '));
				break;

			case 'nextFifteenDays':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 day '));
				break;

			case 'lastFifteenWeeks':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 week '));
				break;

			case 'nextFifteenWeeks':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 week '));
				break;

			case 'lastFifteenMonths':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 month '));
				break;

			case 'nextFifteenMonths':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 month '));
				break;

			default:

				break;
		}
		$result['result'] = 'success';
		$result['endDate'] = $cond['endDate'];
		$result['totalXdNum'] = 0;//总下单数
		$result['totalXdMoney'] = 0;//总下单金额
		$result['totalQrNum'] = 0;//总确认数
		$result['totalQrMoney'] = 0;//总确认金额
		$result['totalFhNum'] = 0;//总发货数
		$result['totalFhMoney'] = 0;//总发货金额
		$result['totalJsNum'] = 0;//总拒收数
		$result['totalJsMoney'] = 0;//总拒收金额
		$result['totalQsNum'] = 0;//总签收数
		$result['totalQsMoney'] = 0;//总签收金额
		//循环获取数据
		for ($i=0; $i < 15; $i++) { 
			$result['list'][$i] = $this->getDytjbbChartDetails($cond);

			//各项相加
			$result['totalXdNum'] += $result['list'][$i]['xdNum'];//总下单数
			$result['totalXdMoney'] += $result['list'][$i]['xdMoney'];//总下单金额
			$result['totalQrNum'] += $result['list'][$i]['qrNum'];//总确认数
			$result['totalQrMoney'] += $result['list'][$i]['qrMoney'];//总确认金额
			$result['totalFhNum'] += $result['list'][$i]['fhNum'];//总发货数
			$result['totalFhMoney'] += $result['list'][$i]['fhMoney'];//总发货金额
			$result['totalJsNum'] += $result['list'][$i]['jsNum'];//总拒收数
			$result['totalJsMoney'] += $result['list'][$i]['jsMoney'];//总拒收金额
			$result['totalQsNum'] += $result['list'][$i]['qsNum'];//总签收数
			$result['totalQsMoney'] += $result['list'][$i]['qsMoney'];//总签收金额

			if(strpos($cond['day'],'ays') !== false){
				//前一天 - 1 day
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
			}else if(strpos($cond['day'],'eeks') !== false){
				//前一周
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 week '));
			}else{
				//有点错误导致第一次 - 1 month 是减少30天，所以先获取本月的一号，再往前减一天
				$cond['endDate'] = date("Y-m-d" ,strtotime(date("Y-m-01" ,strtotime($cond['endDate'])).' - 1 day '));
			}
		}
		return $result;
	}

	/**
	 * @desc 获取地域统计报表图表详情
	 * @param $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getDytjbbChartDetails($cond){
		//获取前一天（周，月）的信息
		if(strpos($cond['day'],'ays') !== false){
			$cond['beginDate'] = $cond['endDate'];
		}else if(strpos($cond['day'],'eeks') !== false){
			$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 week + 1 day '));
		}else{
			$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 month + 1 day '));
		}

		//返回表格的日期内容
		$result['beginDate'] = $cond['beginDate'];
		$result['endDate'] = '';
		if(strpos($cond['day'],'ays') === false){
			$result['endDate'] = ' 到 '.$cond['endDate'];
		}

		//返回显示需要的日期内容
		if(strpos($cond['day'],'ays') !== false){
			//月-日
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[1].'-'.$days[2];
		}else if(strpos($cond['day'],'eeks') !== false){
			//年月日
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[0].$days[1].$days[2];
		}else{
			//年-月
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[0].'-'.$days[1];
		}

		$xdList = xsaaDAO::getInstance()->getDytjbbChart($cond,"'未确认','已确认','已发货','拒收','交易成功'");//下单
		$qrList = xsaaDAO::getInstance()->getDytjbbChart($cond,"'已确认','已发货','拒收','交易成功'");//确认
		$fhList = xsaaDAO::getInstance()->getDytjbbChart($cond,"'已发货','拒收','交易成功'");//发货
		$jsList = xsaaDAO::getInstance()->getDytjbbChart($cond,"'拒收'");//拒收
		$qsList = xsaaDAO::getInstance()->getDytjbbChart($cond,"'交易成功'");//签收

		$result['xdNum'] = $xdList['orders'];
		$result['xdMoney'] = $xdList['money'];
		$result['qrNum'] = $qrList['orders'];
		$result['qrMoney'] = $qrList['money'];
		$result['fhNum'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['jsNum'] = $jsList['orders'];
		$result['jsMoney'] = $jsList['money'];
		$result['qsNum'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];

		return $result;
	}

}
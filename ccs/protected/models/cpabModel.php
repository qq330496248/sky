<?php
/**
 * @desc 产品分类表相关操作类
 * @author DengShaocong
 * @date 2015-11-2
 */
class cpabModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cpabModel对象
	 * @return cpabModel
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 添加产品分类
	 * @param array $cpflInfo 产品分类资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function addCpfl($cpflInfo){
		if(empty($cpflInfo)){
			return array('res'=>'error','mes'=>'相关信息不完整，添加失败');
		}
		$result = cpabDAO::getInstance()->insert($cpflInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}

		return array('res'=>'success','mes'=>'添加成功');
	}
	/**
	 * @desc 查询产品分类
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function GetCpfl($cpfl,$page,$psize){
		$cpfl = cpabDAO::getInstance()->getCpfl($cpfl,$page,$psize);
		//判断是否查询到有数据
		if(!empty($cpfl) && is_array($cpfl)){
			$result['result'] = 'success';
			$result['list'] = $cpfl['info'];
			$result['count'] = $cpfl['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 根据条件查询产品分类
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $flmc 分类名称
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function GetCpflByCond($flmc){
		$cpfl = cpabDAO::getInstance()->getCpflByCond($flmc);
		//判断是否查询到有数据
		if(!empty($cpfl) && is_array($cpfl)){
			$result['result'] = 'success';
			$result['list'] = $cpfl['info'];
			$result['count'] = $cpfl['count'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
	/**
	 * @desc 根据主键删除一个产品分类
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function deleteCpfl($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}	
		$result = cpabDAO::getInstance()->deleteByPk($id);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc 根据主键查找一个产品分类
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function getSingleCpfl($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'错误');
		}
		$result = cpabDAO::getInstance()->findByAttributes(array('cpab01' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个产品分类信息
	 * @param int $id ID
	 * @param array $cpflInfo 修改内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function updateCpfl($id,$cpflInfo){
		if(empty($id) || empty($cpflInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = cpabDAO::getInstance()->updateByPk($id,$cpflInfo);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据主键修改一个产品分类信息
	 * @param int $parent 产品上一级分类
	 * @author DengShaocong
	 * @date 2015-11-30
	 */
	public function getCpzfl($parent){
		$cpzfl = cpabDAO::getInstance()->getCpzfl($parent);
		//判断是否查询到有数据
		if(!empty($cpzfl) && is_array($cpzfl)){
			$result['result'] = 'success';
			$result['list'] = $cpzfl['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}


	/**
	 * @desc 获取退货产品统计——先获取所有商品类型，大类
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getThcptjByCond($cond,$sign){
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
		$result['thNum'] = 0;//总退货数
		$result['thMoney'] = 0;//总退货金额

		$flList = cpabDAO::getInstance()->getCpflForTj('higher');
		$count = count($flList);
		for ($i=0; $i < $count; $i++) { 
			$cond['cpfl'] = $flList[$i]['cpab02'];
			$demoList = $this->getThcptjDetails($cond);
			$result['list'][$i] = $demoList;
			$result['thNum'] += $demoList['thNum'];
			$result['thMoney'] += $demoList['thMoney'];
		}
		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[31]); //导出退货产品统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
			}
			
			if(!empty($result['list']) && is_array($result['list'])){
				$data = $result['list'];
				$fileName = 'jx';  
				$tableName = '退货产品统计报表';
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
	 * @desc 获取退货产品统计——根据产品分类获取退货订单信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-29
	 */
	public function getThcptjDetails($cond){
		$list = cpabDAO::getInstance()->getThcptjDetails($cond);

		if($list['xsaa49'] == '退' || !empty($list['xsaa49'])){
			$result['cpfl'] = $cond['cpfl'];
			$result['reason'] = explode('：', $list['xsad06'])[1];
			$result['thNum'] = $list['num'];
			$result['thMoney'] = $list['money'];
			return $result;
		}
		return null;
	}

	/**
	 * @desc 获取产品类别统计报表
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getCplbtjbbByCond($cond,$sign){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'today'://今天
				$cond['beginDate'] = date('Y-m-d');
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'yesterday'://昨天
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				break;

			case 'seven'://最近7天
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -7 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'thirty'://最近三十天
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -30 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'month'://本月
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = $dateList1[0].'-'.$dateList1[1].'-01' ;
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'lastDay'://前一天
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
				break;

			case 'nextDay'://后一天
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +1 day '));
				break;

			case 'lastSeven'://前7天
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -7 day '));
				break;

			case 'nextSeven'://后7天
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +7 day '));
				break;

			case 'lastThirty'://前30天
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -30 day '));
				break;

			case 'nextThirty'://后30天
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +30 day '));
				break;

			case 'lastMonth'://上个月
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' -1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' -1 day '));
				break;

			case 'nextMonth'://下个月
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
		$result['xdNum'] = 0;//总下单数
		$result['xdMoney'] = 0;//总下单金额
		$result['qrNum'] = 0;//总确认数
		$result['qrMoney'] = 0;//总确认金额
		$result['fhNum'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['qsNum'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额
		$result['jsNum'] = 0;//总拒收数
		$result['jsMoney'] = 0;//总拒收金额
		$flList = cpabDAO::getInstance()->getCpflForTj('higher');
		if($cond['hol'] == 'lower'){
			$flList = cpabDAO::getInstance()->getCpflForTj('lower');
		}
		$count = count($flList);
		for ($i=0; $i < $count; $i++) { 
			$cond['cpfl'] = $flList[$i]['cpab02'];
			$demoList = $this->getCplbtjbbDetails($cond);
			$result['list'][$i] = $demoList;
			$result['xdNum'] += $demoList['xdOrders'];//总下单数
			$result['xdMoney'] += $demoList['xdMoney'];//总下单金额
			$result['qrNum'] += $demoList['qrOrders'];//总确认数
			$result['qrMoney'] += $demoList['qrMoney'];//总确认金额
			$result['fhNum'] += $demoList['fhOrders'];//总发货数
			$result['fhMoney'] += $demoList['fhMoney'];//总发货金额
			$result['qsNum'] += $demoList['qsOrders'];//总签收数
			$result['qsMoney'] += $demoList['qsMoney'];//总签收金额
			$result['jsNum'] += $demoList['jsOrders'];//总拒收数
			$result['jsMoney'] += $demoList['jsMoney'];//总拒收金额
		}

		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[32]); //导出产品类别统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
			}
			
			if(!empty($result['list']) && is_array($result['list'])){
				$data = $result['list'];
				$fileName = 'jx';  
				$tableName = '产品类别统计报表';
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
	 * @desc 获取产品类别统计报表
	 * @param array @cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getCplbtjbbDetails($cond){	

		$result['hol'] = $cond['hol'];
		$result['cpfl'] = $cond['cpfl'];
		$xdList = cpabDAO::getInstance()->getCplbtjbbByCond($cond,"'未确认','已确认','已发货','拒收','交易成功'");//下单信息
		$qrList = cpabDAO::getInstance()->getCplbtjbbByCond($cond,"'已确认','已发货','拒收','交易成功'");//确认信息
		$fhList = cpabDAO::getInstance()->getCplbtjbbByCond($cond,"'已发货','拒收','交易成功'");//发货信息
		$qsList = cpabDAO::getInstance()->getCplbtjbbByCond($cond,"'交易成功'");//签收信息
		$jsList = cpabDAO::getInstance()->getCplbtjbbByCond($cond,"'拒收'");//拒收信息

		$result['xdOrders'] = $xdList['orders'];
		$result['xdMoney'] = $xdList['money'];
		$result['qrOrders'] = $qrList['orders'];
		$result['qrMoney'] = $qrList['money'];
		$result['fhOrders'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['qsOrders'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];
		$result['jsOrders'] = $jsList['orders'];
		$result['jsMoney'] = $jsList['money'];
		return $result;
	}

	/**
	 * @desc 获取所有的产品类别（大类）
	 * @param array @cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-21
	 */
	public function getAllCpfl(){
		$result = cpabDAO::getInstance()->findAllByAttributes(array('cpab06'=>0));
		return $result;
	}


	/**
	 * @desc  获取产品类别报表图表显示
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getCplbtjbbChart($cond){
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
			$result['list'][$i] = $this->getCplbtjbbChartDetails($cond);

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
	 * @desc 获取进线方式统计图表——详情
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getCplbtjbbChartDetails($cond){
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

		$xdList = cpabDAO::getInstance()->getCplbtjbbChart($cond,"'未确认','已确认','已发货','拒收','交易成功'");//下单信息
		$qrList = cpabDAO::getInstance()->getCplbtjbbChart($cond,"'已确认','已发货','拒收','交易成功'");//确认信息
		$fhList = cpabDAO::getInstance()->getCplbtjbbChart($cond,"'已发货','拒收','交易成功'");//发货信息
		$qsList = cpabDAO::getInstance()->getCplbtjbbChart($cond,"'交易成功'");//签收信息
		$jsList = cpabDAO::getInstance()->getCplbtjbbChart($cond,"'拒收'");//拒收信息

		$result['xdNum'] = $xdList['orders'];
		$result['xdMoney'] = $xdList['money'];
		$result['qrNum'] = $qrList['orders'];
		$result['qrMoney'] = $qrList['money'];
		$result['fhNum'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['qsNum'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];
		$result['jsNum'] = $jsList['orders'];
		$result['jsMoney'] = $jsList['money'];

		return $result;
	}
}
?>
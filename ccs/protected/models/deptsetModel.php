<?php
/**
 * @desc 权限组表相关操作类
 * @author DengShaocong
 * @date 2015-11-9
 */
class deptsetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return deptsetModel
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 获取权限组信息
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function getAllDept(){
		$result = array();  //获取列表数据的结果
		$groupList = deptsetDAO::getInstance()->getAllDept();
		//判断是否查询到有数据
		if(!empty($groupList['info']) && is_array($groupList['info'])){
			$result['result'] = 'success';
			$result['list'] = $groupList['info'];
			$result['count'] = $groupList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	//全局变量，用于接收部门信息
	public $deptGrobalInfo = array();
	/**
	 * @desc 获取一个部门的信息
	 * @param int $level 当前等级
	 * @param int $higherdept 上一级部门的编号
	 * @param int $limit 从第几个开始取（以0位开头）
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function getDept($level,$higherdept,$limit){
		$deptInfo = deptsetDAO::getInstance()->getSingleDept($level,$higherdept,$limit);
		if(!empty($deptInfo)){
			array_push($this->deptGrobalInfo,$deptInfo);
		}
		//替换上级部门编号，并且计算这个部门有多少下级部门
		$level ++;
		$higherdept = $deptInfo['deptid'];
		$count = deptsetDAO::getInstance()->getCurrentLevelNum($level,$higherdept)['count'];	
		
		if(!empty($higherdept)){
			for($i = 0;$i<$count;$i++){
				$this->getDept($level,$higherdept,$i);
			}
		}
		
	}

	/**
	 * @desc 获取部门信息
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function getDeptList(){
		//获取一级部门（最上级部门）的数量
		$count = deptsetDAO::getInstance()->getCurrentLevelNum(0,0)['count'];
		for($i = 0;$i < $count; $i ++){
			$this->getDept(0,0,$i);
		}
		if(count($this->deptGrobalInfo)){
			return $this->deptGrobalInfo;
		}
		return array('res'=>'error','mes'=>'获取出错');
	}

	/**
	 * @desc 添加部门
	 * @param array $deptInfo 部门资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function addDept($deptInfo){
		if(empty($deptInfo)){
			return array('res'=>'false','mes'=>'相关信息不完整，添加失败');
		}
		$result = deptsetDAO::getInstance()->insert($deptInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}

	/**
	 * @desc 根据上级部门编号获取部门
	 * @param int $highid 上级部门ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function getBmByHigher($highid){
		$result = array();
		if(empty($highid)){
			return array('res'=>'false','mes'=>'异常');
		}
		$deptInfo = deptsetDAO::getInstance()->getBmByHigher($highid);
		if(empty($result)){
			$result['result'] = 'success';
			$result['list'] = $deptInfo;
		}else{
			$result['result'] = 'error';
			$result['list'] = array();
		}
		return $result;
	}

	/**
	 * @desc 获取单个部门
	 * @param string $id 部门ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function getSingleDept($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'信息不完整，获取失败');
		}
		$result = deptsetDAO::getInstance()->findAllByAttributes(array('deptid'=>$id));
		if(empty($result)){
			return array('res'=>'false','mes'=>'获取失败');
		}
		return $result[0];
	}
	/**
	 * @desc 更改部门
	 * @param array $id ID
	 * @param array $deptInfo 部门资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function updateDept($id,$deptInfo){
		if(empty($id) || empty($deptInfo)){
			return array('res'=>'error','mes'=>'修改错误');
		}
		$result = deptsetDAO::getInstance()->updateByPk($id,$deptInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}

	/**
	 * @desc 根据主键删除一个部门
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function deleteDept($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除错误');
		}
		$result = deptsetDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}

	/**
	 * @desc 获取销售部门
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-17
	 */
	public function getSaleDept(){
		$deptList = deptsetDAO::getInstance()->findAllByAttributes(array('ifmarket'=>'是'));
		return $deptList;
	}

	/**
	 * @desc 根据销售部门分组，获取分组业绩统计报表——获取分组信息
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getFzyjtjbbByCond($cond,$sign){
		$result['result'] = 'success';
		$result['list'] = array();

		$result['beginDate'] = $cond['orderBeginDate'];//
		$result['endDate'] = $cond['orderEndDate'];//

		$result['peopleNum'] = 0;//总客户数
		$result['xdCount'] = 0;//总下单数
		$result['xdMoney'] = 0;//总下单金额
		$result['sdCount'] = 0;//总审单数
		$result['sdMoney'] = 0;//总审单金额
		$result['fhCount'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['jsCount'] = 0;//总拒收数
		$result['jsMoney'] = 0;//总拒收金额
		$result['qsCount'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额

		$deptList = $this->getSaleDept();
		//根据员工信息获取不同的统计信息
		for($i = 0; $i < count($deptList); $i ++) {
			$cond['dept'] = $deptList[$i]['depttext'];
			$demoList = $this->getFzyjtjbbDetails($cond);
			$result['list'][$i] = $demoList;
			$result['peopleNum'] += $demoList['peopleNum'];
			$result['xdCount'] += $demoList['xdOrders'];
			$result['xdMoney'] += $demoList['xdMoney'];
			$result['sdCount'] += $demoList['sdOrders'];
			$result['sdMoney'] += $demoList['sdMoney'];
			$result['fhCount'] += $demoList['fhOrders'];
			$result['fhMoney'] += $demoList['fhMoney'];
			$result['jsCount'] += $demoList['jsOrders'];
			$result['jsMoney'] += $demoList['jsMoney'];
			$result['qsCount'] += $demoList['qsOrders'];
			$result['qsMoney'] += $demoList['qsMoney'];
		}

		$result['totalXdRatio'] = '-';//总成交率
		$result['totalSdRatio'] = '-';//总审单率
		$result['totalQsRatio'] ='-';//总签收率
		if($result['xdCount'] != 0){
			if($result['peopleNum'] != 0){
				$result['totalXdRatio'] = sprintf('%.2f',$result['xdCount']/$result['peopleNum']*100).'%';
			}
			if($result['sdCount'] != 0){
				$result['totalSdRatio'] = sprintf('%.2f',$result['sdCount']/$result['xdCount']*100).'%';
			}
			if($result['qsCount'] != 0){
				$result['totalQsRatio'] = sprintf('%.2f',$result['qsCount']/$result['xdCount']*100).'%';
			}
		}
		
		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[22]); //导出分组业绩统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$reportList = []; //报表显示信息
				foreach ($result['list'] as $key => $value) {
					$reportList[$key]['depttext'] = $value['depttext'];
					$reportList[$key]['peopleNum'] = $value['peopleNum'];
					$reportList[$key]['xdOrders'] = $value['xdOrders'];
					$reportList[$key]['xdMoney'] = $value['xdMoney'];
					$reportList[$key]['xdratio'] = $value['xdratio'];
					$reportList[$key]['sdOrders'] = $value['sdOrders'];
					$reportList[$key]['sdMoney'] = $value['sdMoney'];
					$reportList[$key]['sdratio'] = $value['sdratio'];
					$reportList[$key]['fhOrders'] = $value['fhOrders'];
					$reportList[$key]['fhMoney'] = $value['fhMoney'];
					$reportList[$key]['jsOrders'] = $value['jsOrders'];
					$reportList[$key]['jsMoney'] = $value['jsMoney'];
					$reportList[$key]['qsOrders'] = $value['qsOrders'];
					$reportList[$key]['qsMoney'] = $value['qsMoney'];
					$reportList[$key]['qsratio'] = $value['qsratio'];
				}				
			}
			
			if(!empty($reportList) && is_array($reportList)){
				$data = $reportList;
				$fileName = 'jx';  
				$tableName = '销售分组统计报表';
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
	 * @desc 根据销售部门分组，获取分组业绩统计报表——获取报表内容
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getFzyjtjbbDetails($cond){
		$result['depttext'] = $cond['dept'];
		$result['peopleNum'] = deptsetDAO::getInstance()->getFzyjtjbbByCondRS($cond)['num'];//人数
		$xdList = deptsetDAO::getInstance()->getFzyjtjbbByCond($cond,"'已确认','待发货','已发货','拒收','交易成功'");//下单信息
		$sdList = deptsetDAO::getInstance()->getFzyjtjbbByCond($cond,"'待发货','已发货','拒收','交易成功'");//审单信息
		$fhList = deptsetDAO::getInstance()->getFzyjtjbbByCond($cond,"'已发货','拒收','交易成功'");//发货信息
		$jsList = deptsetDAO::getInstance()->getFzyjtjbbByCond($cond,"'拒收'");//拒收信息
		$qsList = deptsetDAO::getInstance()->getFzyjtjbbByCond($cond,"'交易成功'");//签收信息

		$result['xdOrders'] = $xdList['orders'];
		$result['xdMoney'] = $xdList['money'];
		$result['sdOrders'] = $sdList['orders'];
		$result['sdMoney'] = $sdList['money'];
		$result['fhOrders'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['jsOrders'] = $jsList['orders'];
		$result['jsMoney'] = $jsList['money'];
		$result['qsOrders'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];

		$result['xdratio'] = '-';//成交率
		$result['sdratio'] = '-';//审单率
		$result['qsratio'] = '-';//签收率
		//除，获取比例
		if($result['xdOrders'] != 0){
			if($result['peopleNum'] != 0){
				$result['xdratio'] = sprintf("%.2f",$result['xdOrders']/$result['peopleNum']*100) .'%';
			}
			if($result['sdOrders'] != 0){
				$result['sdratio'] = sprintf("%.2f",$result['sdOrders']/$result['xdOrders']*100) .'%';
			}
			if($result['qsOrders'] != 0){
				$result['qsratio'] = sprintf("%.2f",$result['qsOrders']/$result['xdOrders']*100) .'%';
			}
		}

		return $result;
	}

	/**
	 * @desc 根据时段，获取进线时段分析报表——获取时段
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getJxsdfxbbByCond($cond){
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
		$result['peopleNum'] = 0;//总人数
		$result['qrNum'] = 0;//总确认单数
		$result['qrMoney'] = 0;//总确认单金额
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['list'] = array();
		//分数段获取信息
		for($i = 0; $i < 24; $i ++){
			$cond['beginTime'] = sprintf("%02d",$i).':00:00';
			$cond['endTime'] = sprintf("%02d",$i).':59:59';
			$demoList = $this->getJxsdfxbbDetails($cond,$i);//临时array
			$result['list'][$i] = $demoList;
			$result['list'][$i]['rsRatio'] = '0%';
			$result['list'][$i]['qrRatio'] = '0%';
			$result['peopleNum'] += $demoList['people']['num'];//总人数相加
			$result['qrNum'] += $demoList['qrlist']['orders'];//总确认单数相加
			$result['qrMoney'] += $demoList['qrlist']['money'];//总确认单金额相加
		}
		//如果总人数不为0，计算比例
		if($result['peopleNum'] > 0){
			for($i = 0; $i < 24; $i ++){
				$result['list'][$i]['rsRatio'] = sprintf('%.2f',$result['list'][$i]['people']['num']/$result['peopleNum']*100).'%';
			}
		}
		//如果总单数不为0，计算比例
		if($result['qrNum'] > 0){
			for($i = 0; $i < 24; $i ++){
				$result['list'][$i]['qrRatio'] = sprintf('%.2f',$result['list'][$i]['qrlist']['orders']/$result['qrNum']*100).'%';
			}
		}
		return $result;
	}

	/**
	 * @desc 根据时段，获取进线时段分析报表——获取报表内容
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getJxsdfxbbDetails($cond,$i){
		$result['timeStr'] = $i.'-'.($i+1).'点';//因为进入循环会从$i+1开始获取信息，所以在for外面事先取一次数据
		$result['people'] = deptsetDAO::getInstance()->getJxsdfxbbByCondRS($cond);
		$result['qrlist'] = deptsetDAO::getInstance()->getJxsdfxbbByCondQR($cond);
	
		//把传进来的时间转化时间戳，逐日增加，再查找每一天的某一时段的数据，并且相加
		$datelist1 = explode('-', $cond['beginDate']);
		$datelist2 = explode('-', $cond['endDate']);
		$date1 = mktime(0,0,0,$datelist1[1],$datelist1[2],$datelist1[0]);
		$date2 = mktime(0,0,0,$datelist2[1],$datelist2[2],$datelist2[0]);
		$days = round(($date2-$date1)/3600/24);
		 for ($i=0; $i < $days; $i++) { 
		 	$cond['beginDate'] = date("Y-m-d",strtotime($cond['beginDate']."  +1   day"));
		 	$result['people']['num'] += deptsetDAO::getInstance()->getJxsdfxbbByCondRS($cond)['num'];
		 	$demoList = deptsetDAO::getInstance()->getJxsdfxbbByCondQR($cond);//临时array
			$result['qrlist']['orders'] += $demoList['orders'];
			$result['qrlist']['money'] += $demoList['money'];
		 }
		return $result;
	}

	/**
	 * @desc 获取订单追踪统计报表——部门
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getDdzztjByCond($cond,$sign){
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
		$result['wksNum'] = 0;//未客审总数
		$result['wksMoney'] = 0;//未客审总金额
		$result['yksNum'] = 0;//已客审总数
		$result['yksMoney'] = 0;//已客审总金额
		$result['wcsNum'] = 0;//未财审总数
		$result['wcsMoney'] = 0;//未财审总金额
		$result['ycsNum'] = 0;//已财审总数
		$result['ycsMoney'] = 0;//已财审总金额
		$result['dfhNum'] = 0;//待发货总数
		$result['dfhMoney'] = 0;//待发货总金额
		$result['yfhNum'] = 0;//已发货总数
		$result['yfhMoney'] = 0;//已发货总金额
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$deptList = $this->getSaleDept();
		//根据部门信息获取不同的统计信息
		for($i = 0; $i < count($deptList); $i ++) {
			$cond['dept'] = $deptList[$i]['depttext'];
			$demoList = $this->getDdzztjbbDetails($cond);//临时array
			$result['list'][$i] = $demoList;
			//各个数量相加
			$result['wksNum'] += $demoList['wksOrders'];
			$result['wksMoney'] += $demoList['wksMoney'];

			$result['yksNum'] += $demoList['yksOrders'];
			$result['yksMoney'] += $demoList['yksMoney'];

			$result['wcsNum'] += $demoList['wcsOrders'];
			$result['wcsMoney'] += $demoList['wcsMoney'];

			$result['ycsNum'] += $demoList['ycsOrders'];
			$result['ycsMoney'] += $demoList['ycsMoney'];

			$result['dfhNum'] += $demoList['dfhOrders'];
			$result['dfhMoney'] += $demoList['dfhMoney'];

			$result['yfhNum'] += $demoList['yfhOrders'];
			$result['yfhMoney'] += $demoList['yfhMoney'];
		}
		
		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[25]); //导出订单追踪统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
			}
			
			if(!empty($result['list']) && is_array($result['list'])){
				$data = $result['list'];
				$fileName = 'jx';  
				$tableName = '订单追踪统计报表';
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
	 * @desc 获取订单追踪统计报表——报表
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-23
	 */
	public function getDdzztjbbDetails($cond){
		$result['depttext'] = $cond['dept'];
		$wksList = deptsetDAO::getInstance()->getDdzztjbbByCond($cond,'','');//未客审信息
		$yksList = deptsetDAO::getInstance()->getDdzztjbbByCond($cond,'',"'已客审','已财审'");//已客审信息
		$wcsList = deptsetDAO::getInstance()->getDdzztjbbByCond($cond,'',"'已客审'");//未客审信息
		$ycsList = deptsetDAO::getInstance()->getDdzztjbbByCond($cond,'',"'已财审'");//已财审信息
		$dfhList = deptsetDAO::getInstance()->getDdzztjbbByCond($cond,"'待发货'",'');//待发货信息
		$yfhList = deptsetDAO::getInstance()->getDdzztjbbByCond($cond,"'交易成功','拒收','已发货'",'');//已发货信息

		$result['wksOrders'] = $wksList['orders'];
		$result['wksMoney'] = $wksList['money'];
		$result['yksOrders'] = $yksList['orders'];
		$result['yksMoney'] = $yksList['money'];
		$result['wcsOrders'] = $wcsList['orders'];
		$result['wcsMoney'] = $wcsList['money'];
		$result['ycsOrders'] = $ycsList['orders'];
		$result['ycsMoney'] = $ycsList['money'];
		$result['dfhOrders'] = $dfhList['orders'];
		$result['dfhMoney'] = $dfhList['money'];
		$result['yfhOrders'] = $yfhList['orders'];
		$result['yfhMoney'] = $yfhList['money'];

		return $result;
	}

	/**
	 * @desc 获取所有部门信息
	 * @return array $result 列表信息
	 * * @author huyan
	 * @date 2016-03-09
	 */
	public function getAllDepartment(){
		$gonghaoArr = array();
		$WorkNumList = deptsetDAO::getInstance()->getAllDepartment();
		foreach($WorkNumList as $value){
			$gonghaoArr[] = $value['depttext'];
		}
		//判断是否查询到有数据
		if(empty($WorkNumList) || empty($gonghaoArr)){
			return; /*array('res'=>'error','mes'=>'获取工号信息失败');*/
		}
		return $gonghaoArr;
	}

	/**
	 * @desc 获取分组业绩统计报表图表
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getFztjbbChart($cond){
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
		$result['totalSdNum'] = 0;//总审单数
		$result['totalSdMoney'] = 0;//总审单金额
		$result['totalFhNum'] = 0;//总发货数
		$result['totalFhMoney'] = 0;//总发货金额
		$result['totalJsNum'] = 0;//总拒收数
		$result['totalJsMoney'] = 0;//总拒收金额
		$result['totalQsNum'] = 0;//总签收数
		$result['totalQsMoney'] = 0;//总签收金额
		//循环获取数据
		for ($i=0; $i < 15; $i++) { 
			$result['list'][$i] = $this->getFztjbbChartDetails($cond);

			//各项相加
			$result['totalXdNum'] += $result['list'][$i]['xdNum'];//总下单数
			$result['totalXdMoney'] += $result['list'][$i]['xdMoney'];//总下单金额
			$result['totalSdNum'] += $result['list'][$i]['sdNum'];//总审单数
			$result['totalSdMoney'] += $result['list'][$i]['sdMoney'];//总审单金额
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


	public function getFztjbbChartDetails($cond){
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
		
		$xdList = deptsetDAO::getInstance()->getFzyjtjbbChart($cond,"'未确认','已确认','待发货','已发货','拒收','交易成功'");//下单信息
		$sdList = deptsetDAO::getInstance()->getFzyjtjbbChart($cond,"'待发货','已发货','拒收','交易成功'");//审单信息
		$fhList = deptsetDAO::getInstance()->getFzyjtjbbChart($cond,"'已发货','拒收','交易成功'");//发货信息
		$jsList = deptsetDAO::getInstance()->getFzyjtjbbChart($cond,"'拒收'");//拒收信息
		$qsList = deptsetDAO::getInstance()->getFzyjtjbbChart($cond,"'交易成功'");//签收信息

		$result['xdNum'] = $xdList['orders'];
		$result['xdMoney'] = $xdList['money'];
		$result['sdNum'] = $sdList['orders'];
		$result['sdMoney'] = $sdList['money'];
		$result['fhNum'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['jsNum'] = $jsList['orders'];
		$result['jsMoney'] = $jsList['money'];
		$result['qsNum'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];

		return $result;
	}
}
?>
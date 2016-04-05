<?php
/**
 * @desc 通话记录表相关操作类
 * @author WuJunhua
 * @date 2016-01-28
 */
class thaaModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回thaaModel对象
	 * @return thaaModel
	 * @author WuJunhua
	 * @date 2016-01-28
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取本地通话记录最新的呼叫时间
	 * @param array $infoArr 通话记录信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-01-28
	 */
	public function getCallingRecordsNewestTime(){
		if(empty($infoArr['thaa02'])){
			return array('res'=>'error','msg'=>'获取数据失败');
		}
		$result = thaaDAO::getInstance()->insert($infoArr,true);
		if(empty($result)){
			return array('res'=>'error','msg'=>'插入失败');
		}
		return array('res'=>'success','msg'=>'插入成功');
	}

	/**
	 * @desc 插入通话记录信息
	 * @param array $infoArr 通话记录信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-01-28
	 */
	public function addCallingRecords($infoArr){
		if(empty($infoArr['thaa02'])){
			return array('res'=>'error','msg'=>'获取数据失败');
		}
		$result = thaaDAO::getInstance()->insert($infoArr,true);
		if(empty($result)){
			return array('res'=>'error','msg'=>'插入失败');
		}
		return array('res'=>'success','msg'=>'插入成功');
	}

	/**
	 * @desc 根据号码获取通话记录里的客户信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param int $sign 导出excel标识
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2016-01-28
	 */
	public function getClientInfoByNumber($page,$psize,$sign,$CondList){
		$result = [];  //获取列表数据的结果
		$clientList = thaaDAO::getInstance()->getClientInfoByNumber($page,$psize,$CondList);
		if($sign == 1){
			//导出我的客户资料excel
			$titleArray = [];  //excel标题数组
			$selectColumn = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$exportItems = count(KhglExportExcelConst::$clientDataColumnCn); //导出标题数
			if(!empty($exportItems)){
				for($i = 1; $i <= $exportItems; $i++){
					$titleArray[] = KhglExportExcelConst::$clientDataColumnCn[$i];
				}
			}
			
			if(!empty($clientList['info']) && is_array($clientList['info'])){
				$data = $clientList['info'];
				$fileName = 'jx';  //MyClientData
				$tableName = '通话记录';
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
	 * @desc 系统设置->数据清理->删除通话记录
	 * @author huyan
	 * @date 2016-02-18
	 */
	public function DelCallRecord($thsjq,$thsjz){
		//查询要删除的跟进记录id
		$result = thaaDAO::getInstance()->getCallRecordToBeDel($thsjq,$thsjz);
		if (empty($result)){
			return array('res' => 'error','msg' => '没有查询到符合条件的通话记录');
		}
		if (!empty($result)){
			$ddidArr = array();
		    foreach($result as $value){
			    $ddidArr[] = $value['thaa01'];
		    }
		    $orderNum = count($ddidArr);
			for($i = 0;$i < $orderNum;$i++){
			    $deleteResult = thaaDAO::getInstance()->delete(array('thaa01'=>$ddidArr[$i]));
			}
			return array('res' => 'success','msg' => '删除成功');
		}
	}
	/**
	 * @desc 获取10.230上的通话记录并插入到我们的系统里
	 * @param array $infoArr 通话记录信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-02-18
	 */
	public function getCallingRecords(){
		//获取本地的最新呼叫时间
		$newestCallTime = thaaDAO::getInstance()->findByAttributes(array('thaa01 >' => 0),array('thaa06'),array('thaa06 DESC'));
		//根据最新的呼叫时间去10.230获取 >该时间的所有通话记录
		$getCallingRecords = cdrDAO::getInstance()->getCallingRecordsByRemote($newestCallTime['thaa06']);
		if(empty($getCallingRecords)){
			return array('res' => 'error','msg' => '目前的通话记录已经是最新的！');
		}

		$bjTimeStamp = 8*3600;	//北京8小时的时间戳
		$infoArr = [];
		$callingRecordsArr = []; //通话记录信息
		foreach($getCallingRecords as $callingrecords){
			$ringingDuration = (int)$callingrecords['duration'] - (int)$callingrecords['billsec'] - $bjTimeStamp; //振铃时间戳
			$callDuration = (int)$callingrecords['billsec'] - $bjTimeStamp; //通话时间戳
			$infoArr['thaa02'] = $callingrecords['src']; //主叫号码
			$infoArr['thaa03'] = $callingrecords['dst']; //被叫号码
			$infoArr['thaa04'] = date('H:i:s',$ringingDuration); //振铃时长
			$infoArr['thaa05'] = date('H:i:s',$callDuration); //通话时长
			$infoArr['thaa06'] = $callingrecords['calldate']; //呼叫时间
			$infoArr['thaa07'] = $callingrecords['channel'];
			$infoArr['thaa08'] = $callingrecords['dstchannel'];
			$infoArr['thaa09'] = $callingrecords['disposition'];
			$infoArr['thaa10'] = $callingrecords['uniqueid'];
			$infoArr['thaa11'] = $callingrecords['userfield'];
			$callingRecordsArr[] = $infoArr;
		}

		//把10.230获取的通话记录插入到系统里
		foreach($callingRecordsArr as $callingRecords){
			$result = thaaDAO::getInstance()->insert($callingRecords);
		}
		if(empty($result)){
			return array('res' => 'error','msg' => '获取通话记录失败');
		}
		return array('res' => 'success','msg' => '获取通话记录成功');
	}

	/**
	 * @desc 获取客户通话记录
	 * @author huyan
	 * @date 2016-03-02
	 */
	public function GetCallRecords($khphonecall,$page,$psize){
		$result = thaaDAO::getInstance()->GetCallRecords($khphonecall,$page,$psize);
		if(empty($result)){
			return array('res'=>'error','msg'=>'获取客户订单记录失败');
		}
		return $result;
	}

	/**
	 * @desc 客户详情页面删除通话记录
	 * @author huyan
	 * @date 2016-03-02
	 */
	public function DelCallRecords($orderno){
		$deleteResult = thaaDAO::getInstance()->delete(array('thaa01'=>$orderno));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}


	/**
	 * @desc 获取分机通话记录报表
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getFjthtjbbByCond($cond){
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
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['ybCount'] = 0;//总已拨数
		$result['ybTime'] = '';//总已拨时间
		$result['yjCount'] = 0;//总已接数
		$result['yjTime'] = '';//总已接时间
		$result['wjCount'] = 0;//总未接数
		$result['wjTime'] = '-';//总未接时间
		$result['noCallRatio'] = '0.00%';//漏接率
		$result['totalTime'] = '0';//总时长
		$result['list'] = array();

		if($cond['dept'] != ''){
			$rylist = rylistDAO::getInstance()->findAllByAttributes(array('department'=>$cond['dept']));
		}else{
			$rylist = rylistDAO::getInstance()->getAllWorkNumber();
		}
		$count = count($rylist);
		//各类时间储存
		//已拨
		$demoYbTime['h'] = 0;
		$demoYbTime['i'] = 0;
		$demoYbTime['s'] = 0;
		//已接
		$demoYjTime['h'] = 0;
		$demoYjTime['i'] = 0;
		$demoYjTime['s'] = 0;
		//总时长
		$demoTotalTime['h'] = 0;
		$demoTotalTime['i'] = 0;
		$demoTotalTime['s'] = 0;
		for ($i=0; $i < $count; $i++) { 
			$cond['username'] = $rylist[$i]['username'];
			$cond['fenji'] = $rylist[$i]['fenji'];

			$demoList = $this->getFjthtjbbDetails($cond);
			$result['list'][$i] = $demoList;
			//各项相加
			$result['ybCount'] += $demoList['ybdh']['count'];
			$result['yjCount'] += $demoList['yjdh']['count'];
			$result['wjCount'] += $demoList['wjdh']['count'];

			$ybTime = explode(':', $demoList['ybdh']['time']);
			$yjTime = explode(':', $demoList['yjdh']['time']);
			$totalTime = explode(':', $demoList['allTime']);
			//已拨
			$demoYbTime['h'] += $ybTime[0];
			$demoYbTime['i'] += $ybTime[1];
			$demoYbTime['s'] += $ybTime[2];
			//已接
			$demoYjTime['h'] += $yjTime[0];
			$demoYjTime['i'] += $yjTime[1];
			$demoYjTime['s'] += $yjTime[2];
			//总时长
			$demoTotalTime['h'] += $totalTime[0];
			$demoTotalTime['i'] += $totalTime[1];
			$demoTotalTime['s'] += $totalTime[2];
			
		}
		if($result['yjCount'] > 0 || $result['ybCount'] > 0){
			$result['noCallRatio'] = sprintf('%.2f',$result['wjCount']/($result['ybCount']+$result['yjCount'])*100).'%';
		}
		//时间处理
		//已拨打
		$demoYbTime['i'] += floor($demoYbTime['s']/60);//秒转分
		$demoYbTime['h'] += floor($demoYbTime['i']/60);//分转时
		$demoYbTime['i'] = $demoYbTime['i']%60;//余数
		$demoYbTime['s'] = $demoYbTime['s']%60;//余数
		//已接听
		$demoYjTime['i'] += floor($demoYjTime['s']/60);//秒转分
		$demoYjTime['h'] += floor($demoYjTime['i']/60);//分转时
		$demoYjTime['i'] = $demoYjTime['i']%60;//余数
		$demoYjTime['s'] = $demoYjTime['s']%60;//余数
		//总时长
		$demoTotalTime['i'] += floor($demoTotalTime['s']/60);//秒转分
		$demoTotalTime['h'] += floor($demoTotalTime['i']/60);//分转时
		$demoTotalTime['i'] = $demoTotalTime['i']%60;//余数
		$demoTotalTime['s'] = $demoTotalTime['s']%60;//余数

		$result['ybTime'] = sprintf('%02d',$demoYbTime['h']).':'.sprintf('%02d',$demoYbTime['i']).':'.sprintf('%02d',$demoYbTime['s']);
		$result['yjTime'] = sprintf('%02d',$demoYjTime['h']).':'.sprintf('%02d',$demoYjTime['i']).':'.sprintf('%02d',$demoYjTime['s']);
		$result['totalTime'] = sprintf('%02d',$demoTotalTime['h']).':'.sprintf('%02d',$demoTotalTime['i']).':'.sprintf('%02d',$demoTotalTime['s']);

		return $result;
	}

	/**
	 * @desc 获取分机通话记录报表——信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getFjthtjbbDetails($cond){
		$result['username'] = $cond['username'];
		//已拨电话
		$ybdh = thaaDAO::getInstance()->getFjthtjbbByCondDialed($cond);
		//已接电话
		$yjdh = thaaDAO::getInstance()->getFjthtjbbByCondReceived($cond);
		//未接电话
		$wjdh = thaaDAO::getInstance()->getFjthtjbbByCondMissed($cond);
		//计算电话数以及时长
		$result['ybdh'] = $this->getCallingMessage($ybdh);
		$result['yjdh'] = $this->getCallingMessage($yjdh);
		$result['wjdh'] = $this->getCallingMessage($wjdh);
		$result['wjdh']['time'] = '-';
		$result['noCallRatio'] = '0.00%';//漏接率
		//总时长计算
		
		$ybhis = explode(':', $result['ybdh']['time']);
		$yjhis = explode(':', $result['yjdh']['time']);
		$hours = $ybhis[0] + $yjhis[0];
		$minutes = $ybhis[1] + $yjhis[1];
		$seconds = $ybhis[2] + $yjhis[2];

		//时间处理
		$minutes += floor($seconds/60);//秒转分
		$hours += floor($minutes/60);//分转时
		$seconds = $seconds%60;//余数
		$minutes = $minutes%60;//余数

		$result['allTime'] = sprintf('%02d',$hours).':'.sprintf('%02d',$minutes).':'.sprintf('%02d',$seconds);

		if($result['ybdh']['count'] > 0 || $result['yjdh']['count'] > 0){
			$result['noCallRatio'] = sprintf('%.2f',$result['wjdh']['count']/($result['ybdh']['count']+$result['yjdh']['count'])*100).'%';
		}
		return $result;
	}


	/**
	 * @desc 计算总通话时间以及接听和拨打电话的数量
	 * @param array $mes mysql中查找的电话信息
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getCallingMessage($mes){
		$count = count($mes);
		$timeUnix = 0;
		$hours = 0;//时
		$minutes = 0;//分
		$seconds = 0;//秒
		for ($i=0; $i < $count; $i++){ 
			$his = explode(':', $mes[$i]['thaa05']);
			$hours += $his[0];
			$minutes += $his[1];
			$seconds += $his[2];
		}
		//时间处理
		$minutes += floor($seconds/60);//秒转分
		$hours += floor($minutes/60);//分转时
		$seconds = $seconds%60;//余数
		$minutes = $minutes%60;//余数

		$result['count'] = $count;
		$result['time'] = sprintf('%02d',$hours).':'.sprintf('%02d',$minutes).':'.sprintf('%02d',$seconds);
		return $result;
	}
}

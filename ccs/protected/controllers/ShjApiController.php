<?php
/**
 * @desc 深海捷接口操作类
 * @author WuJunhua
 * @date 2016-01-04
 */
class ShjApiController extends Controller{
	private $fenji;
	public function __construct(){
		$this->fenji = Yii::app()->session['fenji'];
	}

	/**
	 * @desc 测试Api显示
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionGetTestApiHtml(){
		$this->display('ddgl/testApi.html');
	}
	
	/* @des 发送请求
	 * @param string $url 请求的接口地址
	 * @result object $output 结果信息
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionRequestApi($url){
		//初始化
		$ch = curl_init();
		//设置URL
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		/*$chError = curl_error($ch);
		// 捕捉CURL执行错误
		if(!empty($chError)){
			$errmsg = '[异常消息]'.$chError;
			RunTimeLog::apiResultLog('wish', $this->verb, '运行时间'.date('Y-m-d H:i:s',time())."\r\n参数：".json_encode($url)."\r\n结果：".$errmsg);
			return false;
		}*/
		//关闭curl
		curl_close($ch);
		return $output;
	}
	
	/**
	 * @desc 调用电话呼出接口
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionExtensionNumberToMbPhoneApi(){
		$firstPhone = $this->fenji; //主叫号码，必须为分机号码
		$secondPhone = CInputFilter::getString('secondPhone'); //被叫号码，可以为分机号码或外线号码，必填。
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=dial&extension='.$firstPhone.'&extensionDst='.$secondPhone;
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}	

	/**
	 * @desc 调用手机拨打手机接口
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	/*public function actionMbPhoneToMbPhoneApi(){
		$firstPhone = CInputFilter::getString('firstPhone'); //主叫手机号码 
		$secondPhone = CInputFilter::getString('secondPhone'); //需要拨打的手机号码
		$callback = CInputFilter::getString('callback'); //回调
		if(empty($firstPhone) || empty($secondPhone)){
			return false;
		}
		$url = 'http://www.mixcall.cn/interface/api/?action=mobiletransfer&mobile='.$firstPhone.'&mobileDst='.$secondPhone;
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}*/	

	/**
	 * @desc 调用通话保持接口
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionCallOnHoldApi(){
		$firstPhone = $this->fenji; //要保持或恢复的分机号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=hold&extension='.$firstPhone;
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}

	/**
	 * @desc 调用电话转移接口
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionPhoneTransferApi(){
		$firstPhone = $this->fenji; //要转接的分机号码(正在与客户通话的分机，即自己本身)
		$secondPhone = CInputFilter::getString('secondPhone'); //转接的目的地号码，可以是分机，也可以是外线号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=transfer&extension='.$firstPhone.'&extensionDst='.$secondPhone;
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}	

	/**
	 * @desc 调用电话挂断接口
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionPhoneHangUpApi(){
		$firstPhone = $this->fenji; //要挂断通话的分机号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=hangup&extension='.$firstPhone;
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}	

	/**
	 * @desc 调用电话监听接口
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionWiretappingApi(){
		$firstPhone = $this->fenji; //要监听的分机号码
		$secondPhone = CInputFilter::getString('secondPhone'); //被监听的分机号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=chanspy&extension='.$firstPhone.'&extensionDst='.$secondPhone.'&option=b';
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}		

	/**
	 * @desc 调用控制面板接口
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionControlPanelApi(){
		$firstPhone = CInputFilter::getString('firstPhone'); //要监听的分机号码
		//$secondPhone = CInputFilter::getString('secondPhone'); //被监听的分机号码
		$callback = CInputFilter::getString('callback'); //回调
		if(empty($firstPhone)){
			return false;
		}
		$url = 'http://192.168.10.230/interface/api/?action=panel&extension='.$firstPhone;
		$apiResult = $this->actionRequestApi($url);
		//$xml = simplexml_load_string($apiResult);
		//print_r($xml);die;
		echo $callback .'('. $apiResult .')';
	}	

	/**
	 * @desc 调用座席监控接口
	 * @author WuJunhua
	 * @date 2016-01-04
	 */
	public function actionSeatingMonitoringApi(){
		$firstPhone = $this->fenji; //分机号码，说明当前监控座席监控界面的分机。
		$callback = CInputFilter::getString('callback'); //回调
		$firstPhone = '8040';
		$url = 'http://192.168.10.230/interface/api/?action=agentmonitor&extension='.$firstPhone;
		$apiResult = $this->actionRequestApi($url);
		//将xml转化为xml对象
		$xml = simplexml_load_string($apiResult,'SimpleXMLElement',LIBXML_NOCDATA);
		//将xml对象转化为json对象
		$apiResult = json_encode($xml);
		//将json对象转化为数组
		$xmlArr = json_decode($apiResult,true);
		$nodeArr = $xmlArr['node'];
		$agentArr = $xmlArr['agent'];
		$authArr = $xmlArr['auth'];
		
		$newAgentArr = []; //所有座席的信息
		foreach($agentArr['node'] as $value){
			foreach($value as $v){
				$newAgentArr[] = $v;
			}
		}
		$newAuthArr = []; 
		$newestAuthArr = []; //登录座席的操作权限信息
		foreach($authArr['node'] as $value){
			foreach($value as $v){
				$newAuthArr[$v['name']] = $v['value'];
			}
		}
		$newestAuthArr[] = $newAuthArr;
		$newArr = array_merge($newAgentArr,$newestAuthArr);
		$apiResult = json_encode($newArr);
		echo $callback .'('. $apiResult .')';
	}

	/**
	 * @desc 调用电话挂断接口来实现强拆功能
	 * @author WuJunhua
	 * @date 2016-01-12
	 */
	public function actionDemolitionsApi(){
		$firstPhone = CInputFilter::getString('firstPhone'); //要强拆(挂断)通话的分机号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=hangup&extension='.$firstPhone;
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}

	/**
	 * @desc 调用电话转移和电话挂断接口来实现强插功能
	 * @author WuJunhua
	 * @date 2016-01-12
	 */
	public function actionPhoneOverrideApi(){
		$firstPhone = CInputFilter::getString('firstPhone'); //要转接的分机号码(与客户通话中的分机号)
		$secondPhone = $this->fenji; //转接的目的地号码，可以是分机，也可以是外线号码
		$callback = CInputFilter::getString('callback'); //回调
		//电话转移接口
		$url = 'http://192.168.10.230/interface/api/?action=transfer&extension='.$firstPhone.'&extensionDst='.$secondPhone;
		$apiResult = $this->actionRequestApi($url);
		$shiftResultArr = json_decode($apiResult,true);
		if($shiftResultArr['result'] == 1){
			//电话挂断接口
			$hangupUrl = 'http://192.168.10.230/interface/api/?action=hangup&extension='.$firstPhone;
			sleep(12);
			$apiResult = $this->actionRequestApi($hangupUrl);
			echo $callback .'('. $apiResult .')';
			die;
		}
		echo $callback .'('. $apiResult .')';
	}	

	/**
	 * @desc 调用分机示忙/示闲接口来实现强制示闲功能
	 * @author WuJunhua
	 * @date 2016-01-13
	 */
	public function actionForcedFreeApi(){
		$firstPhone = CInputFilter::getString('firstPhone'); //要强拆(挂断)通话的分机号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=setdnd&extension='.$firstPhone.'&dnd=-1';
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}

	/**
	 * @desc 调用分机示忙/示闲接口来实现强制示忙功能
	 * @author WuJunhua
	 * @date 2016-01-13
	 */
	public function actionForcedBusyApi(){
		$firstPhone = CInputFilter::getString('firstPhone'); //要强拆(挂断)通话的分机号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=setdnd&extension='.$firstPhone.'&dnd=1';
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}

	/**
	 * @desc 调用获取数据接口来获取通话记录的数据  【深海捷旧的获取通话记录的方式，现在是新的方式】
	 * @author WuJunhua
	 * @date 2016-01-26
	 */
	/*public function actionGetCallingRecordsApi(){
		$infoArr = []; //通话记录信息
		$data = $_REQUEST; //接口返回的通话记录的所有数据
		$bjTimeStamp = 8*3600;	//北京8小时的时间戳
		$ringingDuration = (int)$data['Duration'] - (int)$data['BillableSeconds'] - $bjTimeStamp; //振铃时间戳
		$callDuration = (int)$data['BillableSeconds'] - $bjTimeStamp; //通话时间戳
		$infoArr['thaa02'] = $data['Source']; //主叫号码
		$infoArr['thaa03'] = $data['Destination']; //被叫号码
		$infoArr['thaa04'] = date('H:i:s',$ringingDuration); //振铃时长
		$infoArr['thaa05'] = date('H:i:s',$callDuration); //通话时长
		$infoArr['thaa06'] = $data['StartTime']; //呼叫时间
		$infoArr['thaa07'] = $data['Channel'];
		$infoArr['thaa08'] = $data['DestinationChannel'];
		$infoArr['thaa09'] = $data['Disposition'];
		$infoArr['thaa10'] = $data['UniqueID'];
		$infoArr['thaa11'] = $data['UserField'];
		$result = thaaModel::model()->addCallingRecords($infoArr);
		//file_put_contents(CALLED_RECORD_DIR, var_export($_REQUEST, true)); //测试通话记录接口的数据是否正常返回
	}*/

	/**
	 * @desc 调用添加黑名单接口
	 * @author WuJunhua
	 * @date 2016-03-18
	 */
	public function actionAddBlacklistApi(){
		$phone = CInputFilter::getString('phone'); //要添加到电话黑名单的号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=addblacklist&extension='.$phone;
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}

	/**
	 * @desc 调用删除黑名单接口
	 * @author WuJunhua
	 * @date 2016-03-18
	 */
	public function actionDelBlacklistApi(){
		$phone = CInputFilter::getString('phone'); //要添加到电话黑名单的号码
		$callback = CInputFilter::getString('callback'); //回调
		$url = 'http://192.168.10.230/interface/api/?action=delblacklist&extension='.$phone;
		$apiResult = $this->actionRequestApi($url);
		echo $callback .'('. $apiResult .')';
	}

}
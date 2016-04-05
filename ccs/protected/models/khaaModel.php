<?php
/**
 * @desc 客户表相关操作类
 * @author WuJunhua
 * @date 2015-10-27
 */
class khaaModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khaaModel对象
	 * @return khaaModel
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加客户资料
	 * @param array $clientInfo 客户资料
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function addClient($clientInfo,$addrInfo,$JobNumber){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'客户资料不能为空');
		}
		$clientList = khaaDAO::getInstance()->getMaxCustomerNumber();
		if(!empty($clientList)){
			$date = substr($clientList['khaa02'],2,4);
			if($date == date('ym')){
				$id = substr($clientList['khaa02'],-4,4);
				$id += 1;
				$clientId = sprintf("%04d",$id);
				$clientNo = 'KH'.date('ym').$clientId;
			}else{
				$id = '1';
				$clientId = sprintf("%04d",$id);
				$clientNo = 'KH'.date('ym').$clientId;
			}
			
		}else{
			$id = '1';
			$clientId = sprintf("%04d",$id);
			$clientNo = 'KH'.date('ym').$clientId;
		}
		$addrInfo['khab01'] = $clientInfo['khaa02'] = $clientNo;
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['provinceid']),array('pname'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['cityid']),array('cname'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aid'=>$addrInfo['areaid']),array('aname'));
		//拼接联系地址
		$addrInfo['khab03'] = $clientInfo['khaa12'] = $province['pname'].','.$city['cname'].','.$area['aname'].','.$addrInfo['deaddress']; 

		$ishmddh = array('khai03'=>$clientInfo['khaa06']);
		$Customerihsmddh = khaiDAO::getInstance()->isExists($ishmddh);
		//黑名单中存在的手机号不允许保存客户
		if($Customerihsmddh){
			return array('res'=>'error','msg'=>'该手机号为黑名单号码,不允许保存');
		}
		$khdianhua = array('khaa06'=>$clientInfo['khaa06']);
		$CustomerPhone = khaaDAO::getInstance()->isExists($khdianhua);
		//添加客户时不能有重复的手机号
		if($CustomerPhone){
			return array('res'=>'error','msg'=>$clientInfo['khaa06'].'的手机号已存在,请确认后再试');
		}

		//查找当前工号的上级id
		$dqghid = rylistDAO::getInstance()->findByAttributes(array('username'=>$JobNumber),array('higherlevel'));
		//找到当前工号的上级工号
		if (!empty($dqghid)) {
			$dqghname = rylistDAO::getInstance()->findByAttributes(array('id'=>$dqghid['higherlevel']),array('username'));
			if (!empty($dqghname)) {
				$clientInfo['khaa46']=$dqghname['username'];
			}
		}
		$res = khaaDAO::getInstance()->insert($clientInfo);
		if(empty($res)){
			return array('res'=>'error','msg'=>'添加失败');
		}
		//插入客户跟进记录
		$followInfo = array();
		$followInfo['khae01'] = $clientNo;
		$followInfo['khae08'] = date('Y-m-d H:i'); //记录时间
		/*$followInfo['khae09'] = date('Y-m-d H:i'); //待办时间*/
		$followInfo['khae02'] = "新进客户"; //主题
		$followInfo['khae03'] = "新进客户"; //内容
		$followInfo['khae04'] = Yii::app()->session['account'];  //安排人工号 
		$followInfo['khae05'] = Yii::app()->session['name']; // 安排人姓名
		$followInfo['khae06'] = Yii::app()->session['account'];//跟进人工号
		$followInfo['khae07'] = Yii::app()->session['name']; //跟进人姓名
		$followResult = khaeDAO::getInstance()->insert($followInfo);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'客户跟进记录有误');
		}
		//释放无用变量
		unset($addrInfo['provinceid']);
		unset($addrInfo['cityid']);
		unset($addrInfo['areaid']);
		unset($addrInfo['deaddress']);
		if(!empty($addrInfo['khab03'])){
			$addrRes = khabDAO::getInstance()->insert($addrInfo);
		}
		return array('res'=>'success','msg'=>'添加成功','clientno'=>$clientNo);
		
	}

	/**
	 * @desc 获取我的客户列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-10-28
	 */
	public function GetMyClient($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo,$sign){
		$addrStr = '';
		$addrArr =[];
		$result = [];  //获取列表数据的结果
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['khsf']),array('pname'));
		$addrInfo['khsf']=$province['pname'];
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['city']),array('cname'));
		$addrInfo['city']=$city['cname'];
		$area = appAreaDAO::getInstance()->findByAttributes(array('aid'=>$addrInfo['area']),array('aname'));
		$addrInfo['area']=$area['aname'];
		$clientList = khaaDAO::getInstance()->GetMyClient($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo);

		if($sign == 1){
			//导出我的客户资料excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[1]); //导出客户资料excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$clientList = khaaDAO::getInstance()->GetMyClient($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo,$selectColumnStr);
				}
			}
			
			if(!empty($clientList['info']) && is_array($clientList['info'])){
				$data = $clientList['info'];
				$fileName = 'jx';  //MyClientData
				$tableName = '我的客户资料';
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
	 * @desc 获取未分配客户列表信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-04-01
	 */
	public function GetNoDistribution($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo,$sign){
		$addrStr = '';
		$addrArr =[];
		$result = [];  //获取列表数据的结果
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['khsf']),array('pname'));
		$addrInfo['khsf']=$province['pname'];
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['city']),array('cname'));
		$addrInfo['city']=$city['cname'];
		$area = appAreaDAO::getInstance()->findByAttributes(array('aid'=>$addrInfo['area']),array('aname'));
		$addrInfo['area']=$area['aname'];
		$clientList = khaaDAO::getInstance()->GetNoDistribution($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo);

		if($sign == 1){
			//导出我的客户资料excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[1]); //导出客户资料excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$clientList = khaaDAO::getInstance()->GetNoDistribution($page,$psize,$order,$sequence,$xskh,$JobNumber,$CondList,$addrInfo,$selectColumnStr);
				}
			}
			
			if(!empty($clientList['info']) && is_array($clientList['info'])){
				$data = $clientList['info'];
				$fileName = 'jx';  //MyClientData
				$tableName = '未分配客户资料';
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
	 * @desc 获取下属客户列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-11-20
	 */
	public function Subordinate($page,$psize,$JobNumber,$order,$CondList,$addrInfo,$sign){
		$addrStr = '';
		$addrArr =array();
		$result = array();  //获取列表数据的结果
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['khsf']),array('pname'));
		$addrInfo['khsf']=$province['pname'];
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['city']),array('cname'));
		$addrInfo['city']=$city['cname'];
		$area = appAreaDAO::getInstance()->findByAttributes(array('aid'=>$addrInfo['area']),array('aname'));
		$addrInfo['area']=$area['aname'];

		$clientList = khaaDAO::getInstance()->Subordinate($page,$psize,$CondList,$order,$JobNumber,$addrInfo);
		if($sign == 1){
			//导出我的客户资料excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[1]); //导出客户资料excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$clientList = khaaDAO::getInstance()->Subordinate($page,$psize,$CondList,$order,$JobNumber,$addrInfo);
				}
			}

			if(!empty($clientList['info']) && is_array($clientList['info'])){
				$data = $clientList['info'];
				$fileName = 'jx';  //MyClientData
				$tableName = '下属客户资料';
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
	 * @desc 获取客户资料详情
	 * @param string $clientNo 客户编号
	 * @return array $currentClient 当前客户信息
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function findCurrentClientData($symbol,$clientno,$sign){
		$JobNumber = Yii::app()->session['account'];  //当前用户工号
		if(empty($clientno)){
			return array('res' => 'error','msg' => '获取客户详情失败');
		}
		//上一个、下一个判定
		if($symbol == '<'){
			$order = 'DESC';
		}
		if($symbol == '>' || $symbol == '='){
			$order = 'ASC';
		}

		//根据当前客户id查询上级工号
		$dqghid = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$clientno),array('khaa46','khaa32'));
		//根据客户id查找客户归属工号
		$khgsghArr = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$clientno),array('khaa32'));
		if (!empty($khgsghArr)) {
			if ($khgsghArr['khaa32']!=$JobNumber) {
			    //是我的下属客户
			    $khgsgh=$khgsghArr['khaa32'];
			    $currentClient = khaaDAO::getInstance()->findsubordinateCustomers($clientno,$symbol,$order,$JobNumber);
			    //下属客户最大最小客户id
			    $maxOrder = khaaDAO::getInstance()->findMaxOrder($JobNumber);//序号最大的客户id
			    $minOrder = khaaDAO::getInstance()->findMinOrder($JobNumber); //序号最小的客户id
		    }
		    else{
			   //表示当前客户资料是我的客户资料 而不是下属客户资料
			    $currentClient = khaaDAO::getInstance()->findCustomerDetail($clientno,$symbol,$order,$JobNumber);
			    //我的客户最大最小客户id
			    $maxOrder = khaaDAO::getInstance()->findMaxcustomer($JobNumber);//序号最大的客户id
			    $minOrder = khaaDAO::getInstance()->findMincustomer($JobNumber); //序号最小的客户id
		    }
		}
		//截取出身日期
		if(!empty($currentClient['khaa05'])){
		    $str2 = substr($currentClient['khaa05'],0,10);
		    $currentClient['khaa05'] =$str2;
	    }

		if(empty($currentClient)){
			return array('res' => 'error','msg' => '获取客户详情失败');
		}

		if($currentClient['khaa02'] == $maxOrder['khaa02']){
			$currentClient['maxorder'] = $currentClient['khaa02'];
		}
		if($currentClient['khaa02'] == $minOrder['khaa02']){
			$currentClient['minorder'] = $currentClient['khaa02'];
		}
		if(!empty($currentClient['khaa12'])){
			$addrStr = $currentClient['khaa12'];
			$addrArr = explode(',', $addrStr);
		}
		
		if(!empty($addrArr)){
			$currentClient['province'] = $addrArr[0];
			$currentClient['city'] = $addrArr[1];
			$currentClient['area'] = $addrArr[2];
			$currentClient['addrdetail'] = $addrArr[3];
		}
		$addrInfo = khabDAO::getInstance()->findByAttributes(array('khab01'=>$clientno));
		if(!empty($addrInfo)){
			$addrStr = $addrInfo['khab03'];
			$currentClient['postcode'] = $addrInfo['khab06'];
			$addrArr = explode(',', $addrStr);
			//客户资料详情
			if ($sign=='2') {
				$currentClient['province'] = $addrArr[0];
			    $currentClient['city'] = $addrArr[1];
			    $currentClient['area'] = $addrArr[2];
			    $currentClient['addrdetail'] = $addrArr[3];
			}
		}

		//下单时的客户资料信息
		if ($sign=='1') {
			//根据当前客户id查询这个客户上次下单时的地址
			$dqghaddress = xsaaDAO::getInstance()->findByAttributes(array('xsaa04'=>$clientno),array('xsaa09'),array('xsaa02 DESC'));
			if (!empty($dqghaddress)) {
				$orderaddrArr = explode(',',$dqghaddress['xsaa09']);
				$currentClient['province'] = $orderaddrArr [0];
				$currentClient['city'] = $orderaddrArr [1];
				$currentClient['area'] = $orderaddrArr [2];
		        $currentClient['addrdetail'] = $orderaddrArr [3];//详细地址
			}
		}
		
		//获取省市区唯一id
		$province = approvinceDAO::getInstance()->findByAttributes(array('pname'=>$currentClient['province']),array('pid'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cname'=>$currentClient['city']),array('cid'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aname'=>$currentClient['area']),array('aid'));
		$currentClient['provinceid'] = $province['pid'];
		$currentClient['cityid'] = $city['cid'];
		$currentClient['areaid'] = $area['aid'];

		//获取当前客户对应的订单id
		$ddkhbh=$currentClient['khaa02'];
		$GetOrder = khaaDAO::getInstance()->getOrderOptions($ddkhbh);

		//工号拼接
		if(!empty($currentClient['khaa32']) && !empty($currentClient['khaa33'])){
			$currentClient['gonghao'] = $currentClient['khaa32'].':'.$currentClient['khaa33'];
		}
		if(empty($currentClient)){
			return array('res' => 'error','msg' => '获取用户详情失败');
		}
		$DetailsAll=array($currentClient,$GetOrder,$khgsghArr);
		return $DetailsAll;
	}

	/**
	 * @desc 获取下属客户资料详情
	 * @param string $clientNo 客户编号
	 * @return array $currentClient 当前客户信息
	 * @author huyan
	 * @date 2016-03-03
	 */
	/*public function findCustomersDetailsData($symbol,$clientno){
		$JobNumber = Yii::app()->session['account'];  //当前用户工号
		if(empty($clientno)){
			return array('res' => 'error','msg' => '获取订单详情失败');
		}
		if($symbol == '<'){
			$order = 'DESC';
		}
		if($symbol == '>' || $symbol == '='){
			$order = 'ASC';
		}

		//查找当前工号对应的id
		//$dqghid = rylistDAO::getInstance()->findByAttributes(array('username'=>$JobNumber),array('id'));
		//查找当前工号对应的下属工号
		//$ssxsgh = rylistDAO::getInstance()->findAllByAttributes(array('higherlevel'=>$dqghid['id']),array('username'));

		$currentClient = khaaDAO::getInstance()->findsubordinateCustomers($clientno,$symbol,$order,$JobNumber);
		//截取出身日期
		if(!empty($currentClient['khaa05'])){
		    $str2 = substr($currentClient['khaa05'],0,10);
		    $currentClient['khaa05'] =$str2;
	    }
		if(empty($currentClient)){
			return array('res' => 'error','msg' => '获取订单详情失败');
		}
		$maxOrder = khaaDAO::getInstance()->findMaxOrder($JobNumber);	//序号最大的客户id
		$minOrder = khaaDAO::getInstance()->findMinOrder($JobNumber); //序号最小的客户id

		if($currentClient['khaa02'] == $maxOrder['khaa02']){
			$currentClient['maxorder'] = $currentClient['khaa02'];
		}
		if($currentClient['khaa02'] == $minOrder['khaa02']){
			$currentClient['minorder'] = $currentClient['khaa02'];
		}
		if(!empty($currentClient['khaa12'])){
			$addrStr = $currentClient['khaa12'];
			$addrArr = explode(',', $addrStr);
		}
		if(!empty($addrArr)){
			$currentClient['province'] = $addrArr[0];
			$currentClient['city'] = $addrArr[1];
			$currentClient['area'] = $addrArr[2];
			$currentClient['addrdetail'] = $addrArr[3];
		}
		$addrInfo = khabDAO::getInstance()->findByAttributes(array('khab01'=>$clientno));
		if(!empty($addrInfo)){
			$addrStr = $addrInfo['khab03'];
			$currentClient['postcode'] = $addrInfo['khab06'];
			$addrArr = explode(',', $addrStr);
			$currentClient['province'] = $addrArr[0];
			$currentClient['city'] = $addrArr[1];
			$currentClient['area'] = $addrArr[2];
			$currentClient['addrdetail'] = $addrArr[3];
			//获取省市区唯一id
			$province = approvinceDAO::getInstance()->findByAttributes(array('pname'=>$currentClient['province']),array('pid'));
			$city = appCityDAO::getInstance()->findByAttributes(array('cname'=>$currentClient['city']),array('cid'));
			$area = appAreaDAO::getInstance()->findByAttributes(array('aname'=>$currentClient['area']),array('aid'));
			$currentClient['provinceid'] = $province['pid'];
			$currentClient['cityid'] = $city['cid'];
			$currentClient['areaid'] = $area['aid'];
		}

		//获取当前客户对应的订单id
		$ddkhbh=$currentClient['khaa02'];
		$GetOrder = khaaDAO::getInstance()->getOrderOptions($ddkhbh);

		//工号拼接
		if(!empty($currentClient['khaa32']) && !empty($currentClient['khaa33'])){
			$currentClient['gonghao'] = $currentClient['khaa32'].':'.$currentClient['khaa33'];
		}
		if(empty($currentClient)){
			return array('res' => 'error','msg' => '获取用户详情失败');
		}
		$DetailsAll=array($currentClient,$GetOrder);
		return $DetailsAll;
	}*/
	/**
	 * @desc 修改新增客户资料
	 * @param string $clientNo 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-11-06
	 */
	public function updateClientData($clientNo,$clientInfo,$addrInfo){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'客户资料不能为空');
		}
		//查看是否修改过归属工号
		$dqghid = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$clientNo),array('khaa32'));
		if ($clientInfo['khaa32']!=$dqghid['khaa32']) {
	        return array('res' => 'error','msg' => '不能修改归属工号');
	    }
		$addrInfo['khab01'] = $clientInfo['khaa02'] = $clientNo;
		//获取省市区名称
		$province = approvinceDAO::getInstance()->findByAttributes(array('pid'=>$addrInfo['provinceid']),array('pname'));
		$city = appCityDAO::getInstance()->findByAttributes(array('cid'=>$addrInfo['cityid']),array('cname'));
		$area = appAreaDAO::getInstance()->findByAttributes(array('aid'=>$addrInfo['areaid']),array('aname'));
		//拼接联系地址
		$addrInfo['khab03'] = $clientInfo['khaa12'] = $province['pname'].','.$city['cname'].','.$area['aname'].','.$addrInfo['deaddress']; 

		//释放无用变量
		unset($addrInfo['provinceid']);
		unset($addrInfo['cityid']);
		unset($addrInfo['areaid']);
		unset($addrInfo['deaddress']);
		if(!empty($addrInfo['khab03'])){
			//修改客户表里面的地址
			$updateResult = khaaDAO::getInstance()->update(array('khaa02'=>$clientNo),$clientInfo);
			$addrRes = khabDAO::getInstance()->update(array('khab01'=>$clientNo),$addrInfo);
		}
		return array('res' => 'success','msg' => '修改成功');
	}

	/**
	 * @desc 删除客户资料
	 * @param string $clientNo 客户编号
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-10-30
	 * @modify  huyan   2015-12-01  删除条件 删除内容
	 */
	public function deleteClientData($clientNo){
		//查询该客户有没有订单
		$OrderInquiryResult = khaaDAO::getInstance()->getOrderInq($clientNo);
		if (!empty($OrderInquiryResult)) {
			return array('res' => 'error','msg' => '该客户还有未交易成功的订单,不能删除');
		}
		if (empty($OrderInquiryResult)) {
			//删除客户资料  删除客户地址  删除客户跟进记录、删除客户订单
			$deleteResult = khaaDAO::getInstance()->delete(array('khaa02'=>$clientNo));
			$deleteAddr=khabDAO::getInstance()->delete(array('khab01'=>$clientNo));
			$deleteFollowRecord=khaeDAO::getInstance()->delete(array('khae01'=>$clientNo));
			$OrderDetailsId = xsaaDAO::getInstance()->findByAttributes(array('xsab02'=>$clientNo),array('xsab01'));
			$deleteCustomerOrder=xsaaDAO::getInstance()->delete(array('xsaa02'=>$clientNo));
			$deleteCustomerOrderDetails=xsabDAO::getInstance()->delete(array('xsab01'=>$OrderDetailsId['xsab01']));

			return array('res' => 'success','msg' => '删除成功');
		}
		return array('res' => 'error','msg' => '删除失败');
	}

	/**
	 * @desc 系统设置->数据清理->删除客户资料
	 * @author huyan
	 * @date 2016-02-18
	 */
	public function DelCustomerClient($CondList){
		//查询要删除的客户资料
		$result = khaaDAO::getInstance()->getCustomerToBeDel($CondList);
		if (empty($result)){
			return array('res' => 'error','msg' => '没有查询到符合条件的客户资料');
		}
		if (!empty($result)){
			$ddidArr = array();
		    foreach($result as $value){
			    $ddidArr[] = $value['khaa02'];
		    }
		    $orderNum = count($ddidArr);
			for($i = 0;$i < $orderNum;$i++){
				//删除客户资料  删除客户地址  删除客户跟进记录
			    $deleteResult = khaaDAO::getInstance()->delete(array('khaa02'=>$ddidArr[$i]));
			    $deleteAddr=khabDAO::getInstance()->delete(array('khab01'=>$ddidArr[$i]));
			    $deleteFollowRecord=khaeDAO::getInstance()->delete(array('khae01'=>$ddidArr[$i]));
			}
			return array('res' => 'success','msg' => '删除成功');
		}
	}

	/**
	 * @desc 获取查询客户资料列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @param int $searchtype 搜索类型
	 * @param string $keyword 搜索关键字
	 * @return  array $result 收藏列表信息
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public function searchClientData($page,$psize,$searchType,$keyword){
		$result = array();
		$clientList = khaaDAO::getInstance()->getClientData($page,$psize,$searchType,$keyword);
		//判断是否查询到有数据
		if(!empty($clientList['info']) && is_array($clientList['info'])){
			$result['result'] = 'success';
			$result['list'] = $clientList['info'];
			$result['count'] = $clientList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;	
	}

	/**
	 * @desc 获取我的客户列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-11-04
	 */
	public function GetSuborClient($page,$psize){
		$addrStr = '';
		$addrArr =array();
		$result = array();  //获取列表数据的结果
		$clientList = khaaDAO::getInstance()->GetSuborClient($page,$psize);
		//判断是否查询到有数据
		if(!empty($clientList['info']) && is_array($clientList['info'])){
			$result['result'] = 'success';
			$result['list'] = $clientList['info'];
			$result['count'] = $clientList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 合并客户资料查询客户 
	 * @param int $searchtype 搜索类型
	 * @param string $keyword 搜索关键字
	 * @return  array $result 列表信息
	 * @author huyan
	 * @date 2015-11-17
	 */
	public function getCustomer($searchType,$keyword,$clientno){
		$result = array();
		$result = khaaDAO::getInstance()->getCustomer($searchType,$keyword,$clientno);
		/*if (empty($result)) {
			
		}*/
		//判断是否查询到有数据
		return $result;	
	}

	/**
	 * @desc 提交合并客户资料
	 * @param string $clientNo 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-11-18
	 */
	public function CommitMerger($clientNo,$clientInfo,$searchType,$keyword,$retaintype,$khzl1,$khzl2){
		$result = array();
		$folResult= array();
		$khzl1Arr = explode(',',$khzl1);
		$khzl2Arr = explode(',',$khzl2);
		$khzl1Client = $khzl1Arr[0];//客户1编号
		$khzl2Client = $khzl2Arr[0];//客户2编号
		$khzl1Arrkhxm = $khzl1Arr[1];
		$khzl2Arrkhxm = $khzl2Arr[1];
		if ($clientNo == $khzl2Client) {
			return array('res'=>'error','msg'=>'相同客户不能合并');
		}
		//根据客户id查询到要合并的客户订单
		$OrderResult = khaaDAO::getInstance()->getComitMerger($clientNo,$searchType,$keyword,$khzl1Client,$khzl2Client,$retaintype);
		if (!empty($OrderResult)){
			if ($retaintype==1) {
				//修改订单表里面的客户id为当前客户的id
			     $result = xsaaDAO::getInstance()->update(array('xsaa04'=>$khzl2Client),array('xsaa04'=>$clientNo,'xsaa05'=>$khzl1Arrkhxm));
			}
			if ($retaintype==2) {
				 $result = xsaaDAO::getInstance()->update(array('xsaa04'=>$khzl1Client),array('xsaa04'=>$khzl2Client,'xsaa05'=>$khzl2Arrkhxm));
			}
		}
		//获取要合并的客户的跟进记录
		$folResult = khaeDAO::getInstance()->CombinedFollow($clientNo,$searchType,$keyword,$khzl1Client,$khzl2Client,$retaintype);
		if (!empty($folResult)) {
			if ($retaintype==1) {
				//保留客户1的资料
				$folResult = khaeDAO::getInstance()->update(array('khae01'=>$khzl2Client),array('khae01'=>$clientNo));
			}
			if ($retaintype==2) {
				//保留客户2的资料
				$folResult = khaeDAO::getInstance()->update(array('khae01'=>$khzl1Client),array('khae01'=>$khzl2Client));
			}
		}
		//获取要合并的客户地址
		//$AddressResult = khabDAO::getInstance()->getAddress($clientNo,$searchType,$keyword,$khzl1Client,$khzl2Client,$retaintype);
		if ($retaintype==1) {
			//保留客户1的资料
			$deleteResult = khaaDAO::getInstance()->delete(array('khaa02'=>$khzl2Client));
		}
		if ($retaintype==2) {
			//保留客户2的资料
			$deleteResult = khaaDAO::getInstance()->delete(array('khaa02'=>$khzl1Client));
		}
		//插入客户跟进记录
		$a='与';
		$b='合并资料';
		$followInfo = array();
		if ($retaintype==1) {
			$followInfo['khae01'] = $khzl1Client;
			$followInfo['khae03'] = $a.$khzl2Client.$b; //主题
		}
		if ($retaintype==2) {
			$followInfo['khae01'] = $khzl2Client;
			$followInfo['khae03'] = $a.$khzl1Client.$b; //主题
		}
		$followInfo['khae02'] ='合并资料';//内容 
		$followInfo['khae04'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['khae05'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['khae06'] = Yii::app()->session['account']; //安排人工号
		$followInfo['khae07'] = Yii::app()->session['name']; //安排人姓名
		$followInfo['khae08'] = date('Y-m-d H:i'); //记录时间
		$followInfo['khae09'] = date('Y-m-d H:i'); //待办时间
		$followResult = khaeDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'客户跟进记录有误');
		}
		if (empty($khzl2)|| $khzl2Arr[0] == '没有查询到该客户') {
			return array('res'=>'error','msg'=>'请先查询要合并的客户资料');
		}
		return array('res' => 'success','msg' => '合并成功');
	}


	/**
	 * @desc 客户详情转客户资料
	 * @param string $clientNo 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-11-06
	 */
	public function TurnCustomer($clientno,$clientInfo,$addrInfo){

		//查看是否修改过归属工号
		$dqghid = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$clientno),array('khaa32'));
		if ($clientInfo['khaa32']==$dqghid['khaa32']) {
	        return array('res' => 'error','msg' => '相同工号不能互相转');
	    }
	    //修改客户资料里面的归属工号
		$result = khaaDAO::getInstance()->update(array('khaa02'=>$clientno),$clientInfo);
		//插入客户跟进记录
		$followInfo = array();
		$followInfo['khae01'] = $clientno; //跟进记录客户id
		$followInfo['khae02'] = '转进客户'; //主题
		$followInfo['khae03'] ='转进客户';//内容 
		$followInfo['khae04'] = $clientInfo['khaa32'];//跟进人工号
		$followInfo['khae05'] = $clientInfo['khaa33']; //跟进人姓名
		$followInfo['khae06'] = Yii::app()->session['account']; //安排人工号
		$followInfo['khae07'] = Yii::app()->session['name']; //安排人姓名
		$followInfo['khae08'] = date('Y-m-d H:i'); //记录时间
		$followInfo['khae09'] = date('Y-m-d H:i'); //待办时间
		$followResult = khaeDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'客户跟进记录有误');
		}
		return array('res' => 'success','msg' => '客户已转出');
	}
	/**
	 * @desc添加客户资料查询
	 * @param string $clientNo 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function QueryUser($khname){
		$result = array();
		$result = khaaDAO::getInstance()->QueryUser($khname);
		if (!empty($result)){
			return array('res'=>'UserPresence','msg'=>'客户姓名已存在，是否继续保存？');
		}
		if (empty($result)){
			return array('res'=>'Presence','msg'=>'继续');
		}
		//判断是否查询到有数据
		return $result;	
	}


	/**
	 * @desc 单个/批量转客户
	 * @param string $orderno 投诉客户编号
	 * @param string $orderInfo 投诉信息
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-09
	 */
	public function getTurnOutCustomer($orderno,$clientInfo){
		$orderNum = count($orderno); //确认转出的客户数
		for($i = 0;$i < $orderNum;$i++){
			$result = khaaDAO::getInstance()->update(array('khaa02'=>$orderno[$i]),$clientInfo);
		}
		if(empty($result)){
			return array('res' => 'error','msg' => '转出失败');
		}
		//插入客户跟进记录
		$followInfo = array();
		for($i = 0;$i < $orderNum;$i++){
		    $followInfo['khae01'] = $orderno[$i]; //跟进记录客户id
		    $followInfo['khae02'] = '转进客户'; //主题
		    $followInfo['khae03'] ='转进客户';//内容 
		    $followInfo['khae04'] = $clientInfo['khaa32'];//跟进人工号
		    $followInfo['khae05'] = $clientInfo['khaa33']; //跟进人姓名
		    $followInfo['khae06'] = Yii::app()->session['account']; //安排人工号
		    $followInfo['khae07'] = Yii::app()->session['name']; //安排人姓名
		    $followInfo['khae08'] = date('Y-m-d H:i'); //记录时间
		    $followInfo['khae09'] = date('Y-m-d H:i'); //待办时间
		    $followResult = khaeDAO::getInstance()->insert($followInfo,true);
		    if(empty($followResult)){
		    	return array('res'=>'error','msg'=>'客户跟进记录有误');
		    }
	    }
	    return array('res' => 'success','msg' => '客户已转出');	
	}

	/**
	 * @desc 分配客户资料
	 * @return json $result 操作的结果
	 * @author huyan
	 * @date 2016-04-01
	 */
	public function DistributionCustomer($orderno,$clientInfo){
		//print_r($orderno);die;
		$orderNum = count($orderno); //确认转出的客户数
		for($i = 0;$i < $orderNum;$i++){
			$res = khaaDAO::getInstance()->findByAttributes(array('khaa02'=>$orderno[$i]),array('khaa32','khaa33'));
			$clientInfo['khaa48']=$res['khaa32'].':'.$res['khaa33'];
			$result = khaaDAO::getInstance()->update(array('khaa02'=>$orderno[$i]),$clientInfo);
		}

		if(empty($result)){
			return array('res' => 'error','msg' => '分配失败');
		}
	    return array('res' => 'success','msg' => '分配成功');	
	}

	/**
	 * @desc 系统设置->数据清理->数据资料转移
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function DataTransfer($khgh1,$khgh2){
		$kh1 = array('username'=>$khgh1);
		$kh2 = array('username'=>$khgh2);
		//判断工号1是否存在
		$Customer1 = rylistDAO::getInstance()->isExists($kh1);
		$Customer2 = rylistDAO::getInstance()->isExists($kh2);
		if ($Customer1!=1) {
			return array('res'=>'error','msg'=>'工号1不存在');
		}
		if ($Customer2!=1) {
			return array('res'=>'error','msg'=>'工号2不存在');
		}
		if($Customer1&&$Customer2){
			//根据工号查找登录姓名
			$Transfername = rylistDAO::getInstance()->getTransfername($khgh2);
			$pjfh=':';
			$gsgh=$khgh1.$pjfh.$Transfername['personname'];
		    //查询要转移的跟进记录
		    $FollowTra= khaeDAO::getInstance()->getFollowTransfer($khgh1);
		    $clientInfo = array();
		    $clientInfo['khae04']=$khgh2;
		    $clientInfo['khae05']=$Transfername['personname'];
		   /* if (empty($FollowTra)){
			    return array('res' => 'error','msg' => '没有查询到符合条件的跟进记录');
		    }*/
		    if (!empty($FollowTra)){
			    $ddidArr = array();
		        foreach($FollowTra as $value){
			        $ddidArr[] = $value['khae04'];
		        }
		        $orderNum = count($ddidArr);
			    for($i = 0;$i < $orderNum;$i++){
			        $deleteResult = khaeDAO::getInstance()->update(array('khae04'=>$ddidArr[$i]),$clientInfo);
			    }
		    }

		    //查询要转移的客户资料
		    $CustomerTransfer= khaaDAO::getInstance()->getCustomerTransfer($khgh1);
		    //根据工号查找客户表归属姓名
			//$TraCustomername = khaaDAO::getInstance()->getCustomername($khgh2);
		    $CustomerInfo = array();
		    $CustomerInfo['khaa32']=$khgh2;
		    $CustomerInfo['khaa33']=$Transfername['personname'];
		   /* if (empty($CustomerTransfer)){
			    return array('res' => 'error','msg' => '没有查询到符合条件的客户资料');
		    }*/
		    if (!empty($CustomerTransfer)){
			    $ddidArr = array();
		        foreach($CustomerTransfer as $value){
			        $ddidArr[] = $value['khaa32'];
		        }
		        $orderNum = count($ddidArr);
			    for($i = 0;$i < $orderNum;$i++){
			        $deleteResult = khaaDAO::getInstance()->update(array('khaa32'=>$ddidArr[$i]),$CustomerInfo);
			    }
		    }
		    return array('res'=>'success','msg'=>'数据资料转移成功');
		}
	}

	/**
	 * @desc 获取客户订单记录
	 * @param string $clientno 客户编号
	 * @return array $result 客户跟进记录信息
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function GetOrderRecord($clientno,$page,$psize){
		$result = khaaDAO::getInstance()->GetOrderRecord($clientno,$page,$psize);
		if(empty($result)){
			return array('res'=>'error','msg'=>'获取客户订单记录失败');
		}
		return $result;
	}

	/**
	 * @desc 获取客户详情订单号选项
	 * @param string $clientno 客户编号
	 * @return array $result 客户跟进记录信息
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function getOrderOptions($clientno){
		$gonghaoArr = array();
		$WorkNumList = khaaDAO::getInstance()->getOrderOptions($clientno);
		foreach($WorkNumList as $value){
			$gonghaoArr[] = $value['xsaa02'];
		}
		//判断是否查询到有数据
		if(empty($WorkNumList) || empty($gonghaoArr)){
			//return array('res'=>'error','msg'=>'没有订单');
		}
		return $gonghaoArr;
	}

	/**
	 * @desc 获取一个客户信息，用于excel上传
	 * @return array $result 客户信息
	 * @author DengShaocong
	 * @date 2016-01-04
	 */
	public function getExcelClient(){
		$result = khaaDAO::getInstance()->getExcelClient();
		return $result;
	}


	/**
	 * @desc 获取所有客户id
	 * @return array $result 
	 * @author huyan
	 * @date 2016-01-07
	 */
	public function getCustomerNumberOptions($JobNuber){
		$gonghaoArr = array();
		$WorkNumList = khaaDAO::getInstance()->getCustomerNumberOptions($JobNuber);
		foreach($WorkNumList as $value){
			$gonghaoArr[] = $value['khaa02'];
		}
		//判断是否查询到有数据
		if(empty($WorkNumList) || empty($gonghaoArr)){
			//return array('res'=>'error','msg'=>'获取投诉类型信息失败');
		}
		return $gonghaoArr;
	}

	/**
	 * @desc 获取客户id  姓名
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-01-07
	 */
	public function getNameAndId($page,$psize,$JobNuber){
		$result = array();  //获取列表数据的结果
		$clientList = khaaDAO::getInstance()->getNameAndId($page,$psize,$JobNuber);
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
	 * @desc 添加投诉客户id 姓名查询
	 * @author huyan
	 * @date 2016-01-07
	 */
	public function QueryNameOrdId($page,$psize,$searchtype,$keyword,$JobNuber){
		$clientList = khaaDAO::getInstance()->QueryNameOrdId($page,$psize,$searchtype,$keyword,$JobNuber);
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
	 * @desc 根据呼入号码来获取客户资料
	 * @param string $callerId 呼入号码
	 * @return array $currentClient 当前客户信息
	 * @author huyan
	 * @date 2015-12-24
	 */
	public function getClientDetailByNumber($callerId){
		if(empty($callerId)){
			return array('res' => 'error','msg' => '获取客户资料失败');
		}
		//获取客户资料信息
		$clientDetail = khaaDAO::getInstance()->getClientDetailByNumber($callerId);
		if(empty($clientDetail)){
			return array('res' => 'new','msg' => '请注意：这是一个新的客户来电！！');
		}
		return $clientDetail;
	}

	/**
	 * @desc 通过Excel添加用户
	 * @return array $clientInfo 客户信息
	 * @author DengShaocong
	 * @date 2016-01-27
	 */
	public function addFromExcel($clientInfo){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'添加出错');
		}
		$Customerihsmddh = khaiDAO::getInstance()->isExists(array('khai03'=>$clientInfo['khaa06']));
		//黑名单中存在的手机号不允许保存客户
		if($Customerihsmddh){
			return array('res'=>'hmd','msg'=>'hmd');
		}
		$CustomerPhone = khaaDAO::getInstance()->isExists(array('khaa06'=>$clientInfo['khaa06']));
		//添加客户时不能有重复的手机号
		if($CustomerPhone){
			return array('res'=>'same','msg'=>'same');
		}
		$result = khaaDAO::getInstance()->insert($clientInfo,true);
		if(empty($result)){
			return array('res'=>'error','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

}

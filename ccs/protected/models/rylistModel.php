<?php
/**
 * @desc 人员登录表相关操作类
 * @author DengShaocong
 * @date 2015-10-30
 */
class rylistModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return rylistModel
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 登录
	 * @param string $username 工号
	 * @param string $psd 密码
	 * @return array $result
	 * @author DengShaoocng
	 * @date 2015-10-27
	 */
	public function login($username,$psd){
		$p = rylistDAO::getInstance()->findByAttributes(array('username' => $username));
		$result = array();
		if(empty($p)){
			$result['res'] = 'false';
			$result['mes'] = '用户不存在';
		}else if($psd!=$p['pwd']){
			$result['res'] = 'false';
			$result['mes'] = '密码错误,请重新输入';
		}else{
			if($p['enabled'] == "F"){
				$result['res'] = 'false';
				$result['mes'] = '你选择的用户已被禁用，请查证';
			}else if($p['isonline'] == "T"){
				$result['res'] = 'false';
				$result['mes'] = '你选择的用户已登录，请查证';
			}else{
				$result['res'] = 'success';
				$result['list'] = $p;
				$result['mes'] = '成功';
			}
		} 
		return $result;
	}
	/**
	 * @desc 修改登录状态（在线）
	 * @param string $id 员工ID
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2015-11-18
	 */
	public function online($id){
		$result = array();
		if(empty($id)){
			$result['res'] = 'false';
			$result['mes'] = '工号有误';
		}
		$ryInfo['isonline'] = "T";
		$o = rylistDAO::getInstance()->updateByPk($id,$ryInfo);
		if(empty($o)){
			$result['res'] = 'false';
			$result['mes'] = '登录有误';
		}else{
			$result['res'] = 'success';
			$result['mes'] = '登录成功';
		}
		return $result;
	}
	/**
	 * @desc 修改登录状态（离线）
	 * @param string $id 员工ID
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2015-11-18
	 */
	public function offline($id){
		$result = array();
		if(empty($id)){
			$result['res'] = 'false';
			$result['mes'] = '工号有误';
		}
		$ryInfo['isonline'] = "F";
		$o = rylistDAO::getInstance()->updateByPk($id,$ryInfo);
		if(empty($o)){
			$result['res'] = 'false';
			$result['mes'] = '登录有误';
		}else{
			$result['res'] = 'success';
			$result['mes'] = '登录成功';
		}
		return $result;
	}

	/**
	 * @desc 添加员工工号
	 * @param array $ghInfo 考核项目资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public function addGh($ghInfo){
		//var_dump($ygkhInfo);	
		if(empty($ghInfo)){
			return array('res'=>'error','mes'=>'相关信息不完整，添加失败');
		}
		$result = rylistDAO::getInstance()->insert($ghInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}
	/**
	 * @desc 获取员工工号信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getAllGh($page,$psize){
		$result = array();  //获取列表数据的结果
		$clientList = rylistDAO::getInstance()->getAllGh($page,$psize);
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
	 * @desc 根据主键删除一个员工信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function deleteGh($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除错误');
		}
		$result = rylistDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}
	/**
	 * @desc 根据主键查找一个员工信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getSingleGh($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'错误');
		}
		$result = rylistDAO::getInstance()->findByAttributes(array('id' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个员工信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function updateGh($id,$ghInfo){
		if(empty($id) || empty($ghInfo)){
			return array('res'=>'error','mes'=>'修改错误');
		}
		$result = rylistDAO::getInstance()->updateByPk($id,$ghInfo);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}
	/**
	 * @desc 根据条件查找员工信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param int $username 工号
	 * @param int $personname 姓名
	 * @param int $qxjsid 权限角色ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-1
	 * @modify WuJunhua 2016-02-04 增加工号列表的导出excel功能
	 */
	public function getRylistByCond($page,$psize,$ryInfo,$sign){
		$gh = rylistDAO::getInstance()->getRylistByCond($page,$psize,$ryInfo);

		if($sign == 1){
			//导出工号列表excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[19]); //导出工号列表excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$gh = rylistDAO::getInstance()->getRylistByCond($page,$psize,$ryInfo,$selectColumnStr);
				}
			}
			
			if(!empty($gh['info']) && is_array($gh['info'])){
				$data = $gh['info'];
				$fileName = 'jx';  
				$tableName = '工号列表';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);
				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['count'] = $gh['count'];
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
		if(!empty($gh) && is_array($gh)){
			$result['result'] = 'success';
			$result['list'] = $gh['info'];
			$result['count'] = $gh['count'];
			//顺序、倒序需要返回页码和条数
			$result['page'] = $page;	
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 获取员工工号列表信息
	 * @return array $result 员工工号信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getRylistForSelect(){
		$gh = rylistDAO::getInstance()->getRylistForSelect();
		//判断是否查询到有数据
		if(!empty($gh) && is_array($gh)){
			$result['result'] = 'success';
			$result['list'] = $gh['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
	/**
	 * @desc 根据员工ID删除一个员工
	 * @param int $page 页码
	 * @param int $id 员工ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function deleteRylist($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除错误');
		}
		$rylist = rylistDAO::getInstance()->findByAttributes(array('id'=>$id));

		contactsetDAO::getInstance()->delete(array('username'=>$rylist['username'],'personname'=>$rylist['personname']));

		$result = rylistDAO::getInstance()->deleteByPk($id);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}
	/**
	 * @desc 根据员工ID获取一个员工信息
	 * @param int $page 页码
	 * @param int $id 员工ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function getSingleRylist($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'错误');
		}
		$result = rylistDAO::getInstance()->findByAttributes(array('id' => $id));
		return $result;
	}
	/**
	 * @desc 根据员工ID修改一个员工信息
	 * @param int $id 员工ID
	 * @param array $ghInfo 员工信息
	 * @param array $contact 通讯录信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 * @modify 2016-04-01 修改上级时  修改客户表里面的上级工号
	 */
	public function updateRylist($id,$ghInfo,$contact,$hqgh){
		if(empty($id) || empty($ghInfo)){
			return array('res'=>'error','mes'=>'信息出错，修改错误');
		}
		if (!empty($ghInfo['higherlevel'])) {
			//根据id查找工号
			$hqsjgh = rylistDAO::getInstance()->findByAttributes(array('id'=>$ghInfo['higherlevel']),array('username'));
			$clientInfo = array();
			$clientInfo['khaa46'] = $hqsjgh['username'];
			//修改客户表上级工号
		    $updateResult = khaaDAO::getInstance()->update(array('khaa32'=>$hqgh),$clientInfo);
		}
		$rylist = rylistDAO::getInstance()->findByAttributes(array('id'=>$id));

		contactsetDAO::getInstance()->update(array('username'=>$rylist['username'],'personname'=>$rylist['personname']),$contact);

		$result = rylistDAO::getInstance()->updateByPk($id,$ghInfo);
	
		if(empty($result)){
			return array('res'=>'false','mes'=>'操作出错，修改失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}

	/**
	 * @desc 获取所有工号信息
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-11-16
	 */
	public function getAllWorkNumber(){
		$gonghaoArr = array();
		$WorkNumList = rylistDAO::getInstance()->getAllWorkNumber();
		foreach($WorkNumList as $value){
			$gonghaoArr[] = $value['username'].':'.$value['personname'];
		}
		//判断是否查询到有数据
		if(empty($WorkNumList) || empty($gonghaoArr)){
			return array('res'=>'error','mes'=>'获取工号信息失败');
		}
		return $gonghaoArr;
	}
	/**
	 * @desc 获取当前工号的下属工号（用于转下属客户）
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2016-03-04
	 */
	public function getSuborWorkNumber($JobNuber){
		$gonghaoArr = array();
		//查找当前工号的id
		$dqghid = rylistDAO::getInstance()->findByAttributes(array('username'=>$JobNuber),array('id'));
		$sjghid=$dqghid['id'];
		$WorkNumList = rylistDAO::getInstance()->getAllSuborWorkNumber($sjghid);
		foreach($WorkNumList as $value){
			$gonghaoArr[] = $value['username'].':'.$value['personname'];
		}
		//判断是否查询到有数据
		if(empty($WorkNumList) || empty($gonghaoArr)){
			/*return array('res'=>'error','mes'=>'获取工号信息失败');*/
		}
		return $gonghaoArr;
	}

	/**
	 * @desc 查找工号是否存在
	 * @param string $username 工号
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function checkExist($username){
		$result = rylistDAO::getInstance()->findByAttributes(array('username' => $username));
		if(empty($result)){
			return array('res' => 'can');
		}
		return $result;
	}

	/**
	 * @desc 根据权限角色编号查找工号信息
	 * @param string $groupbh 权限角色编号
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function getRylistByGroupbh($groupbh){
		if(empty($groupbh)){
			return array('res'=>'error','mes'=>'异常');
		}
		$gh = rylistDAO::getInstance()->getRylistByGroupbh($groupbh);
		//判断是否查询到有数据
		if(!empty($gh) && is_array($gh)){
			$result['result'] = 'success';
			$result['list'] = $gh['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 根据部门编号查找工号信息
	 * @param string $dept 部门名称
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function getRylistByBm($dept){
		if(empty($deptid)){
			return array('res'=>'error','mes'=>'异常');
		}
		$gh = rylistDAO::getInstance()->getRylistByBm($dept);
		//判断是否查询到有数据
		if(!empty($gh) && is_array($gh)){
			$result['result'] = 'success';
			$result['list'] = $gh['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 获取工号姓名
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-11-16
	 * modify huyan 2015-12-30 分页
	 */
	public function getNamNumber($cond,$page,$psize){
		$result = array();  //获取列表数据的结果
		$clientList = rylistDAO::getInstance()->getNamNumber($cond,$page,$psize);
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
	 * @desc 查询工号或姓名
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function getUserNumber($searchtype,$keyword){
		$UserNumberList = rylistDAO::getInstance()->getUserNumber($searchtype,$keyword);
		//判断是否查询到有数据
		/*if(empty($UserNumberList)){
			return array('res'=>'error','mes'=>'没有查到该用户');
		}*/
		return $UserNumberList;
	}

	/**
	 * @desc 根据员工ID修改一个员工信息
	 * @param int $id 员工ID
	 * @return string $oldpwd 原始密码
	 * @return string $newpwd 新密码
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function updatePwd($id,$oldpwd,$newpwd){
		$result = array();
		if(empty($id) || empty($oldpwd) || empty($newpwd)){
			return array('res'=>'error','mes'=>'出现异常，请联系管理员');
		}
		$ry = rylistDAO::getInstance()->findByAttributes(array('id' => $id));
		if(empty($ry)){
			return array('res'=>'error','mes'=>'出现异常，请联系管理员');
		}
		if($ry['pwd'] == $oldpwd){
			$a = rylistDAO::getInstance()->updateByPk($id,array('pwd' => $newpwd));
			if(empty($a)){
				$result['res'] = 'false';
				$result['mes'] = '新旧密码不可相同！';
			}else{
				$result['res'] = 'success';
				$result['mes'] = '修改成功！';
			}
		}else{
			$result['res'] = 'false';
			$result['mes'] = '原密码错误,请重新输入！';
		}
		return $result;
	}

	/**
	 * @desc 注销退出时，修改最后登录时间
	 * @param int $id 员工ID
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function updateLoginTime($id){
		$nowTime = date('Y-m-d H:i:s'); 
		if(empty($id)){
			return array('res'=>'error','mes'=>'出现异常，请联系管理员');
		}
		$update = rylistDAO::getInstance()->updateByPk($id,array('loginTime' => $nowTime,'opetime' => $nowTime));
	}

	/**
	 * @desc 登录时，修改登录IP
	 * @param int $id 员工ID
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function updateLoginIP($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'出现异常，请联系管理员');
		}
		$update = rylistDAO::getInstance()->updateByPk($id,array('loginIp' => $_SERVER['REMOTE_ADDR']));
	}

	/**
	 * @desc 获取所有工号(不处理)
	 * @return array $result 列表信息
	 * @author WuJunhua
	 * @date 2015-12-07
	 */
	public function getWorkNumber(){
		$WorkNumList = rylistDAO::getInstance()->getAllWorkNumber();
		//判断是否查询到有数据
		if(empty($WorkNumList)){
			return array('res'=>'error','mes'=>'获取工号信息失败');
		}
		return $WorkNumList;
	}

	/**
	 * @desc 下单分业绩时根据工号id获取工号信息
	 * @param int $workId 工号id
	 * @return array $rylist 结果信息
	 * @author WuJunhua
	 * @date 2015-12-07
	 */
	public function getNumberList($workId){
		if(empty($workId)){
			return array('res'=>'error','mes'=>'操作有误');
		}
		$result = rylistDAO::getInstance()->findByAttributes(array('id' => $workId),array('id','username','personname'));
		if(empty($result)){
			return array('res'=>'error','mes'=>'操作有误，获取工号信息失败');
		}
		$rylist = $result['username'].':'.$result['personname'];
		return $rylist;
	}

	/**
	 * @desc 群发时获取工号
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-22
	 */
	public function getnameAndNumber(){
		$gonghaoArr = array();
		$WorkNumList = rylistDAO::getInstance()->getnameAndNumber();
		//判断是否查询到有数据
		if(empty($WorkNumList)){
			return array('res'=>'error','mes'=>'获取工号信息失败');
		}
		return $WorkNumList;
	}

	/**
	 * @desc 获取采购文员列表
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-01-12
	 */
	public function getCgwyList(){
		$result = array();
		$list = rylistDAO::getInstance()->getCgwyList();
		if(!empty($list) && is_array($list)){
			$result['res'] = 'success';
			$result['list'] = $list;
		}else{
			$result['res'] = 'error';
			$result['list'] = array();
		}
		return $result;
	}

	/**
	 * @desc 获取采购专员列表
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-01-12
	 */
	public function getCgzyList(){
		$result = array();
		$list = rylistDAO::getInstance()->getCgzyList();
		if(!empty($list) && is_array($list)){
			$result['res'] = 'success';
			$result['list'] = $list;
		}else{
			$result['res'] = 'error';
			$result['list'] = array();
		}
		return $result;
	}

	/**
	 * @desc 检查分机号是否重复
	 * @param string $fenji 分机号
	 * @author DengShaocong
	 * @date 2016-01-15
	 */
	public function checkFenji($fenji){
		$list = rylistDAO::getInstance()->findByAttributes(array('fenji'=>$fenji));
		if(empty($list)){
			return array('res'=>'can');
		}
		return $list;
	}

	/**
	 * @desc 获取员工业绩统计报表——获取员工信息
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-02-19
	 */
	public function getYgyjtjbbByCond($cond,$sign){
		$result = array();
		//获取员工信息
		if($cond['dept'] != ''){
			$rylist = rylistDAO::getInstance()->findAllByAttributes(array('department'=>$cond['dept']));
		}else{
			$rylist = rylistDAO::getInstance()->selectAllByNothing();
		}
		$result['result'] = 'success';
		$result['list'] = array();

		$result['ryNum'] = count($rylist);//总员工数
		//用于页面回显
		$result['orderBeginDate'] = $cond['orderBeginDate'];
		$result['orderEndDate'] = $cond['orderEndDate'];
		$result['accBeginDate'] = $cond['accBeginDate'];
		$result['accEndDate'] = $cond['accEndDate'];
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

		//根据员工信息获取不同的统计信息
		for($i = 0; $i < count($rylist); $i ++) {
			$cond['personname'] = $rylist[$i]['personname'];
			$demoList = $this->getYgyjtjbbDetails($cond);
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
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[21]); //导出员工业绩统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
				$reportList = []; //报表显示信息
				foreach ($result['list'] as $key => $value) {
					$reportList[$key]['personname'] = $value['personname'];
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
				$tableName = '员工业绩统计报表';
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
	 * @desc 获取员工业绩统计报表——获取报表内容（订单）
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-02-19
	 */
	public function getYgyjtjbbDetails($cond){
		$result['peopleNum'] = rylistDAO::getInstance()->getYgyjtjbbByCondRS($cond)['num'];
		$xdList = rylistDAO::getInstance()->getYgyjtjbbByCond($cond,"'已确认','待发货','已发货','拒收','交易成功'");//下单信息
		$sdList = rylistDAO::getInstance()->getYgyjtjbbByCond($cond,"'待发货','已发货','拒收','交易成功'");//审单信息
		$fhList = rylistDAO::getInstance()->getYgyjtjbbByCond($cond,"'已发货','拒收','交易成功'");//发货信息
		$jsList = rylistDAO::getInstance()->getYgyjtjbbByCond($cond,"'拒收'");//拒收信息
		$qsList = rylistDAO::getInstance()->getYgyjtjbbByCond($cond,"'交易成功'");//签收信息

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
		$result['personname'] = $cond['personname'];		
		return $result;
	}

	/**
	 * @desc 检测并把在线状态改为离线的状态(js定时器每1分钟检测一次)
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-02-25
	 */
	public function checkAndChangeStatus($account){
		$nowTime = date('Y-m-d H:i:s'); //当前时间
		$updateResult = rylistDAO::getInstance()->update(array('username' => $account),array('opetime' => $nowTime,'loginTime' => $nowTime));
		if(empty($updateResult)){
			return array('result' => 'error');
		}
		$lineArr = []; //是否在线状态
		$lineArr['online'] = 'T';
		$lineArr['offline'] = 'F';
		$result = rylistDAO::getInstance()->updateLineStatus($nowTime,$lineArr);
		if(empty($result)){
			return array('result' => 'error');
		}
		return array('result' => 'success');
	}

	/**
	 * @desc 强制注销
	 * @param int $sign 标识
	 * @param array $userInfo 用户信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-02-25
	 */
	public function forceLogoff($sign,$userInfo){
		$nowTime = date('Y-m-d H:i:s'); //当前时间
		$ryInfo = [];
		$ryInfo['opetime'] = $ryInfo['loginTime'] = $nowTime;
		$ryInfo['isonline'] = "F";
		$conditionFenji = array('fenji' => $userInfo['fenji']);
    	$testFenji = rylistDAO::getInstance()->isExists($conditionFenji);
		if(empty($testFenji)){
			return array('res'=>'tips','msg'=>'*该分机号不存在于系统当中');
		}
		if($sign == 2){
			$conditionUsername = array('username' => $userInfo['username']);
	    	$testUsername = rylistDAO::getInstance()->isExists($conditionUsername);
			if(empty($testUsername)){
				return array('res'=>'tips','msg'=>'*该用户名不存在于系统当中');
			}
			$findResult = rylistDAO::getInstance()->findByAttributes(array('fenji' => $userInfo['fenji'],'username' => $userInfo['username']),array('username','fenji'));
			if(empty($findResult) || $findResult['username'] != $userInfo['username'] || $findResult['fenji'] != $userInfo['fenji']){
				return array('res'=>'tips','msg'=>'*分机号与用户名不匹配，请重新输入');
			}
		}

		$updateResult = rylistDAO::getInstance()->update(array('fenji' => $userInfo['fenji']),$ryInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '强制注销失败');
		}
		if($userInfo['fenji'] == Yii::app()->session['fenji']){
			Yii::app()->session->clear();
			return array('res' => 'selfSuccess','msg' => '强制注销成功');
		}
		return array('res' => 'success','msg' => '强制注销成功');
	}

	/**
	 * @desc 获取工号客户数统计报表
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getGhkhstjbbByCond($cond,$sign){
		//获取员工信息
		if($cond['dept'] != ''){
			$rylist = rylistDAO::getInstance()->findAllByAttributes(array('department'=>$cond['dept']));
		}else{
			$rylist = rylistDAO::getInstance()->selectAllByNothing();
		}

		$result['result'] = 'success';
		$result['list'] = array();
		$result['totalNum'] = 0; //总人数
		//根据员工信息获取不同的统计信息
		for($i = 0; $i < count($rylist); $i ++) {
			$cond['username'] = $rylist[$i]['username'];
			$cond['personname'] = $rylist[$i]['personname'];
			$demoList =  $this->getGhkhstjbbDetails($cond);
			$result['list'][$i] = $demoList;

			$result['totalNum'] += $demoList['num'];
		}
		//假如总人数不为零，计算比例
		if($result['totalNum'] > 0){
			$count = count($result['list']);
			for($i = 0; $i < $count; $i ++){
				$result['list'][$i]['ratio'] = sprintf('%.2f',$result['list'][$i]['num']/$result['totalNum']*100).'%';
			}
		}
		
		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[24]); //导出分组业绩统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
			}
			
			if(!empty($result['list']) && is_array($result['list'])){
				$data = $result['list'];
				$fileName = 'jx';  
				$tableName = '工号客户数统计报表';
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
	 * @desc 获取工号客户数统计信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getGhkhstjbbDetails($cond){
		$result['username'] = $cond['username'];
		$result['personname'] = $cond['personname'];
		$result['num'] = khaaDAO::getInstance()->getGhkhstjbbByCond($cond)['num'];
		$result['ratio'] = '0%';
		return $result;
	}

	/**
	 * @desc 获取员工考核统计
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getYgkhtjbbByCond($cond){
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

		//获取员工信息
		if($cond['dept'] != ''){
			$rylist = rylistDAO::getInstance()->findAllByAttributes(array('department'=>$cond['dept']));
		}else{
			$rylist = rylistDAO::getInstance()->selectAll();
		}

		$result['result'] = 'success';
		$result['list'] = array();
		$result['totalPunishTime'] = 0; //总处罚数
		$result['totalPunishScore'] = 0; //总处罚分数
		$result['totalRewardTime'] = 0; //总奖励数
		$result['totalRewardScore'] = 0; //总奖励分数
		$result['totalScore'] = 0; //总奖罚分数

		//根据员工信息获取不同的统计信息
		for($i = 0; $i < count($rylist); $i ++) {
			$cond['id'] = $rylist[$i]['id'];
			$cond['username'] = $rylist[$i]['username'];
			$cond['personname'] = $rylist[$i]['personname'];
			$demoList =  $this->getYgkhtjbbDetails($cond);
			$result['list'][$i] = $demoList;
			//各项相加
			$result['totalPunishTime'] += $demoList['punish']['num'];
			$result['totalPunishScore'] += $demoList['punish']['score'];
			$result['totalRewardTime'] += $demoList['reward']['num'];
			$result['totalRewardScore'] += $demoList['reward']['score'];
		}

		$result['totalScore'] = $result['totalPunishScore'] + $result['totalRewardScore'];

		return $result;
	}

	/**
	 * @desc 获取员工考核统计信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getYgkhtjbbDetails($cond){
		$result['username'] = $cond['username'];
		$result['personname'] = $cond['personname'];
		$result['punish'] = rylistDAO::getInstance()->getYgkhtjbbByCond($cond,'F');//惩罚信息
		$result['reward'] = rylistDAO::getInstance()->getYgkhtjbbByCond($cond,'T');//信息
		$result['totalScore'] = $result['punish']['score'] + $result['reward']['score'];
		return $result;
	}

	/**
	 * @desc 获取接线业绩报表——获取员工
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getJxyjbbByCond($cond){
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

		//获取员工信息
		if($cond['dept'] != ''){
			$rylist = rylistDAO::getInstance()->findAllByAttributes(array('department'=>$cond['dept']));
		}else{
			$rylist = rylistDAO::getInstance()->selectAllByNothing();
		}

		$result['result'] = 'success';
		$result['list'] = array();

		$result['beginDate'] = $cond['beginDate'];//
		$result['endDate'] = $cond['endDate'];//
		
		$result['ryNum'] = count($rylist);//总员工数
		$result['peopleNum'] = 0;//总客户数
		$result['xdCount'] = 0;//总下单数
		$result['xdMoney'] = 0;//总下单金额
		$result['sdCount'] = 0;//总审单数
		$result['sdMoney'] = 0;//总审单金额
		$result['qsCount'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额

		//根据员工信息获取不同的统计信息
		for($i = 0; $i < count($rylist); $i ++) {
			$cond['username'] = $rylist[$i]['username'];
			$cond['personname'] = $rylist[$i]['personname'];
			$demoList = $this->getJxyjbbDetails($cond);
			$result['list'][$i] = $demoList;

			$result['peopleNum'] += $demoList['people']['num'];
			$result['xdCount'] += $demoList['xdlist']['orders'];
			$result['xdMoney'] += $demoList['xdlist']['money'];
			$result['sdCount'] += $demoList['sdlist']['orders'];
			$result['sdMoney'] += $demoList['sdlist']['money'];
			$result['qsCount'] += $demoList['qslist']['orders'];
			$result['qsMoney'] += $demoList['qslist']['money'];
		}


		$result['totalXdRatio'] = '0%';//总成交率
		$result['totalSdRatio'] = '0%';//总审单率
		$result['totalQsRatio'] ='0%';//总签收率

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
		return $result;
	}

	/**
	 * @desc 获取接线业绩报表——获取报表信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getJxyjbbDetails($cond){
		$result['username'] = $cond['username'];
		$result['personname'] = $cond['personname'];	
		$result['people'] = rylistDAO::getInstance()->getYgyjtjbbByCondRS($cond);
		$result['xdlist'] = rylistDAO::getInstance()->getJxyjbbByCond($cond,"'已确认','待发货','已发货','拒收','交易成功'");//下单信息
		$result['sdlist'] = rylistDAO::getInstance()->getJxyjbbByCond($cond,"'待发货','已发货','拒收','交易成功'");//审单信息
		$result['qslist'] = rylistDAO::getInstance()->getJxyjbbByCond($cond,"'交易成功'");//签收信息

		$result['xdratio'] = '0%';//成交率
		$result['sdratio'] = '0%';//审单率
		$result['qsratio'] = '0%';//签收率
		//除，获取比例
		if($result['xdlist']['orders'] != 0){
			if($result['people']['num'] != 0){
				$result['xdratio'] = sprintf("%.2f",$result['sdlist']['orders']/$result['people']['num']*100) .'%';
			}
			if($result['sdlist']['orders'] != 0){
				$result['sdratio'] = sprintf("%.2f",$result['sdlist']['orders']/$result['xdlist']['orders']*100) .'%';
			}
			if($result['qslist']['orders'] != 0){
				$result['qsratio'] = sprintf("%.2f",$result['qslist']['orders']/$result['xdlist']['orders']*100) .'%';
			}
		}
		return $result;
	}

	/**
	 * @desc 获取接线有效率报表——获取员工信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getJxyxlbbByCond($cond){
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

		//获取员工信息
		if($cond['dept'] != ''){
			$rylist = rylistDAO::getInstance()->findAllByAttributes(array('department'=>$cond['dept']));
		}else{
			$rylist = rylistDAO::getInstance()->selectAllByNothing();
		}

		$result['result'] = 'success';
		$result['list'] = array();

		$result['beginDate'] = $cond['beginDate'];//
		$result['endDate'] = $cond['endDate'];//
		
		$result['ryNum'] = count($rylist);//总员工数
		$result['bhCount'] = 0;//总拨号数
		$result['jtCount'] = 0;//总接听数
		$result['khCount'] = 0;//总客户数
		$result['wxCount'] = 0;//总无效客户数

		//根据员工信息获取不同的统计信息
		for($i = 0; $i < count($rylist); $i ++) {
			$cond['username'] = $rylist[$i]['username'];
			$cond['personname'] = $rylist[$i]['personname'];
			$demoList = $this->getJxyxlbbDetails($cond);
			$result['list'][$i] = $demoList;

			$result['bhCount'] += $demoList['bhcs']['num'];//总拨号数
			$result['jtCount'] += $demoList['jtcs']['num'];//总接听数
			$result['khCount'] += $demoList['khzs']['num'];//总客户数
			$result['wxCount'] += $demoList['wxkh']['num'];//总无效客户数
		}


		$result['totalWXRatio'] = '0.00%';//总成交率
		//计算比例
		if($result['khCount'] != 0){
			$result['totalWXRatio'] = sprintf('%.2f',$result['wxCount']/$result['khCount']*100).'%';
		}
		return $result;
	}

	/**
	 * @desc 获取接线有效率报表——获取报表信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-02
	 */
	public function getJxyxlbbDetails($cond){
		$result['username'] = $cond['username'];
		$result['personname'] = $cond['personname'];
		$result['bhcs'] = rylistDAO::getInstance()->getJxyxlbbBH($cond,'');//拨号次数
		$result['jtcs'] = rylistDAO::getInstance()->getJxyxlbbBH($cond,'ANSWERED');//接听次数
		$result['khzs'] = rylistDAO::getInstance()->getYgyjtjbbByCondRS($cond);//客户总数
		$result['wxkh'] = rylistDAO::getInstance()->getJxyxlbbWXKH($cond);//无效客户
		$result['wxRatio'] = '0.00%';
		if($result['khzs']['num'] > 0){
			$result['wxRatio'] = sprintf('%.2f',$result['wxkh']['num']/$result['khzs']['num']*100).'%';
		}
		
		return $result;
	}

	/**
	 * @desc 获取当前在线人数
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function getOnlinePeopleNum(){
		$result = rylistDAO::getInstance()->getOnlinePeopleNum();
		return $result;
	}

	/**
	 * @desc 更新权限角色信息成功后，改变相应工号的post字段
	 * @param string $groupbh 角色编号
	 * @param string $groupname 角色信息
	 * @author DengShaocong
	 * @date 2016-03-17
	 */
	public function updatePostMess($groupbh,$groupname){
		$demoRylist = rylistDAO::getInstance()->update(array('postID'=>$groupbh),array('post'=>$groupname));
	}






	/**
	 * @desc 获取员工业绩统计图表——获取员工信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function getYgyjtjbbChart($cond){
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
			$result['list'][$i] = $this->getYgyjtjbbChartDetails($cond);

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

	/**
	 * @desc 获取员工业绩统计图表——详情
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-29
	 */
	public function getYgyjtjbbChartDetails($cond){
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

		$xdlist = rylistDAO::getInstance()->getYgyjtjbbChart($cond,"'未确认','已确认','待发货','已发货','拒收','交易成功'");//下单信息
		$sdlist = rylistDAO::getInstance()->getYgyjtjbbChart($cond,"'待发货','已发货','拒收','交易成功'");//审单信息
		$fhlist = rylistDAO::getInstance()->getYgyjtjbbChart($cond,"'已发货','拒收','交易成功'");//发货信息
		$jslist = rylistDAO::getInstance()->getYgyjtjbbChart($cond,"'拒收'");//拒收信息;
		$qslist = rylistDAO::getInstance()->getYgyjtjbbChart($cond,"'交易成功'");//签收信息

		$result['xdNum'] = $xdlist['orders'];
		$result['xdMoney'] = $xdlist['money'];
		$result['sdNum'] = $sdlist['orders'];
		$result['sdMoney'] = $sdlist['money'];
		$result['fhNum'] = $fhlist['orders'];
		$result['fhMoney'] = $fhlist['money'];
		$result['jsNum'] = $jslist['orders'];
		$result['jsMoney'] = $jslist['money'];
		$result['qsNum'] = $qslist['orders'];
		$result['qsMoney'] = $qslist['money'];

		return $result;
	}
}

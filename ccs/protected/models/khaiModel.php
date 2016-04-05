<?php
/**
 * @desc 黑名单相关操作类
 * @author huyan
 * @date 2015-12-07
 */
class khaiModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khadModel对象
	 * @return khaiModel
	 * @author huyan
	 * @date 2015-12-07
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加黑名单
	 * @param array $clientInfo 客户资料
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function AddBlacklist($clientInfo){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'黑名单信息不能为空');
		}
		$clientList = khaiDAO::getInstance()->getMaxCustomerNumber();
		if(!empty($clientList)){

			$date = substr($clientList['khai02'],2,4);
			if($date == date('ym')){
				$id = substr($clientList['khai02'],-4,4);
				$id += 1;
				$clientId = sprintf("%04d",$id);
				$clientNo = 'HM'.date('ym').$clientId;
			}else{
				$id = '1';
				$clientId = sprintf("%04d",$id);
				$clientNo = 'HM'.date('ym').$clientId;
			}
		}else{
			$id = '1';
			$clientId = sprintf("%04d",$id);
			$clientNo = 'HM'.date('ym').$clientId;
		}
		$clientInfo['khai02']=$clientNo;

		$hmdsjh = array('khai03'=>$clientInfo['khai03']);
		$CustomerPhone = khaiDAO::getInstance()->isExists($hmdsjh);
		//添加客户时不能有重复的手机号
		if($CustomerPhone==1){
			return array('res'=>'error','msg'=>'该手机号已存在黑名单中,请重新输入');
		}

		$res = khaiDAO::getInstance()->insert($clientInfo);
		return array('res'=>'success','msg'=>'添加成功');
		
	}

	/**
	 * @desc 获取黑名单列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function getCustomerBlacklist($page,$psize,$phone){
		$addrStr = '';
		$addrArr =array();
		$result = array();  //获取列表数据的结果
		$clientList = khaiDAO::getInstance()->getCustomerBlacklist($page,$psize,$phone);
		
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
	 * @desc 删除一个黑名单电话
	 * @param string $orderno 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function DeleteCustomerBlack($orderno){
		$deleteResult = khaiDAO::getInstance()->delete(array('khai02'=>$orderno));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}

	/**
	 * @desc 修改黑名单
	 * @param string $clientNo 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function ModifyEditBlackList($clientInfo){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'黑名单信息不能为空');
		}
		$phone=$clientInfo['khai03'];
		$UserNumberList = khaiDAO::getInstance()->getBlackListNumber($phone);
		print_r($UserNumberList);die;
		$BlackNum=$UserNumberList['khai02'];
		
		$updateResult = khaiDAO::getInstance()->update(array('khai02'=>$BlackNum),$clientInfo);
		return array('res' => 'success','msg' => '修改成功');
	}

	
	/**
	 * @desc点击编辑获取黑名单电话
	 * @return array $result 电话信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function getEditBlackList($orderNo){
		$UserNumberList = khaiDAO::getInstance()->getEditBlackList($orderNo);
		//print_r($WorkNumList);die;
		//判断是否查询到有数据
		/*if(empty($UserNumberList)){
			return array('res'=>'error','msg'=>'没有查到该用户');
		}*/
		return $UserNumberList;
	}

	/**
	 * @desc 从csv中导入黑名单信息
	 * @param array $listInfo 黑名单信息
	 * @return array $result 电话信息
	 * @author huyan
	 * @date 2016-01-28
	 */
	public function addListFromCsv($listInfo){
		if(empty($listInfo)){
			return array('res'=>'error','msg'=>'添加出错');
		}
		$result = khaiDAO::getInstance()->insert($listInfo,true);
		if(empty($result)){
			return array('res'=>'false','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

}

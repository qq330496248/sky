<?php
/**
 * @desc 内部短信表相关操作类
 * @author huyan
 * @date 2015-11-24
 */
class khagModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khagModel对象
	 * @return khafModel
	 * @author huyan
	 * @date 2015-11-16
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 发送内部短信
	 * @param array $clientInfo 短信信息
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-11-24
	 */
	public function SendMessages($clientInfo,$NameAndNumber,$pitchon){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'短信资料不能为空');
		}
		$JobNumber=$clientInfo['khag03'];
		if ($pitchon=='checked') {
			$nameNum = count($NameAndNumber);//确认发出的短信数
			$arr2=array();
			 for($i = 0;$i < $nameNum;$i++){
				$clientInfo['khag03']=$NameAndNumber[$i];
				$arr2[]=$clientInfo;
				$res = khagDAO::getInstance()->insert($clientInfo,true);
			}
		}
		else{
			if ($clientInfo['khag03']=='') {
				return array('res'=>'error','msg'=>'请选择收信人');
			}
			$Number = explode(',',$clientInfo['khag03']);
		    $orderNum = count($Number); //确认发出的短信数
		    $arr1=array();
		    for($i = 0;$i < $orderNum;$i++){

		    	$clientInfo['khag03']=$Number[$i];
		    	$arr1[]=$clientInfo;
		    	$res = khagDAO::getInstance()->insert($clientInfo,true);
		    }
		}
		if(empty($res)){
			return array('res'=>'error','msg'=>'发送失败');
		}
		return array('res'=>'success','msg'=>'发送成功');
		
	}

	/*
	*获取已发内部短信
	* @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @author huyan
	 * @date 2015-11-11
	 */
	public function getSentMessages($page,$psize,$CondList,$JobNuber){
		$result = array();  //获取列表数据的结果
		$clientList = khagDAO::getInstance()->getSentMessages($page,$psize,$CondList,$JobNuber);
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

	/*
	*获取已收内部短信
	* @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @author huyan
	 * @date 2015-11-11
	 */
	public function getReceivedMessages($page,$psize,$CondList,$JobNuber){
		$result = array();  //获取列表数据的结果
		$clientList = khagDAO::getInstance()->getReceivedMessages($page,$psize,$CondList,$JobNuber);
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
	 * @desc 删除一条已发内部短信
	 * @param string $orderno 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function DelSentMessages($orderno){
		$deleteResult = khagDAO::getInstance()->delete(array('khag09'=>$orderno));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}

	/**
	 * @desc 短信状态修改为已读
	 * @param string $orderno 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function GetModifyMessage($dxxh){
		$clientInfo = array();
        $clientInfo['khag08'] = '已读';
		$updateResult = khagDAO::getInstance()->update(array('khag09'=>$dxxh),$clientInfo);
	}

	/**
	 * @desc 获取内部未读短信
	 * @param string $username 员工ID
	 * @author DengShaocong
	 * @date 2016-03-25
	 */
	public function getNoReadMess($username){
		$result = khagDAO::getInstance()->getNoReadMess($username);
		return $result;
	}
}

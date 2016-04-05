<?php
/**
 * @desc 客户短信表相关操作类
 * @author huyan
 * @date 2015-11-16
 */
class khafModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khafModel对象
	 * @return khafModel
	 * @author huyan
	 * @date 2015-11-16
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/*
	*客户短信
	 @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function getMessage($page,$psize,$khyfdx){
		$result = array();  //获取列表数据的结果
		$clientList = khafDAO::getInstance()->getMessage($page,$psize,$khyfdx);
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
	 * @desc 根据不同的订单状态获取订单列表
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $orderStatus 短信状态
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-11-04
	 */
	public function getShortMessage($page,$psize,$ShortMessage,$CondList){
		$result = array();  //获取列表数据的结果
		$orderList = khafDAO::getInstance()->getShortMessage($page,$psize,$ShortMessage,$CondList);
		//判断是否查询到有数据
		if(!empty($orderList['info']) && is_array($orderList['info'])){
			$result['result'] = 'success';
			$result['list'] = $orderList['info'];
			$result['count'] = $orderList['count'];
			
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/*
	*获取查询客户短信
	 @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function SMSQuery($page,$psize,$gsgh,$khphone,$kssj,$jssj,$khszz){
		$result = array();
		$khzl1Arr = explode(':',$gsgh);
		$khzl1Client = $khzl1Arr[0];//工号
		$clientList = khafDAO::getInstance()->SMSQuery($page,$psize,$khzl1Client,$khphone,$kssj,$jssj,$khszz);
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
	 * @desc 获取客户详情页面短信记录（外部短信）
	 * @author huyan
	 * @date 2016-03-03
	 */
	public function GetShortmesRecords($khphonecall,$page,$psize){
		$result = khafDAO::getInstance()->GetShortmesRecords($khphonecall,$page,$psize);
		if(empty($result)){
			return array('res'=>'error','msg'=>'获取客户短信记录失败');
		}
		return $result;
	}

    /**
	 * @desc 删除一条客户详情页面短信记录（外部短信）
	 * @author huyan
	 * @date 2016-03-03
	 */
	public function DelShortmesRecords($orderno){
		$deleteResult = khafDAO::getInstance()->delete(array('khaf01'=>$orderno));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}
}

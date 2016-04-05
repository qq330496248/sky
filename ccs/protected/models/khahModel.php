<?php
/**
 * @desc 投诉类型相关操作类
 * @author huyan
 * @date 2015-12-04
 */
class khahModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khadModel对象
	 * @return khahModel
	 * @author huyan
	 * @date 2015-12-04
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加投诉类型（小分类）
	 * @param array $clientInfo 客户资料
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function AddSmallTypeComplaint111derr($clientInfo,$tssjfl){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'投诉类型信息不能为空');
		}
	   //查询上一级投诉类型类型id
		$result = khadDAO::getInstance()->getUpperLevel($tssjfl);
		print_r($result);die;
	    $sjbh=$result['info'][0]['khad01'];
	    $clientInfo['khah01']=$sjbh;

		$res = khahDAO::getInstance()->insert($clientInfo);
		return array('res'=>'success','msg'=>'添加成功');
		
	}

	/*
	*获取投诉类型列表
	* @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @author huyan
	 * @date 2015-12-03
	 */
	public function getComplaintTypeList($page,$psize){
		$result = array();  //获取列表数据的结果
		$clientList = khahDAO::getInstance()->getComplaintTypeList($page,$psize);
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
	 * @desc 删除一个客户投诉
	 * @param string $orderno 投诉编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function DeleteTypeComplaint{
		//print_r($orderno);die;
		$deleteResult = khadDAO::getInstance()->delete(array('khah01'=>$orderno));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}


}

<?php
/**
 * @desc 订单跟进记录表相关操作类
 * @author WuJunhua
 * @date 2015-11-13
 */
class xsadModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回xsaaModel对象
	 * @return xsadModel
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	/**
	 * @desc 获取订单跟进记录
	 * @param string $orderNo 订单编号
	 * @return array $result 订单跟进记录信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function getOrderFollowRecording($page,$psize,$orderNo){
		$result = xsadDAO::getInstance()->getOrderFollowRecording($page,$psize,$orderNo);
		//判断是否查询到有数据
		if(!empty($result['info']) && is_array($result['info'])){
			$result['result'] = 'success';
			$result['list'] = $result['info'];
			$result['count'] = $result['count'];
			$result['page'] = $page;
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
		return $result;
	}

	/**
	 * @desc 删除订单跟进记录
	 * @param int $followId 订单跟进记录id
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2015-12-30
	 */
	public function deleteOrderFollowRecording($followId){
		$deleteResult = xsadDAO::getInstance()->delete(array('xsad10' => $followId));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}

		/**
	 * @desc 系统设置->数据清理->删除订单跟进记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function DelOrderFollow($ddsjq,$ddsjz){
		//查询要删除的跟进记录id
		$result = xsadDAO::getInstance()->getOrderFollow($ddsjq,$ddsjz);
		if (empty($result)){
			return array('res' => 'error','msg' => '没有查询到符合条件的订单');
		}
		if (!empty($result)){
			$ddidArr = array();
		    foreach($result as $value){
			    $ddidArr[] = $value['xsad10'];
		    }
		    $orderNum = count($ddidArr);
			for($i = 0;$i < $orderNum;$i++){
			    $deleteResult = xsadDAO::getInstance()->delete(array('xsad10'=>$ddidArr[$i]));
			}
			return array('res' => 'success','msg' => '删除成功');
		}
	}

	/**
	 * @desc 获取客户待办事项信息
	 * @author DengShaocong
	 * @param array $cond 查询条件
	 * @return array $result 结果集
	 * @date 2016-03-14
	 */
	public function getOrderBacklog($cond){
		$result = array();
		$backlogList = xsadDAO::getInstance()->getOrderBacklog($cond);
		if(!empty($backlogList) && is_array($backlogList)){
			$result['result'] = 'success';
			$result['list'] = $backlogList['list'];
			$result['count'] = $backlogList['count'];
		}else{
			$result['result'] = 'error';
			$result['list'] = null;
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 完成订单待办事项
	 * @param string $id 待办事项ID 
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function finishOrderBacklog($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'修改出错');
		}
		$result = xsadDAO::getInstance()->updateByPk($id,array('xsad12'=>'已完成'));
		if(empty($result)){
			return array('mes'=>'false','msg'=>'修改失败');
		}
		return array('mes'=>'success','msg'=>'修改成功');
	}


	/**
	 * @desc 批量完成订单待办事项
	 * @param string $str 多个待办事项ID拼成的字符串 
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function finishOrderBacklogs($str){
		if(empty($str)){
			return array('mes'=>'error','msg'=>'修改出错');
		}
		$ids = explode(',', $str);
		$count = count($ids);
		for ($i=0; $i < $count; $i++) { 
			if($ids[$i]){
				xsadDAO::getInstance()->updateByPk($ids[$i],array('xsad12'=>'已完成'));
			}
		}
		return array('mes'=>'success','msg'=>'修改成功');
	}
}


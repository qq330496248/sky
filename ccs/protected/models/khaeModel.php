<?php
/**
 * @desc 客户跟进记录表相关操作类
 * @author huyan
 * @date 2015-11-11
 */
class khaeModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khaaModel对象
	 * @return khaeModel
	 * @author huyan
	 * @date 2015-10-27
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/*
	 * 获取跟进记录
	 * @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @author huyan
	 * @date 2015-11-11
	 */
	public function getFollowing($page,$psize,$CondList,$sign,$JobNuber){
		$result = array();  //获取列表数据的结果
		$clientList = khaeDAO::getInstance()->getFollowing($page,$psize,$CondList,$JobNuber);

		if($sign == 1){
			//导出客户跟进记录excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[2]); //导出客户跟进记录excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$clientList = khaeDAO::getInstance()->getFollowing($page,$psize,$CondList,$JobNuber,$selectColumnStr);
				}
			}
			
			if(!empty($clientList['info']) && is_array($clientList['info'])){
				$data = $clientList['info'];
				$fileName = 'jx';  //MyClientData
				$tableName = '客户跟进记录';
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
	 * @desc 获取客户跟进记录
	 * @param string $clientno 客户编号
	 * @return array $result 客户跟进记录信息
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function GetFollowRecording($clientno){
		$result = khaeDAO::getInstance()->GetFollowRecording($clientno);
		if(empty($result)){
			return array('res'=>'error','msg'=>'获取客户跟进记录失败');
		}
		return $result;
	}
	/**
	 * @desc 添加跟进记录
	 * @param array $clientInfo 跟进记录
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-11-16
	 */
	public function AddFollowRecord($clientInfo){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'跟进记录不能为空');
		}
		$res = khaeDAO::getInstance()->insert($clientInfo);//true表示当前这个表没有自增id主键
		if(!empty($clientInfo['khae09'])){
			//更新客户表最新跟进时间和跟进标签
		    $FollowTime=khaaDAO::getInstance()->update(array('khaa02'=>$clientInfo['khae01']),array('khaa18'=>$clientInfo['khae08'],'khaa43'=>$clientInfo['khae02']));
		}
		if(empty($res)){
			return array('res'=>'error','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功','clientno'=>$clientInfo['khae01']);
		
	}

	/**
	 * @desc 删除一条跟进记录
	 * @param string $orderno 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-02
	 */
	public function DeleteRecords($orderno){
		$deleteResult = khaeDAO::getInstance()->delete(array('khae12'=>$orderno));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}

	/**
	 * @desc 系统设置->数据清理->删除客户跟进记录
	 * @author huyan
	 * @date 2016-02-17
	 */
	public function DelFollowRecord($gjsjq,$gjsjz){
		//查询要删除的跟进记录id
		$result = khaeDAO::getInstance()->getFollowToBeDel($gjsjq,$gjsjz);
		if (empty($result)){
			return array('res' => 'error','msg' => '没有查询到符合条件的订单');
		}
		if (!empty($result)){
			$ddidArr = array();
		    foreach($result as $value){
			    $ddidArr[] = $value['khae12'];
		    }
		    $orderNum = count($ddidArr);
			for($i = 0;$i < $orderNum;$i++){
			    $deleteResult = khaeDAO::getInstance()->delete(array('khae12'=>$ddidArr[$i]));
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
	public function getClientBacklog($cond){
		$result = array();
		$backlogList = khaeDAO::getInstance()->getClientBacklog($cond);
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
	 * @desc 完成客户待办事项
	 * @param string $id 待办事项ID 
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function finishClientBacklog($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'修改出错');
		}
		$result = khaeDAO::getInstance()->updateByPk($id,array('khae10'=>'已完成'));
		if(empty($result)){
			return array('mes'=>'false','msg'=>'修改失败');
		}
		return array('mes'=>'success','msg'=>'修改成功');
	}


	/**
	 * @desc 批量完成客户待办事项
	 * @param string $str 多个待办事项ID拼成的字符串 
	 * @author DengShaocong
	 * @date 2016-03-14
	 */
	public function finishClientBacklogs($str){
		if(empty($str)){
			return array('mes'=>'error','msg'=>'修改出错');
		}
		$ids = explode(',', $str);
		$count = count($ids);
		for ($i=0; $i < $count; $i++) { 
			if($ids[$i]){
				khaeDAO::getInstance()->updateByPk($ids[$i],array('khae10'=>'已完成'));
			}
		}
		return array('mes'=>'success','msg'=>'修改成功');
	}
}

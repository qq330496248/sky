<?php
/**
 * @desc 投诉类型相关操作类
 * @author huyan
 * @date 2015-12-04
 */
class khadModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khadModel对象
	 * @return khadModel
	 * @author huyan
	 * @date 2015-12-04
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}


	/**
	 * @desc 获取投诉类型（大分类）
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function TypeCompOptions(){
		$gonghaoArr = array();
		$WorkNumList = khadDAO::getInstance()->TypeCompOptions();
		foreach($WorkNumList as $value){
			$gonghaoArr[] = $value['khad02'];
		}
		//判断是否查询到有数据
		if(empty($WorkNumList) || empty($gonghaoArr)){
			//return array('res'=>'error','msg'=>'获取投诉类型息失败');
		}
		return $gonghaoArr;
	}

	/**
	 * @desc 添加投诉分类（大分类）
	 * @param array $clientInfo 客户资料
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function AddTypeComplaint($clientInfo){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'投诉类型信息不能为空');
		}
		$clientList = khadDAO::getInstance()->getMaxCustomerNumber();
		if(!empty($clientList)){
			$date = substr($clientList['khad01'],2,4);
			if($date == date('ym')){
				$id = substr($clientList['khad01'],-4,4);
				$id += 1;
				$clientId = sprintf("%04d",$id);
				$clientNo = 'TS'.date('ym').$clientId;
			}else{
				$id = '1';
				$clientId = sprintf("%04d",$id);
				$clientNo = 'TS'.date('ym').$clientId;
			}
		}else{
			$id = '1';
			$clientId = sprintf("%04d",$id);
			$clientNo = 'TS'.date('ym').$clientId;
		}

		//获取上一个大分类的区间
		$TypeCompList = khadDAO::getInstance()->getBigSection();
		if(empty($TypeCompList)){
			$jjj=1000;
		    $clientInfo['khad05'] = $jjj; 
		}
		if(!empty($TypeCompList)){
		    $clientInfo['khad05'] =$TypeCompList['khad05']+1000;
		}
		$clientInfo['khad01'] = $clientNo;

		$tslxmc = array('khad02'=>$clientInfo['khad02']);
		$CustomerTslxmc = khadDAO::getInstance()->isExists($tslxmc);
		//添加投诉类型时不能有重复的类型名称
		if($CustomerTslxmc==1){
			return array('res'=>'error','msg'=>'类型名称已经存在,请重新输入');
		}
	
		$res = khadDAO::getInstance()->insert($clientInfo);
		return array('res'=>'success','msg'=>'添加成功');
		
	}

	/**
	 * @desc 添加投诉类型（小分类）
	 * @param array $clientInfo 客户资料
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function AddSmallTypeComplaint($clientInfo,$tssjfl){
		if(empty($clientInfo)){
			return array('res'=>'error','msg'=>'投诉类型信息不能为空');
		} 
		//获取当前大分类id和区间
		$BigSection=khadDAO::getInstance()->gettUpperLevelSection($tssjfl);
		$tslxbh=($BigSection['khad01']);

		//获取小分类区间最大值
		$result = khadDAO::getInstance()->getSmallTypUpperLevel($tslxbh);
		//print_r($result);die;
		
	    $sjbh=$BigSection['khad01'];
	    $clientInfo['khad01']=$tslxbh;
	    $clientInfo['khad03']=$tslxbh;

	    if (empty($result)) {
	    	$clientInfo['khad05'] =$BigSection['khad05']+1;
	    }
	    if (!empty($result)) {
	    	$clientInfo['khad05']=$result['khad05']+1;
	    }
	    $tslxmc = array('khad02'=>$clientInfo['khad02']);

		$CustomerTslxmc = khadDAO::getInstance()->isExists($tslxmc);
		//添加投诉类型时不能有重复的类型名称
		if($CustomerTslxmc==1){
			return array('res'=>'error','msg'=>'类型名称已经存在,请重新输入');
		}
		$res = khadDAO::getInstance()->insert($clientInfo);
		return array('res'=>'success','msg'=>'添加成功');
		
	}

	/*
	 * 获取投诉类型列表
	 * @param int $page 页码
	 * @param int $psize 每页显示的条数 
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function getComplaintTypeList($page,$psize){
		$result = array();  //获取列表数据的结果
		$clientList = khadDAO::getInstance()->getComplaintTypeList($page,$psize);
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
	 * @desc 删除一条投诉类型
	 * @param string $orderno 客户编号
	 * @return array 结果信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function DeleteTypeComplaint($orderno,$oderlist){
		
		//判断这个分类是大分类还是小分类
		//$dflResult = khadDAO::getInstance()->getdafenlClasscation($orderno);
		 //$InquiryResult = khadDAO::getInstance()->getSmallClasscation($orderno,$oderlist);
		$aaa = khadDAO::getInstance()->findByAttributes(array('khad05'=>$orderno),array('khad03'));
		if($aaa['khad03'] ==''){//是大分类
			//查询这个大分类下面有没有小分类
		    $InquiryResult = khadDAO::getInstance()->getSmallClasscation($orderno,$oderlist);
		    if (!empty($InquiryResult)) {

			   return array('res' => 'error','msg' => '请先删除该分类下的数据');
		    }
		    else {
		    	//$InquiryResult['info'][0]['khad03']==''
			    $deleteResult = khadDAO::getInstance()->delete(array('khad05'=>$orderno));
		        return array('res' => 'success','msg' => '删除成功');
		    }

		}else{
			//删除小分类
			$deleteResult = khadDAO::getInstance()->delete(array('khad05'=>$orderno));
		    return array('res' => 'success','msg' => '删除成功');
		}
	}

	/**
	 * @desc 获取所有投诉类型
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function getTypecompOptions(){
		$gonghaoArr = array();
		$WorkNumList = khadDAO::getInstance()->getTypecompOptions();
		foreach($WorkNumList as $value){
			$gonghaoArr[] = $value['khad02'];
		}
		//判断是否查询到有数据
		if(empty($WorkNumList) || empty($gonghaoArr)){
			//return array('res'=>'error','msg'=>'获取投诉类型信息失败');
		}
		return $gonghaoArr;
	}


}

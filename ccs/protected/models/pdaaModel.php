<?php
/**
 * @desc 库存盘点表相关操作类
 * @author WuJunhua
 * @date 2015-12-01
 */
class pdaaModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回pdaaModel对象
	 * @return pdaaModel
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 生成盘点单号
	 * @param array $goodItems 商品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public function generateInventoryOrder($goodItems){
		$inventoryOver = cpglConst::$InventoryStatus[5]; 
		//$inventoryInvalid = cpglConst::$InventoryStatus[6];
		$orderList = pdaaDAO::getInstance()->getNewestOrder();
		if(!empty($orderList)){
			if($orderList['pdaa04'] != $inventoryOver){
				return array('res'=>'error','msg'=>'最新的盘点单号还未盘点完结,不能生成盘点单号！');
			}
		}
		if(!empty($orderList)){
			$date = substr($orderList['pdaa01'],2,4);
			if($date == date('ym')){
				$id = substr($orderList['pdaa01'],-4,4);
				$id += 1;
				$orderId = sprintf("%04d",$id);
				$orderNo = 'PD'.date('ym').$orderId;
			}else{
				$id = '1';
				$orderId = sprintf("%04d",$id);
				$orderNo = 'PD'.date('ym').$orderId;
			}
		}else{
			$id = '1';
			$orderId = sprintf("%04d",$id);
			$orderNo = 'PD'.date('ym').$orderId;
		}
		$orderInfo['pdaa01'] = $goods['pdab01'] = $orderNo;
		$orderInfo['pdaa02'] = Yii::app()->session['account'];
		$orderInfo['pdaa03'] = date('Y-m-d H:i:s');
		$orderInfo['pdaa04'] = cpglConst::$InventoryStatus[1];

		//处理单个或多个商品信息
		$goodItemsArr = array_chunk($goodItems, 7);
		if(!empty($goodItemsArr)){
			foreach($goodItemsArr as $val){
				$goods['pdab02'] = $val[0];
				$goods['pdab03'] = $val[1];
				$goods['pdab11'] = $val[2];
				$goods['pdab04'] = $val[3];
				$goods['pdab07'] = $val[4];
				$goods['pdab05'] = $val[5];
				$goods['pdab10'] = $val[6];
				$goodsArr[] = $goods;
			}
		}

		$condition1 = array('pdaa01' => $orderNo);
		$orderResult = pdaaDAO::getInstance()->isExists($condition1);
		//下单时不能有重复的盘点单号
		if($orderResult){
			return array('res'=>'error','msg'=>'已有该盘点单号');
		}

		$res = pdaaDAO::getInstance()->insert($orderInfo,true);
		//遍历把商品信息插入到盘点明细表
		foreach($goodsArr as $val){
			$result = pdabDAO::getInstance()->insert($val,true);
		}
		if(empty($res) || empty($result)){
			return array('res'=>'error','msg'=>'生成盘点单号失败');
		}

		return array('res'=>'success','msg'=>'生成盘点单号成功');
	}

	/**
	 * @desc 获取盘点明细列表信息(盘点状态不能为盘点完结/盘点作废)
	 * @return array $result 盘点单号列表信息
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public function getInventoryOrderList($sign){
		$orderList = array();
		$inventoryStatus = array();
		$inventoryStatus['inventoryOver'] = cpglConst::$InventoryStatus[5]; 
		$inventoryStatus['inventoryInvalid'] = cpglConst::$InventoryStatus[6];
		$orderList = pdaaDAO::getInstance()->getInventoryOrderList($inventoryStatus);

		if($sign == 1){
			//导出盘点明细excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[11]); //导出盘点明细excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = pdaaDAO::getInstance()->getInventoryOrderList($inventoryStatus,$selectColumnStr);
				}
			}
			if(!empty($orderList) && is_array($orderList)){
				$data = $orderList;
				$fileName = 'jx';  
				$tableName = '盘点明细';
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
				$result['count'] = 0;
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}

		if(empty($orderList)){
			return array('res'=>'error','msg'=>'获取盘点单号列表信息失败');
		}
		return $orderList;
	}

	/**
	 * @desc 获取盘差列表信息
	 * @return array $result 盘差列表信息
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function generateDifferenceForm(){
		$orderList = array();
		$inventoryStatus = array();
		$inventoryStatus['inventoryOver'] = cpglConst::$InventoryStatus[5]; 
		$inventoryStatus['inventoryInvalid'] = cpglConst::$InventoryStatus[6];
		$inventoryNum = pdaaDAO::getInstance()->getCurrentInventoryOrder($inventoryStatus);
		if(empty($inventoryNum)){
			return array('res'=>'error','msg'=>'没有生成新的盘点单号，请进行生成盘点单号操作');
		}
		$orderList = pdaaDAO::getInstance()->generateDifferenceForm($inventoryStatus,$inventoryNum);
		if(empty($orderList)){
			return array('res'=>'error','msg'=>'获取盘差列表信息失败');
		}
		return $orderList;
	}

	/**
	 * @desc 系统设置->数据清理->删除库存盘点记录
	 * @author huyan
	 * @date 2016-02-19
	 */
	public function DelStockInventory($pdsjq,$pdsjz){
		//查询要删除的盘点记录
		$result = pdaaDAO::getInstance()->getStockStockInventoryToBeDel($pdsjq,$pdsjz);
		if (empty($result)){
			return array('res' => 'error','msg' => '没有查询到符合条件的库存盘点记录');
		}
		if (!empty($result)){
			$ddidArr = array();
		    foreach($result as $value){
			    $ddidArr[] = $value['pdaa01'];
		    }
		    $orderNum = count($ddidArr);
			for($i = 0;$i < $orderNum;$i++){
			    $deleteResult = pdaaDAO::getInstance()->delete(array('pdaa01'=>$ddidArr[$i]));
			}
			return array('res' => 'success','msg' => '删除成功');
		}
		return array('res' => 'error','msg' => '删除失败');
	}
	
}
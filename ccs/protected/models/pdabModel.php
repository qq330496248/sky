<?php
/**
 * @desc 盘点明细表相关操作类
 * @author WuJunhua
 * @date 2015-12-01
 */
class pdabModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回pdabModel对象
	 * @return pdabModel
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 录入盘点数量
	 * @param array $goodItems 单条或多条产品信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2015-12-02
	 */
	public function entryCountQuantity($goodItems){
		$inventoryStatus = [];
		$inventoryStatus['inventoryOver'] = cpglConst::$InventoryStatus[5];
		$inventoryStatus['inventoryInvalid'] = cpglConst::$InventoryStatus[6];
		$inventoryNum = pdaaDAO::getInstance()->getCurrentInventoryOrder($inventoryStatus);
		if(empty($inventoryNum)){
			return array('res'=>'error','msg'=>'没有生成新的盘点单号，请进行生成盘点单号操作');
		}
		$productInfo['pdab01'] = $orderInfo['pdaa01'] = $inventoryNum['pdaa01']; //盘点单号
		$orderInfo['pdaa02'] = Yii::app()->session['account'];
		$orderInfo['pdaa03'] = date('Y-m-d H:i:s');
		$orderInfo['pdaa04'] = cpglConst::$InventoryStatus[3];

		$proDetailsArr = []; //盘点明细表信息
		//处理单个或多个产品信息
		$goodItemsArr = array_chunk($goodItems,4);
		if(!empty($goodItemsArr)){
			foreach($goodItemsArr as $val){
				$productInfo['pdab02'] = $val[0];
				if(empty($productInfo['pdab02'])){
					return array('res'=>'tips','msg'=>'产品批次不能为空');
				}
				$conditionBatch = array('cpae01' => $val[0]);
    	    	$testBatch= cpaeDAO::getInstance()->isExists($conditionBatch);
				if(empty($testBatch)){
					return array('res'=>'tips','msg'=>'输入的产品批次不存在，请重新输入！');
				}

				$productInfo['pdab03'] = $val[1];
				if(empty($productInfo['pdab03'])){
					return array('res'=>'tips','msg'=>'产品款号不能为空');
				}
				$conditionNumber = array('cpaa01' => $val[1]);
    	    	$testGoodNumber = cpaaDAO::getInstance()->isExists($conditionNumber);
				if(empty($testGoodNumber)){
					return array('res'=>'tips','msg'=>'输入的商品款号不存在，请重新输入！');
				}
				if(empty($val[2])){
					return array('res'=>'tips','msg'=>'产品名称不能为空');
				}
				$conditionName = array('cpaa02' => $val[2]);
    	    	$testGoodName = cpaaDAO::getInstance()->isExists($conditionName);
				if(empty($testGoodName)){
					return array('res'=>'tips','msg'=>'输入的商品名称不存在，请重新输入！');
				}

				$productInfo['pdab08'] = $val[3];
				if(empty($productInfo['pdab08'])){
					return array('res'=>'tips','msg'=>'库存量不能为空');
				}
				$proDetailsArr[] = $productInfo;
			}
		}

		$transaction = Yii::app()->db->beginTransaction();  //事务处理
		try {
			//更新库存盘点表
			$res = pdaaDAO::getInstance()->update(array('pdaa01'=>$orderInfo['pdaa01']),array('pdaa02'=>$orderInfo['pdaa02'],'pdaa03'=>$orderInfo['pdaa03'],'pdaa04'=>$orderInfo['pdaa04']));
			//遍历把盘点数量更新到盘点明细表
			foreach($proDetailsArr as $val){
				$result = pdabDAO::getInstance()->update(array('pdab01'=>$val['pdab01'],'pdab02'=>$val['pdab02'],'pdab03'=>$val['pdab03']),array('pdab08'=>$val['pdab08']));
			}

			if(empty($res)){
				return array('res'=>'error','msg'=>'录入盘点数量失败');
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollBack();
		}
		return array('res'=>'success','msg'=>'录入盘点数量成功');
		
	}
	
}

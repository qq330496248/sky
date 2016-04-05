<?php
/**
 * @desc 订单明细表相关操作类
 * @author WuJunhua
 * @date 2015-11-13
 */
class xsabModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回xsaaModel对象
	 * @return xsabModel
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	/**
	 * @desc 获取退货订单记录详情
	 * @param string $orderNo 订单编号
	 * @return array $returnOrderDetails 结果信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 */
	public function getReturnOrderDetails($orderNo){
		$selections = array('xsab03','xsab02','xsab18','xsab14','xsab06','xsab16','xsab17');
		$returnOrderDetails = xsabDAO::getInstance()->findAllByAttributes(array('xsab01' => $orderNo),$selections);
		if(empty($returnOrderDetails)){
			return array('res'=>'error','msg'=>'获取退货订单记录详情失败');
		}
		return $returnOrderDetails;
	}

	/**
	 * @desc 获取退货款号汇总列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $sequence 顺序/倒序
	 * @param string $order 按照什么排序
	 * @return array $result 退货款号汇总列表信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 * @modify huyan 修改查询条件
	 */
	public function getReturnGoodsSummaryList($page,$psize,$sequence,$order,$CondList,$sign){
		$result = [];  //获取列表数据的结果 
		$goodStatus = ddglConst::$WhetherReturns[3]; //商品已退货入仓
		$orderList = xsaaDAO::getInstance()->getReturnGoodsSummaryList($page,$psize,$goodStatus,$sequence,$order,$CondList);

		if($sign == 1){
			//导出退货款号汇总excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[8]); //导出退货款号汇总excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getReturnGoodsSummaryList($page,$psize,$goodStatus,$sequence,$order,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '退货款号汇总';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);

				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['count'] = $orderList['count'];
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
		if(!empty($orderList['info']) && is_array($orderList['info'])){
			$result['result'] = 'success';
			$result['list'] = $orderList['info'];
			$result['count'] = $orderList['count'];
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
	 * @desc 获取退货款号明细列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 退货款号明细列表信息
	 * @author WuJunhua
	 * @date 2015-11-26
	 */
	public function getReturnGoodsDetailsList($page,$psize,$CondList,$sign){
		$result = [];  //获取列表数据的结果 
		$goodStatus = ddglConst::$WhetherReturns[3]; //商品已退货入仓
		$orderList = xsaaDAO::getInstance()->getReturnGoodsDetailsList($page,$psize,$goodStatus,$CondList);
		
		if($sign == 1){
			//导出退货款号明细excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[9]); //导出退货款号明细excel的字段和标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}			
				foreach($titleArr as $val){
					$selectColumnArr[] = $val['valuetype2'];	//数组重构
				}
				$selectColumnStr = implode(',', $selectColumnArr);
				if(!empty($selectColumnStr)){
					$orderList = xsaaDAO::getInstance()->getReturnGoodsDetailsList($page,$psize,$goodStatus,$CondList,$selectColumnStr);
				}
			}
			
			if(!empty($orderList['info']) && is_array($orderList['info'])){
				$data = $orderList['info'];
				$fileName = 'jx';  
				$tableName = '退货款号明细';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);
				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['count'] = $orderList['count'];
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
		if(!empty($orderList['info']) && is_array($orderList['info'])){
			$result['result'] = 'success';
			$result['list'] = $orderList['info'];
			$result['count'] = $orderList['count'];
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
	 * @desc 获取当前订单号商品列表
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2015-12-15
	 */
	public function getObtainorderdetails($orderNo){
		
		$orderList = xsabDAO::getInstance()->getObtainorderdetails($orderNo);
		return $orderList;
	}

	/**
	 * @desc 添加（修改）订单审核商品
	 * @param array $orderInfo 订单资料
	 * @param array $goodItems 商品信息
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-12-15
	 */
	public function ChangeOrderAudit($orderInfo,$goodItems,$ordernomx,$kuanhao){
		if(empty($orderInfo)){
			return array('res'=>'error','msg'=>'保存失败');
		}
		$orderNo=$orderInfo['xsab01'];
		
		//删除选择的商品详情
		$orderNum = count($ordernomx); //要删除的商品详情数量
		/*if(!empty($ordernomx)){
			for($i = 0;$i < $orderNum;$i++){
			    $deleteResult = xsabDAO::getInstance()->delete(array('xsab01'=>$orderNo,'xsab03'=>$ordernomx[$i]));
		    }
		}*/
		$orderkuanh = count($kuanhao);
		if(isset($goodItems[0])){
        	if(!empty($goodItems[0])){
        		$goodItemsArr = array_chunk($goodItems, 6);//商品数组
        	}
		}
		if(empty($goodItems[0])){
			return array('res'=>'sph','msg'=>'没有任何改变，不需要保存');
		}
		$arr2 = array_unique($kuanhao);
    	$num2 = count($arr2);
    	if(!empty($goodItems[0])){
    		 //循环判断有没有重复商品
		    for($a = 0;$a < $orderkuanh;$a++){
		    	//查询明细表有没有当前添加商品行的款号
		    	$judgment = xsabDAO::getInstance()->findByAttributes(array('xsab03'=>$kuanhao[$a],'xsab01'=>$orderNo),array('xsab03'));
		    	if (!empty($judgment)) {
		    	    return array('res'=>'tips','msg'=>'已选择与订单中相同的商品,请先删除重复商品,然后修改数量');
		        }
		    }
    	    if ($orderkuanh>$num2) {
            	return array('res'=>'tips','msg'=>'商品行中选择了相同商品,请先删除重复商品,然后修改数量');
            }else{
	    	    $goodName = ''; //库存量为0的商品
	    	    $InventoryShortage = ''; //库存量不足的商品
			    foreach($goodItemsArr as $val){
				    $goods['xsab01'] = $orderNo;
				    $goods['xsab03'] = $val[0];
	    	    	$conditionNumber = array('cpaa01' => $val[0]);

	    	    	$testGoodNumber = cpaaDAO::getInstance()->isExists($conditionNumber);
					if(empty($testGoodNumber)){
						return array('res'=>'tips','msg'=>'输入的商品款号不存在，请重新输入！');
					}

				    $goods['xsab02'] = $val[1];
	    	    	$conditionName = array('cpaa02' => $val[1]);
	    	    	$testGoodName = cpaaDAO::getInstance()->isExists($conditionName);
					if(empty($testGoodName)){
						return array('res'=>'tips','msg'=>'输入的商品名称不存在，请重新输入！');
					}

				    if(empty($goods['xsab02'])){
				    	return array('res'=>'tips','msg'=>'商品名称不能为空');
				    }
				    $hqjhj=cpaeDAO::getInstance()->getBuyingPrice($val[0]);
				    if (floatval($val[2])<floatval($hqjhj['cpjhj'])) {
				    	$chanpkh='款号'.$val[0].'的成本价为'.$hqjhj['cpjhj'].'&nbsp;&nbsp;&nbsp;';
				    	return array('res'=>'tips','msg'=>$chanpkh.'商品单价不能低于成本价');
				    }
				    $goods['xsab06'] = $goods['xsab05'] = $val[2];
				    $goods['xsab04'] = $val[3];
				    if(empty($goods['xsab04'])){
				    	return array('res'=>'tips','msg'=>'商品数量不能为空');
				    }
				    $goods['xsab08'] = $goods['xsab07'] = $val[4];
				    $goodsArr[] = $goods;
		        }
            }
	    }
	   	//遍历把商品信息插入到订单明细表
		foreach($goodsArr as $val){
			$result = xsabDAO::getInstance()->insert($val,true);
		}
	    //根据订单id累计总价，总数
        $orderList = xsabDAO::getInstance()->getTotalPrice($orderNo);
        $totalComNum = array();
        $totalComNum['xsaa17'] = 0;
        $totalComNum['xsaa19'] = 0;
        $totalComNum['xsaa42']=0;
        foreach($orderList as $val){
         	//$totalComNum['xsaa17'] += $val['xsab07'];
         	$totalComNum['xsaa19'] += $val['xsab08'];
         	$totalComNum['xsaa42']+=$val['xsab04'];
        }
        $result = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderNo),$totalComNum);

        $followInfo = array();
		$followInfo['xsad01'] = $orderNo;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = '添加商品'; //内容
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}

	    return array('res'=>'success','msg'=>'保存成功');
	}

	/**
	 * @desc 修改商品价格
	 * @author huyan
	 * @date 2015-12-29
	 */
	public function ChangeOrderprice($orderInfo,$orderno,$kuanhao,$spsl){
		if(empty($orderInfo)){
			return array('res'=>'error','msg'=>'修改失败');
		}
		$BuyingPrice = cpaeDAO::getInstance()->getBuyingPrice($kuanhao);
		if (floatval($orderInfo['xsab06'])<floatval($BuyingPrice['cpjhj'])) {
			return array('res'=>'error','msg'=>'销售价格不能低于产品价格');
		}
		//获取商品原价
		$judgment = xsabDAO::getInstance()->findByAttributes(array('xsab03'=>$kuanhao,'xsab01'=>$orderno),array('xsab05','xsab04'));
		//优惠价
		$yhjg = $judgment['xsab05']-$orderInfo['xsab06'];
		$yhzj = $yhjg*$judgment['xsab04'];
		$orderInfo['xsab10'] = $yhjg;
		$orderInfo['xsab11'] = $yhzj;
        $resultAll = xsabDAO::getInstance()->update(array('xsab03'=>$kuanhao,'xsab01'=>$orderno),$orderInfo);
        //根据订单id累计总价，总数
        $orderList = xsabDAO::getInstance()->getTotalPrice($orderno);
        $totalComNum = array();
        //$totalComNum['xsaa17'] = 0;
        $totalComNum['xsaa19'] = 0;
        $totalComNum['xsaa42']=0;
        $totalComNum['xsaa18']=0;
        foreach($orderList as $val){
         	//$totalComNum['xsaa17'] += $val['xsab07'];
         	$totalComNum['xsaa19'] += $val['xsab08'];
         	$totalComNum['xsaa42'] += $val['xsab04'];
         	$totalComNum['xsaa18'] += $val['xsab11'];
        }
        $result = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno),$totalComNum);
        $followInfo = array();
		$followInfo['xsad01'] = $orderno;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = '修改价格'; //内容
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
	    return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 修改商品数量
	 * @author huyan
	 * @date 2015-12-29
	 */
	public function ChangeOrderNumber($orderInfo,$orderno,$kuanhao){
		if(empty($orderInfo)){
			return array('res'=>'error','msg'=>'修改失败');
		}
        $result = xsabDAO::getInstance()->update(array('xsab01'=>$orderno,'xsab03'=>$kuanhao),$orderInfo);

        //获取商品原价和数量
		$judgment = xsabDAO::getInstance()->findByAttributes(array('xsab03'=>$kuanhao,'xsab01'=>$orderno),array('xsab05','xsab06'));
		//优惠价
		$yhjg = $judgment['xsab05']-$judgment['xsab06'];
		$yhzj = $yhjg*$orderInfo['xsab04'];
		//$orderInfo['xsab10'] = $yhjg;
		$orderInfo['xsab11'] = $yhzj;
        $resultAll = xsabDAO::getInstance()->update(array('xsab03'=>$kuanhao,'xsab01'=>$orderno),$orderInfo);

        //根据订单id累计总价，总数
        $orderList = xsabDAO::getInstance()->getTotalPrice($orderno);
        $totalComNum = array();
        $totalComNum['xsaa19'] = 0;
        $totalComNum['xsaa42']=0;
        $totalComNum['xsaa18']=0;
        foreach($orderList as $val){
         	//$totalComNum['xsaa17'] += $val['xsab07'];
         	$totalComNum['xsaa19'] += $val['xsab08'];
         	$totalComNum['xsaa42']+=$val['xsab04'];
         	$totalComNum['xsaa18'] += $val['xsab11'];
        }
        $result = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno),$totalComNum);

        $followInfo = array();
		$followInfo['xsad01'] = $orderno;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = '修改数量'; //内容
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
	    return array('res'=>'success','msg'=>'修改成功');
	}


	/**
	 * @desc 删除商品
	 * @author huyan
	 * @date 2015-12-29
	 */
	public function DeleteCommodity($orderno,$ordernomx){
		$orderNum = count($ordernomx); //要删除的商品数量
		if(!empty($ordernomx)){
			for($i = 0;$i < $orderNum;$i++){
				//删除选择的商品详情
			    $deleteResult = xsabDAO::getInstance()->delete(array('xsab01'=>$orderno,'xsab03'=>$ordernomx[$i]));
		    }
		}

		 //根据订单id累计总价，总数
        $orderList = xsabDAO::getInstance()->getTotalPrice($orderno);
        $totalComNum = array();
        //$totalComNum['xsaa17'] = 0;
        $totalComNum['xsaa19'] = 0;
        $totalComNum['xsaa42']=0;
        foreach($orderList as $val){
         	//$totalComNum['xsaa17'] += $val['xsab07'];
         	$totalComNum['xsaa19'] += $val['xsab08'];
         	$totalComNum['xsaa42']+=$val['xsab04'];
        }
        $result = xsaaDAO::getInstance()->update(array('xsaa02'=>$orderno),$totalComNum);


		$followInfo = array();
		$followInfo['xsad01'] = $orderno;
		$followInfo['xsad04'] = date('Y-m-d H:i:s'); //跟进时间
		$followInfo['xsad02'] = Yii::app()->session['account']; //跟进人工号
		$followInfo['xsad03'] = Yii::app()->session['name']; //跟进人姓名
		$followInfo['xsad06'] = '删除商品'; //内容
		$followInfo['xsad07'] = Yii::app()->session['account']; //安排人工号
		$followInfo['xsad08'] = Yii::app()->session['name']; //安排人姓名
		$followResult = xsadDAO::getInstance()->insert($followInfo,true);
		if(empty($followResult)){
			return array('res'=>'error','msg'=>'订单跟进记录有误');
		}
	    return array('res'=>'success','msg'=>'删除成功');
	}

}


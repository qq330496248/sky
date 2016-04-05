<?php
/**
 * @desc 供应商表相关操作类
 * @author Dengshaocong
 * @date 2015-11-24
 */
class cgabModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cgaaModel对象
	 * @return cgabModel
	 * @author Dengshaocong
	 * @date 2015-11-24
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加供应商
	 * @param array $gysInfo 供应商信息
	 * @return array $result 采购单结果信息
	 * @author Dengshaocong
	 * @date 2015-11-24
	 */
	public function addGys($gysInfo){
		if(empty($gysInfo)){
			return array('res' => 'error','mes' => '供应商信息为空');
		}

		//从数据库中获取最后一个编号，获取其中序号，重新编辑新的编号——————格式：gr年月xxxx（xxxx为四位数字，0001开始）
		$gysList = cgabDAO::getInstance()->getFinalGysNum();
		if(!empty($gysList)){
			$id = substr($gysList[0]['cgab01'],-4,4);
			$id += 1;
			$gysID = sprintf("%04d",$id);
			$gysNO = 'GY'.date('ym').$gysID;
		}else{
			$id = 1;
			$gysID = sprintf("%04d",$id);
			$gysNO = 'GY'.date('ym').$gysID;
		}
		$gysInfo['cgab01'] = $gysNO;
		$result = cgabDAO::getInstance()->insert($gysInfo,true);
		if(empty($result) || $result == false){
			return array('res' => 'false', 'mes' => '保存失败，请检查是否输入错误！');
		}
		return array('res' => 'success', 'mes' => '添加成功');
	}

	/**
	 * @desc 检验供应商是否重名
	 * @param string $name 供应商名字
	 * @return array $result 采购单结果信息
	 * @author Dengshaocong
	 * @date 2015-12-18
	 */
	public function checkExist($name){
		$result = cgabDAO::getInstance()->findByAttributes(array('cgab02'=>$name));
		return $result;
	}

	/**
	 * @desc 根据条件获取供应商信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $gysInfo 条件
	 * @author Dengshaocong
	 * @date 2015-11-25 
	 */
	public function getGysByCond($page,$psize,$gysInfo){
		$result = array();
		$gysList = cgabDAO::getInstance()->getGysByCond($page,$psize,$gysInfo);
		//print_r($gysList);die;
		if(!empty($gysList) && is_array($gysList)){
			$result['result'] = 'success';
			$result['list'] = $gysList['info'];
			$result['count'] = $gysList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 获取供应商信息
	 * @author Dengshaocong
	 * @date 2015-11-25 
	 */
	public function getGys(){
		$result = array();
		$gysList = cgabDAO::getInstance()->getGys();

		if(!empty($gysList) && is_array($gysList)){
			$result['result'] = 'success';
			$result['list'] = $gysList['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 根据分类获取供应商
	 * @param int $cpfl 分类ID
	 * @author Dengshaocong
	 * @date 2015-12-3
	 */
	public function getGysByFl($cpfl){
		$result = array();
		$gysList = cgabDAO::getInstance()->getGysByFl($cpfl);

		if(!empty($gysList) && is_array($gysList)){
			$result['result'] = 'success';
			$result['list'] = $gysList['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
	/**
	 * @desc 根据ID删除供应商
	 * @param string $id 主键
	 * @author Dengshaocong
	 * @date 2015-11-25 
	 */
	public function deleteGys($id){
		if(empty($id)){
			return array('res' => 'error','mes' => '删除错误');
		}
		$result = cgabDAO::getInstance()->deleteByPk($id);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc 根据ID获取供应商信息
	 * @param string $id 主键
	 * @author Dengshaocong
	 * @date 2015-11-25 
	 */
	public function getSingleGys($id){
		if(empty($id)){
			return array('res' => 'error','mes' => '删除错误');
		}
		$result = cgabDAO::getInstance()->findByAttributes(array('cgab01' => $id));
		return $result;
	}
	/**
	 * @desc 根据ID更改供应商
	 * @param string $id 主键
	 * @param array $gysInfo 供应商信息
	 * @author Dengshaocong
	 * @date 2015-11-25 
	 */
	public function updateGys($id,$gysInfo){
		if(empty($id) || empty($gysInfo)){
			return array('res' => 'error','mes' => '删除错误');
		}
		$result = cgabDAO::getInstance()->updateByPk($id,$gysInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，修改失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}

	/**
	 * @desc 获取所有供应商
	 * @return array $result 列表信息
	 * @author huyan
	 * @date 2016-01-12
	 */
	public function getSupplierOptions(){
		$gonghaoArr = array();
		$WorkNumList = cgabDAO::getInstance()->getSupplierOptions();
		foreach($WorkNumList as $value){
			$gonghaoArr[] = $value['cgab02'];
		}
		//判断是否查询到有数据
		if(empty($WorkNumList) || empty($gonghaoArr)){
			//return array('res'=>'error','msg'=>'获取投诉供应商');
		}
		return $gonghaoArr;
	}

	/**
	 * @desc 获取供应商统计报表（供应商列表）
	 * @param array $condInfo  查询条件
	 * @param int $page  页数
	 * @param int $psize  每页数据项
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-02-22
	 */
	public function getGysForReport($condInfo,$page,$psize){
		$result['result'] = 'success';
		$result['list'] = array();
//		$info = cgabDAO::getInstance()->getGysForReport($condInfo,$page,$psize);
		$list = $this->getGysByCond($page,$psize,$condInfo);
		$result['count'] = $list['count'];
		$gyslist = $list['list'];
		//根据取到的供应商，获取各个统计信息
		for($i = 0; $i < count($gyslist); $i ++){
			$condInfo['gysID'] = $gyslist[$i]['cgab01'];
			$condInfo['gysName'] = $gyslist[$i]['cgab02'];
			$condInfo['gysType'] = $gyslist[$i]['cgab04'];
			$condInfo['cgwy'] = $gyslist[$i]['cgab21'];
			$condInfo['cgzy'] = $gyslist[$i]['cgab23'];
			$result['list'][$i] = $this->getGysbbDetails($condInfo);
		}
		return $result;
	}

	/**
	 * @desc 获取供应商统计报表（供应商统计数据）
	 * @param array $condInfo  查询条件
	 * @return array $result 
	 * @author DengShaoocng
	 * @date 2016-02-22
	 */
	public function getGysbbDetails($condInfo){
		$result['cglist'] = cgabDAO::getInstance()->getGystjbbByCondCG($condInfo);//采购量
		$result['kclist'] = cgabDAO::getInstance()->getGystjbbByCondKC($condInfo);//库存量
		$result['fhlist'] = cgabDAO::getInstance()->getGystjbbByCondFH($condInfo);//发货量以及金额
		$result['shlist'] = cgabDAO::getInstance()->getGystjbbByCondSH($condInfo);//收货量以及金额
		$result['gysID'] = $condInfo['gysID'];
		$result['gysName'] = $condInfo['gysName'];
		$result['gysType'] = $condInfo['gysType'];
		$result['cgwy'] = $condInfo['cgwy'];
		$result['cgzy'] = $condInfo['cgzy'];
		return $result;
	}


	/**
	 * @desc 获取供应商进销存报表信息
	 * @param array $cond 查询条件
	 * @param int $page 页数
	 * @param int $psize 页显示数
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-22
	 */
	public function getGysjxcByCond($cond,$page,$psize){
		$result = array();
		$result['result'] = 'success';

		$result['beginDate'] = $cond['beginDate'];//用于页面回显
		$result['endDate'] = $cond['endDate'];//用于页面回显
		$result['totalJhNum'] = 0;//进货数
		$result['totalJhMoney'] = 0;//进货金额
		$result['totalKcNum'] = 0;//库存数
		$result['totalKcMoney'] = 0;//库存商品金额
		$result['totalKcCount'] = 0;//库存商品种类
		$result['totalFhOrders'] = 0;//发货数
		$result['totalFhMoney'] = 0;//发货金额
		$result['totalShOrders'] = 0;//收货数
		$result['totalShMoney'] = 0;//收货金额
		$result['totalShCost'] = 0;//收货成本
		$result['totalGrossProfit'] = 0;//毛利
		$result['totalProfitRatio'] = '0%';//毛利率
		//时间回显存储完之后，添加时分秒
		$cond['beginDate'] .= ' 00:00:00';
		$cond['endDate'] .= ' 23:59:59';

		$gysList = cgabDAO::getInstance()->getAllGysByCond($page,$psize,$cond);

		$result['count'] = $gysList['count'];

		$count = count($gysList['info']);
		for ($i=0; $i < $count; $i++) { 
			$cond['gysid'] = $gysList['info'][$i]['cgab01'];
			$cond['gysname'] = $gysList['info'][$i]['cgab02'];
			$cond['jkfs'] = $gysList['info'][$i]['cgab15'];
			$cond['cgwy'] = $gysList['info'][$i]['cgab21'];
			$cond['cgzy'] = $gysList['info'][$i]['cgab23'];
			$cond['tjsj'] = $gysList['info'][$i]['cgab17'];
			$demoList = $this->getGsjxcDetails($cond);
			$result['list'][$i] = $demoList;

			$result['totalJhNum'] += $demoList['jhNum'];//进货数
			$result['totalJhMoney'] += $demoList['jhMoney'];//进货金额
			$result['totalKcNum'] += $demoList['kcNum'];//库存数
			$result['totalKcMoney'] += $demoList['kcMoney'];//库存商品金额
			$result['totalKcCount'] += $demoList['kcCount'];//库存商品种类
			$result['totalFhOrders'] += $demoList['fhOrders'];//发货数
			$result['totalFhMoney'] += $demoList['fhMoney'];//发货金额
			$result['totalShOrders'] += $demoList['shOrders'];//收货数
			$result['totalShMoney'] += $demoList['shMoney'];//收货金额
			$result['totalShCost'] += $demoList['shCost'];//收货成本
			$result['totalGrossProfit'] += $demoList['grossProfit'];//毛利
		}
		if($result['totalJhMoney'] > 0){
			$result['totalProfitRatio'] = sprintf('%.2f',$result['totalGrossProfit']/$result['totalJhMoney']*100).'%';
		}
		return $result;
	}

	/**
	 * @desc 获取供应商进销存报表明细
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-22
	 */
	public function getGsjxcDetails($cond){
		$result['gysid'] = $cond['gysid'];
		$result['gysname'] = $cond['gysname'];
		$result['jkfs'] = $cond['jkfs'];
		$result['cgwy'] = $cond['cgwy'];
		$result['cgzy'] = $cond['cgzy'];
		$result['tjsj'] = $cond['tjsj'];
		$result['profitRatio'] = '0%';

		$jhList = cgaaDAO::getInstance()->getMygysjxcByCondJH($cond);//进货信息
		$kcList = cpaaDAO::getInstance()->getMygysjxcByCondKC($cond);//库存信息
		$fhList = cpaaDAO::getInstance()->getMygysjxcByCond($cond,"'已发货','交易成功'");//发货信息
		$shList = cpaaDAO::getInstance()->getMygysjxcByCond($cond,"'交易成功'");//收货信息

		$result['jhNum'] = $jhList['num'];
		$result['jhMoney'] = $jhList['money'];
		$result['kcNum'] = $kcList['num'];
		$result['kcMoney'] = $kcList['money'];
		$result['kcCount'] = $kcList['count'];
		$result['fhOrders'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['shOrders'] = $shList['orders'];
		$result['shMoney'] = $shList['money'];
		$result['shCost'] = $shList['cost'];
		$result['grossProfit'] = $shList['money'] - $jhList['money'];
		if($result['jhMoney'] > 0){
			$result['profitRatio'] = sprintf('%.2f',$result['grossProfit']/$result['jhMoney']*100).'%';
		}
		return $result;
	}
}
?>
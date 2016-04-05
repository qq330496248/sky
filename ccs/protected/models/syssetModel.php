<?php
/**
 * @desc 系统配置表相关操作类
 * @author WuJunhua
 * @date 2015-11-01
 */
class syssetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回syssetModel对象
	 * @return syssetModel
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取工号所在组的选项卡信息
	 * @return array $result 工号所在组选项卡的结果信息
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public function getGroupsType($ghszz){
		$result = array();  //工号所在组选项卡的结果信息
		$groupsTypeList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $ghszz));
		if(empty($groupsTypeList)){
			return false;
		}
		foreach($groupsTypeList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取手机类型选项卡信息
	 * @return array $result 手机类型选项卡的结果信息
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public function getPhoneType($sjlx){
		$result = array();  //手机类型选项卡的结果信息
		$phoneTypeList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $sjlx));
		if(empty($phoneTypeList)){
			return false;
		}
		foreach($phoneTypeList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 客户等级选项卡信息
	 * @return array $result 客户等级选项卡的结果信息
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public function getCustomerLevel($khdj){
		$result = array();  //手机类型选项卡的结果信息
		$customerLevelList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $khdj));
		if(empty($customerLevelList)){
			return false;
		}
		foreach($customerLevelList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}
	

	/**
	 * @desc 客户意向选项卡信息
	 * @return array $result客户意向选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getCustomerIntention($khyx){
		$result = array();  //客户意向结果信息
		$CustomerlList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $khyx));
		if(empty($CustomerlList)){
			return false;
		}
		foreach($CustomerlList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 客户进线方式选项卡信息
	 * @return array $result客户进线方式选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getIntoLine($jxfs){
		$result = array();  //客户进线方式结果信息
		$IntoLineList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $jxfs));
		if(empty($IntoLineList)){
			return false;
		}
		foreach($IntoLineList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}
	
	/**
	 * @desc 客户来源选项卡信息
	 * @return array $result客户来源选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getClientSource($khly){
		$result = array();  //客户来源结果信息
		$ClientSourceList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $khly));
		if(empty($ClientSourceList)){
			return false;
		}
		foreach($ClientSourceList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	
	/**
	 * @desc 客户学历选项卡信息
	 * @return array $result客户学历选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getEducation($khxl){
		$result = array();  //客户学历结果信息
		$EducationList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $khxl));
		if(empty($EducationList)){
			return false;
		}
		foreach($EducationList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 客户职业选项卡信息
	 * @return array $result 客户职业选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getOccupation($khzy){
		$result = array();  // 客户职业结果信息
		$OccupationList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $khzy));
		if(empty($OccupationList)){
			return false;
		}
		foreach($OccupationList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 客户收入选项卡信息
	 * @return array $result 客户收入选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getIncome($khsr){
		$result = array();  // 客户收入结果信息
		$IncomeList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $khsr));
		if(empty($IncomeList)){
			return false;
		}
		foreach($IncomeList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 客户跟进标签选项卡信息
	 * @return array $result 客户跟进标签选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getkehuIntoLine($gjbq){
		$result = array();  //客户跟进标签结果信息
		$kehuIntoLineList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $gjbq));
		if(empty($kehuIntoLineList)){
			return false;
		}
		foreach($kehuIntoLineList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}
	
	/**
	 * @desc 购买次数选项卡信息
	 * @return array $result 购买次数选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getPurchaseNumber($gmcs){
		$result = array();  //购买次数结果信息
		$PurchaseNumberList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $gmcs));
		if(empty($PurchaseNumberList)){
			return false;
		}
		foreach($PurchaseNumberList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	
	/**
	 * @desc 是否成交选项卡信息
	 * @return array $result是否成交选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getWhetherNot($sfcj){
		$result = array();  //是否成交结果信息
		$WhetherNotList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $sfcj));
		if(empty($WhetherNotList)){
			return false;
		}
		foreach($WhetherNotList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 是否完成选项卡信息
	 * @return array $result是否完成选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getIsComplete($sfwc){
		$result = array();  //是否完成结果信息
		$IsCompleteList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $sfwc));
		if(empty($IsCompleteList)){
			return false;
		}
		foreach($IsCompleteList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}
	
	/**
	 * @desc 是否处理选项卡信息
	 * @return array $result是否处理选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-01
	 */
	public function getIsFinishing($sfcl){
		$result = array();  //是否处理结果信息
		$IsFinishingList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $sfcl));
		if(empty($IsFinishingList)){
			return false;
		}
		foreach($IsFinishingList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}


	/**
	 * @desc 处理结果选项卡信息
	 * @return array $result是否处理选项卡的结果信息
	 * @author huyan
	 * @date 2015-12-3
	 */
	public function getProcessing($cljg){
		$result = array();  //是否处理结果信息
		$IsFinishingList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $cljg));
		if(empty($IsFinishingList)){
			return false;
		}
		foreach($IsFinishingList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 供应商列表信息
	 * @return array $result 供应商列表结果信息
	 * @author huyan
	 * @date 2015-11-12
	 */
	public function getSuppliers($gyslb){
		$result = array();  //供应商列表结果信息
		/*typeencode:编号（A025）
		valuetype1:对应的值（中国联通，中国移动）*/
		$SupplierslList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $gyslb));
		if(empty($SupplierslList)){
			return false;
		}
		foreach($SupplierslList as $val){
			$result[$val['id']] = $val['valuetype1'];//数组重构
		}
		return $result;
	}
	/**
	 * @desc 客户意向信息
	 * @return array $result 供应商列表结果信息
	 * @author huyan
	 * @date 2015-11-12
	 */
	public function getKhyx(){
		$khyx = syssetDAO::getInstance()->getKhyx();
		//判断是否查询到有数据
		if(!empty($khyx) && is_array($khyx)){
			$result['result'] = 'success';
			$result['list'] = $khyx['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc  获取订单审核状态
	 * @return array $result 结果信息
	 * @author huyan
	 * @date 2015-11-25
	 */
	public function getAuditStatus($ddshzt){
		$result = array();  // 订单审核状态结果信息
		$ddshztList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $ddshzt));
		if(empty($ddshztList)){
			return false;
		}
		foreach($ddshztList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}


	/**
	 * @desc 库存数选项卡信息
	 * @return array $result库存数选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-25
	 */
	public function getInventoryNumber($kcs){
		$result = array();  //库存数结果信息
		$InventoryNumberlList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $kcs));
		if(empty($InventoryNumberlList)){
			return false;
		}
		foreach($InventoryNumberlList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}
	/**
	 * @desc 上架下架选项卡信息
	 * @return array $result上架下架选项卡的结果信息
	 * @author huyan
	 * @date 2015-11-25
	 */
	public function getUpperLowerFrame($sjxj){
		$result = array();  //上架下架结果信息
		$UpperLowerFramelList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $sjxj));
		if(empty($UpperLowerFramelList)){
			return false;
		}
		foreach($UpperLowerFramelList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 添加客户意向
	 * @param array $khyxInfo 客户意向资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function addKhyx($khyxInfo){
		if(empty($khyxInfo)){
			return array('res'=>'error','msg'=>'相关信息不完整，添加失败');
		}
		$result = syssetDAO::getInstance()->insert($khyxInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 根据主键修改一个客户意向
	 * @param int $id ID
	 * @param array $khyxInfo 修改信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function updateKhyx($id,$khyxInfo){
		if(empty($id) || empty($khyxInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = syssetDAO::getInstance()->updateByPk($id,$khyxInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'修改错误');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}

	/**
	 * @desc 根据主键删除一个客户意向
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function deleteKhyx($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = syssetDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc  获取会员等级
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-1
	 */
	public function getHydj(){
		$hydj = syssetDAO::getInstance()->getHydj();
		//判断是否查询到有数据
		if(!empty($hydj) && is_array($hydj)){
			$result['result'] = 'success';
			$result['list'] = $hydj['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
	/**
	 * @desc 添加会员等级
	 * @param array $hydjInfo 会员等级资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function addHydj($hydjInfo){
		if(empty($hydjInfo)){
			return array('res'=>'error','msg'=>'相关信息不完整，添加失败');
		}
		$result = syssetDAO::getInstance()->insert($hydjInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 根据主键修改一个客户意向
	 * @param int $id ID
	 * @param array $hydjInfo 修改信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function updateHydj($id,$hydjInfo){
		if(empty($id) || empty($hydjInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = syssetDAO::getInstance()->updateByPk($id,$hydjInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据主键删除一个客户意向
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function deleteHydj($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = syssetDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc  获取跟进标签
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-1
	 */
	public function getKhgjbq(){
		$khgjbq = syssetDAO::getInstance()->getKhgjbq();
		//判断是否查询到有数据
		if(!empty($khgjbq) && is_array($khgjbq)){
			$result['result'] = 'success';
			$result['list'] = $khgjbq['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
	/**
	 * @desc 添加客户意向
	 * @param array $hydjInfo 会员等级资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function addKhgjbq($khgjbqInfo){
		if(empty($khgjbqInfo)){
			return array('res'=>'error','msg'=>'相关信息不完整，添加失败');
		}
		$result = syssetDAO::getInstance()->insert($khgjbqInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 根据主键修改一个客户意向
	 * @param int $id ID
	 * @param array $hydjInfo 修改信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function updateKhgjbq($id,$khgjbqInfo){
		if(empty($id) || empty($khgjbqInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = syssetDAO::getInstance()->updateByPk($id,$khgjbqInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据主键删除一个客户意向
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function deleteKhgjbq($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = syssetDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc  获取电话黑名单
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function getDhhmd(){
		$dhhmd = syssetDAO::getInstance()->getDhhmd();
		//判断是否查询到有数据
		if(!empty($dhhmd) && is_array($dhhmd)){
			$result['result'] = 'success';
			$result['list'] = $dhhmd['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
	/**
	 * @desc  添加电话黑名单
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-17
	 * @modify 2016-03-18 WuJunhua 增加重复号码的验证
	 */
	public function addDhhmd($dhhmdInfo){
		if(empty($dhhmdInfo)){
			return array('res'=>'error','msg'=>'相关信息不完整，添加失败');
		}
		$conditionPhone = array('typeencode' => $dhhmdInfo['typeencode'],'valuetype1' => $dhhmdInfo['valuetype1']);
    	$testPhone = syssetDAO::getInstance()->isExists($conditionPhone);
		if(!empty($testPhone)){
			return array('res'=>'error','msg'=>'该号码已被添加进电话黑名单,请重新操作');
		}
		$result = syssetDAO::getInstance()->insert($dhhmdInfo);
		if(empty($result)){
			return array('res'=>'error','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	
	/**
	 * @desc  删除电话黑名单
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function deleteDhhmd($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'操作有误,删除失败');
		}
		$result = syssetDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'error','msg'=>'删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}

	/**
	 * @desc  更新职业列表
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function updateZy($zyInfo){
		if(empty($zyInfo)){
			return array('res'=>'error','msg'=>'信息错误');
		}
		syssetDAO::getInstance()->delete(array('typeencode' => 'A017'));
		$zyArr = array();
		$zyArr['typeencode'] = 'A017';
		foreach($zyInfo as $value){
			$zyArr['valuetype1'] = $value;
			syssetDAO::getInstance()->insert($zyArr);
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc  获取职业列表
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function getZy(){
		$zy = syssetDAO::getInstance()->getZy();
		//判断是否查询到有数据
		if(!empty($zy) && is_array($zy)){
			$result['result'] = 'success';
			$result['list'] = $zy['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc  更新短信关键字列表
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-24
	 */
	public function updateDxgjz($gjzInfo){
		if(empty($gjzInfo)){
			return array('res'=>'error','mes'=>'信息错误');
		}
		syssetDAO::getInstance()->delete(array('typeencode' => 'A030'));
		$gjzArr = array();
		$gjzArr['typeencode'] = 'A030';
		foreach($gjzInfo as $value){
			$gjzArr['valuetype1'] = $value;
			syssetDAO::getInstance()->insert($gjzArr);
		}
		return array('res'=>'success','mes'=>'修改成功');
	}
	/**
	 * @desc  获取屏蔽的短信关键字列表
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-18
	 */
	public function getDxgjz(){
		$gjz = syssetDAO::getInstance()->getDxgjz();

		if(!empty($gjz) && is_array($gjz)){
			$result['result'] = 'success';
			$result['list'] = $gjz['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc  更新电话加拨的号码
	 * @param array 包含电话加拨号码的数组
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-22
	 */
	public function updateDhjb($info){
		if(empty($info)){
			return array('res'=>'error','mes'=>'更新错误');
		}
		$result = syssetDAO::getInstance()->update(array('typeencode'=>'A032'),$info);
		if(empty($result)){
			return array('res'=>'false','mes'=>'更新失败');
		}
		return array('res'=>'success','mes'=>'更新成功');
	}

	/**
	 * @desc  获取电话加拨的号码
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-22
	 */
	public function getDhjb(){
		$result = syssetDAO::getInstance()->findByAttributes(array('typeencode'=>'A032'));
		return $result;
	}
	
	

	/**
	 * @desc 获取列名信息（导入导出EXCEL）
	 * @param $page int 页数
	 * @param $psize int 每页显示条数
	 * @param $type string 类型
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function getCol($page,$psize,$type){
		if(empty($type)){
			return array('res'=>'error','msg'=>'错误');
		}
		$col = syssetDAO::getInstance()->getCol($page,$psize,$type);

		if(!empty($col) && is_array($col)){
			$result['result'] = 'success';
			$result['list'] = $col['info'];
			$result['count'] = $col['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 修改列名信息（导入导出EXCEL）
	 * @param $id int ID
	 * @param $info array 列名信息
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function updateCol($id,$info){
		if(empty($id)||empty($info)){
			return array('res'=>'error','msg'=>'修改出错');
		}
		$result = syssetDAO::getInstance()->updateByPk($id,$info);
		if(empty($result)){
			return array('res'=>'false','msg'=>'修改失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}

	/**
	 * @desc 清空列名序号（导入导出EXCEL）
	 * @param $id int ID
	 * @author DengShaocong
	 * @date 2016-01-29
	 */
	public function emptyCol($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'清空出错');
		}
		$info['valuetype4'] = '';
		$result = syssetDAO::getInstance()->updateByPk($id,$info);
		if(empty($result)){
			return array('res'=>'false','msg'=>'清空失败');
		}
		return array('res'=>'success','msg'=>'清空成功');
	}

	/**
	 * @desc  获取导入数据库的字段模板
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-28
	 */
	public function getDBList($type){
		if(empty($type)){
			return array('res'=>'error','msg'=>'出错');
		}
		$info = syssetDAO::getInstance()->getDBList($type);
		return $info['info'];
	}

	/**
	 * @desc 添加列名
	 * @param $id int ID
	 * @author DengShaocong
	 * @date 2016-02-01
	 */
	public function addCol($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'添加出错');
		}
		$info['valuetype4'] = '000';
		$result = syssetDAO::getInstance()->updateByPk($id,$info);
		if(empty($result)){
			return array('res'=>'false','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功，请修改序号');
	}

	/**
	 * @desc  获取导入数据库的字段模板
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-28
	 */
	public function getDBInfo($type){
		if(empty($type)){
			return array('res'=>'error','msg'=>'出错');
		}
		$info = syssetDAO::getInstance()->getDBInfo($type);
		return $info['info'];
	}

	/**
	 * @desc  获取进线方式
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-17
	 */
	public function getInLineMethods(){
		$methods = syssetDAO::getInstance()->findAllByAttributes(array('typeencode'=>'A008'));
		return $methods;
	}

	/**
	 * @desc  获取意向报表——获取意向信息
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-17
	 */
	public function getYxbbByCond($cond){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'today':
				$cond['beginDate'] = date('Y-m-d');
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'yesterday':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				break;

			case 'seven':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -7 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'thirty':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -30 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'month':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = $dateList1[0].'-'.$dateList1[1].'-01' ;
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'lastDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
				break;

			case 'nextDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +1 day '));
				break;

			case 'lastSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -7 day '));
				break;

			case 'nextSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +7 day '));
				break;

			case 'lastThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -30 day '));
				break;

			case 'nextThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +30 day '));
				break;

			case 'lastMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' -1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' -1 day '));
				break;

			case 'nextMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' +1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' +2 month -1 day '));
				break;

			default:

				break;
		}

		$result = array();
		$result['result'] = 'success';
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['peopleNum'] = 0;//总客户数
		$result['xdCount'] = 0;//总下单数
		$result['xdMoney'] = 0;//总下单金额
		$result['sdCount'] = 0;//总审单数
		$result['sdMoney'] = 0;//总审单金额
		$result['fhCount'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['qsCount'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额

		$yxList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode'=>'A016'));
		for($i = 0; $i < count($yxList); $i ++){
			$cond['yx'] = $yxList[$i]['valuetype1'];
			$demoList = $this->getYxbbDetails($cond);
			$result['list'][$i] = $demoList;
			//各项相加
			$result['peopleNum'] += $demoList['peopleNum'];
			$result['xdCount'] += $demoList['xdOrders'];
			$result['xdMoney'] += $demoList['xdMoney'];
			$result['sdCount'] += $demoList['sdOrders'];
			$result['sdMoney'] += $demoList['sdMoney'];
			$result['fhCount'] += $demoList['fhOrders'];
			$result['fhMoney'] += $demoList['fhMoney'];
			$result['qsCount'] += $demoList['qsOrders'];
			$result['qsMoney'] += $demoList['qsMoney'];
		}
		return $result;
	}

	/**
	 * @desc 根据类型编码获取对应的值 【公用的方法】   *******上面很多方法都重复了，需要优化！！！*********
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-02-19
	 */
	public function getInformation($typeencode){
		$result = [];  //结果信息
		$res = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $typeencode),array('id','valuetype1'));
		if(empty($res)){
			return false;
		}
		foreach($res as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc  获取意向报表——获取报表信息
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-17
	 */
	public function getYxbbDetails($cond){
		$result['peopleNum'] = syssetDAO::getInstance()->getYxbbByCondRS($cond)['num'];
		$xdList = syssetDAO::getInstance()->getYxbbByCond($cond,"'已确认','待发货','已发货','拒收','交易成功'");//下单信息
		$sdList = syssetDAO::getInstance()->getYxbbByCond($cond,"'待发货','已发货','拒收','交易成功'");//审单信息
		$fhList = syssetDAO::getInstance()->getYxbbByCond($cond,"'已发货','拒收','交易成功'");//发货信息
		$qsList = syssetDAO::getInstance()->getYxbbByCond($cond,"'交易成功'");//签收信息

		$result['xdOrders'] = $xdList['orders'];
		$result['xdMoney'] = $xdList['money'];
		$result['sdOrders'] = $sdList['orders'];
		$result['sdMoney'] = $sdList['money'];
		$result['fhOrders'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['qsOrders'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];

		$result['yx'] = $cond['yx'];
		return $result;
	}

	/**
	 * @desc  获取进线方式报表——获取进线方式信息
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getJxfstjbbByCond($cond){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'today':
				$cond['beginDate'] = date('Y-m-d');
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'yesterday':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				break;

			case 'seven':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -7 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'thirty':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -30 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'month':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = $dateList1[0].'-'.$dateList1[1].'-01' ;
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'lastDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
				break;

			case 'nextDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +1 day '));
				break;

			case 'lastSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -7 day '));
				break;

			case 'nextSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +7 day '));
				break;

			case 'lastThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -30 day '));
				break;

			case 'nextThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +30 day '));
				break;

			case 'lastMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' -1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' -1 day '));
				break;

			case 'nextMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' +1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' +2 month -1 day '));
				break;

			default:

				break;
		}

		$result['result'] = 'success';
		$result['list'] = array();
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['peopleNum'] = 0;//总客户数
		$result['xdCount'] = 0;//总下单数
		$result['xdMoney'] = 0;//总下单金额
		$result['sdCount'] = 0;//总审单数
		$result['sdMoney'] = 0;//总审单金额
		$result['fhCount'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['qsCount'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额
		$result['jsCount'] = 0;//总签收数
		$result['jsMoney'] = 0;//总签收金额

		$jxfsList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode'=>'A008'));
		for($i = 0; $i < count($jxfsList); $i ++){
			$cond['jxfs'] = $jxfsList[$i]['valuetype1'];
			$demoList =  $this->getJxfstjbbDetails($cond);//临时array
			$result['list'][$i] = $demoList;

			$result['peopleNum'] += $demoList['people']['num'];//总客户数
			$result['xdCount'] += $demoList['xdList']['orders'];//总下单数
			$result['xdMoney'] += $demoList['xdList']['money'];//总下单金额
			$result['sdCount'] += $demoList['sdList']['orders'];//总审单数
			$result['sdMoney'] += $demoList['sdList']['money'];//总审单金额
			$result['fhCount'] += $demoList['fhList']['orders'];//总发货数
			$result['fhMoney'] += $demoList['fhList']['money'];//总发货金额
			$result['qsCount'] += $demoList['qsList']['orders'];//总签收数
			$result['qsMoney'] += $demoList['qsList']['money'];//总签收金额
			$result['jsCount'] += $demoList['jsList']['orders'];//总签收数
			$result['jsMoney'] += $demoList['jsList']['money'];//总签收金额
		}
		return $result;
	}

	/**
	 * @desc  获取进线方式报表——获取进线方式报表信息
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getJxfstjbbDetails($cond){
		$result['people'] = syssetDAO::getInstance()->getJxfstjbbByCondRS($cond);
		$result['xdList'] = syssetDAO::getInstance()->getJxfstjbbByCond($cond,"'未确认','已确认','已发货','拒收','交易成功'");
		$result['sdList'] = syssetDAO::getInstance()->getJxfstjbbByCond($cond,"'已确认','已发货','拒收','交易成功'");
		$result['fhList'] = syssetDAO::getInstance()->getJxfstjbbByCond($cond,"'已发货','拒收','交易成功'");
		$result['qsList'] = syssetDAO::getInstance()->getJxfstjbbByCond($cond,"'拒收'");
		$result['jsList'] = syssetDAO::getInstance()->getJxfstjbbByCond($cond,"'交易成功'");
		$result['jxfs'] = $cond['jxfs'];
		return $result;
	}

	/**
	 * @desc  修改默认省市区地址信息 
	 * @param array $deafultAddr 地址信息
	 * @author DengShaocong
	 * @date 2016-03-04
	 */
	public function updateDeafultAddr($deafultAddr){
		if(empty($deafultAddr)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = syssetDAO::getInstance()->update(array('typeencode'=>'A034'),$deafultAddr);
		if(!empty($result)){
			return array('res'=>'success','msg'=>'修改成功');
		}
		return array('res'=>'false','msg'=>'修改失败');
	}

	/**
	 * @desc  获取默认省市区地址信息 
	 * @author DengShaocong
	 * @date 2016-03-04
	 */
	public function getDeafultAddr(){
		$demoList = syssetDAO::getInstance()->findByAttributes(array('typeencode'=>'A034'));
		//分割省市区信息
		$demoStr = explode('-', $demoList['valuetype1']);
		$province = explode('.', $demoStr[0]);
		$city = explode('.', $demoStr[1]);
		$area = explode('.', $demoStr[2]);
		$result['openOrClose'] = $demoList['valuetype2'];
		$result['provinceID'] = $province[0];
		$result['province'] = $province[1];
		$result['cityID'] = $city[0];
		$result['city'] = $city[1];
		$result['areaID'] = $area[0];
		$result['area'] = $area[1];
		return $result;
	}

	/**
	 * @desc 获取异动原因选项卡信息
	 * @return array $result 异动原因选项卡的结果信息
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function getReasonOptions($ydyy){
		$result = array();  //手机类型选项卡的结果信息
		$ReasonTypeList = syssetDAO::getInstance()->findAllByAttributes(array('typeencode' => $ydyy));
		if(empty($ReasonTypeList)){
			return false;
		}
		foreach($ReasonTypeList as $val){
			$result[$val['id']] = $val['valuetype1'];	//数组重构
		}
		return $result;
	}


	/**
	 * @desc  获取意向报表图表显示
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getYxtjbbChart($cond){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'days':
				//日期重置，从今天开始计算
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'weeks':
				//日期重置，从今天开始计算
				$w = date("w" ,strtotime(date('Y-m-d')));
				$cond['endDate'] = date('Y-m-d');
				for ($i=0; $w < 6; $i++) { 
					$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'] . '+1 day '));
					$w = date("w" ,strtotime($cond['endDate']));
				}
				break;
			case 'months':
				//日期重置，从今天开始计算
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime(date('Y-m-d'))).' +1 month -1 day '));
				break;

			case 'lastFifteenDays':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 day '));
				break;

			case 'nextFifteenDays':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 day '));
				break;

			case 'lastFifteenWeeks':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 week '));
				break;

			case 'nextFifteenWeeks':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 week '));
				break;

			case 'lastFifteenMonths':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 month '));
				break;

			case 'nextFifteenMonths':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 month '));
				break;

			default:

				break;
		}
		$result['result'] = 'success';
		$result['endDate'] = $cond['endDate'];
		$result['totalXdNum'] = 0;//总下单数
		$result['totalXdMoney'] = 0;//总下单金额
		$result['totalSdNum'] = 0;//总审单数
		$result['totalSdMoney'] = 0;//总审单金额
		$result['totalFhNum'] = 0;//总发货数
		$result['totalFhMoney'] = 0;//总发货金额
		$result['totalQsNum'] = 0;//总签收数
		$result['totalQsMoney'] = 0;//总签收金额
		//循环获取数据
		for ($i=0; $i < 15; $i++) { 
			$result['list'][$i] = $this->getYxtjbbChartDetails($cond);

			//各项相加
			$result['totalXdNum'] += $result['list'][$i]['xdNum'];//总下单数
			$result['totalXdMoney'] += $result['list'][$i]['xdMoney'];//总下单金额
			$result['totalSdNum'] += $result['list'][$i]['sdNum'];//总审单数
			$result['totalSdMoney'] += $result['list'][$i]['sdMoney'];//总审单金额
			$result['totalFhNum'] += $result['list'][$i]['fhNum'];//总发货数
			$result['totalFhMoney'] += $result['list'][$i]['fhMoney'];//总发货金额
			$result['totalQsNum'] += $result['list'][$i]['qsNum'];//总签收数
			$result['totalQsMoney'] += $result['list'][$i]['qsMoney'];//总签收金额

			if(strpos($cond['day'],'ays') !== false){
				//前一天 - 1 day
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
			}else if(strpos($cond['day'],'eeks') !== false){
				//前一周
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 week '));
			}else{
				//有点错误导致第一次 - 1 month 是减少30天，所以先获取本月的一号，再往前减一天
				$cond['endDate'] = date("Y-m-d" ,strtotime(date("Y-m-01" ,strtotime($cond['endDate'])).' - 1 day '));
			}
		}
		return $result;
	}

	/**
	 * @desc 获取意向统计图表——详情
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getYxtjbbChartDetails($cond){
		//获取前一天（周，月）的信息
		if(strpos($cond['day'],'ays') !== false){
			$cond['beginDate'] = $cond['endDate'];
		}else if(strpos($cond['day'],'eeks') !== false){
			$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 week + 1 day '));
		}else{
			$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 month + 1 day '));
		}

		//返回表格的日期内容
		$result['beginDate'] = $cond['beginDate'];
		$result['endDate'] = '';
		if(strpos($cond['day'],'ays') === false){
			$result['endDate'] = ' 到 '.$cond['endDate'];
		}

		//返回显示需要的日期内容
		if(strpos($cond['day'],'ays') !== false){
			//月-日
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[1].'-'.$days[2];
		}else if(strpos($cond['day'],'eeks') !== false){
			//年月日
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[0].$days[1].$days[2];
		}else{
			//年-月
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[0].'-'.$days[1];
		}

		$xdlist = syssetDAO::getInstance()->getYxtjbbChart($cond,"'未确认','已确认','待发货','已发货','拒收','交易成功'");//下单信息
		$sdlist = syssetDAO::getInstance()->getYxtjbbChart($cond,"'待发货','已发货','拒收','交易成功'");//审单信息
		$fhlist = syssetDAO::getInstance()->getYxtjbbChart($cond,"'已发货','拒收','交易成功'");//发货信息
		$qslist = syssetDAO::getInstance()->getYxtjbbChart($cond,"'交易成功'");//签收信息

		$result['xdNum'] = $xdlist['orders'];
		$result['xdMoney'] = $xdlist['money'];
		$result['sdNum'] = $sdlist['orders'];
		$result['sdMoney'] = $sdlist['money'];
		$result['fhNum'] = $fhlist['orders'];
		$result['fhMoney'] = $fhlist['money'];
		$result['qsNum'] = $qslist['orders'];
		$result['qsMoney'] = $qslist['money'];

		return $result;
	}

	/**
	 * @desc  获取进线方式报表图表显示
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getJxfstjbbChart($cond){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'days':
				//日期重置，从今天开始计算
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'weeks':
				//日期重置，从今天开始计算
				$w = date("w" ,strtotime(date('Y-m-d')));
				$cond['endDate'] = date('Y-m-d');
				for ($i=0; $w < 6; $i++) { 
					$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'] . '+1 day '));
					$w = date("w" ,strtotime($cond['endDate']));
				}
				break;
			case 'months':
				//日期重置，从今天开始计算
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime(date('Y-m-d'))).' +1 month -1 day '));
				break;

			case 'lastFifteenDays':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 day '));
				break;

			case 'nextFifteenDays':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 day '));
				break;

			case 'lastFifteenWeeks':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 week '));
				break;

			case 'nextFifteenWeeks':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 week '));
				break;

			case 'lastFifteenMonths':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -15 month '));
				break;

			case 'nextFifteenMonths':
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +15 month '));
				break;

			default:

				break;
		}
		$result['result'] = 'success';
		$result['endDate'] = $cond['endDate'];
		$result['totalXdNum'] = 0;//总下单数
		$result['totalXdMoney'] = 0;//总下单金额
		$result['totalSdNum'] = 0;//总审单数
		$result['totalSdMoney'] = 0;//总审单金额
		$result['totalFhNum'] = 0;//总发货数
		$result['totalFhMoney'] = 0;//总发货金额
		$result['totalJsNum'] = 0;//总拒收数
		$result['totalJsMoney'] = 0;//总拒收金额
		$result['totalQsNum'] = 0;//总签收数
		$result['totalQsMoney'] = 0;//总签收金额
		//循环获取数据
		for ($i=0; $i < 15; $i++) { 
			$result['list'][$i] = $this->getJxfstjbbChartDetails($cond);

			//各项相加
			$result['totalXdNum'] += $result['list'][$i]['xdNum'];//总下单数
			$result['totalXdMoney'] += $result['list'][$i]['xdMoney'];//总下单金额
			$result['totalSdNum'] += $result['list'][$i]['sdNum'];//总审单数
			$result['totalSdMoney'] += $result['list'][$i]['sdMoney'];//总审单金额
			$result['totalFhNum'] += $result['list'][$i]['fhNum'];//总发货数
			$result['totalFhMoney'] += $result['list'][$i]['fhMoney'];//总发货金额
			$result['totalJsNum'] += $result['list'][$i]['jsNum'];//总拒收数
			$result['totalJsMoney'] += $result['list'][$i]['jsMoney'];//总拒收金额
			$result['totalQsNum'] += $result['list'][$i]['qsNum'];//总签收数
			$result['totalQsMoney'] += $result['list'][$i]['qsMoney'];//总签收金额

			if(strpos($cond['day'],'ays') !== false){
				//前一天 - 1 day
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
			}else if(strpos($cond['day'],'eeks') !== false){
				//前一周
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 week '));
			}else{
				//有点错误导致第一次 - 1 month 是减少30天，所以先获取本月的一号，再往前减一天
				$cond['endDate'] = date("Y-m-d" ,strtotime(date("Y-m-01" ,strtotime($cond['endDate'])).' - 1 day '));
			}
		}
		return $result;
	}

	/**
	 * @desc 获取进线方式统计图表——详情
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-30
	 */
	public function getJxfstjbbChartDetails($cond){
		//获取前一天（周，月）的信息
		if(strpos($cond['day'],'ays') !== false){
			$cond['beginDate'] = $cond['endDate'];
		}else if(strpos($cond['day'],'eeks') !== false){
			$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 week + 1 day '));
		}else{
			$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 month + 1 day '));
		}

		//返回表格的日期内容
		$result['beginDate'] = $cond['beginDate'];
		$result['endDate'] = '';
		if(strpos($cond['day'],'ays') === false){
			$result['endDate'] = ' 到 '.$cond['endDate'];
		}

		//返回显示需要的日期内容
		if(strpos($cond['day'],'ays') !== false){
			//月-日
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[1].'-'.$days[2];
		}else if(strpos($cond['day'],'eeks') !== false){
			//年月日
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[0].$days[1].$days[2];
		}else{
			//年-月
			$days = explode('-', $cond['endDate']);
			$result['day'] = $days[0].'-'.$days[1];
		}

		$xdlist = syssetDAO::getInstance()->getJxfstjbbChart($cond,"'未确认','已确认','待发货','已发货','拒收','交易成功'");//下单信息
		$sdlist = syssetDAO::getInstance()->getJxfstjbbChart($cond,"'待发货','已发货','拒收','交易成功'");//审单信息
		$fhlist = syssetDAO::getInstance()->getJxfstjbbChart($cond,"'已发货','拒收','交易成功'");//发货信息
		$jslist = syssetDAO::getInstance()->getJxfstjbbChart($cond,"'拒收'");//拒收
		$qslist = syssetDAO::getInstance()->getJxfstjbbChart($cond,"'交易成功'");//签收信息

		$result['xdNum'] = $xdlist['orders'];
		$result['xdMoney'] = $xdlist['money'];
		$result['sdNum'] = $sdlist['orders'];
		$result['sdMoney'] = $sdlist['money'];
		$result['fhNum'] = $fhlist['orders'];
		$result['fhMoney'] = $fhlist['money'];
		$result['jsNum'] = $jslist['orders'];
		$result['jsMoney'] = $jslist['money'];
		$result['qsNum'] = $qslist['orders'];
		$result['qsMoney'] = $qslist['money'];

		return $result;
	}


	/**
	 * @desc 获取号码屏蔽信息
	 * @param string $typeencode 类型编码
	 * @return array $result 号码屏蔽的结果信息
	 * @author WuJunhua
	 * @date 2016-03-31
	 */
	public function getNumberShieldMsg($typeencode){
		$result = [];  //号码屏蔽信息
		$result = syssetDAO::getInstance()->findByAttributes(['typeencode' => $typeencode],['id','valuetype1','valuetype2','valuetype3']);
		if(empty($result)){
			$result['res'] = 'error';
			$result['msg'] = '获取号码屏蔽信息失败';
		}
		return $result;
	}

	/**
	 * @desc 根据主键修改号码屏蔽信息
	 * @param int $id ID
	 * @param array $infoArr 修改信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-03-31
	 */
	public function updateHmpb($id,$infoArr){
		if(empty($id) || empty($infoArr)){
			return ['res' => 'error','msg' => '操作有误'];
		}
		$findResult = [];  //数据库号码屏蔽信息
		$findResult = syssetDAO::getInstance()->findByAttributes(['id' => $id],['valuetype1','valuetype2','valuetype3']);
		if (empty($findResult)) {
			return ['res' => 'error','msg' => '获取号码屏蔽信息失败'];
		}
		if ($findResult['valuetype1'] == $infoArr['valuetype1'] && $findResult['valuetype2'] == $infoArr['valuetype2'] && $findResult['valuetype3'] == $infoArr['valuetype3']) {
			return ['res' => 'error','msg' => '没有作任何修改'];
		}
		$result = [];  //修改号码屏蔽信息的结果
		$result = syssetDAO::getInstance()->updateByPk($id,$infoArr);
		if (empty($result)) {
			return ['res' => 'error','msg' => '修改错误'];
		}
		return ['res' => 'success','msg' => '修改成功'];
	}

	/**
	 * @desc 处理号码屏蔽
	 * @param string $number 待屏蔽的号码
	 * @return mix $result 结果信息
	 * @author WuJunhua
	 * @date 2016-03-31
	 */
	public function handleNumberShield($number){
		$result = ''; //结果信息
		$findResult = [];  //号码屏蔽信息
		$typeencode = 'A036';
		$findResult = syssetDAO::getInstance()->findByAttributes(['typeencode' => $typeencode],['id','valuetype1','valuetype2','valuetype3']);
		if(empty($findResult)){
			return ['res'=>'error','msg'=>'获取号码屏蔽信息失败'];
		}

		if($findResult['valuetype2'] == '是'){
			//定义屏蔽开始位置
			switch ($findResult['valuetype3']) {
				case '前':
					$start = 0;
					break;
				case '中':
					$start = 3;
					break;
				case '后':
					$start = -1;
					break;	
				default:
					return ['res'=>'error','msg'=>'屏蔽开始位置有误'];
					break;
			}

			//定义号码屏蔽数和内容
			switch ($findResult['valuetype1']) {
				case '1':
					$length = 1;
					$content = '*';
					break;
				case '2':
					$length = 2;
					$content = '**';
					break;
				case '3':
					$length = 3;
					$content = '***';
					break;
				case '4':
					$length = 4;
					$content = '****';
					break;
				case '5':
					$length = 5;
					$content = '*****';
					break;
				case '6':
					$length = 6;
					$content = '******';
					break;
				case '7':
					$length = 7;
					$content = '*******';
					break;
				case '8':
					$length = 8;
					$content = '********';
					break;
				default:
					return ['res'=>'error','msg'=>'号码屏蔽数有误'];
					break;
			}

			if($findResult['valuetype3'] == '后'){
				$result = substr_replace($number, $content, -$length);
			}else{
				$result = substr_replace($number, $content, $start, $length);

			}
		}
		
		return $result;
		
	}

}


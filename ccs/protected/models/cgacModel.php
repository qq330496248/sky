<?php
/**
 * @desc 采购单明细表相关操作类
 * @author DengShaocong
 * @date 2015-12-14
 */
class cgacModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cgacModel对象
	 * @return cgacModel
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取最大项目数
	 * @param string $id 采购单号
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getMaxCount($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'信息出错');
		}
		$result = cgacDAO::getInstance()->getMaxCount($id);
		if(empty($result)){
			return array('res'=>'false','mes'=>'获取失败');
		}
		return $result;
	}

	/**
	 * @desc 获取单个采购单明细信息
	 * @param string $id 采购单号
	 * @param string $count 第几个项目
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-15
	 */
	public function getSingleCgd($id,$count){
		if(($count < 0) || empty($id)){
			return array('res'=>'error','mes'=>'信息不全，出错');
		}
		$result = cgacDAO::getInstance()->findByAttributes(array('cgac02'=>$id,'cgac11'=>$count));
		if(empty($result)){
			return array('res'=>'false','mes'=>'获取失败');
		}
		return $result;
	}


	/**
	 * @desc 更新采购单信息
	 * @param string $id 采购单号
	 * @param string $count 第几个项目
	 * @param array $cgdInfo 采购单信息
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function updateCgd($id,$count,$cgdInfo){
		if(empty($id) || ($count < 0) || empty($cgdInfo)){
			return array('res'=>'error','mes'=>'数据不全，出错');
		}
		$result = cgacDAO::getInstance()->update(array('cgac02'=>$id,'cgac11'=>$count),$cgdInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'更新失败');
		}
		$this->updateTotalPriceAndNum($id);
		return array('res'=>'success','mes'=>'更新成功');
	}

	/**
	 * @desc 删除一项采购单
	 * @param string $id 采购单号
	 * @param string $count 第几个项目
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-9
	 */
	public function deleteCgd($id,$count){
		if(($count < 0) || empty($id)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}
		//先删除，在修改
		$result = cgacDAO::getInstance()->delete(array('cgac02'=>$id,'cgac11'=>$count));

		if($count == 0){//如果删除项是第一项，让下一项成为第一项
			$list = cgacDAO::getInstance()->findAllByAttributes(array('cgac02'=>$id));
			if(!empty($list)){
				$id = $list[0]['cgac01'];
				cgacDAO::getInstance()->update(array('cgac01'=>$id),array('cgac11' => 0));
			}
		}
		if(empty($result)){
			return array('res'=>'false','msg'=>'删除失败');
		}
		if(!empty($this->getMaxCount($id)['res'])){
			if($this->getMaxCount($id)['res'] == 'false'){
				cgaaDAO::getInstance()->deleteByPk($id);
			}
		}
		$this->updateTotalPriceAndNum($id);
		return array('res'=>'success','msg'=>'删除成功');
	}

	/**
	 * @desc 更新或者删除某一项采购项目后，更新采购单的总金额以及数量
	 * @param string $id 采购单号
	 * @return array 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function updateTotalPriceAndNum($id){
		$result = cgacDAO::getInstance()->getAllPriceAndNum($id);
		$price = 0;
		$num = 0;
		if(!empty($result)){
			for($i = 0;$i < count($result); $i ++){
				$price += $result[$i]['cgac07'];
				$num += $result[$i]['cgac06'];
			}
		}
		$cgdInfo['cgaa03'] = $price;
		$cgdInfo['cgaa04'] = $num;
		cgaaDAO::getInstance()->updateByPk($id,$cgdInfo);
	}

	/**
	 * @desc 获取退货退货供应商记录商品详情
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function ReturnSupplierOrder($page,$psize,$orderNo){
		$result = array();
		$clientList = cgacDAO::getInstance()->ReturnSupplierOrder($page,$psize,$orderNo);
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
	
}


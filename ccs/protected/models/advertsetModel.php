<?php
/**
 * @desc 广告表相关操作类
 * @author Dengshaocong
 * @date 2015-11-16
 */
class advertsetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回advertsetModel对象
	 * @return advertsetModel
	 * @author Dengshaocong
	 * @date 2015-12-14
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加新广告
	 * @param array $adInfo 广告资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function addAdvert($adInfo){
		if(empty($adInfo)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}
		$advertList = advertsetDAO::getInstance()->getMaxAdvertNumber();
		if(!empty($advertList)){
			$date=substr($advertList['advertid'],2,4);
			if($date==date('ym')){
			   	$id = substr($advertList['advertid'],-4,4);
			   	$id += 1;
			   	$advertId = sprintf("%04d",$id);
			   	$advertNo = 'GG'.date('ym').$advertId;
			}else{
				$id = 1;
			   	$advertId = sprintf("%04d",$id);
			   	$advertNo = 'GG'.date('ym').$advertId;
			}
		}else{
			$id = '1';
			$advertId = sprintf("%04d",$id);
			$advertNo = 'GG'.date('ym').$advertId;
		}
		$adInfo['advertid'] = $advertNo;
		$result = advertsetDAO::getInstance()->insert($adInfo,true);
		if(empty($result)){
			return array('res'=>'false','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 获取广告
	 * @param array $condInfo 查询条件
	 * @param int $page 页数
	 * @param int $psize 每页条数
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getAdvertByCond($condInfo,$page,$psize){
		$result = array();
		$advert = advertsetDAO::getInstance()->getAdvertByCond($condInfo,$page,$psize);
		//判断是否查询到有数据
		if(!empty($advert) && is_array($advert)){
			$result['result'] = 'success';
			$result['list'] = $advert['info'];
			$result['count'] = $advert['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 删除广告
	 * @param string $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function delAdvert($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}
		$result = advertsetDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'false','msg'=>'删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}


	/**
	 * @desc 根据ID获取单个广告信息
	 * @param string $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getSingleAdvert($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}
		$result = advertsetDAO::getInstance()->findByAttributes(array('advertid' => $id));
		if(empty($result)){
			return array('res'=>'false','msg'=>'获取失败');
		}
		return $result;
	}

	/**
	 * @desc 更新广告信息
	 * @param string $id ID
	 * @param array $adInfo 广告信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function updateAdvert($id,$adInfo){
		if(empty($id) || empty($adInfo)){
			return array('res'=>'error','msg'=>'信息不全，出错');
		}
		$result = advertsetDAO::getInstance()->updateByPk($id,$adInfo);
		if(empty($result)){
			return array('res'=>'false','msg'=>'修改失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
}
?>
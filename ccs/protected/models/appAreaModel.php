<?php
/**
 * @desc 区县表相关操作类
 * @author WuJunhua
 * @date 2015-10-26
 */
class appAreaModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回appAreaModel对象
	 * @return appAreaModel
	 * @author WuJunhua
	 * @date 2015-10-22
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取城市下面的区县信息
	 * @param string $cityId 城市ID
	 * @return array $result 区县的结果信息
	 * @author WuJunhua
	 * @date 2015-10-26
	 */
	public function getArea($cityId){
		$result = array();  //城市的结果信息
		$areaList = appAreaDAO::getInstance()->findAllByAttributes(array('cid' => $cityId));
		if(empty($areaList)){
			return false;
		}
		foreach($areaList as $val){
			$result[$val['aid']] = $val['aname'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取城市下面的区县信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $ids 省份、城市、区县ID
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2015-12-31
	 */
	public function getAllArea($page,$psize,$ids){
		$result = array();
		$area = appAreaDAO::getInstance()->getAllArea($page,$psize,$ids);
		if(!empty($area) && is_array($area)){
			$result['res'] = 'success';
			$result['list'] = $area['info'];
			$result['count'] = $area['count'];
		}else{
			$result['res'] = 'error';
			$result['list'] = array();
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 添加区县信息
	 * @param array $areaInfo 区县信息
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function addArea($areaInfo){
		if(empty($areaInfo)){
			return array('res'=>'error','mes'=>'添加出错');
		}
		$list = appAreaDAO::getInstance()->getMaxAreaNumber($areaInfo['cid']);
		if(!empty($list)){
			$areaInfo['aid'] = $list['aid']+1;
		}else{
			$areaInfo['aid'] = $areaInfo['cid']+1;
		}
		$result = appAreaDAO::getInstance()->insert($areaInfo,true);
		if(empty($result)){
			return array('res'=>'false','mes'=>'添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}

	/**
	 * @desc 修改区县信息
	 * @param int $id 区县ID
	 * @param array $areaInfo 区县信息
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function updateArea($id,$areaInfo){
		if(empty($areaInfo) || empty($id)){
			return array('res'=>'error','mes'=>'修改出错');
		}
		$result = appAreaDAO::getInstance()->updateByPk($id,$areaInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'修改失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}

	/**
	 * @desc 删除区县信息
	 * @param int $id 区县ID
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function deleteArea($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除出错');
		}
		$result = appAreaDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'false','mes'=>'删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}

	/**
	 * @desc 获取单个区县信息
	 * @param int $id 区县ID
	 * @return array $result 区县的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function getSingleArea($id){
		if(empty($id)){
			return null;
		}
		$result = appAreaDAO::getInstance()->getSingleArea($id);
		return $result;
	}
}


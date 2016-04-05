<?php
/**
 * @desc 会员等级表相关操作类
 * @author DengShaocong
 * @date 2015-11-3
 */
class hydjModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khyxModel对象
	 * @return hydjModel
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc  获取会员等级
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-1
	 */
	public function getHydj(){
		$hydj = hydjDAO::getInstance()->getKhyx();
		//判断是否查询到有数据
		if(!empty($hydj) && is_array($hydj)){
			$result['result'] = 'success';
			$result['list'] = $hydj;
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
	public function addHydj($hydjInfo){
		if(empty($hydjInfo)){
			return array('res'=>'error','mes'=>'相关信息不完整，添加失败');
		}
		$result = hydjDAO::getInstance()->insert($hydjInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
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
			return array('res'=>'error','mes'=>'修改错误');
		}
		$result = hydjDAO::getInstance()->updateByPk($id,$hydjInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
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
			return array('res'=>'error','mes'=>'删除错误');
		}
		$result = hydjDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}
}
?>
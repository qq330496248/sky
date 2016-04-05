<?php
/**
 * @desc 快递公司表相关操作类
 * @author DengShaocong
 * @date 2015-11-9
 */
class kdgsModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return kdgsModel
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 获取快递公司信息
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function getAllKdgs(){
		$result = array();  //获取列表数据的结果
		$groupList = kdgsDAO::getInstance()->getAllKdgs();
		//判断是否查询到有数据
		if(!empty($groupList['info']) && is_array($groupList['info'])){
			$result['result'] = 'success';
			$result['list'] = $groupList['info'];
			$result['count'] = $groupList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 添加快递公司
	 * @param array $bmfzInfo 快递公司资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function addKdgs($kdgsInfo){
		if(empty($kdgsInfo)){
			return array('res'=>'false','msg'=>'相关信息不完整，添加失败');
		}
		$result = kdgsDAO::getInstance()->insert($kdgsInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 更改快递公司
	 * @param array $id ID
	 * @param array $bmfzInfo 快递公司资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function updateKdgs($id,$kdgsInfo){
		if(empty($id) || empty($kdgsInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = kdgsDAO::getInstance()->updateByPk($id,$kdgsInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据主键删除一个快递公司
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function deleteKdgs($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = kdgsDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
}
?>
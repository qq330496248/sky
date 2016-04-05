<?php
/**
 * @desc 权限组表相关操作类
 * @author DengShaocong
 * @date 2015-11-9
 */
class bmfzModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return BmfzModel
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 获取权限组信息
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function getAllGroup(){
		$result = array();  //获取列表数据的结果
		$groupList = bmfzDAO::getInstance()->getAllGroup();
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
	 * @desc 添加权限组
	 * @param array $bmfzInfo 权限组资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function addBmfz($bmfzInfo){
		if(empty($bmfzInfo)){
			return array('res'=>'false','msg'=>'相关信息不完整，添加失败');
		}
		$result = bmfzDAO::getInstance()->insert($bmfzInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 更改权限组
	 * @param array $id ID
	 * @param array $bmfzInfo 权限组资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function updateBmfz($id,$bmfzInfo){
		if(empty($id) || empty($bmfzInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = bmfzDAO::getInstance()->updateByPk($id,$bmfzInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据主键删除一个权限组
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function deleteBmfz($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = bmfzDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
}
?>
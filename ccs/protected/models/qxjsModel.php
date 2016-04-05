<?php
/**
 * @desc 权限角色表相关操作类
 * @author DengShaocong
 * @date 2015-10-28
 */
class qxjsModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return qxjsModel
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加权限角色
	 * @param array $qxjsInfo 权限角色资料
	 * @param array $qxszInfo 页面权限
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public function addAdmin($qxjsInfo,$qxszInfo){
		if(empty($qxjsInfo)){
			return array('res'=>'false','msg'=>'相关信息不完整，添加失败');
		}
		$result = qxjsDAO::getInstance()->insert($qxjsInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 添加权限角色的页面权限设置
	 * @param array $qxszInfo 页面权限
	 * @param array $qxjs 权限角色
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public function addQxsz($qxszInfo,$qxjs){
		$qxjsxm = array();
		if(empty($qxszInfo)){
			return array('res'=>'false','msg'=>'信息为空');
		}
		$id = qxjsDAO::getInstance()->findByAttributes(array('qxjs' => $qxjs));
		
		$qxjsxm['qxjsid'] = $id['id'];
		foreach ($qxszInfo as $value) {
			$qxjsxm['qxxmid'] = $value;
			$result = qxjsxmDAO::getInstance()->insert($qxjsxm);
		}
	}
	/**
	 * @desc 获取权限角色信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function getAllRole($page,$psize){
		$result = array();  //获取列表数据的结果
		$clientList = qxjsDAO::getInstance()->getAllRole($page,$psize);
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
	/**
	 * @desc 根据主键删除一个权限角色信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function deleteRole($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}

		$qxjsxm = qxjsxmDAO::getInstance()->delete(array('qxjsid' => $id));
		$result = qxjsDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc 根据主键查找一个权限角色信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getSingleQxjs($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'错误');
		}
		$result = qxjsDAO::getInstance()->findByAttributes(array('id' => $id));
		return $result;
	}
	/**
	 * @desc 根据权限角色ID查找一个权限角色页面权限信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getSingleQxjsxm($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'错误');
		}
		$result = qxjsxmDAO::getInstance()->findAllByAttributes(array('qxjsid' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个权限角色信息
	 * @param int $id ID
	 * @param array $qxjsInfo 权限角色信息
	 * @param int $qxjsxmInfo 权限角色页面权限信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function updateQxjs($id,$qxjsInfo,$qxjsxmInfo){
		if(empty($id) || empty($qxjsInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$qxjsxm = qxjsxmDAO::getInstance()->delete(array('qxjsid' => $id));
		$result = ygkhDAO::getInstance()->updateByPk($id,$qxjsInfo);
		
		$qxjsxm = array();
		$qxjsxm['qxjsid'] = $id;
		foreach ($qxjsxmInfo as $value) {
			$qxjsxm['qxxmid'] = $value;
			$result = qxjsxmDAO::getInstance()->insert($qxjsxm);
		}

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 获取权限角色信息
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-10-30
	 */
	public function getRoleForGh(){
		$result = array();  //获取列表数据的结果
		$clientList = qxjsDAO::getInstance()->getRoleForGh();
		//判断是否查询到有数据
		if(!empty($clientList) && is_array($clientList)){
			$result['result'] = 'success';
			$result['list'] = $clientList;
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
}
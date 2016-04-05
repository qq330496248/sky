<?php
/**
 * @desc 权限角色表相关操作类
 * @author DengShaocong
 * @date 2015-10-28
 */
class appRightListModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return appRightListModel
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 添加权限角色的权限位
	 * @param array $rightInfo 权限位列表
	 * @param array $qxjs 权限角色
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function addRight($rightInfo,$qxjs){
		$appRightList = array();
		if(empty($rightInfo)){
			return array('res'=>'error','msg'=>'信息为空');
		}
		$gr = groupRightDAO::getInstance()->findByAttributes(array('groupname' => $qxjs));
		$appRightList['groupbh'] = $gr['groupbh'];
		foreach ($rightInfo as $value) {
			$appRightList['rightbh'] = $value;
			$result = appRightListDAO::getInstance()->insert($appRightList,true);
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 根据权限角色编号查找一个权限角色的权限位
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function getSingleAppRightList($groupbh){
		if(empty($groupbh)){
			return array('res'=>'error','msg'=>'错误');
		}
		$result = array();
		$list = appRightListDAO::getInstance()->findAllByAttributes(array('groupbh' => $groupbh));
		if(!empty($list) && is_array($list)){
			$result['result'] = 'success';
			$result['list'] = $list;
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
	/**
	 * @desc 根据工号获取一个员工的权限位
	  * @param string $groupbh 员工的权限角色编号
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-11-12
	 */
	public function getRyRight($groupbh){
		if(empty($groupbh)){
			return array('res'=>'error','msg'=>'错误');
		}
		$list = appRightListDAO::getInstance()->getRyRight($groupbh);
		if(!empty($list) && is_array($list)){
			$result['result'] = 'success';
			$result['list'] = $list['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
}
?>
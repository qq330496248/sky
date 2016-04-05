<?php
/**
 * @desc 权限组表相关操作类
 * @author DengShaocong
 * @date 2015-11-11
 */
class groupRightModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return groupModel
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加权限角色
	 * @param array $qxjsInfo 权限角色资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function addGroupRight($qxjsInfo){
		if(empty($qxjsInfo)){
			return array('res'=>'false','msg'=>'相关信息不完整，添加失败');
		}
		//从数据库中获取最后一个编号，获取其中序号，重新编辑新的编号——————格式：gr年月xxxx（xxxx为四位数字，0001开始）
		$grList = groupRightDAO::getInstance()->getFinalGrNum();
		if(!empty($grList)){
			$id = substr($grList[0]['groupbh'],-4,4);
			$id += 1;
			$grID = sprintf("%04d",$id);
			$grNO = 'GR'.date('ym').$grID;
		}else{
			$id = 1;
			$grID = sprintf("%04d",$id);
			$grNO = 'GR'.date('ym').$grID;
		}
		$qxjsInfo['groupbh'] = $grNO;

		$result = groupRightDAO::getInstance()->insert($qxjsInfo,true);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 获取权限角色信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function getGroupRight(){
		$result = array();  //获取列表数据的结果
		$grList = groupRightDAO::getInstance()->getGroupRight();
		//判断是否查询到有数据
		if(!empty($grList['info']) && is_array($grList['info'])){
			$result['result'] = 'success';
			$result['list'] = $grList['info'];
			$result['count'] = $grList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 检查权限角色是否已经存在同名
	 * @param string $name 权限角色名字
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-12-23
	 */
	public function checkGroupRightExist($name){
		$result = array();
		$grList = groupRightDAO::getInstance()->findByAttributes(array('groupname'=>$name));
		if(!empty($grList)){
			$result['result'] = 'success';
			$result['list'] = $grList;
		}else{
			$result['result'] = 'fail';
		}
		return $result;
	}

	/**
	 * @desc 根据主键删除一个权限角色信息
	 * @param string $groupbh 编号
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function deleteGroupRight($groupbh){
		if(empty($groupbh)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$qxjsxm = appRightListDAO::getInstance()->delete(array('groupbh' => $groupbh));
		$result = groupRightDAO::getInstance()->deleteByPk($groupbh,true);
		
		if(empty($result)){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}

	/**
	 * @desc 根据主键查找一个权限角色信息
	 * @param string $groupbh 编号
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function getSingleGroupRight($groupbh){
		if(empty($groupbh)){
			return array('res'=>'error','msg'=>'错误');
		}
		$result = groupRightDAO::getInstance()->findByAttributes(array('groupbh' => $groupbh));
		return $result;
	}

	/**
	 * @desc 根据主键修改一个权限角色信息
	 * @param string $groupbh 编号
	 * @param array $qxjsInfo 权限角色信息
	 * @param array $rightInfo 权限角色的权限位
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function updateGroupRight($groupbh,$qxjsInfo,$rightInfo){
		if(empty($groupbh) || empty($qxjsInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		if(!empty($rightInfo)){
			appRightListDAO::getInstance()->delete(array('groupbh' => $groupbh));
		}
		$result = groupRightDAO::getInstance()->updateByPk($groupbh,$qxjsInfo);	
		$appRightList = array();
		$appRightList['groupbh'] = $groupbh;
		foreach ($rightInfo as $value) {
			$appRightList['rightbh'] = $value;
			$a = appRightListDAO::getInstance()->insert($appRightList);

		}
		if(empty($result)){
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
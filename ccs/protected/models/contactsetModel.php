<?php
/**
 * @desc 联系人表相关操作类
 * @author Dengshaocong
 * @date 2016-01-11
 */
class contactsetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回contactsetModel对象
	 * @return contactsetModel
	 * @author Dengshaocong
	 * @date 2016-01-11
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}


	/**
	 * @desc 添加联系人
	 * @param array $user  联系人资料
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function addUser($user){
		if(empty($user)){
			return array('res'=>'error','mes'=>'添加出错');
		}
		$result = contactsetDAO::getInstance()->insert($user,true);
		if(empty($result)){
			return array('res'=>'false','mes'=>'添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}

	/**
	 * @desc 获取所有联系人
	 * @param array $condInfo  查询条件
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function getUser($condInfo){
		$result = array();
		$user = contactsetDAO::getInstance()->getUser($condInfo);
		if(!empty($user) && is_array($user)){
			$result['res'] = 'success';
			$result['list'] = $user['info'];
		}else{
			$result['res'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 获取联系人
	 * @param array $id ID
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function getSingleUser($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'获取出错');
		}
		$result = contactsetDAO::getInstance()->findByAttributes(array('id'=>$id));
		if(empty($result)){
			return array('res'=>'false','mes'=>'添加失败');
		}
		return $result;
	}

	/**
	 * @desc 更新联系人
	 * @param array $id ID
	 * @param array $user 联系人资料
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function updateUser($id,$user){
		if(empty($id) || empty($user)){
			return array('res'=>'error','mes'=>'更新出错');
		}
		$result = contactsetDAO::getInstance()->updateByPk($id,$user);
		if(empty($result)){
			return array('res'=>'false','mes'=>'更新失败');
		}
		return array('res'=>'success','mes'=>'更新成功');
	}


	/**
	 * @desc 删除联系人
	 * @param array $id ID
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function deleteUser($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除出错');
		}
		$result = contactsetDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'false','mes'=>'删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}

	/**
	 * @desc 获取电话信息（用于电话转移）
	 * @param int $page 页数
	 * @param int $psize 每页显示的数量
	 * @param string $fenji 分机号
	 * @author DengShaocong
	 * @date 2016-01-15
	 */
	public function getTransfer($page,$psize,$fenji){
		$result = array();
		$userList = contactsetDAO::getInstance()->getTransfer($page,$psize,$fenji);
		if(!empty($userList) && is_array($userList)){
			$result['res'] = 'success';
			$result['list'] = $userList['info'];
			$result['count'] = $userList['count'];
		}else{
			$result['res'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
}
?>
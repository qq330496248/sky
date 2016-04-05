<?php
/**
 * @desc 员工考核表相关操作类
 * @author DengShaocong
 * @date 2015-10-28
 */
class ygkhModel extends BaseModel{
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
	 * @desc 添加考核项目
	 * @param array $ygkhInfo 考核项目资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public function addKhxm($ygkhInfo){
		if(empty($ygkhInfo)){
			return array('res'=>'error','mes'=>'相关信息不完整，添加失败');
		}
		if($ygkhInfo['type']=="F" && $ygkhInfo['score']>0){
			return array('res'=>'false','mes'=>'分数与奖罚不相符，添加失败');
		}
		if($ygkhInfo['type']=="T" && $ygkhInfo['score']<0){
			return array('res'=>'false','mes'=>'分数与奖罚不相符，添加失败');
		}
		$result = ygkhDAO::getInstance()->insert($ygkhInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}
	/**
	 * @desc 获取考核项目信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function getAllXm($page,$psize){
		$result = array();  //获取列表数据的结果
		$clientList = ygkhDAO::getInstance()->getAllXm($page,$psize);
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
	 * @desc 根据主键删除一个考核项目信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function deleteXm($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除错误');
		}
		$result = ygkhDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}
	/**
	 * @desc 根据主键查找一个考核项目信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function getSingleXm($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'错误');
		}
		$result = ygkhDAO::getInstance()->findByAttributes(array('id' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个考核项目信息
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function updateXm($id,$xmInfo){
		if(empty($id) || empty($xmInfo)){
			return array('res'=>'error','mes'=>'修改错误');
		}
		$result = ygkhDAO::getInstance()->updateByPk($id,$xmInfo);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}
}
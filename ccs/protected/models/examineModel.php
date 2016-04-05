<?php
/**
 * @desc 权限组表相关操作类
 * @author DengShaocong
 * @date 2015-11-10
 */
class examineModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return khjlModel
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 添加考核记录
	 * @param array $khjlInfo 考核记录资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function addKhjl($khjlInfo){
		if(empty($khjlInfo)){
			return array('res'=>'false','mes'=>'相关信息不完整，添加失败');
		}
		$result = examineDAO::getInstance()->insert($khjlInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}
	/**
	 * @desc 根据条件查找考核记录
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $khjlInfo 查找条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function getKhjlByCond($page,$psize,$khjlInfo){
		$khjl = examineDAO::getInstance()->getKhjlByCond($page,$psize,$khjlInfo);
		//判断是否查询到有数据
		if(!empty($khjl) && is_array($khjl)){
			$result['result'] = 'success';
			$result['list'] = $khjl['info'];
			$result['count'] = $khjl['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 删除考核记录
	 * @param int $id 考核记录ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function deleteKhjl($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除错误');
		}
		$result = examineDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}
	/**
	 * @desc 根据主键查找一个考核记录
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function getSingleKhjl($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'错误');
		}
		$result = examineDAO::getInstance()->findByAttributes(array('id' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个考核记录
	 * @param int $id ID
	 * @param int $khjlInfo 修改内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function updateKhjl($id,$khjlInfo){
		if(empty($id) || empty($khjlInfo)){
			return array('res'=>'error','mes'=>'修改错误');
		}
		$result = examineDAO::getInstance()->updateByPk($id,$khjlInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}
}	
?>
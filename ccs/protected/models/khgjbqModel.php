<?php
/**
 * @desc 会员等级表相关操作类
 * @author DengShaocong
 * @date 2015-11-3
 */
class khgjbqModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回khgjbqModel对象
	 * @return khgjbqModel
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
	public function getKhgjbq(){
		$khgjbq = khgjbqDAO::getInstance()->getKhgjbq();
		//判断是否查询到有数据
		if(!empty($khgjbq) && is_array($khgjbq)){
			$result['result'] = 'success';
			$result['list'] = $khgjbq;
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
	public function addKhgjbq($khgjbqInfo){
		if(empty($khgjbqInfo)){
			return array('res'=>'error','msg'=>'相关信息不完整，添加失败');
		}
		$result = khgjbqDAO::getInstance()->insert($khgjbqInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 根据主键修改一个客户意向
	 * @param int $id ID
	 * @param array $hydjInfo 修改信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function updateKhgjbq($id,$khgjbqInfo){
		if(empty($id) || empty($khgjbqInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = khgjbqDAO::getInstance()->updateByPk($id,$khgjbqInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据主键删除一个客户意向
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function deleteKhgjbq($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = khgjbqDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
}
?>
<?php
/**
 * @desc 公告表相关操作类
 * @author Dengshaocong
 * @date 2015-11-16
 */
class annsetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回annsetModel对象
	 * @return annsetModel
	 * @author Dengshaocong
	 * @date 2015-11-16
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 添加新公告
	 * @param array $annInfo 公告资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function addAnn($annInfo){
		if(empty($annInfo)){
			return array('res'=>'false','msg'=>'相关信息不完整，添加失败');
		}
		$result = annsetDAO::getInstance()->insert($annInfo,true);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 获取公告
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function getAnn($annCond){
		$result = array();  //获取列表数据的结果
		$annList = annsetDAO::getInstance()->getAnn($annCond);

		//判断是否查询到有数据
		if(!empty($annList['info']) && is_array($annList['info'])){
			$result['result'] = 'success';
			$result['list'] = $annList['info'];
			//$result['count'] = $annList['count'];
		}else{
			$result['result'] = 'error';
			//$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 删除公告
	  * @param array $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function deleteAnn($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = annsetDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc 获取一个公告信息
	  * @param array $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-16
	 */
	public function getSingleAnn($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'错误');
		}
		$result = annsetDAO::getInstance()->findByAttributes(array('id' => $id));
		return $result;
	}
	/**
	 * @desc 更新公告
	 * @param array $id ID
	 * @param array $annInfo 公告资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function updateAnn($id,$annInfo){
		if(empty($id) || empty($annInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = annsetDAO::getInstance()->updateByPk($id,$annInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，修改失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
}
?>
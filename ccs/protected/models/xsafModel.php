<?php
/**
 * @desc 订单拒收原因内容表相关操作类
 * @author WuJunhua
 * @date 2015-11-20
 */
class xsafModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回xsaaModel对象
	 * @return xsafModel
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	/**
	 * @desc 获取所有拒收原因分类下对应的选项
	 * @return array $result 所有拒收原因内容
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function getAllRejectContent($rejectId){
		$result = xsafDAO::getInstance()->findAllByAttributes(array('xsaf01'=>$rejectId),array('xsaf02','xsaf03'));
		if(empty($result)){
			return array('res'=>'error','msg'=>'获取拒收原因分类下对应的选项失败');
		}
		return $result;
	}

	/**
	 * @desc 新增退货子（详细）原因
	 * @param array $info 内容
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function addThzyy($info){
		if(empty($info)){
			return array('res'=>'error','msg'=>'添加出错');
		}
		$result = xsafDAO::getInstance()->insert($info,true);
		if(empty($result)){
			return array('res'=>'false','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功','http'=>'index.php?r=xtsz/GetThzyyHtml&parent='.$info['xsaf01']);
	}

	/**
	 * @desc 删除退货原因（小类）
	 * @param string $id ID
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function deleteThzyy($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'删除出错');
		}
		$result = xsafDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('mes'=>'false','msg'=>'删除失败');
		}
		return array('mes'=>'false','msg'=>'删除成功');
	}
	
	/**
	 * @desc 更新退货原因（小类）
	 * @param string $id ID
	 * @param array $info 内容
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function updateThzyy($id,$info){
		if(empty($id) || empty($info)){
			return array('mes'=>'error','msg'=>'修改出错');
		}
		$result = xsafDAO::getInstance()->updateByPk($id,$info);
		if(empty($result)){
			return array('mes'=>'false','msg'=>'修改失败');
		}
		return array('mes'=>'success','msg'=>'修改成功','http'=>'index.php?r=xtsz/GetThzyyHtml&parent='.$info['xsaf01']);
	}

	/**
	 * @desc 获取单个退货原因（大类）信息
	 * @param int  $id ID
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function getSingleReason($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'出错！');
		}
		$result = xsafDAO::getInstance()->findAllByAttributes(array('xsaf01'=>$id));
		return $result;
	}
}


<?php
/**
 * @desc 产品分类表相关操作类
 * @author DengShaocong
 * @date 2015-11-4
 */
class cpagModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cpagModel对象
	 * @return cpagModel
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 添加产品属性分类
	 * @param array $cpsxInfo 产品属性
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function addCpsx($cpsxInfo){
		if(empty($cpsxInfo)){
			return array('res'=>'error','mes'=>'相关信息不完整，添加失败');
		}
		$result = cpagDAO::getInstance()->insert($cpsxInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}

		return array('res'=>'success','mes'=>'添加成功');
	}
	/**
	 * @desc 查询产品属性
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function GetCpsxByCond($cpsx,$page,$psize){
		$cpsx = cpagDAO::getInstance()->getCpsxByCond($cpsx,$page,$psize);
		//判断是否查询到有数据
		if(!empty($cpsx) && is_array($cpsx)){
			$result['result'] = 'success';
			$result['list'] = $cpsx['info'];
			$result['count'] = $cpsx['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 根据主键删除一个产品分类
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function deleteCpfl($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除错误');
		}	
		$result = cpabDAO::getInstance()->deleteByPk($id);

		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}
	/**
	 * @desc 根据主键查找一个产品分类
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function getSingleCpfl($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'错误');
		}
		$result = cpabDAO::getInstance()->findByAttributes(array('cpab01' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个产品分类信息
	 * @param int $id ID
	 * @param array $cpflInfo 修改内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function updateCpfl($id,$cpflInfo){
		if(empty($id) || empty($cpflInfo)){
			return array('res'=>'error','mes'=>'修改错误');
		}
		$result = cpabDAO::getInstance()->updateByPk($id,$cpflInfo);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}
	/**
	 * @desc 根据主键查找一个产品属性
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function getSingleCpsx($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'错误');
		}
		$result = cpagDAO::getInstance()->findByAttributes(array('cpag01' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个产品属性信息
	 * @param int $id ID
	 * @param array $cpsxInfo 修改内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function updateCpsx($id,$cpsxInfo){
		if(empty($id) || empty($cpsxInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = cpagDAO::getInstance()->updateByPk($id,$cpsxInfo);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据主键删除一个产品属性
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function deleteCpsx($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除错误');
		}	
		$result = cpagDAO::getInstance()->deleteByPk($id);

		if(empty($result) || $result == false){
			return array('res'=>'false','mes'=>'操作出错，删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}
	/**
	 * @desc 查询产品属性详情
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param int $parent 上一级属性ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function GetCpsxxqByCond($parent){
		$cpsx = cpagDAO::getInstance()->getCpsxxqByCond($parent);
		//判断是否查询到有数据
		if(!empty($cpsx) && is_array($cpsx)){
			$result['result'] = 'success';
			$result['list'] = $cpsx['info'];
			$result['count'] = $cpsx['count'];
		}else{
			$result['result'] = 'error';
			//$result['count'] = 0;
		}
		return $result;
	}
}
?>
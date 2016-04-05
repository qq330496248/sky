<?php
/**
 * @desc 产品品牌表相关操作类
 * @author DengShaocong
 * @date 2015-11-2
 */
class cpadModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cpadModel对象
	 * @return cpadModel
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 添加产品品牌
	 * @param array $cpppInfo 产品品牌
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function addCppp($cpppInfo){
		if(empty($cpppInfo)){
			return array('res'=>'error','mes'=>'相关信息不完整，添加失败');
		}
		$result = cpadDAO::getInstance()->insert($cpppInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}
	/**
	 * @desc 根据条件查询产品品牌
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $cpmc 产品名称
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function GetCpppByCond($page,$psize,$cpmc){
		$cppp = cpadDAO::getInstance()->getCpppByCond($page,$psize,$cpmc);
		//判断是否查询到有数据
		if(!empty($cppp) && is_array($cppp)){
			$result['result'] = 'success';
			$result['list'] = $cppp['info'];
			$result['count'] = $cppp['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 根据主键删除一个产品品牌
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function deleteCppp($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = cpadDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}
	/**
	 * @desc 根据主键查找一个产品品牌
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function getSingleCppp($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'错误');
		}
		$result = cpadDAO::getInstance()->findByAttributes(array('cpad01' => $id));
		return $result;
	}
	/**
	 * @desc 根据主键修改一个产品品牌信息
	 * @param int $id ID
	 * @param array $cpppInfo 修改内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function updateCppp($id,$cpppInfo){
		if(empty($id) || empty($cpppInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = cpadDAO::getInstance()->updateByPk($id,$cpppInfo);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据条件查询产品品牌
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-30
	 */
	public function getCppp(){
		$cppp = cpadDAO::getInstance()->getCppp();
		//判断是否查询到有数据
		if(!empty($cppp) && is_array($cppp)){
			$result['result'] = 'success';
			$result['list'] = $cppp['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}
}
?>
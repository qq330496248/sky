<?php
/**
 * @desc 仓库表相关操作类
 * @author Dengshaocong
 * @date 2016-01-12
 */
class warehouseModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回warehouseModel对象
	 * @return warehouseModel
	 * @author Dengshaocong
	 * @date 2016-01-12
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}


	/**
	 * @desc 新建仓库
	 * @param array $wareInfo 仓库资料
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function addWareHouse($wareInfo){
		if(empty($wareInfo)){
			return array('res'=>'error','mes'=>'添加出错');
		}
		$wareNo = "";
		$wareList = warehouseDAO::getInstance()->getMaxWarehouseNumber();
		if(!empty($wareList)){
			$date=substr($wareList['id'],2,4);
			if($date==date('ym')){
			   $id = substr($wareList['id'],-4,4);
			   $id += 1;
			   $wareID = sprintf("%04d",$id);
			   $wareNo = 'KW'.date('ym').$wareID;
			}
			
		}else{
			$id = '1';
			$wareID = sprintf("%04d",$id);
			$wareNo = 'KW'.date('ym').$wareID;
		}
		$wareInfo['id'] = $wareNo;
		$result = warehouseDAO::getInstance()->insert($wareInfo,true);
		if(empty($result)){
			return array('res'=>'false','mes'=>'添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}

	/**
	 * @desc 获取所有仓库
	 * @param int $page 页数
	 * @param int $page 每页显示的个数
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function getWareHouse($page,$psize){
		$result = array();
		$list = warehouseDAO::getInstance()->getWareHouse($page,$psize);
		if(!empty($list) && is_array($list)){
			$result['res'] = 'success';
			$result['list'] = $list['list'];
			$result['count'] = $list['count'];
		}else{
			$result['res'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 获取10条仓位信息
	 * @param string $location 库位
	 * @return array $result 
	 * @author WuJunhua
	 * @date 2016-01-21
	 */
	public function getTenWarehouseData($location){
		$result = array();
		$list = warehouseDAO::getInstance()->getTenWarehouseData($location);
		if(!empty($list) && is_array($list)){
			$result['res'] = 'success';
			$result['list'] = $list;
		}else{
			$result['res'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 根据仓位id获取单个仓库位信息
	 * @param array $id ID
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function getSingleWareHouse($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'获取出错');
		}
		$result = warehouseDAO::getInstance()->findByAttributes(array('id'=>$id));
		if(empty($result)){
			return array('res'=>'false','mes'=>'获取失败');
		}
		return $result;
	}


	/**
	 * @desc 更新仓库
	 * @param array $id ID
	 * @param array $wareInfo 仓库资料
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function updateWareHouse($id,$wareInfo){
		if(empty($id) || empty($wareInfo)){
			return array('res'=>'error','mes'=>'更新出错');
		}
		$result = warehouseDAO::getInstance()->updateByPk($id,$wareInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'更新失败');
		}
		return array('res'=>'success','mes'=>'更新成功');
	}


	/**
	 * @desc 删除仓库
	 * @param array $id ID
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function deleteWareHouse($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除出错');
		}
		$result = warehouseDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'false','mes'=>'删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}

	/**
	 * @desc 禁用仓库
	 * @param array $id ID
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function stopWarehouse($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'禁用出错');
		}
		$wareInfo['ifuse'] = '否';
		$result = warehouseDAO::getInstance()->updateByPk($id,$wareInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'禁用失败');
		}
		return array('res'=>'success','mes'=>'禁用成功');
	}

	/**
	 * @desc 启用仓库
	 * @param array $id ID
	 * @return array $result 
	 * @author DengShaocong
	 * @date 2016-01-12
	 */
	public function startWarehouse($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'启用出错');
		}
		$wareInfo['ifuse'] = '是';
		$result = warehouseDAO::getInstance()->updateByPk($id,$wareInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'启用失败');
		}
		return array('res'=>'success','mes'=>'启用成功');
	}
}
?>
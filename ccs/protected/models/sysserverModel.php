<?php
/**
 * @desc 服务器表相关操作类
 * @author Dengshaocong
 * @date 2016-03-16
 */
class sysserverModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回sysserverModel对象
	 * @return sysserverModel
	 * @author Dengshaocong
	 * @date 2016-03-16
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}


	/**
	 * @desc 添加服务器列表
	 * @param array $info 添加内容
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function addServer($info){
		if(empty($info)){
			return array('mes'=>'error','msg'=>'添加出错');
		}
		$result = sysserverDAO::getInstance()->insert($info,true);
		if(!empty($result)){
			return array('mes'=>'success','msg'=>'添加成功');
		}
		return array('mes'=>'false','msg'=>'添加失败');
	}

	/**
	 * @desc 删除服务器
	 * @param string $id ID
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function deleteServer($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'删除出错');
		}
		$result = sysserverDAO::getInstance()->deleteByPk($id);
		if(!empty($result)){
			return array('mes'=>'success','msg'=>'删除成功');
		}
		return array('mes'=>'false','msg'=>'删除失败');
	}

	/**
	 * @desc 修改服务器
	 * @param string $id ID
	 * @param array $info 内容
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function updateServer($id,$info){
		if(empty($info) || empty($id)){
			return array('mes'=>'error','msg'=>'修改出错');
		}
		$result = sysserverDAO::getInstance()->updateByPk($id,$info);
		if(!empty($result)){
			return array('mes'=>'success','msg'=>'修改成功');
		}
		return array('mes'=>'false','msg'=>'修改失败');
	}

	/**
	 * @desc 获取单个服务器
	 * @param string $id ID
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function getSingleServer($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'获取出错');
		}
		$result = sysserverDAO::getInstance()->findByAttributes(array('refSigns'=>$id));
		if(!empty($result)){
			return $result;
		}
		return array('mes'=>'false','msg'=>'获取失败');
	}

	/**
	 * @desc 获取服务器列表
	 * @param int $page 页数
	 * @param int $psize 每页数
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function getServerByCond($page,$psize){
		$result = array();
		$demoList = sysserverDAO::getInstance()->getServerByCond($page,$psize);
		if(!empty($demoList) && is_array($demoList)){
			$result['result'] = 'success';
			$result['list'] = $demoList['list'];
			$result['count'] = $demoList['count'];
		}else{
			$result['result'] = 'error';
			$result['list'] = null;
			$result['count'] = 0;
		}
		return $result;
	}
}
?>
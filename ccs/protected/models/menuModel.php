<?php
/**
 * @desc 权限组表相关操作类
 * @author DengShaocong
 * @date 2015-11-11
 */
class menuModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回qxjsModel对象
	 * @return menuModel
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取菜单
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-11-11
	 */
	public function getMenu(){
		$result = array();
		$menuList = menuDAO::getInstance()->getMenu();
		if(!empty($menuList['info']) && is_array($menuList['info'])){
			$result['result'] = 'success';
			$result['list'] = $menuList['info'];
			$result['count'] = $menuList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

}
?>
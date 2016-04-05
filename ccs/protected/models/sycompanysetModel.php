<?php
/**
 * @desc 公司信息表相关操作类
 * @author Dengshaocong
 * @date 2015-11-16
 */
class sycompanysetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回sycompanysetModel对象
	 * @return sycompanysetModel
	 * @author Dengshaocong
	 * @date 2015-12-16
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取公司信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-14
	 */
	public function getGsxx(){
		$result = sycompanysetDAO::getInstance()->getGsxx();
		if(empty($result)){
			return array('res'=>'false','mes'=>'获取失败');
		}
		return $result;
	}

	/**
	 * @desc 更新公司信息
	 * @param int $id ID
	 * @param array $companyInfo 公司信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-16
	 */
	public function updateGsxx($id,$companyInfo){
		if(empty($id) || empty($companyInfo)){
			return array('res'=>'error','mes'=>'信息出错');
		}
		$result = sycompanysetDAO::getInstance()->updateByPk($id,$companyInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'更新失败');
		}
		return $result;
	}
}
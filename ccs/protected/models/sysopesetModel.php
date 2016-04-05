<?php
/**
 * @desc 操作记录表相关操作类
 * @author DengShaocong
 * @date 2015-12-2
 */
class sysopesetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回sysopesetModel对象
	 * @return sysopesetModel
	 * @author DengShaocong
	 * @date 2015-12-2
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加一条操作记录
	 * @param array $opeInfo 操作记录详情
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-2
	 */
	public function addOpeSet($opeInfo){
		if(empty($opeInfo)){
			return array('res'=>'error','mes'=>'未知错误');
		}
		$result = sysopesetDAO::getInstance()->insert($opeInfo,true);
		if(empty($result)){
			return array('res'=>'false','mes'=>'操作出错，添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}

	/**
	 * @desc 根据条件获取操作记录
	 * @param array $setCond 条件
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @author Dengshaocong
	 * @date  2015-12-02
	 */
	public function getCzjl($setCond,$page,$psize){
		$result = array();  //获取列表数据的结果
		$setList = sysopesetDAO::getInstance()->getCzjl($setCond,$page,$psize);

		//判断是否查询到有数据
		if(!empty($setList['info']) && is_array($setList['info'])){
			$result['result'] = 'success';
			$result['list'] = $setList['info'];
			$result['count'] = $setList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
}
?>
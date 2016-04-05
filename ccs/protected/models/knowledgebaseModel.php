<?php
/**
 * @desc 知识分类表相关操作类
 * @author Dengshaocong
 * @date 2016-01-08
 */
class knowledgebaseModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回knowledgebaseModel对象
	 * @return knowledgebaseModel
	 * @author Dengshaocong
	 * @date 2016-01-08
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加知识库
	 * @param array $zskInfo 知识库资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function addZsk($zskInfo){
		if(empty($zskInfo)){
			return array('res'=>'error','mes'=>'信息不全，添加出错');
		}
		$list = knowledgebaseDAO::getInstance()->getMaxZskNumber();
		$zskNo = '';
		if(!empty($list)){
			$date=substr($list['id'],2,4);
			if($date==date('ym')){
			   $id = substr($list['id'],-4,4);
			   $id += 1;
			   $zskId = sprintf("%04d",$id);
			   $zskNo = 'ZS'.date('ym').$zskId;
			}else{
				$id = '1';
				$zskId = sprintf("%04d",$id);
				$zskNo = 'ZS'.date('ym').$zskId;
			}
		}else{
			$id = '1';
			$zskId = sprintf("%04d",$id);
			$zskNo = 'ZS'.date('ym').$zskId;
		}
		$zskInfo['id'] = $zskNo;
		$result = knowledgebaseDAO::getInstance()->insert($zskInfo,true);

		if(empty($result)){
			return array('res'=>'false','mes'=>'添加错误');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}

	/**
	 * @desc 获取知识库
	 * @param array $condInfo 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function getZsk($condInfo){
		$result = array();
		$zsk = knowledgebaseDAO::getInstance()->getZsk($condInfo);
		if(!empty($zsk) && is_array($zsk)){
			$result['res'] = 'success';
			$result['list'] = $zsk;
		}else{
			$result['res'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc 获取一个知识库
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function getSingleZsk($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'获取出错');
		}
		$result = knowledgebaseDAO::getInstance()->findByAttributes(array('id'=>$id));
		return $result;
	}

	/**
	 * @desc 更新知识库
	 * @param int $id ID
	 * @param array $zskInfo 知识库资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function updateZsk($id,$zskInfo){
		if(empty($zskInfo) || empty($id)){
			return array('res'=>'error','mes'=>'信息不全，修改出错');
		}
		$result = knowledgebaseDAO::getInstance()->updateByPk($id,$zskInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'修改错误');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}

	/**
	 * @desc 删除知识库
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function deleteZsk($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'信息不全，删除出错');
		}
		$result = knowledgebaseDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'false','mes'=>'删除错误');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}
}
?>
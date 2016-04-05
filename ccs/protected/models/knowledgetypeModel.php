<?php
/**
 * @desc 知识分类表相关操作类
 * @author Dengshaocong
 * @date 2016-01-07
 */
class knowledgetypeModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回knowledgetypeModel对象
	 * @return knowledgetypeModel
	 * @author Dengshaocong
	 * @date 2016-01-07
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}


	/**
	 * @desc 添加知识分类
	 * @param array $zsflInfo 知识分类资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function addZsfl($zsflInfo){
		if(empty($zsflInfo)){
			return array('res'=>'error','mes'=>'信息为空，添加出错');
		}
		$result = knowledgetypeDAO::getInstance()->insert($zsflInfo,true);
		if(empty($result)){
			return array('res'=>'false','mes'=>'添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}


	//全局变量，用于接收知识分类信息
	public $typeGrobalInfo = array();
	/**
	 * @desc 获取一个分类的信息
	 * @param int $level 当前等级
	 * @param int $higherdept 上一级部门的编号
	 * @param int $limit 从第几个开始取（以0位开头）
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function getType($level,$highertype,$limit){
		$typeInfo = knowledgetypeDAO::getInstance()->getSingleType($level,$highertype,$limit);
		if(!empty($typeInfo)){
			array_push($this->typeGrobalInfo,$typeInfo);
		}
		$level ++;
		$highertype = $typeInfo['id'];
		$count = knowledgetypeDAO::getInstance()->getCurrentLevelNum($level,$highertype)['count'];	
		if(!empty($highertype)){
			for($i = 0;$i<$count;$i++){
				$this->getType($level,$highertype,$i);
			}
		}
		
	}

	/**
	 * @desc 获取部门信息
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function getTypeList(){
		$count = knowledgetypeDAO::getInstance()->getCurrentLevelNum(0,0)['count'];
		for($i = 0;$i < $count; $i ++){
			$this->getType(0,0,$i);
		}
		if(count($this->typeGrobalInfo)){
			return $this->typeGrobalInfo;
		}
		return array('res'=>'error','mes'=>'获取出错');
	}

	/**
	 * @desc 获取一个分类的信息（更新）
	 * @param int $id ID
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function getSingleFl($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'信息为空，获取出错');
		}
		$result = knowledgetypeDAO::getInstance()->findByAttributes(array('id'=>$id));
		if(empty($result)){
			return array('res'=>'false','mes'=>'获取失败');
		}
		return $result;
	}

	/**
	 * @desc 修改知识分类
	 * @param int $id ID
	 * @param array $zsflInfo 知识分类资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function updateZsfl($id,$zsflInfo){
		if(empty($id) || empty($zsflInfo)){
			return array('res'=>'error','mes'=>'信息为空，修改出错');
		}
		$result = knowledgetypeDAO::getInstance()->updateByPk($id,$zsflInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'修改失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}

	/**
	 * @desc 删除知识分类
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function deleteZsfl($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'信息为空，删除出错');
		}
		$result = knowledgetypeDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'false','msg'=>'删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}


	//全局变量，用于接收当前ID以及以下的知识分类名称
	public $typeString = "";
	/**
	 * @desc 获取当前ID以及以下的知识分类名称
	 * @param int $type ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function getTypeAndSon($type){
		$result = knowledgetypeDAO::getInstance()->findByAttributes(array('id'=>$type));
		if(!empty($result)){
			$this->typeString .= "'".$result['typename']."'";
			$this->getSon($type);
		}
		return $this->typeString;
	}

	/**
	 * @desc 获取当前ID以下的知识分类名称
	 * @param int $parent 上一级ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function getSon($parent){
		$result = knowledgetypeDAO::getInstance()->getSon($parent);
		if(!empty($result)){ 
			$this->typeString .= ','."'".$result['typename']."'";
			$this->getSon($result['id']);
		}
	}

	/**
	 * @desc 删除知识分类前的子分类验证
	 * @param int $id 分类ID
	 * @author DengShaocong
	 * @date 2016-04-01
	 */
	public function getZszfl($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'无ID');
		}
		$result = knowledgetypeDAO::getInstance()->findAllByAttributes(array('higherlevel'=>$id));
		if(empty($result)){
			return array('res'=>'false','msg'=>'无内容');
		}
		return array('res'=>'success','msg'=>'有内容');
	}
}
?>
<?php
/**
 * @desc 问卷表相关操作类
 * @author WuJunhua
 * @date 2016-01-07
 */
class whaaModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回whaaModel对象
	 * @return whaaModel
	 * @author WuJunhua
	 * @date 2016-01-07
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 添加问卷
	 * @param array $bookInfo 问卷信息
	 * @return array $result 结果信息
	 * @author WuJunhua
	 * @date 2016-01-07
	 */
	public function addBook($bookInfo){
		if(empty($bookInfo['whaa02'])){
			return array('res'=>'error','msg'=>'问卷名称不能为空');
		}
		if(empty($bookInfo['whaa03'])){
			return array('res'=>'error','msg'=>'问卷介绍不能为空');
		}
		$condition = array('whaa02' => $bookInfo['whaa02']);
		$bookResult = whaaDAO::getInstance()->isExists($condition);
		//添加问卷时不能有重复的问卷名称
		if($bookResult){
			return array('res'=>'error','msg'=>'该问卷名称已存在，请重新输入');
		}
		$result = whaaDAO::getInstance()->insert($bookInfo);
		if(empty($result)){
			return array('res'=>'error','msg'=>'添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 获取问卷列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 问卷列表信息
	 * @author WuJunhua
	 * @date 2016-01-09
	 */
	public function getQuestionnaireList($page,$psize){
		$result = array();  //获取列表数据的结果
		$orderList = whaaDAO::getInstance()->getQuestionnaireList($page,$psize);
		//判断是否查询到有数据
		if(!empty($orderList['info']) && is_array($orderList['info'])){
			$result['result'] = 'success';
			$result['list'] = $orderList['info'];
			$result['count'] = $orderList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 获取问卷详情
	 * @param int $bookId 问卷序号
	 * @return array $bookDetails 问卷信息
	 * @author WuJunhua
	 * @date 2016-01-08
	 */
	public function getBookDetails($bookId){
		if(empty($bookId)){
			return array('res' => 'error','msg' => '获取订单详情失败');
		}
		$bookDetails = whaaDAO::getInstance()->getBookDetails($bookId);
		if(empty($bookDetails)){
			return array('res' => 'error','msg' => '获取订单详情失败');
		}
		return $bookDetails;
	}

	/**
	 * @desc 修改问卷信息
	 * @param int $bookId 问卷序号
	 * @param array $bookInfo 问卷信息
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2016-01-08
	 */
	public function updateBookMsg($bookId,$bookInfo){
		//修改问卷名称时，不能有相同的问卷名称
		$result = whaaDAO::getInstance()->findByAttributes(array('whaa02' => $bookInfo['whaa02'],'whaa01 !=' => $bookId),array('whaa02'));
		if(!empty($result['whaa02'])){
			return array('res' => 'error','msg' => '该问卷名称已存在，请重新输入');
		}
		//修改问卷时，没有改变时会弹框
		$isChange = whaaDAO::getInstance()->findByAttributes(array('whaa01' => $bookId),array('whaa02','whaa03'));
		if($isChange['whaa02'] == $bookInfo['whaa02'] && $isChange['whaa03'] == $bookInfo['whaa03']){
			return array('res' => 'error','msg' => '没有做任何修改');
		}
		$updateResult = whaaDAO::getInstance()->update(array('whaa01' => $bookId),$bookInfo);
		if(empty($updateResult)){
			return array('res' => 'error','msg' => '保存失败');
		}
		return array('res' => 'success','msg' => '保存成功');
	}

	/**
	 * @desc 删除问卷
	 * @param int $bookId 问卷序号
	 * @return array 结果信息
	 * @author WuJunhua
	 * @date 2016-01-08
	 */
	public function deleteBookData($bookId){
		$deleteResult = whaaDAO::getInstance()->delete(array('whaa01' => $bookId));
		if(empty($deleteResult)){
			return array('res' => 'error','msg' => '删除失败');
		}
		return array('res' => 'success','msg' => '删除成功');
	}

}


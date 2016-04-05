<?php
/**
 * @desc 出库入库表相关操作类
 * @author huyan
 * @date 2016-02-18
 */
class cpafModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cpaeModel对象
	 * @return cpafModel
	 * @author huyan
     * @date 2016-02-18
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

    /**
	 * @desc 系统设置->数据清理->删除出库入库记录
	 * @author huyan
	 * @date 2016-02-18
	 */
	public function DelStorageRecords($jlsjq,$jlsjz,$crklx){
		//查询要删除的客户资料
		$result = cpafDAO::getInstance()->getStorageRecords($jlsjq,$jlsjz,$crklx);
		if (empty($result)){
			return array('res' => 'error','msg' => '没有查询到符合条件的出库或入库记录');
		}
		if (!empty($result)){
			$ddidArr = array();
		    foreach($result as $value){
			    $ddidArr[] = $value['cpaf01'];
		    }
		    $orderNum = count($ddidArr);
			for($i = 0;$i < $orderNum;$i++){
				//删除出入库记录
			    $deleteResult = cpafDAO::getInstance()->delete(array('cpaf01'=>$ddidArr[$i]));
			}
			return array('res' => 'success','msg' => '删除成功');
		}
	}

		/**
	 * @desc 获取库存明细-明细
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function getInventoryDetail($page,$psize,$CondList){
		$clientList = cpafDAO::getInstance()->getInventoryDetail($page,$psize,$CondList);
		//判断是否查询到有数据
		if(!empty($clientList['info']) && is_array($clientList['info'])){
			$result['result'] = 'success';
			$result['list'] = $clientList['info'];
			$result['count'] = $clientList['count'];
			$result['page'] = $page;
			$result['psize'] = $psize;
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
}

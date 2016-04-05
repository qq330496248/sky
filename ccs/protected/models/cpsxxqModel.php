<?php
/**
 * @desc 产品属性详情表相关操作类
 * @author DengShaocong
 * @date 2015-11-5
 */
class cpsxxqModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cpsxxqModel对象
	 * @return cpsxxqModel
	 * @author DengShaocong
	 * @date 2015-11-5
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 添加产品属性
	 * @param string $cpmc 产品名称
	 * @param array $cpsxxq 产品属性详情 
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-5
	 */
	public function addCpsxxq($cpmc,$cpsxxq){
		//$insert = array();
		$cp = cpaaDAO::getInstance()->findByAttributes(array('cpaa02' => $cpmc));	
		//$insert['cpid'] = $cp['cpaa01'];
		$cpsxxq['cpid'] = $cp['cpaa01'];
		$result = cpsxxqDAO::getInstance()->insert($cpsxxq);
		
		/*foreach($cpsxxq as $value){
			$insert['cpsxxq'] = $value;
			cpsxxqDAO::getInstance()->insert($insert);
		}*/
	}
	/**
	 * @desc 获取产品与产品属性的关联表详情
	 * @param string $cpid 产品ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-5
	 */
	public function GetCpsxxqFromCp($cpid){
		$cpsxxq = cpsxxqDAO::getInstance()->GetCpsxxqFromCp($cpid);
		//判断是否查询到有数据
		if(!empty($cpsxxq) && is_array($cpsxxq)){
			$result['result'] = 'success';
			$result['list'] = $cpsxxq['info'];
			//$result['count'] = $clientList['count'];
		}else{
			$result['result'] = 'error';
			//$result['count'] = 0;
		}
		return $result;
	}
}
?>
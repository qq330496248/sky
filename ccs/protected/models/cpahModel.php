<?php
/**
 * @desc 产品部门标示表相关操作类
 * @author Dengshaocong
 * @date 2016-03-31
 */
class cpahModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回cpahModel对象
	 * @return advertsetModel
	 * @author Dengshaocong
	 * @date 2016-03-31
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}


	/**
	 * @desc 添加部门标示
	 * @param string $cpmc 产品名称
	 * @param string $bmbsAll checkbox【共用】的内容（是否存在） 
	 * @param array $bmbs 部门标示内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-31
	 */
	public function addBmbs($cpmc,$bmbsAll,$bmbs){
		if(empty($bmbsAll) && empty($bmbs)){
			return array('res'=>'error','msg'=>'无需添加部门标示');
		}
		$cp = cpaaDAO::getInstance()->findByAttributes(array('cpaa02' => $cpmc));	
		//添加的内容
		$bmbsList['cpah01'] = $cp['cpaa01'];

		if(!empty($bmbsAll)){
			$deptList = deptsetDAO::getInstance()->findAllByAttributes(array('ifmarket'=>'是'));
			foreach ($deptList as  $value) {
				$bmbsList['cpah02'] = $value['deptID'];
				$bmbsList['cpah03'] = $value['depttext'];
				cpahDAO::getInstance()->insert($bmbsList,true);
			}
		}else{
			foreach ($bmbs as $value) {
				$demo = explode(':',$value);
				$bmbsList['cpah02'] = $demo[0];
				$bmbsList['cpah03'] = $demo[1];
				cpahDAO::getInstance()->insert($bmbsList,true);
			}
		}
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 根据产品ID删除部门标示
	 * @param int $cpid 产品ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-31
	 */
	public function deleteBmbs($cpid){
		if(empty($cpid)){
			return array('res'=>'error','msg'=>'未知错误');
		}
		cpahDAO::getInstance()->delete(array('cpah01'=>$cpid));
		return array('res'=>'success','msg'=>'添加成功');
	}

	/**
	 * @desc 根据产品ID更新部门标示
	 * @param int $cpid 产品ID
	 * @param string $bmbsAll checkbox【共用】的内容（是否存在） 
	 * @param array $bmbs 部门标示内容
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-31
	 */
	public function updateBmbs($cpid,$bmbsAll,$bmbs){
		if(empty($cpid)){
			return array('res'=>'error','msg'=>'未知错误');
		}
		$this->deleteBmbs($cpid);

		//添加的内容
		$bmbsList['cpah01'] = $cpid;

		if(!empty($bmbsAll)){
			$deptList = deptsetDAO::getInstance()->findAllByAttributes(array('ifmarket'=>'是'));
			foreach ($deptList as  $value) {
				$bmbsList['cpah02'] = $value['deptID'];
				$bmbsList['cpah03'] = $value['depttext'];
				cpahDAO::getInstance()->insert($bmbsList,true);
			}
		}else{
			foreach ($bmbs as $value) {
				$demo = explode(':',$value);
				$bmbsList['cpah02'] = $demo[0];
				$bmbsList['cpah03'] = $demo[1];
				cpahDAO::getInstance()->insert($bmbsList,true);
			}
		}
	}

	/**
	 * @desc 根据产品ID获取部门标示
	 * @param int $cpid 产品ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-03-31
	 */
	public function getBmbs($cpid){
		$demoList = cpahDAO::getInstance()->findAllByAttributes(array('cpah01'=>$cpid));
		$str = '';
		if(!empty($demoList)){
			foreach ($demoList as $value) {
				$str .= $value['cpah02'].':'.$value['cpah03'].',';
			}
			$str = substr($str, 0, -1);
		}
		return $str;
	}
}
?>
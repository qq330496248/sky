<?php
/**
 * @desc 登录操作类
 * @author DengShaocong
 * @date 2015-11-17
 */
class loginsetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回loginModel对象
	 * @return loginsetModel
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 登录
	 * @param string $ryid 人员ID
	 * @return integer $result 
	 * @author DengShaoocng
	 * @date 2015-11-17
	 */
	public function AddSet($ryid){
		$loginsetInfo = array();
		$loginsetInfo['username'] = $ryid;
		$loginsetInfo['loginip'] = $_SERVER['REMOTE_ADDR'];
		$loginsetInfo['logintime'] = date('Y-m-d H:i:s');
		$p = loginsetDAO::getInstance()->insert($loginsetInfo);
	}
	/**
	 * @desc 获取登录日志
	 * @param array $setCond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function getSet($setCond){
		$result = array();  //获取列表数据的结果
		$setList = loginsetDAO::getInstance()->getSet($setCond);

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
	/**
	 * @desc 修改登录日志，非本人
	 * @param int $id 日志ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function changeSelf($id){
		$result = array();
		if(empty($id)){
			$result['res'] = 'false';
			$result['mes'] = '异常，请联系管理员';
		}
		$set = loginsetDAO::getInstance()->findByAttributes(array('id' => $id));
		if($set['ifself'] == 'N'){
			$result['mes'] = '您已经提交过申请了，请勿重复申请！';
		}else{
			$loginInfo['ifself'] = "N";
			$o = loginsetDAO::getInstance()->updateByPk($id,$loginInfo);
			if($o > (-1)){
				$result['mes'] = '修改成功！';
			}else{
				$result['mes'] = '修改失败！';
			}
		}
		return $result;
	}
}
?>
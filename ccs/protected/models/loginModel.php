<?php
/**
 * @desc 登录操作类
 * @author DengShaocong
 * @date 2015-10-27
 */
class loginModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回loginModel对象
	 * @return loginModel
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 登录
	 * @param string $username 工号
	 * @param string $psd 密码
	 * @return integer $result 0-用户不存在|1-密码不正确|2-成功
	 * @author DengShaoocng
	 * @date 2015-10-27
	 */
	public function login($username,$psd){
		$result = 0;
		$p = rylistDAO::getInstance()->findByAttributes(array('username' => $username));
		
		if(empty($p)){
			$result['res'] = 'false';
			$result['mes'] = '用户不存在';
		}
		if($psd!=$p['pwd']){
			$result['res'] = 'false';
			$result['mes'] = '密码错误,请重新输入';
		}else{
			$result['res'] = 'success';
			$result['mes'] = '成功';
		}

		return $result;
	}
}
?>
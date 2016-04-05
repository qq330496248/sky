<?php
/**
 * @desc 登录登出控制器操作类
 * @author DengShaocong
 * @date 2015-11-12
 */	
class loginController extends Controller{
	public function actionIndex(){
		/*//******调试使用的******
		$sessionInfo['account'] = 'admin';
		$sessionInfo['password'] = 'admin';
		$sessionInfo['Competence'] = 'all';
		$sessionInfo['ip'] = '58.63.4.205';
		//$sessionInfo['ip'] = Yii::app()->request->getUserHostAddress();

		//测试用的工号、姓名
		$sessionInfo['account'] = Yii::app()->session['account'] = 'admin';
		$sessionInfo['password'] = Yii::app()->session['password'] = 'admin';
		$sessionInfo['name'] = Yii::app()->session['name'] = 'jxtx';
		$sessionInfo['Competence'] = Yii::app()->session['Competence'] = 'all';
		$sessionInfo['ip'] = Yii::app()->session['ip'] = '58.63.4.205';
		$this->assign('sessioninfo', $sessionInfo);*/
		$this->display('login.html');
	}
	/**
	 * @desc 首页模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetIndexHtml(){
		$sessionInfo = $this->getSessionInfo();
		if(empty($sessionInfo['account'])){
			$this->display('login.html');
			die;
		}
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('HttpHost',CLIENT_REQUESTS_ADDRESS);
		$this->display('index.html');
	}
	/**
	 * @desc 登录日志模板显示
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function actionGetDlrzHtml(){
		$sessionInfo = $this->getSessionInfo();
		if(empty($sessionInfo['account'])){
			$this->display('login.html');
			die;
		}
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('xtsz/dlrz.html');
	}
	/**
	 * @desc 登录
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionLogin(){
		$result = array();
		$username = CInputFilter::getString('username');
		$psd = md5(CInputFilter::getString('psd'));
		if(empty($username)){
			$result['res'] = "false";
			$result['mes'] = "用户名不能为空！";
			$this->renderJson($result);
		}
		if(empty($psd)){
			$result['res'] = "false";
			$result['mes'] = "密码不能为空！";
			$this->renderJson($result);
		}
		$result = rylistModel::model()->login($username,$psd);
		if(empty($result)){
			$result['res'] = "false";
			$result['mes'] = "未知错误，请联系管理员";
		}

		if($result['res'] == 'success'){
			//rylistModel::model()->online($result['list']['id']);
			loginsetModel::model()->AddSet($result['list']['username']);
			rylistModel::model()->updateLoginIP($result['list']['id']);
			$sessionInfo['id'] = Yii::app()->session['id'] = $result['list']['id'];
			$sessionInfo['account'] = Yii::app()->session['account'] = $result['list']['username'];
			$sessionInfo['password'] = Yii::app()->session['password'] = $result['list']['pwd'];
			$sessionInfo['name'] = Yii::app()->session['name'] = $result['list']['personname'];
			$sessionInfo['groupbh'] = Yii::app()->session['groupbh'] = $result['list']['postID'];
			$sessionInfo['post'] = Yii::app()->session['post'] = $result['list']['post'];
			$sessionInfo['Competence'] = Yii::app()->session['Competence'] = 'all';
			$sessionInfo['ip'] = Yii::app()->session['ip'] = '58.63.4.205';
			$sessionInfo['fenji'] = Yii::app()->session['fenji'] = $result['list']['fenji'];
		}
		$this->renderJson($result);
	}
	/**
	 * @desc 登出
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function actionLogOut(){
		rylistModel::model()->offline(Yii::app()->session['id']);
		rylistModel::model()->updateLoginTime(Yii::app()->session['id']);
		/*$sessionInfo['id'] = "";
		$sessionInfo['account'] = "";
		$sessionInfo['password'] = "";
		$sessionInfo['name'] = "";
		$sessionInfo['groupbh'] = "";
		$sessionInfo['Competence'] = "";
		$sessionInfo['ip'] = "";
		$sessionInfo['fenji'] = "";*/
		Yii::app()->session->clear();
		$result = array();
		$this->renderJson($result);
		//$this->actionIndex();
	}
	/**
	 * @desc 根据条件获取登录日志
	 * @author DengShaocong
	 * @date 2015-11-17
	 */
	public function actionGetSetByCond(){
		$setCond = array();
		$setCond['username'] = CInputFilter::getString("username");	
		$setCond['begindate'] = CInputFilter::getString("begindate");
		$setCond['enddate'] = CInputFilter::getString("enddate");
		$result = array();  //列表信息结果
		$result = loginsetModel::model()->getSet($setCond);
		$this->renderJson($result);
	}
	/**
	 * @desc 获取登录人员最后一次的登录时间
	 * @author DengShaocong
	 * @date 2015-11-23
	 */
	public function actionGetTime(){
		$result = array();
		$setCond['username'] = Yii::app()->session['account'];	
		$result = loginsetModel::model()->getSet($setCond);
		$this->renderJson($result);
	}
	/**
	 * @desc 非本人登录的修改操作
	 * @author DengShaocong
	 * @date 2015-11-23
	 */
	public function actionChangeSelf(){
		$result = array();
		$id = CInputFilter::getString("id");
		$result = loginsetModel::model()->changeSelf($id);
		$this->renderJson($result);
	}
}

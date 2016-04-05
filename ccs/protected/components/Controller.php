<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * @desc smarty assign function
	 * @param string $key
	 * @param mixed $value
	 */
	public function assign($key, $value) {
// 		Yii::app()->smarty->assign($key, $value);
		$app = Yii::app();			//CWebApplication对象
		$smarty = $app->smarty;		//CModule::__get创建对象
		$smarty->assign($key,$value);
	}
	
	/**
	 * @desc smarty display function
	 * @param string $view
	 */
	public function display($view) {
		Yii::app()->smarty->display($view);
	}
	
	/**
	 * @desc 检测用户是否登录
	 * @author ChenLuoyong
	 * @date 2014-10-31
	 */
	protected function checkLogin()
	{
		$userInfo = Yii::app()->session['userInfo'];
		if(empty($userInfo['userid'])){
			$this->redirect(array('/'));
		}
		return true;
	}
	
	/**
	 * @desc 获取访问的请求来源
	 * @author ChenLuoyong
	 * @date 2014-11-1
	 */
	protected function getRequestSource()
	{
		return CInputFilter::getInt('s');
	}
	
	/* @des 对象转换成数组
	 * @author Zijie Yuan
	 * @para string
	 * @date 2014-11-13
	 * @return array
	 */
	function object_to_array($obj){
		$arr = array();
	  	$_arr = is_object($obj) ? get_object_vars($obj) :$obj;
	  	foreach ($_arr as $key=>$val){
	   		$val = (is_array($val) || is_object($val)) ? $this->object_to_array($val):$val;
	   		$arr[$key] = $val;
	  	}
	  return $arr;
	}
	
	/**
	 * @desc 数据转换成json格式
     * @param mixed $data 数据
     * @param string $encode 是否json_encode
	 * @author Zijie Yuan
	 * @date 2014-11-13
	 * @modify YangLong 2015-04-23 增加不encode的功能
     * @return void|boolean
     */
	protected function renderJson($data, $encode = TRUE)
    {
        if (empty($data)) {
            return false;
        }
        header('Content-type: application/json');
        if ($encode) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        Yii::app()->end();
    }
	
	/**
	 * @desc 检测第三方登录,未登录则通知对方登录，否则返回true
	 * @author ChenLuoyong
	 * @date 2014-11-29
	 * @return mixed
	 */
	protected function checkCK1Login($action = '')
	{
		$userInfo = Yii::app()->session['userInfo'];
		if(empty($userInfo)){
			if($_SERVER['QUERY_STRING']){	//r=xxx/xxx/xxx
				Yii::app()->session['action'] = substr($_SERVER['QUERY_STRING'],2);	//未登录时记录路径，从r=后读取控制器路径
			}
			$login_notify_url = Yii::app()->params['ck1_login_notify_url'];
			$this->redirect(array($login_notify_url));
		}
		return true;
	}
	
	/**
	 * @desc 验证用户的权限
	 * @param int  $permission 需要验证的权限
	 * @$returnValue bool 是否要返回int 0|1
	 * @return bool true | false
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	public function checkPermission($permission,$returnValue = FALSE){
		if(empty($permission)){
			if($returnValue){
				return PdsConst::USER_NOT_ADMIN;
			}
			return false;
		}
		//读取session中的权限
		$sessionInfo = Yii::app()->session[PdsConst::SESSION_USER_PERMISSION];
		if(empty($sessionInfo)){
			if($returnValue){
				return PdsConst::USER_NOT_ADMIN;
			}
			return false;
		}
		if($sessionInfo == $permission){
			if($returnValue){
				return PdsConst::USER_ADMIN;
			}
			return true;
		}else{
			if($returnValue){
				return PdsConst::USER_NOT_ADMIN;
			}
			return false;
		}
	}

	/**
	 * @desc 获取用户全部的session信息
	 * @return array $sessionInfo 需要的session信息的数组
	 * @author WuJunhua
	 * @date 2015-11-10
	 */
	public function getSessionInfo(){
		$sessionInfo['id'] = Yii::app()->session['id'];
		$sessionInfo['account'] = Yii::app()->session['account'];
		$sessionInfo['password'] = Yii::app()->session['password'];
		$sessionInfo['name'] = Yii::app()->session['name'];
		$sessionInfo['Competence'] = Yii::app()->session['Competence'];
		$sessionInfo['ip'] = Yii::app()->session['ip'];
		$sessionInfo['groupbh'] = Yii::app()->session['groupbh'];
		$sessionInfo['gonghao'] = $sessionInfo['account'].':'.$sessionInfo['name'];
		$sessionInfo['fenji'] = Yii::app()->session['fenji'];
		return $sessionInfo;
	}
}
<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$redisConfig = dirname(__FILE__).'/protected/config/redis.php';
//define('CALLED_RECORD_DIR', dirname(__FILE__).'/public/apilog/callrecord.txt');	// 通话记录存放路径文件   /* 测试旧的获取通话记录时用 */

//设定查询条件的默认开始时间和结束时间
define('DEFAULT_START_TIME', date('Y-m-01', strtotime(date("Y-m-d"))));
define('DEFAULT_CURRENT_TIME',date('Y-m-d'));
define('DEFAULT_END_TIME', ' 23:59:59');

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
defined('DEFAULT_CONTROLLER') or define('DEFAULT_CONTROLLER','site');

define('YII_ENABLE_EXCEPTION_HANDLER',false);
define('YII_ENABLE_ERROR_HANDLER',false);

define('PAGE_SIZE',25);	//默认一页显示多少记录

define('LOCAL_DEBUG',true);		//是否本地测试
define('WRITE_APILOG',true);	//接口数据是否写入日志

define('RUNTIMELOG',false); // 是否记录运行时间

//获取服务器地址
if($_SERVER['HTTP_HOST'] == 'localhost'){
	define('CLIENT_REQUESTS_ADDRESS', $_SERVER['HTTP_HOST'].'/ccs');  
}else{
	define('CLIENT_REQUESTS_ADDRESS', $_SERVER['HTTP_HOST']);  
}

require_once($yii);
require_once($redisConfig);

Yii::createWebApplication($config)->run();

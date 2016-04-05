<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$redisConfig = dirname(__FILE__).'/protected/config/redis.php';

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

require_once($yii);
require_once($redisConfig);

if (php_sapi_name() === 'cli'){
	if (isset($argv[1])) {
		$_GET['r'] = $argv[1];
		$opArray = explode('=', $argv[2]);
		$_GET[$opArray[0]] = $opArray[1];
		$cnoArray = explode('=', $argv[3]);
		$_GET[$cnoArray[0]] = $cnoArray[1];
	} else {
		die('no controller action param');
	}
	Yii::createWebApplication($config)->run();
}
else{
	die('Not CLI Execute Mode');
}

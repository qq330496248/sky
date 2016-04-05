<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	//'name'=>'ccs',
	'defaultController' => 'login',
	// preloading 'log' component
	'preload'=>array('log', 'Kint'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.extensions.smarty.sysplugins.*',
		'application.enum.*',
		'application.dao.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),*/
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'smarty'=>array(	//enable smarty class
			'class'=>'application.extensions.CSmarty',
		),
		'Kint'=>array(
			'class'=>'ext.Kint.Kint',
		),
		'cache'=>array(
				'class'=>'CFileCache',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
 				/*array(
 					'class'=>'CWebLogRoute',
 				),*/
			),
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			// 'urlFormat'=>'path',
			'caseSensitive'=>false,
		),
		
		// database settings
		'db'=>array(
			//'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=127.0.0.1;dbname=db000',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),

		'dbCdr'=>array(
			'class'=>'CDbConnection',   //操作多个数据库时，加上这个配置
			'connectionString' => 'mysql:host=192.168.10.230;dbname=singhead',
			'emulatePrepare' => true,
			'username' => 'JXTX',
			'password' => 'JXTX123456',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),

		/*'dbHu'=>array(  //测试singhead的服务器
			'class'=>'CDbConnection', 
			'connectionString' => 'mysql:host=192.168.10.219;dbname=singhead',
			'emulatePrepare' => true,
			'username' => 'test',
			'password' => '123456',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),*/

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        /*'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning'
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute'
                )
            )
        ), */
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'home_url' => 'http://oms.xunyitong.com',
		'serviceEmail'=>'308134042@qq.com',	// this is used in contact page
		'entriesPerPage'=>50,
		'online_env'=>false,
		/*'redis_conn'=>array(
				'default'=>array('ip'=>'192.168.1.207','port'=>'6379'),
			),*/
		'excel'=>'excel/',
		'upload' => 'public/template/images/upload/',
		'attachment' => 'attachment/',
		'addresslabel' => 'addresslabel/'
	),
);

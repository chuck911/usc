<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'USC Community',
	'theme'=>'bootstrap',
	'language'=>'zh_CN',
	'defaultController'=>'pick',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.eauth.*',
		'ext.eauth.services.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			'generatorPaths'=>array('bootstrap.gii'),
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'QWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>require('db.php'),

		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap', 
			//'enableJS'=>false,
    ),

		'eauth'=>array(
			'class'=>'ext.eauth.EAuth',
			'popup'=>false,
			'services'=>array(
				'qq' => array(
					'class' => 'QQOAuthService',
					'client_id' => '100288026',
					'client_secret' => 'a2a5a76c80551bcd65ce8816c35932c8',
				),
				'renren' => array(
					'class' => 'RenrenOAuthService',
					'client_id' => 'e29c5ee4ce004e0e8956cde4654a82f6',
					'client_secret' => 'ee062f6a045e4f599c5951281e7c776b',
				),
			),
		),
		
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'language'=>'es',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.vendors.phpexcel.PHPExcel',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'prueba-1',
			'ipFilters' => array( $_SERVER [ 'REMOTE_ADDR' ]), 
		),
		
	),

	// application components
	'components'=>array(
		'ePdf'	=>array(
			'class'		=>'ext.yii-pdf.EYiiPdf',
			'params'	=>array(
				'mpdf'	=>array(
					'librarySourcePath'	=>'application.vendors.mpdf.*',
					'constants'			=>array(
						'_MPDF_TEMP_PATH'	=>Yii::getPathOfAlias('application.runtime'),
					),
					'class'=>'mpdf',
				),
			),
		),
			
		'user'=>array(
			// enable cookie-based authentication
			//'allowAutoLogin'=>true,
			'loginUrl'=>array('site/login?callback='.$_GET['callback']),
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=sisscsj',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'prueba-1',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
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
		'request'=>array(
			'enableCsrfValidation'=>false,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema',
	'language'=>'es',
	'sourceLanguage'=>'es',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		'application.extensions.yii-mail.*',
	),

	'modules'=>array(

		'rights' => array(
            'install' => false,
            'userIdColumn' => 'id',
            'userNameColumn' => 'nombreUsuario',
        ),
		'gii'=>array(
			'generatorPaths' => array(
          'bootstrap.gii'),
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>false,
		),
	),

	// application components
	'components'=>array(
		'cliente'=>array(
             'class'=>'application.components.MiCliente',
             'ws_url'=>'http://192.168.1.50/desarrollo/plataformaYii/australOftalmologia/index.php?r=informes/ws',
       ),
		 'ePdf' => array(
        'class'         => 'ext.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf'     => array(
                'librarySourcePath' => 'application.extensions.MPDF56.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                    'mode'              => '', //  This parameter specifies the mode of the new document.
                    'format'            => 'A4', // format A4, A5, ...
                    'default_font_size' => 0, // Sets the default document font size in points (pt)
                    'default_font'      => '', // Sets the default font-family for the new document.
                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                    'mgr'               => 15, // margin_right
                    'mgt'               => 16, // margin_top
                    'mgb'               => 16, // margin_bottom
                    'mgh'               => 9, // margin_header
                    'mgf'               => 9, // margin_footer
                    'orientation'       => 'P', // landscape or portrait orientation
                )*/
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'application.extensions.html2pdf.*',
                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                    'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                )*/
            )
        ),
    ),
		'mailer' => array(
    'class' => 'ext.swiftMailer.SwiftMailer',
    // For SMTP
    'mailer' => 'smtp',
    'host'=>'ssl://smtp.gmail.com',
    'port'=>'465',
    'From'=>'asoc.australdeoftalmologia@gmail.com',
    'username'=>'asoc.australdeoftalmologia@gmail.com',
    'password'=>'andy8399',
),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'RWebUser',

		),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
		),
		 'bootstrap'=>array(
            'class' => 'ext.bootstrap.components.Bootstrap',
	    	'responsiveCss' => true,
        ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=db;dbname=australOftalmologia',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'vertrigo',
			'charset' => 'utf8',
		),
		'db2'=>array(
            'class'=>'CDbConnection',
            'connectionString'=>'mysql:host=localhost;dbname=centrooftalmologia',
            'username'=>'root',
            'password'=>'vertrigo',
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
				//array(
				// 	'class'=>'CWebLogRoute',
				// ),
				
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
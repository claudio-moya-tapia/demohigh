<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Mundialero',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'rayalab2013',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '192.168.*.*'),
        ),
    ),
    // application components
    'components' => array(
        //Custom component: database
        'cacheUsers' => array('class' => 'CacheUsers'),
        //Custom component: database
        'useDatabase' => array('class' => 'UseDatabase'),
        //Custom component: aes encrypter
        'aesManager' => array('class' => 'AesManager'),
        //Custom component: login
        'loginFormShared' => array('class' => 'LoginFormShared'),
        //Custom component: detector mobile
        'mobileDetected' => array('class' => 'MobileDetected'),
        //Custom component: assetManagerCustom para activar o desactivar la publicacion de assets		
        'assetManager' => array(
            'class' => 'CAssetManagerCustom',
            'publish' => false
        ),
        //Custom component: scriptUrl para corregir urls de css y js, SOLO en PROD:
        /*
          'request'=>array(
          'scriptUrl' => '',
          ),
         */
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'detectMobileBrowser' => array(
            'class' => 'application.extensions.yii-detectmobilebrowser.XDetectMobileBrowser',
        ),
        //Custom component: urlManager para corregir urls globales
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            //'baseUrl'=>'', //SOLO en PROD
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            'driver' => 'GD',
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'defaultRoles' => array('authenticated', 'guest'),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'aesSystem' => array(
            'tokenSystem' => 'xxxxx',
            'mode' => 'xxxxx',
            'iv' => 'xxxxx'
        ),
        'enviroment' => 'dev',
        'projectName' => 'mundialero2014',
        'baseUrl' => 'http://www.mundialero.cl',
        'baseUrlImg' => 'http://mundialero2014.storage.googleapis.com',
        'baseUrlGs' => 'gs://mundialero2014',
        'baseUrlJson' => 'http://www.mundialero.cl',
        'gsBucket' => 'mundialero2014', 
        'dataBaseConfig' => array(
            //'connectionString'=>'mysql:unix_socket=/cloudsql/mundialero2014:mundialero;dbname=',
            'connectionString' => 'mysql:host=xxxxx;dbname=',
            'user' => 'xxxxx',
            'pass' => 'xxxxx',
        ),
        'dataBases' => array(
            'rayalab' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_rayalab',
                'layout' => 'main_system'
            ),
            'enaex' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_enaex',
                'layout' => 'main_system'
            ),
            'fch' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_fch',
                'layout' => 'main_system'
            ),
            'dcv' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_dcv',
                'layout' => 'main_system'
            ),
            'skberge' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_skberge',
                'layout' => 'main_system'
            ),
            'anden' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_anden',
                'layout' => 'main_system'
            ),
            'bbva' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_bbva',
                'layout' => 'main_system_bbva'
            ),
            'credicorp' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_credicorp',
                'layout' => 'main_system'
            ),
            'ripley' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_ripley',
                'layout' => 'main_system_ripley'
            ),
            'skchile' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_skchile',
                'layout' => 'main_system'
            ),
            'afphabitat' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_afphabitat',
                'layout' => 'main_system'
            ),
            'clc' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_clc',
                'layout' => 'main_system'
            ),
            'skc' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_skc',
                'layout' => 'main_system'
            ),
            'cmr' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_cmr',
                'layout' => 'main_system'
            ),
            'bancofalabella' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_bancofalabella',
                'layout' => 'main_system'
            ),
            'falabella' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_falabella',
                'layout' => 'main_system'
            ),
            'santander' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_santander',
                'layout' => 'main_system'
            ),
            'tironi' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_tironi',
                'layout' => 'main_system'
            ),
            'euroamerica' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_euroamerica',
                'layout' => 'main_system_euroamerica'
            ),
            'aesgener' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_aesgener',
                'layout' => 'main_system'
            ),
            'contract' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_contract',
                'layout' => 'main_system'
            ),
            'ucinf' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_ucinf',
                'layout' => 'main_system'
            ),
            'bancochile' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_bancochile',
                'layout' => 'main_system_euroamerica'
            ),
            'gruposiglo' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_gruposiglo',
                'layout' => 'main_system'
            ),
            'colbun' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_colbun',
                'layout' => 'main_system_colbun'
            ),
            'cchc' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_cchc',
                'layout' => 'main_system'
            ),
            'cristal' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_cristal',
                'layout' => 'main_system'
            ),
            'brotecicafal' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_brotecicafal',
                'layout' => 'main_system_brotecicafal'
            ),
            'raya' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_raya',
                'layout' => 'main_system'
            ),
            'anam' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_anam',
                'layout' => 'main_system'
            ),
            'copec' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_copec',
                'layout' => 'main_system'
            ),
            'tmfgroup' => array(
                'connectionString' => 'mysql:host=xxxxx;dbname=',
                'dbname' => 'mundialero_tmfgroup',
                'layout' => 'main_system'
            ),
        )
    ),
);

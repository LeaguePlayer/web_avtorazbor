<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

//add modules and db file config
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'modules.php');  // $modules
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db.php');       // $db_config

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Авторазбор',
    'language' => 'ru',
    'theme'=>'default',
    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'appext.shoppingCart.*',
        'appext.imagesgallery.*',
        'appext.YiiMailer.*',
        'appext.crontab.*',
        //'application.components.shoppingCart.*'
        //'application.behaviors.*',
    ),
    'aliases'=>array(
        'appext'=>'application.extensions',
    ),
    'modules'=> array(
    // uncomment the following to enable the Gii tool

    'gii'=>array(
        'class'=>'system.gii.GiiModule',
        'password'=>'qwe123',
        'ipFilters'=>array('127.0.0.1','::1'),
        'generatorPaths'=>array(
            'application.gii',
        ),
        //'import' => array(
        //  'appext.imagesgallery.GalleryBehavior',
        //),
    ),
    'admin'=>array(),
    'email'=>array(),
    'auth'=>array(
        'defaultLayout' => 'application.modules.admin.views.layouts.custom'
    ),
    'user'=>array(
        # encrypting method (php hash function)
        'hash' => 'md5',
        # send activation email
        'sendActivationMail' => true,

        # allow access for non-activated users
        'loginNotActiv' => false,

        # activate user on registration (only sendActivationMail = false)
        'activeAfterRegister' => false,

        # automatically login from registration
        'autoLogin' => true,

        # registration path
        'registrationUrl' => array('/user/registration'),

        # recovery password path
        'recoveryUrl' => array('/user/recovery'),

        # login form path
        'loginUrl' => array('/user/login'),

        # page after login
        'returnUrl' => array('/user/profile'),

        # page after logout
        'returnLogoutUrl' => array('/user/login'),
    ),
),

    // application components
    'components'=>array(
        // 'cart' => array(
        //     'class' => 'appext.shoppingCart.EShoppingCart',
        //     'onUpdatePosition' => array('CartNotifer', 'updatePosition'),
        //     'onRemovePosition' => array('CartNotifer', 'removePosition'),
        //     'discounts' => array(
        //         array(
        //             'class' => 'appext.shoppingCart.discounts.TestDiscount',
        //         ),
        //     ),
        // ),
        // 'clientScript'=>array(
        //     'scriptMap' => array(
        //         'jquery' => false,
        //         'jquery.js' => 'http://code.jquery.com/jquery-1.11.0.min.js',
        //         //'form.css' => '/css/blueprint.form.css'
        //      ),
        // ),
        'cart' =>array(
            'class' => 'appext.shoppingCart.EShoppingCart',
        ),
        'swiftmail'=> array(
            'class' => 'SwiftmailerComponent'
        ),
        'excel'=> array(
            'class' => 'ExcelComponent'
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',// 'auth.components.CachedDbAuthManager',
            //'cachingDuration' => 0,
            'itemTable' => '{{authitem}}',
            'itemChildTable' => '{{authitemchild}}',
            'assignmentTable' => '{{authassignment}}',
            'behaviors' => array(
                'auth' => array(
                    'class' => 'auth.components.AuthBehavior',
                ),
            ),
        ),
        'user'=>array(
            'class' => 'application.modules.user.components.WebUser',
        ),
        'bootstrap'=>array(
            'class'=>'appext.yiistrap.components.TbApi',
        ),
        'yiiwheels' => array(
            'class' => 'appext.yiiwheels.YiiWheels',
        ),
        'phpThumb'=>array(
            'class'=>'appext.EPhpThumb.EPhpThumb',
            'options'=>array()
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'showScriptName'=>false,
            'urlFormat'=>'path',
            'rules'=>array(
                'gii'=>'gii',
                'admin'=>'admin/start/index',
                '/'=>'site/index',

                'page/service'=>'page/service',

                'catalog/<alias:[\w\-]+>/<id:\d+>'=>'catalog/car',
                'detail/parts'=>'detail/parts',
                'detail/<alias:[\w\-]+>/<id:\d+>'=>'detail/view',

                '<controller:page|news>/<alias:(\w|\-)+>'=>'<controller>/view',
                '<controller:\w+>'=>'<controller>/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<alias:\w+>'=>'<controller>/view',
            ),
        ),
        'clientScript'=>array(
            'class'=>'EClientScript',
            'scriptMap' => array(
                'jquery' => false,
                'jquery.js' => 'http://code.jquery.com/jquery-1.11.0.js',
                'jquery.min.js' => '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
             ),
        ),
        'date' => array(
            'class'=>'application.components.Date',
            //And integer that holds the offset of hours from GMT e.g. 4 for GMT +4
            'offset' => 0,
        ),
        'db' => $db_config,
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
                /*array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'error, warning, trace, profile, info',
                    'enabled'=>true,
                ),*/
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(),
);
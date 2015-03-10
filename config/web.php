<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'sintret-projects',
    'name' => 'Sintret Projects',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'adminlte',
    'homeUrl' => '/projects',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hQtvUtJQWdasasaeXS5OLnuwiDPkB4ixYwQD',
            'baseUrl' => '/projects',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhPManager'  'yii\rbac\PhPManager'
            'defaultRoles' => ['user'],
        ],
        
        'util' => [
            'class' => 'app\components\Util',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            //'enableStrictParsing' => true,
            'class' => 'app\components\SintretUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'logout' => 'site/logout',
                'login' => 'site/login',
                '' => 'site/index',
            //'debug/<controller>/<action>' => 'debug/<controller>/<action>',
            ]
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module',
// other module settings
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            'downloadAction' => 'gridview/export/download',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvdynagrid/messages',
                'forceTranslation' => true
            ]
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'sintret' => [
                'class' => 'sintret\gii\generators\crud\Generator',
            ],
            'sintretModel' => [
                'class' => 'sintret\gii\generators\model\Generator'
            ]
        ]
    ];
}

return $config;

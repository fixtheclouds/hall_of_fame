<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'the-id',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/admin',
            'rules' => [
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/uploads/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'thumbnail' => [
            'class' => 'sadovojav\image\Thumbnail',
            'cachePath' => '@webroot/cache'
        ]
    ],
    'params' => $params,
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'modelMap' => [
                'User' => 'common\models\User',
                'Profile' => 'common\models\Profile'
            ],
            'controllerMap' => [
                'security' => [
                    'class' => 'dektrium\user\controllers\SecurityController',
                    'layout' => '@backend/views/layouts/login'
                ],
                'recovery' => [
                    'class' => 'dektrium\user\controllers\RecoveryController',
                    'layout' => '@backend/views/layouts/login'
                ],
                'registration' => [
                    'class' => 'dektrium\user\controllers\RegistrationController',
                    'layout' => '@backend/views/layouts/login'
                ]
            ],
            'enableRegistration' => false
        ]
    ]
];

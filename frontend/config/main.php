<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
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
            'baseUrl' => '/',
            'rules' => [
                'my_account' => 'event/actual'
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@frontend/views/user'
                ],
            ],
        ],
        'imageresize' => [
            'class' => 'noam148\imageresize\ImageResize',
            'cachePath' => 'assets/images',
            'useFilename' => true,
            'absoluteUrl' => false,
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
                'RegistrationForm' => 'frontend\models\RegistrationForm',
                'Profile' => 'common\models\Profile'
            ],
            'controllerMap' => [
                'settings' => 'frontend\controllers\SettingsController',
                'recovery' => 'frontend\controllers\RecoveryController',
                'profile' => 'frontend\controllers\ProfileController',
                'registration' => 'frontend\controllers\RegistrationController'
            ],
            'enableConfirmation' => false,
            'enableGeneratingPassword' => true,
            'enableFlashMessages' => false
        ]
    ],
    'aliases' => [
        //'@thumb' => '/',
    ]
];

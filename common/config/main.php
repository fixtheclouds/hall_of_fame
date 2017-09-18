<?php
return [
    'language' => 'ru-RU',
    'name' => 'Галерея славы',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'settings' => [
            'class' => 'pheme\settings\components\Settings'
        ],
    ],
    'modules' => [
        'settings' => [
            'class' => 'pheme\settings\Module',
            'sourceLanguage' => 'ru'
        ],
    ],
];

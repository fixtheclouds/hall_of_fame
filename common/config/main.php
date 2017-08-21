<?php
return [
    'language' => 'ru-RU',
    'name' => 'Галерея славы',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ]
    ],
    'modules' => [
        'rbac' => 'dektrium\rbac\RbacWebModule'
    ],
];

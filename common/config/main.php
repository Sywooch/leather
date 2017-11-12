<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=timetobu.mysql.tools;dbname=timetobu_leather',
        'username' => 'timetobu_leather',
        'password' => '6nkjjebc',
        'charset' => 'utf8',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];

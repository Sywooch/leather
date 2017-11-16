<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute'=> '/shop/index',
    'language' => 'en-EN',
    'sourceLanguage' => 'en-EN',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'baseUrl'=>'/',
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'action' => \yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY, // используем временный редирект вместо постоянного
            ],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                "/" => 'shop/index',
                "products" => 'shop/catalog',
                "contact" => 'shop/contact',
                "<slug:.*>/<id:\d+>" => 'shop/product',
            ],
        ],
        'formatter' => [
            'locale' => 'ru-Ru',
            'dateFormat' => 'd/M/Y',
            'datetimeFormat' => 'd/M/Y H:i',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => '',
        ],
        
    ],
    'params' => $params,
];

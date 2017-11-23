<?php

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1'){
    $db = [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=leather',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ];

    $email = [
        'class' => 'yii\swiftmailer\Mailer',
        'viewPath' => '@common/mail',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => true,
    ];

} else {
    $db = [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=timetobu.mysql.tools;dbname=timetobu_leather',
        'username' => 'timetobu_leather',
        'password' => '6nkjjebc',
        'charset' => 'utf8',
    ];

    $email = [
        'class' => 'yii\swiftmailer\Mailer',
        'viewPath' => '@common/mail',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'mail.ukraine.com.ua',
            'username' => 'info@diano.store',
            'password' => 'RR392EIesui4',
            'port' => '2525',
            'encryption' => 'tls',
        ],
    ];
}


return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

    'components' => [
        'cache' => [
            'class' => 'yii\caching\DbCache',
        ],

        'db' => $db,
        'mailer' => $email,
    ],
    'modules' => [
       'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ]
    ],
   
];

<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],

    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Api',
        ],
        'track' => [
            'class' => 'app\modules\track\Track',
        ],
    ],

    'components' => [

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IWd7JlzhyaqEdtInLU5szeAiRwTO-L3m',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class
            ]
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
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [

                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],

                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logVars'=> [],
                    'categories' => ['yii\db\Command::execute'],
                    'logFile' => '@runtime/logs/execute.log',
                ],



            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                'track/<action>'=> 'track/track/<action>',

                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => 'api/track',
                    'extraPatterns' => [

                        // multiple POST /api/tracks/multiple
                        // body [ ids: "1,...9", "status":"TrackModule valid status" ]
                        'POST multiple' => 'multiple',
                    ],
                ],

            ],

        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
         'allowedIPs' => ['127.0.0.1', '::1'],

    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

<?php
use \yii\web\Request;
$baseUrl = str_replace('/app', null, (new Request)->getBaseUrl());
return [
    'id' => 'app',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\controllers',
    'bootstrap' => ['log', 'app\components\bootstrap\ModuleLoader', 'app\components\bootstrap\Setting'],
    'components' => [
        'assetManager' => [
            'basePath' => '@webroot/web/assets',
            'baseUrl' => '@web/app/web/assets',
        ],
        'request' => [
            'baseUrl' => $baseUrl,
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
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
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => '<app>/site/captcha',
                    'route' => 'site/captcha',
                ],
                [
                    'pattern' => '<app>/<module>',
                    'route' => '<module>',
                ],
                [
                    'pattern' => '<app>/<module>/<action>',
                    'route' => '<module>/default/<action>',
                ],
                [
                    'pattern' => '<app>/<module>/<controller>',
                    'route' => '<module>/<controller>',
                ],
                [
                    'pattern' => '<app>/<module>/<controller>/<action>',
                    'route' => '<module>/<controller>/<action>',
                ],
            ]
        ],
    ],
    'params' => [],
];

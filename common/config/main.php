<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', //'yii\rbac\PhpManager', // 或者使用  'yii\rbac\DbManager'
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    /* 'userClassName' => 'app\models\User', */
                    'idField' => 'user_id',
                    'usernameField' => 'username',
                    'fullnameField' => 'profile.full_name',
                    'extraColumns' => [
                        [
                            'attribute' => 'full_name',
                            'label' => 'Full Name',
                            'value' => function ($model, $key, $index, $column) {
                                return $model->profile->full_name;
                            },
                        ],
                        [
                            'attribute' => 'dept_name',
                            'label' => 'Department',
                            'value' => function ($model, $key, $index, $column) {
                                return $model->profile->dept->name;
                            },
                        ],
                        [
                            'attribute' => 'post_name',
                            'label' => 'Post',
                            'value' => function ($model, $key, $index, $column) {
                                return $model->profile->post->name;
                            },
                        ],
                    ],
                    'searchClass' => 'app\models\UserSearch',
                ],
            ],
            'layout' => 'left-menu',
            'menus' => [
                'assignment' => [
                    'label' => 'Grant Access', // change label
                ],
                'route' => null, // disable menu
            ],
            'mainLayout' => '@app/views/layouts/main.php',
        ],
    ],
    // 'as access' => [
    //     'class' => 'mdm\admin\components\AccessControl',
    //     'allowActions' => [
    //         'site/*',
    //         'admin/*',
    //         'some-controller/some-action',
    //         //此处的action列表，允许任何人（包括游客）访问
    //         //所以如果是正式环境（线上环境），不应该在这里配置任何东西，为空即可
    //         //但是为了在开发环境更简单的使用，可以在此处配置你所需要的任何权限
    //         //在开发完成之后，需要清空这里的配置，转而在系统里面通过RBAC配置权限
    //     ],
    // ],
];

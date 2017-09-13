<?php
return [
    'components' => [
        // list of component configurations
        'errorHandler' => [
                    'class' => 'yii\web\ErrorHandler',
                    'errorAction' => 'admin/default/error',
                    //'view' => '@app/modules/admin/views/default/error.php'
                ]
    ],
    'params' => [
        // list of parameters
    ],
];
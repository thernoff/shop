<?php

namespace app\modules\cabinet;

use yii\filters\AccessControl;

/**
 * cabinet module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\cabinet\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    //для авторизованных пользователей разрешаем все действия
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                   
                ],
            ],
        ];
    }
}

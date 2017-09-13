<?php

namespace app\modules\admin;
use Yii;
use yii\filters\AccessControl;
use app\modules\admin\models\UserRecord;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        //Yii::$app->errorHandler->errorAction = 'admin/default/error';
        \Yii::configure($this, require(__DIR__ . '/config/config.php'));
        $handler = $this->get('errorHandler');
        \Yii::$app->set('errorHandler', $handler);
        $handler->register();
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
    
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        // your custom code here
        if (!Yii::$app->user->isGuest){
            $user = UserRecord::findOne(Yii::$app->user->identity->getId());
            if (($user->role->alias !== 'admin') && ($user->role->alias !== 'manager')){
                \Yii::$app->response->redirect('/main/index')->send();
                return false; // or false to not run the action
            }
            
        }
        return true;
    }
}

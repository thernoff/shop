<?php

namespace app\modules\cabinet\controllers;

use Yii;
use yii\web\Controller;
//use app\modules\cabinet\models\User;
use app\models\User;
use app\modules\cabinet\models\ChangePasswordForm;
/**
 * Default controller for the `cabinet` module
 */
class CabinetController extends AppCabinetController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $user = User::findOne(Yii::$app->user->identity->getId());

        return $this->render('view', ['model' => $user]);
    }
    
    public function actionChangePassword()
    {
        $user = User::findOne(Yii::$app->user->identity->getId());
        $model = new ChangePasswordForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->changePassword()){
            return $this->render('view', ['model' => $user]);
        }
        return $this->render('_form-change-password', ['model' => $model]);
    }
    
    public function actionUpdate()
    {
        $user = User::findOne(Yii::$app->user->identity->getId());

        if ($user->load(Yii::$app->request->post()) && $user->save()){
            return $this->render('view', ['model' => $user]);
        }
        return $this->render('update', ['model' => $user]);
    }
}

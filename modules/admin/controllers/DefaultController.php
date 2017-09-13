<?php

namespace app\modules\admin\controllers;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();
            return $this->render('error', [
                'statusCode' => $statusCode,
                'exception' => $exception,
                'name' => $name,
                'message' => $message,
            ]);
        }
        return $this->render('error');
    }
}

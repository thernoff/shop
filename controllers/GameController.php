<?php

namespace app\controllers;

use Yii;
use app\models\Genre;
use app\models\Game;

class GameController extends AppController
{ 
    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $game = Game::findOne($id);//"ленивая" загрузка
        if (empty($game)){
            throw new \yii\web\HttpException(404, "Данный вид продукта отсутствует.");
        }
        //debug($game);die;
        //$game = Game::find()->with('genre')->where(['id' => $id])->limit(1)->one();//"жадная" загрузка
        $this->setMetaTags('GameShop :: ' . $game->title, $game->keywords, $game->short_description);
        return $this->render('view', compact('game'));
    }
}
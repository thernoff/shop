<?php

namespace app\controllers;

use Yii;
use app\models\Genre;
use app\models\Game;
use yii\data\Pagination;

class GenreController extends AppController
{
    public function actionIndex()
    {
        $this->setMetaTags('GameShop');
        return $this->render('index');
    }
    
    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $genre = Genre::findOne($id);
        if (empty($genre)){
            throw new \yii\web\HttpException(404, "Указанная категория отсутствует.");
        }
        //$games = Game::find()->where(['genre_id' => $id])->all();
        //Получаем объект запроса
        $query = Game::find()->where(['genre_id' => $id]);
        //Создаем объект класса Pagination
        $pages = new Pagination([
            'totalCount' => $query->count(), 
            'pageSize' => 9,
            //'forcePageParam' => false,//?
            'pageSizeParam' => false,//убираем per-page из url
        ]);
        //
        $games = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        $this->setMetaTags('GameShop :: ' . $genre->name, $genre->keywords, $genre->description);
        return $this->render('view', compact('games', 'genre', 'pages'));
    }
    
    public function actionSearch()
    {
        $search = trim(Yii::$app->request->get('search'));
        if (!$search){
            return $this->render('search');
        }
        //Получаем объект запроса
        $query = Game::find()->where(['like', 'title', $search]);
        //Создаем объект класса Pagination
        $pages = new Pagination([
            'totalCount' => $query->count(), 
            'pageSize' => 9,
            //'forcePageParam' => false,//?
            'pageSizeParam' => false,//убираем per-page из url
        ]);
        //
        $games = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        $this->setMetaTags('GameShop :: ' . $search);
        return $this->render('search', compact('games', 'pages', 'search'));
    }
}
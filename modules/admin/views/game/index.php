<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Games';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить игру', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'title',
            [
                'attribute' => 'title',
                'value' => function($data){
                    return "<a href=" . Url::to(['game/update', 'id' => $data->id]) . ">" . $data->title. "</a>";
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'genre_id',
            [
                'attribute' => 'genre_id',
                'value' => function($data){
                    return $data->genre->name;
                },
            ],
            //'publisher_id',
            [
                'attribute' => 'publisher_id',
                'value' => function($data){
                    return $data->publisher->name;
                },
            ],
            //'pub_data',
            // 'multipleer',
            // 'coop',
            // 'is_new',
            [
                'attribute' => 'is_new',
                'value' => function($data){
                    return !$data->is_new ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            // 'is_popular',
            // 'is_recomend',
            // 'discount',
             'price',
            // 'status',
            // 'title_image',
            // 'description:ntext',
            // 'keywords',
            // 'short_description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

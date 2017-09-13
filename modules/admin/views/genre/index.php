<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Genres';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Genre', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function($data){
                    return $data->genre->name ? $data->genre->name : "Без родителя";
                }
            ],
            
            'keywords',
            'description',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

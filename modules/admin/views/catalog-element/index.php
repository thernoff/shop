<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Содержимое справочника';
$this->params['breadcrumbs'][] = $this->title;
//debug($dataProvider);die;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['catalog/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Создать элемент', Url::to(['create', 'catalogId' => $catalogId]) , ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {link}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-eye-open"></span>', 
                       Url::to(['catalog-element/view', 'id' => $model->id, 'catalogId' => $model::$catalogId]));
                    },
                    'update' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>', 
                       Url::to(['catalog-element/update', 'id' => $model->id, 'catalogId' => $model::$catalogId]));
                    },
                    'delete' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>', 
                       Url::to(['catalog-element/delete', 'id' => $model->id, 'catalogId' => $model::$catalogId]));
                    },
                ],
            ],
        ],
    ]); ?>
</div>

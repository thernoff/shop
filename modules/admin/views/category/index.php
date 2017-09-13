<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['product/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Создать категорию', ['create', 'productId' => $productId], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'alias',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function($model){
                    return $model->parentId->name ? $model->parentId->name : "Без родителя";
                }
            ],
            
            //'keywords',
            //'description',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->status ? '<span class = "text-success">Активна</span>' : '<span class = "text-danger">Не активна</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {link}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-eye-open"></span>', 
                       Url::to(['category/view', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                    'update' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>', 
                       Url::to(['category/update', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                    'delete' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>', 
                       Url::to(['category/delete', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                ],
            ],
        ],
    ]); ?>
</div>

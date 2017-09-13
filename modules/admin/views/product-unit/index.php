<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список экземпляров продукта';
$this->params['breadcrumbs'][] = $this->title;
//debug($dataProvider);die;
//debug($arrVisibleColumns);die;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['product/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить экземпляр товара', Url::to(['create', 'productId' => $productId]) , ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'columns' => $arrVisibleColumns,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        
            'id',
            'title',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function($model){
                    return $model->category->name;
                }
            ],
            'price',
            //'discount_id',
            [
                'attribute' => 'discount_id',
                'value' => function($model){
                    return $model->discount->procent ? $model->discount->procent . '%' : '0%';
                }
            ],
            //'status'
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->status ? '<span class = "text-success">Активен</span>' : '<span class = "text-danger">Не активен</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            'count',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {link}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon  glyphicon-eye-open"></span>', 
                       Url::to(['product-unit/view', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                    'update' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>', 
                       Url::to(['product-unit/update', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                    'delete' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>', 
                       Url::to(['product-unit/delete', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                ],
            ],
        ],
    ]); ?>
</div>

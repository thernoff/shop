<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'alias',
            
            [
                'label' => 'Категории',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        'Категории',
                        Url::to(['category/index', 'productId' => $model->id]),
                        [
                            'title' => 'Категории',
                            'class' => 'btn btn-primary',
                            //'target' => '_blank'
                        ]
                    );
                }
            ],
            
            [
                'label' => 'Экземпляры товара',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        'Экземпляры товара',
                        Url::to(['product-unit/index', 'productId' => $model->id]),
                        [
                            'title' => 'Экземпляры товара',
                            'class' => 'btn btn-primary',
                            //'target' => '_blank'
                        ]
                    );
                }
            ],
            
            [
                'label' => 'Добавить свойство',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        'Добавить свойство',
                        Url::to(['property/index', 'productId' => $model->id]),
                        [
                            'title' => 'Добавить свойство',
                            'class' => 'btn btn-primary',
                            //'target' => '_blank'
                        ]
                    );
                }
            ],
      
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

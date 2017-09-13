<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Скидки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать скидку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'procent',
            'start',
            'end',
            //'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    return !$model->status ? '<span class = "text-danger">Не активна</span>' : '<span class = "text-success">Активна</span>';
                }
            ],
            [
                'label' => 'Действие скидок',
                'format' => 'raw',
                'value' => function($model){
                    return !$model->isDiscount() ? '<span class = "text-danger">Закончились</span>' : '<span class = "text-success">Идут</span>';
                },
            ],
            
            [
                'label' => 'Продукты со скидками',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        'Продукты со скидками',
                        Url::to(['discount-product/index', 'discountId' => $model->id]),
                        [
                            'title' => 'Продукты со скидками',
                            //'target' => '_blank'
                            'class' => 'btn btn-primary'
                        ]
                    );
                }
            ],
                    
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

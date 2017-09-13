<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список заказов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'id',
                'value' => function($data){
                    return "<a href=" . Url::to(['order/view', 'id' => $data->id]) . ">Заказ №" . $data->id. "</a>";
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            [
                'attribute' => 'user_id',
                'value' => function($data){
                    return !$data->user_id ? '<span class = "text-danger">Без регистрации</span>' : '<span class = "text-success">' . $data->user->login . '</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ? '<span class = "text-danger">Активен</span>' : '<span class = "text-success">Завершен</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'status',
            // 'name',
            // 'email:email',
            // 'phone',
            // 'address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

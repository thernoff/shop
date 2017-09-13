<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить нового пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'login',
            'username',
            'lastname',
            'email:email',
            'phone',
            // 'password',
            // 'role_id',
            [
                'attribute' => 'role_id',
                'value' => function($model){
                    return $model->role->name;
                }
            ],
            // 'auth_key',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

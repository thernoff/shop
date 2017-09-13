<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\common\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'id_parent',
            [
                'attribute' => 'id_parent',
                'value' => function($model){
                    return $model->category->name;
                }
            ],
            'title',
            'alias',
            'path',
            'content:raw',
            'keywords',
            'description',
            //'status',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->status ? '<span class = "text-success">Активна</span>' : '<span class = "text-danger">Не активна</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ]
        ],
    ]) ?>

</div>

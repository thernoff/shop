<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Discount */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Скидки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Скидки', ['index'], ['class' => 'btn btn-primary']) ?>
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
            'name',
            'procent',
            'start',
            'end',
            //'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ? '<span class = "text-danger">Не активна</span>' : '<span class = "text-success">Активна</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
        ],
    ]) ?>

</div>

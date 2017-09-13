<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Genre */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Genres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index',  'productId' => $model::$productId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id, 'productId' => $model::$productId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, 'productId' => $model::$productId], [
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
            [
                'attribute' => 'parent_id',
                'value' => function($model){
                    return $model->parentId->name ? $model->parentId->name : "Без родителя";
                }
            ],
            //'parent_id',
            'name',
            'alias',
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

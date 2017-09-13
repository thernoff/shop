<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

//$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'name',
            'alias',
            //'type',
            [
                'attribute' => 'type_id',
                'value' => function($model){
                    return $model->type->name;
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'value',
            [
                'attribute' => 'value',
                'value' => function($model){
                    return $model->getDefaultValue();
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'required',
            [
                'attribute' => 'required',
                'value' => function($model){
                    return !$model->required ? '<span class = "text-success">Нет</span>' : '<span class = "text-danger">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'visible',
            [
                'attribute' => 'visible',
                'value' => function($model){
                    return !$model->visible ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
        ],
    ]) ?>

</div>

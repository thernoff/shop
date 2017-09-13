<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список свойств';
$this->params['breadcrumbs'][] = $this->title;
//debug($dataProvider);die;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['product/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Создать свойство', Url::to(['create', 'productId' => $productId]) , ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'alias',
            //'type_id',
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
                    if ($model->type->alias == 'string'){
                        return 'Наибольшее количество символов: ' . $model->value;
                    }
                    
                    if ($model->type->alias == 'number'){
                        return 'Значение по умолчанию: ' . $model->value;
                    }
                    
                    if ($model->type->alias == 'boolean'){
                        return !$model->value ? '<span class = "text-success">Нет</span>' : '<span class = "text-danger">Да</span>';
                    }
                    
                    if ($model->type->alias == 'file'){
                        return 'Имя файла: ' . $model->value;
                    }
                    
                    if ($model->type->alias == 'catalog'){
                        return 'Имя справочника: ' . \app\modules\admin\models\Catalog::findOne($model->value)->name;
                    }
                    
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
            [
                'attribute' => 'visible',
                'value' => function($model){
                    return !$model->visible ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //['class' => 'yii\grid\ActionColumn'],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {link}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-eye-open"></span>', 
                       Url::to(['property/view', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                    'update' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>', 
                       Url::to(['property/update', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                    'delete' => function ($url,$model) {
                        return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>', 
                       Url::to(['property/delete', 'id' => $model->id, 'productId' => $model::$productId]));
                    },
                ],
            ],
        ],
    ]); ?>
</div>

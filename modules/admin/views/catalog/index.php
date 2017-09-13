<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Справочники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать справочник', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'alias',
            'product',
            
            [
                'label' => 'Содержимое',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        'Содержимое',
                        Url::to(['catalog-element/index', 'catalogId' => $model->id]),
                        [
                            'title' => 'Содержимое',
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

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Game */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $img = $model->getImage();?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            //'genre_id',
            [
                'attribute' => 'genre_id',
                'value' => $model->genre->name,
            ],
            //'publisher_id',
            [
                'attribute' => 'publisher_id',
                'value' => $model->publisher->name,
            ],
            'pub_data',
            //'multipleer',
            [
                'attribute' => 'multipleer',
                'value' => function($data){
                    return !$data->multipleer ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'coop',
            [
                'attribute' => 'coop',
                'value' => function($data){
                    return !$data->coop ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'is_new',
            [
                'attribute' => 'is_new',
                'value' => function($data){
                    return !$data->is_new ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'is_popular',
            [
                'attribute' => 'is_popular',
                'value' => function($data){
                    return !$data->is_popular ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'is_recomend',
            [
                'attribute' => 'is_recomend',
                'value' => function($data){
                    return !$data->is_recomend ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            'discount',
            'price',
            //'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ? '<span class = "text-danger">Нет</span>' : '<span class = "text-success">Да</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'image',
            [
                'attribute' => 'image',
                'value' => "<img src='{$img->getUrl()}'>",
                'format' => 'html'
            ],
            'description:html',
            'keywords',
            'short_description',
        ],
    ]) ?>

</div>

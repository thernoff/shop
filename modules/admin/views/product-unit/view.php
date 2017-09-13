<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index', 'productId' => $productId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id, 'productId' => $productId,], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<h3>Основные свойства</h3>
<?php $img = $model->getImage();?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //Вывод базовых свойств
            'id',
            'title',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function($model){
                    return $model->category->name;
                }
            ],
            //'is_new',
            [
                'attribute' => 'is_new',
                'value' => function($model){
                    return $model->is_new ? '<span class = "text-success">Да</span>' : '<span class = "text-danger">Нет</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'is_popular',
            [
                'attribute' => 'is_popular',
                'value' => function($model){
                    return $model->is_popular ? '<span class = "text-success">Да</span>' : '<span class = "text-danger">Нет</span>';
                },
                'format' => 'raw',// или 'format' => 'html'
            ],
            //'is_recomend',
            [
                'attribute' => 'is_recomend',
                'value' => function($model){
                    return $model->is_recomend ? '<span class = "text-success">Да</span>' : '<span class = "text-danger">Нет</span>';
                },
                'format' => 'raw',
            ],
            //'discount_id',
            [
                'attribute' => 'discount_id',
                'value' => function($model){
                    return $model->discount_id ? $model->discount->procent . '%' : $model->discount_id . '%';
                }
            ],
            'price',
            //'status',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->status ? '<span class = "text-success">Активен</span>' : '<span class = "text-danger">Не активен</span>';
                },
                'format' => 'raw',
            ],
            //'title_image',
            [
                'attribute' => 'image',
                'label' => 'Главное изображение',
                'value' => "<img src='{$img->getUrl('100x')}'>",
                'format' => 'html'
            ],
            //'description',
            [
                'attribute' => 'description',
                'value' => function($model){
                    return $model->description;
                },
                'format' => 'raw',
            ],
            'keywords',
            'short_description'
        ],
    ]) ?>
    <?php if(!empty($additionalProperties)): ?>
        <h3>Дополнительные свойства</h3>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => $additionalProperties,
        ]) ?>
    <?php endif; ?>
</div>

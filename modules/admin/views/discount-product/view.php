<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DiscountProduct */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Discount Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'product_id' => $model->product_id, 'category_id' => $model->category_id, 'product_unit_id' => $model->product_unit_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'product_id' => $model->product_id, 'category_id' => $model->category_id, 'product_unit_id' => $model->product_unit_id], [
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
            'name',
            'discount_id',
            'product_id',
            'category_id',
            'product_unit_id',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DiscountProduct */

$this->title = 'Update Discount Product: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Discount Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'product_id' => $model->product_id, 'category_id' => $model->category_id, 'product_unit_id' => $model->product_unit_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="discount-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'discountId' => $discountId
    ]) ?>

</div>

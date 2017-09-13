<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = 'Изменение экземпляра товара: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'additionalProperties' => $additionalProperties,
        'fieldsAdditionalProperties' => $fieldsAdditionalProperties,
        'parentCategories' => $parentCategories,
        'parentCategories1' => $parentCategories1,
        'productId' => $productId,
    ]) ?>

</div>

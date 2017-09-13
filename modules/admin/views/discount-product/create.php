<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DiscountProduct */

$this->title = 'Добавить скидку к товару (группе товаров)';
$this->params['breadcrumbs'][] = ['label' => 'Discount Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'discount' => $discount,
        'discountId' => $discountId
    ]) ?>

</div>

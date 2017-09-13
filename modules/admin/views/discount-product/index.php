<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты со скидками';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['discount/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить продукт', ['create', 'discountId' => $discountId], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            //'discount_id',
            [
                'attribute' => 'discount_id',
                'value' => function($model){
                    return $model->discount->procent . '%';
                },
            ],
            //'product_id',
            [
                'attribute' => 'product_id',
                'value' => function($model){
                    $product = app\modules\admin\models\Product::findOne($model->product_id);
                    return $product->name;
                },
            ],
            //'category_id',
            [
                'attribute' => 'category_id',
                'value' => function($model){
                    $product = app\modules\admin\models\Product::findOne($model->product_id);
                    $category = $product->getCategory($model->category_id);
                    return $category->name;
                },
            ],
            //'product_unit_id',
            [
                'attribute' => 'product_unit_id',
                'value' => function($model){
                    $product = app\modules\admin\models\Product::findOne($model->product_id);
                    $productUnit = $product->getProductUnit($model->product_unit_id);
                    return $productUnit->title;
                },
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
        ],
    ]); ?>
</div>

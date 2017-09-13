<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1>Просмотр заказа №<?= Html::encode($model->id) ?></h1>

    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'created_at',
            'updated_at',
            'qty',
            'sum',
            //'status',
            [
                'attribute' => 'status',
                'value' => !$model->status ? '<span class = "text-danger">Активен</span>' : '<span class = "text-success">Завершен</span>',
                'format' => 'raw',// или 'format' => 'html'
            ],
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>
    <h3>Список товаров:</h3>
    <?php $items = $model->orderItems; ?>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr class="active">
                <th class="cart-product-name item">Название</th>
                <th class="cart-qty item">Количество</th>
                <th class="cart-sub-total item">Цена за единицу</th>
                <th class="cart-total last-item">Всего</th>
            </tr>
        </thead><!-- /thead -->
        <tbody>
            <?php
                $totalQty = 0;
                $totalSum = 0;
            ?>
            <?php foreach ($items as $item):?>
            <?php
                $totalQty += $item['qty_item'];
                $totalSum += $item['price'] * $item['qty_item'];
            ?>
                <tr>
                        <td class="cart-product-name-info">
                                <p>
                                    <b><?= $item['name']?></b>
                                </p>
                        </td>
                        
                        <td class="cart-product-quantity">
                            <div class="quant-input">
                               <p><?= $item['qty_item']?></p>
                            </div>
                        </td>
                        <td class="cart-product-sub-total"><span class="cart-sub-total-price"><?= $item['price']?></span></td>
                        <td class="cart-product-grand-total"><span class="cart-grand-total-price"><?= $item['price'] * $item['qty_item']?></span></td>
                </tr>
            <?php endforeach; ?>
                <tr class="info">
                    <td colspan="3">
                        Количество товара:
                    </td>
                    <td colspan="1">
                        <?php echo $totalQty; ?>
                    </td>
                </tr>
                <tr class="info">
                    <td colspan="3">
                        Итоговая стоимость:
                    </td>
                    <td colspan="1">
                        <?php echo $totalSum; ?>
                    </td>
                </tr>
        </tbody><!-- /tbody -->
    </table><!-- /table -->
</div>
</div>

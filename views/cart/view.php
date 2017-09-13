<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php  if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=Yii::$app->session->getFlash('success');?>
    </div>
<?php endif; ?>
<?php  if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=Yii::$app->session->getFlash('error');?>
    </div>
<?php endif; ?>
<?php if (!empty($session['cart'])): ?>
<h1>Оформление заказа</h1>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="cart-romove item">Удалить</th>
                <th class="cart-description item">Изображение</th>
                <th class="cart-product-name item">Название</th>
                <th class="cart-qty item">Количество</th>
                <th class="cart-sub-total item">Цена за единицу</th>
                <th class="cart-total last-item">Всего</th>
            </tr>
        </thead><!-- /thead -->
        <tfoot>
                <tr>
                    <td colspan="5">
                        Количество товара:
                    </td>
                    <td colspan="1">
                        <?= $session['cart.qty']?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        Итоговая стоимость:
                    </td>
                    <td colspan="1">
                        <?= $session['cart.sum']?>
                    </td>
                </tr>
        </tfoot>
        <tbody>
            <?php foreach ($session['cart'] as $productId => $productUnits):?>
                <?php foreach ($productUnits as $id => $productUnit):?>
                    <tr>
                            <td class="romove-item"><a href="#" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
                            <td class="cart-image">
                                    <a class="entry-thumbnail" href="<?= Url::to(['main/detail', 'productId' => $productId, 'id' => $id] ); ?>">
                                        <?= yii\helpers\Html::img( $productUnit["img"], 
                                                [
                                                    'data-echo' => $productUnit["img"],
                                                    'width' =>100,
                                                    'height' => 150,
                                                    'alt' => $productUnit["title"],
                                                    'class' => 'img-responsive',
                                                ]);
                                        ?>
                                    </a>
                            </td>
                            <td class="cart-product-name-info">
                                    <h4 class='cart-product-description'>
                                        <a href="<?= Url::to(['main/detail', 'productId' => $productId, 'id' => $id] ); ?>">
                                            <?= $productUnit['title']?>
                                        </a>
                                    </h4>
                                    <div class="row">
                                            <div class="col-sm-4">
                                                    <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                    <div class="reviews">

                                                    </div>
                                            </div>
                                    </div><!-- /.row -->
                                    <!--<div class="cart-product-info">
                                            <span class="product-imel">IMEL:<span>084628312</span></span><br>
                                            <span class="product-color">COLOR:<span>White</span></span>
                                    </div>-->
                            </td>

                            <td class="cart-product-quantity">
                                <div class="quant-input">
                                    <span><?= $productUnit['qty']?></span>
                                </div>
                            </td>
                            <td class="cart-product-sub-total"><span class="cart-sub-total-price"><?= $productUnit['price']?></span></td>
                            <td class="cart-product-grand-total"><span class="cart-grand-total-price"><?= $productUnit['price'] * $productUnit['qty']?></span></td>
                    </tr>
            <?php endforeach; ?>
                <?php endforeach; ?>
                
        </tbody><!-- /tbody -->
    </table><!-- /table -->
</div>

    <div>
        <?php $form = ActiveForm::begin() ?>
            <?php
                if (!Yii::$app->user->isGuest){
                    $user = \app\models\User::findOne(Yii::$app->user->identity->getId());
                    $order->name = $user->username;
                    $order->email = $user->email;
                    $order->phone = $user->phone;
                }
                echo $form->field($order, 'name');
                echo $form->field($order, 'email');
                echo $form->field($order, 'phone');
                echo $form->field($order, 'address')->textarea();
                echo Html::submitButton('Заказать', ['class' => 'btn btn-success']);
            ?>
        <?php ActiveForm::end() ?>
    </div>
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>
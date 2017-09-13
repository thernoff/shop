<?php if (!empty($session['cart'])): ?>
<div class="table-responsive">
        <table class="table table-bordered">
                <thead>
                        <tr>
                                <th class="cart-romove item">Убрать</th>
                                <th class="cart-description item">Изображение</th>
                                <th class="cart-product-name item">Название</th>
                                <th class="cart-total last-item">Цена</th>
                        </tr>
                </thead><!-- /thead -->
                <tbody>
                    <?php foreach ($session['cart'] as $id => $item):?>
                        <tr>
                                <td class="romove-item text-center"><span class="icon del-item" data-id="<?= $id; ?>"><i class="fa fa-trash-o" ></i></span></td>
                                <td class="cart-image">
                                        <a class="entry-thumbnail" href="#">
                                            <?=
                                            yii\helpers\Html::img('/images/title-image/' . $item["img"], 
                                            [
                                                'data-echo' => '/images/title-image/' . $item["img"],
                                                'width' =>100,
                                                'height' => 130,
                                                'alt' => $item["title"],
                                                'class' => 'img-responsive',
                                            ]);
                                            ?>
                                        </a>
                                </td>
                                <td class="cart-product-name-info">
                                        <h4 class='cart-product-description'><a href="detail.html"><?= $item['title']?></a></h4>
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
                                <td class="cart-product-grand-total"><span class="cart-grand-total-price"><?= $item['price'];?></span></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Итого</td>
                        <td colspan="1"><?= $session['cart.qty']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">На сумму</td>
                        <td colspan="1"><?= $session['cart.sum']; ?></td>
                    </tr>
                </tbody><!-- /tbody -->
        </table><!-- /table -->
</div>
<?php else: ?>
<h3>Корзина пуста</h3>
<?php endif; ?>
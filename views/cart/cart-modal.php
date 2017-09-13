<div class="dropdown dropdown-cart">
        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown" role="button">
                <div class="items-cart-inner">
                        <div class="total-price-basket">
                                <span class="lbl">Корзина -</span>
                                <span class="total-price">
                                        <span class="sign">$</span>
                                        <span class="value"><?= $session['cart.sum']; ?></span>
                                </span>
                        </div>
                        <div class="basket">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                        </div>
                        <div class="basket-item-count"><span class="count"><?= $session['cart.qty']; ?></span></div>

            </div>
        </a>
        <?php if (!empty($session['cart'])): ?>
        <ul class="dropdown-menu dropdown-menu-cart">
            <li>
                <?php foreach ($session['cart'] as $id => $item):?>
                <div class="cart-item product-summary">
                        <div class="row">
                                <div class="col-xs-3">
                                        <div class="image">
                                                <a href="detail.html">
                                        <?=
                                            yii\helpers\Html::img('/images/title-image/' . $item["img"], 
                                            [
                                                'data-echo' => '/images/title-image/' . $item["img"],
                                                'width' =>20,
                                                'height' => 25,
                                                'alt' => $item["title"],
                                                'class' => 'img-responsive',
                                            ]);
                                        ?></a>
                                        </div>
                                </div>
                                <div class="col-xs-8">

                                        <h3 class="name"><a href="index.php?page-detail"><?= $item['title']?></a></h3>
                                        <div class="price">Цена за <?= $item['qty']?> шт.: <?= $item['price'] * $item['qty']?></div>
                                </div>
                                <div class="col-xs-1 action trash">
                                        <a href="#" class="del-item" data-id="<?= $id; ?>"><i class="fa fa-trash"></i></a>
                                </div>
                        </div>
                </div><!-- /.cart-item -->
                <?php endforeach; ?>
                <div class="clearfix"></div>
                <hr>

                <div class="clearfix cart-total">
                    <div class="pull-right">

                                    <span class="text">Кол-во:</span><span class='price'><?= $session['cart.qty']; ?></span>
                                    <span class="text">Стоимость:</span><span class='price'><?= $session['cart.sum']; ?></span>

                    </div>
                    <div class="clearfix"></div>

                    <a href="<?= yii\helpers\Url::to(['cart/view']); ?>" class="btn btn-upper btn-primary btn-block m-t-20">Оформить</a>	
                </div><!-- /.cart-total-->


            </li>
        </ul><!-- /.dropdown-menu-->
        <?php else: ?>
        <ul class="dropdown-menu">
            <li>
                <div class="row">Корзина пуста</div>
                </li>
        </ul>
        <?php endif; ?>
</div><!-- /.dropdown-cart -->
<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<section class="section seller-product wow fadeInUp">
    <h3 class="section-title">Бестселлеры</h3>
        <div class="row outer-top-xs">
            <?php foreach($productUnits as $productUnit): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="products">
                        <div class="product">
                            <div class="product-micro">
                                <div class="row product-micro-row">
                                    <div class="col col-xs-6">
                                        <div class="product-image">
                                            <div class="image">
                                                <?php 
                                                    //$mainImg = $productUnit->getImage();
                                                    $mainImg = $productUnit->image;
                                                ?>
                                                <a href="<?= Url::to(['main/detail', 'productId' => $productUnit->_productId, 'id' => $productUnit->id] ); ?>">
                                                    <?= Html::img($mainImg->getUrl('150x210'), [
                                                        'data-lightbox' =>$mainImg->getUrl('150x210'), 
                                                        'alt' => $productUnit->title,
                                                        //'src' => "/images/blank.gif",
                                                        //'width' => 195,
                                                        //'height' => 243,
                                                        ]);
                                                    ?>
                                                </a>
                                            </div><!-- /.image -->

                                        </div><!-- /.product-image -->
                                    </div><!-- /.col -->
                                    <div class="col col-xs-6">
                                        <div class="product-info">
                                            <h4 class="name">
                                                <a href="<?= Url::to(['main/detail', 'productId' => $productUnit->_productId, 'id' => $productUnit->id] ); ?>">
                                                    <?= $productUnit->title; ?>
                                                </a>
                                            </h4>
                                            <div class="rating rateit-small"></div>
                                            <div class="product-price">	
                                                <?php if ($productUnit->discount->procent && $productUnit->discount->isDiscount()):?>
                                                <?php 
                                                    $price = $productUnit->price;
                                                    $discount = $productUnit->discount->procent;
                                                    $newPrice = (int)($price * (1 - ($discount / 100)));
                                                ?>
                                                    <div class="product-price">	
                                                        <span class="price">
                                                            <?= $newPrice; ?>
                                                        </span>
                                                        <span class="price-before-discount"><?= $productUnit->price; ?></span>

                                                    </div><!-- /.product-price -->
                                                <?php else: ?>
                                                    <div class="product-price">	
                                                        <span class="price">
                                                            <?= $productUnit->price; ?>
                                                        </span>
                                                    </div><!-- /.product-price -->
                                                <?php endif; ?>
                                            </div><!-- /.product-price -->
                                            <div class="action m-t-10">
                                                <a  class="lnk btn btn-primary add-to-cart"
                                                    href="<?= \yii\helpers\Url::to(['cart/add', 'productUnitId' => $productUnit->id, 'productId' => $productUnit->_productId]); ?>" 
                                                    data-product-unit-id="<?= $productUnit->id;?>"
                                                    data-product-id="<?= $productUnit->_productId;?>"
                                                >
                                                    В корзину
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.product-micro-row -->
                            </div><!-- /.product-micro -->
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</section>
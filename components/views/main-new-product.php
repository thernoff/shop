<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    <div class="more-info-tab clearfix ">
       <h3 class="new-product-title pull-left">Новинки</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                <?php foreach($arrNewProducts as $key => $productUnits): ?>
                    <?php if ($key == 'all'): ?>
                        <li class="active"><a href="#<?= $key; ?>" data-toggle="tab"><?= $arrTabLabels[$key]; ?></a></li>
                    <?php else: ?>
                        <li><a href="#<?= $key; ?>" data-toggle="tab"><?= $arrTabLabels[$key]; ?></a></li>
                    <?php endif; ?>
                    
                    <!--<li><a href="#smartphone" data-toggle="tab">smartphone</a></li>-->
                <?php endforeach;?>
            </ul><!-- /.nav-tabs -->
    </div>

    <div class="tab-content outer-top-xs">
        <?php foreach($arrNewProducts as $key => $productUnits): ?>
        <div class="tab-pane <?php if ($key == 'all') echo 'in active';?>" id="<?= $key; ?>">			
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="5">
                    <?php foreach ($productUnits as $productUnit):?>
                    <div class="item item-carousel">
                        <div class="products">

                        <div class="product">		
                            <div class="product-image">
                                <div class="image">
                                    <?php
                                        $mainImg = $productUnit->image;
                                    ?>
                                        <a href="<?= Url::to(['main/detail', 'productId' => $productUnit->_productId, 'id' => $productUnit->id] ); ?>">
                                            <?= Html::img("/images/blank.gif", [
                                                'data-echo' =>$mainImg->getUrl('190x266'), 
                                                'alt' => $productUnit->title,
                                                //'width' => 195,
                                                //'height' => 243,
                                                ]);
                                            ?>
                                        </a>
                                    
                                    
                                </div><!-- /.image -->			

                                <div class="tag new"><span>new</span></div>                        		   
                            </div><!-- /.product-image -->

                            <div class="product-info text-left">
                                <h3 class="name">
                                    <a href="<?= Url::to(['main/detail', 'productId' => $productUnit->_productId, 'id' => $productUnit->id] ); ?>">
                                            <?= $productUnit->title; ?>
                                    </a>
                                </h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>

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

                            </div><!-- /.product-info -->
                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                        <a class="btn btn-primary icon add-to-cart" 
                                            href="<?= \yii\helpers\Url::to(['cart/add', 'productUnitId' => $productUnit->id, 'productId' => $productUnit->_productId]); ?>" 
                                            data-product-unit-id="<?= $productUnit->id;?>"
                                            data-product-id="<?= $productUnit->_productId;?>"
                                        >

                                                <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <!--<button class="btn btn-primary" type="button">В корзину</button>-->
                                        <a class="btn btn-primary add-to-cart" 
                                            href="<?= \yii\helpers\Url::to(['cart/add', 'productUnitId' => $productUnit->id, 'productId' => $productUnit->_productId]); ?>" 
                                            data-product-unit-id="<?= $productUnit->id;?>"
                                            data-product-id="<?= $productUnit->_productId;?>"
                                        >
                                            В корзину
                                        </a>


                                        </li>

                                        <li class="lnk wishlist">
                                            <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                     <i class="icon fa fa-heart"></i>
                                            </a>
                                        </li>

                                        <li class="lnk">
                                            <a class="add-to-cart" href="detail.html" title="Compare">
                                                <i class="fa fa-retweet"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div><!-- /.action -->
                            </div><!-- /.cart -->
                        </div><!-- /.product -->

                        </div><!-- /.products -->
                    </div><!-- /.item -->
                    <?php endforeach;?>
        </div><!-- /.home-owl-carousel -->
    </div><!-- /.product-slider -->
</div><!-- /.tab-pane -->
<?php endforeach;?>

        </div><!-- /.tab-content -->
</div><!-- /.scroll-tabs -->

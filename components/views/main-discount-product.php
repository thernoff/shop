<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">Товары со скидкой</h3>
    <!--<div class="product-slider">-->
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs" data-item="5">
	<?php foreach ($productUnits as $productUnit):?>
         <?php if ($productUnit->discount->procent && $productUnit->discount->isDiscount()):?>
        <div class="item item-carousel">
            <div class="products">		
                <div class="product">		
                    <div class="product-image">
                        <div class="image">
                               <?php 
                                    //$mainImg = $productUnit->getImage(); 
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

                        <div class="tag sale"><span>sale</span></div>            		   
                    </div><!-- /.product-image -->


                    <div class="product-info text-left">
                        <h3 class="name"><a href="<?= Url::to(['main/detail', 'productId' => $productUnit->_productId, 'id' => $productUnit->id] ); ?>"><?= $productUnit->title; ?></a></h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                       
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
                        
                    </div><!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                            <!--<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                        <i class="fa fa-shopping-cart"></i>													
                                        </button>-->
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
        <?php endif; ?>
        <?php endforeach;?>
</div><!-- /.home-owl-carousel -->
<!--</div>-->
</section><!-- /.section -->
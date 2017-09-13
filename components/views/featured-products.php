<?php
use yii\helpers\Html;
?>
<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">Популярные товары</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

<?php foreach ($featuredGame as $game):?>
    <?php
        $mainImg = $game->getImage();
    ?>
    <div class="item item-carousel">
        <div class="products">
				
	<div class="product">		
            <div class="product-image">
                    <div class="image">
                        <a href="detail.html">
                            <?= Html::img("/images/blank.gif", [
                                'data-echo' =>$mainImg->getUrl('195x243'), 
                                'alt' => $game->title,
                                //'width' => 195,
                                //'height' => 243,
                                ]);
                            ?>
                        </a>
                        
                    </div><!-- /.image -->			

                    <div class="tag hot"><span>hot</span></div>		   
            </div><!-- /.product-image -->
		
            <div class="product-info text-left">
                <h3 class="name"><a href="<?= \yii\helpers\Url::to(['game/view', 'id' => $game->id]); ?>"><?= $game->title; ?></a></h3>
                <div class="rating rateit-small"></div>
                <div class="description"></div>

                <div class="product-price">	
                    <span class="price"><?= $game->price; ?></span>
                    <?php if ($game->discount): ?>
                        <span class="price-before-discount"><?= $game->discount; ?></span>
                    <?php endif; ?>
                </div><!-- /.product-price -->

            </div><!-- /.product-info -->
            <div class="cart clearfix animate-effect">
                <div class="action">
                        <ul class="list-unstyled">
                            <li class="add-cart-button btn-group">
                                <!--<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                        <i class="fa fa-shopping-cart"></i>													
                                </button>-->
                                <a class="btn btn-primary icon add-to-cart" href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $game['id']]); ?>" data-id="<?= $game['id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                <!--<button class="btn btn-primary" type="button">В корзину</button>-->
                                <a class="btn btn-primary add-to-cart" href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $game['id']]); ?>" data-id="<?= $game['id']; ?>">В корзину</a>
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
    <?php endforeach; ?>
    </div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
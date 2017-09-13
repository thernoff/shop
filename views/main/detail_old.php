<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class='single-product'>
<div class="row  wow fadeInUp">
<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
<div class="product-item-holder size-big single-product-gallery small-gallery">
<?php
$mainImg = $productUnit->getImage();
$gallery = $productUnit->getImages();

?>
    <div id="owl-single-product">
        <div class="single-product-gallery-item" id="slide1">
            <a data-lightbox="image-1" data-title="Gallery" href="<?= $mainImg->getUrl(); ?>">
                <?= Html::img("/images/blank.gif", [
                            'data-echo' => $mainImg->getUrl('370x450'), 
                            'alt' => $productUnit->title,
                            'class' => 'img-responsive',
                        ]);
                ?>
            </a>
        </div><!-- /.single-product-gallery-item -->
        
        <?php $i = 2; foreach ($gallery as $image): ?>
        <div class="single-product-gallery-item" id="slide<?= $i; ?>">
            <a data-lightbox="image-<?= $i; ?>" data-title="Gallery" href="<?= $image->getUrl();?>">
                <img class="img-responsive" alt="" src="<?= $image->getUrl();?>" data-echo="<?= $image->getUrl();?>" />
            </a>
        </div><!-- /.single-product-gallery-item -->
        <?php $i++; endforeach; ?>
    </div><!-- /.single-product-slider -->


    <div class="single-product-gallery-thumbs gallery-thumbs">
        <div id="owl-single-product-thumbnails">
             <?php $i = 1; foreach ($gallery as $image): ?>
            <div class="item">
                <a class="horizontal-thumb active" data-lightbox="image-<?= $i; ?>" data-target="#owl-single-product" data-slide="<?= $i; ?>" href="#slide<?= $i; ?>">
                    <img class="img-responsive" width="85" alt="" src="<?= $image->getUrl('85x100');?>" data-echo="<?= $image->getUrl('85x100');?>" />
                </a>
            </div>
            <?php $i++; endforeach; ?>
        </div><!-- /#owl-single-product-thumbnails -->
    </div><!-- /.gallery-thumbs -->

</div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->        			
<div class='col-sm-6 col-md-7 product-info-block'>
        <div class="product-info">
                <h1 class="name"><?= $productUnit->title; ?></h1>

                <div class="rating-reviews m-t-20">
                        <div class="row">
                                <div class="col-sm-3">
                                        <div class="rating rateit-small"></div>
                                </div>
                                <div class="col-sm-8">
                                        <div class="reviews">
                                                <a href="#" class="lnk">(06 Reviews)</a>
                                        </div>
                                </div>
                        </div><!-- /.row -->		
                </div><!-- /.rating-reviews -->

                <div class="stock-container info-container m-t-10">
                        <div class="row">
                                <div class="col-sm-3">
                                        <div class="stock-box">
                                                <span class="label">Availability :</span>
                                        </div>	
                                </div>
                                <div class="col-sm-9">
                                        <div class="stock-box">
                                                <span class="value">In Stock</span>
                                        </div>	
                                </div>
                        </div><!-- /.row -->	
                </div><!-- /.stock-container -->

                <div class="description-container m-t-20">
                        <?= $productUnit->description; ?>
                </div><!-- /.description-container -->

                <div class="price-container info-container m-t-20">
                        <div class="row">


                                <div class="col-sm-6">
                                        <div class="price-box">        
                                            <?php if ($productUnit->discount->procent && $productUnit->discount->isDiscount()):?>
                                                <?php 
                                                    $price = $productUnit->price;
                                                    $discount = $productUnit->discount->procent;
                                                    $newPrice = (int)($price * (1 - ($discount / 100)));
                                                ?>
                                                    <span class="price"><?= $newPrice; ?></span>
                                                    <span class="price-strike"><?= $price; ?></span>

                                            <?php else: ?>
                                                    <span class="price"><?= $productUnit->price; ?></span>
                                            <?php endif; ?>
                                        </div>
                                </div>

                                <div class="col-sm-6">
                                        <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                   <i class="fa fa-retweet"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                        </div>
                                </div>

                        </div><!-- /.row -->
                </div><!-- /.price-container -->

                <div class="quantity-container info-container">
                    <div class="row">

                        <div class="col-sm-2">
                                <span class="label">Qty :</span>
                        </div>

                        <div class="col-sm-2">
                                <div class="cart-quantity">
                                    <div class="quant-input">
                                        <div class="arrows">
                                          <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                          <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                        </div>
                                        <input id="qty" type="text" value="1">
                                    </div>
                                </div>
                        </div>

                        <div class="col-sm-7">
                            <a  class="btn btn-primary add-to-cart" data-id="<?= $productUnit->id; ?>"
                                href="<?= Url::to(['cart/add', 'productUnitId' => $productUnit->id, 'productId' => $productId]); ?>"
                                data-product-unit-id="<?= $productUnit->id;?>"
                                data-product-id="<?= $productId;?>"
                            >
                                <i class="fa fa-shopping-cart inner-right-vs"></i> В корзину
                            </a>
                        </div>


                    </div><!-- /.row -->
                </div><!-- /.quantity-container -->

                <div class="product-social-link m-t-20 text-right">
                        <span class="social-label">Share :</span>
                        <div class="social-icons">
                    <ul class="list-inline">
                        <li><a class="fa fa-facebook" href="http://facebook.com/transvelo"></a></li>
                        <li><a class="fa fa-twitter" href="#"></a></li>
                        <li><a class="fa fa-linkedin" href="#"></a></li>
                        <li><a class="fa fa-rss" href="#"></a></li>
                        <li><a class="fa fa-pinterest" href="#"></a></li>
                    </ul><!-- /.social-icons -->
                </div>
                </div>




        </div><!-- /.product-info -->
</div><!-- /.col-sm-7 -->
</div><!-- /.row -->

<?php if (!Yii::$app->user->isGuest):?>				
    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
        <div class="row">
            <div class="col-sm-3">
                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                        <li class="active"><a data-toggle="tab" href="#description">Описание</a></li>
                        <li><a data-toggle="tab" href="#review">Отзыв</a></li>
                        
                </ul><!-- /.nav-tabs #product-tabs -->
            </div>
            <div class="col-sm-9">

                <div class="tab-content">

                    <div id="description" class="tab-pane in active">
                            <div class="product-tab">
                                    <p class="text">Suspendisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget, lacinia id purus. Suspendisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget, lacinia id purus. Susp endisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibe ndum gravida eget, lacinia id purus. Susp endisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget, lacinia id purus. Suspendisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget, lacinia id purus.<p><p class="text"> Suspendisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget, lacinia id purus. Susp endisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibe ndum gravida eget, lacinia id purus. Susp endisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget, lacinia id purus.</p>
                            </div>	
                    </div><!-- /.tab-pane -->

                    <div id="review" class="tab-pane">
                        <div class="product-tab">

                                <div class="product-reviews">
                                        <h4 class="title">Customer Reviews</h4>

                                        <div class="reviews">
                                                <div class="review">
                                                        <div class="review-title"><span class="summary">Best Product For me :)</span><span class="date"><i class="fa fa-calendar"></i><span>20 minutes ago</span></span></div>
                                                        <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit nisl in adipiscin"</div>
                                                        <div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name">Michael Lee</span></div>													</div>

                                        </div><!-- /.reviews -->
                                </div><!-- /.product-reviews -->



                                <div class="product-add-review">
                                        <h4 class="title">Write your own review</h4>
                                        <div class="review-table">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">	
                                                    <thead>
                                                            <tr>
                                                                <th class="cell-label">&nbsp;</th>
                                                                <th>1 star</th>
                                                                <th>2 stars</th>
                                                                <th>3 stars</th>
                                                                <th>4 stars</th>
                                                                <th>5 stars</th>
                                                            </tr>
                                                    </thead>	
                                                    <tbody>
                                                            <tr>
                                                                <td class="cell-label">Quality</td>
                                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cell-label">Price</td>
                                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cell-label">Value</td>
                                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                            </tr>
                                                    </tbody>
                                                </table><!-- /.table .table-bordered -->
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.review-table -->

                                        <div class="review-form">
                                                <div class="form-container">
                                                        <form role="form" class="cnt-form">

                                                                <div class="row">
                                                                        <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                        <label for="exampleInputName">Your Name <span class="astk">*</span></label>
                                                                                        <input type="text" class="form-control txt" id="exampleInputName" placeholder="">
                                                                                </div><!-- /.form-group -->
                                                                                <div class="form-group">
                                                                                        <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                                        <input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                                                </div><!-- /.form-group -->
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                        <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                                                        <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                                </div><!-- /.form-group -->
                                                                        </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                        <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                                </div><!-- /.action -->

                                                        </form><!-- /.cnt-form -->
                                                </div><!-- /.form-container -->
                                        </div><!-- /.review-form -->

                                </div><!-- /.product-add-review -->										

                </div><!-- /.product-tab -->
            </div><!-- /.tab-pane -->


                </div><!-- /.tab-content -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.product-tabs -->
<?php endif; ?>
<!-- ============================================== UPSELL PRODUCTS ============================================== -->
<?php echo app\components\UpsellProductsWidget::widget();?>
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			
</div><!-- /.col -->
<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- ========================================== SECTION – HERO ========================================= -->
<?php //echo app\components\BannerSaleGenreWidget::widget();?>
<!-- ========================================= SECTION – HERO : END ========================================= -->
<div class="clearfix filters-container m-t-10">
    <div class="row">
        <div class="col col-sm-12 col-md-6">
            <div class="col col-sm-3 col-md-6 no-padding">
                    <div class="lbl-cnt">
                            <span class="lbl">Сортировать по</span>
                            <div class="fld inline">
                                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                    Выберите <span class="caret"></span>
                                            </button>

                                            <ul role="menu" class="dropdown-menu">
                                                    <li role="presentation"><a href="#">По убыванию цены</a></li>
                                                    <li role="presentation"><a href="#">По возрастанию цены</a></li>
                                            </ul>
                                    </div>
                            </div><!-- /.fld -->
                    </div><!-- /.lbl-cnt -->
            </div><!-- /.col -->
            <div class="col col-sm-3 col-md-6 no-padding">
                    <div class="lbl-cnt">
                        <span class="lbl">Количество на странице</span>
                        <div class="fld inline">
                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                    5 <span class="caret"></span>
                                </button>

                                <ul role="menu" class="dropdown-menu">
                                    <li role="presentation"><a href="#">10</a></li>
                                    <li role="presentation"><a href="#">15</a></li>
                                </ul>
                            </div>
                        </div><!-- /.fld -->
                    </div><!-- /.lbl-cnt -->
            </div><!-- /.col -->
        </div><!-- /.col -->
<?php if ($search): ?>
<div class="col col-sm-12 col-md-12">
<h2>Результаты поиска по запросу: <?= yii\helpers\Html::encode($search); ?></h2>
</div>
<div class="col col-sm-6 col-md-4 text-right">

    <div class="pagination-container">
        <?php 
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                    'options' =>[
                        'class' => 'list-inline list-unstyled',//задаем ul нужный стиль
                    ],
                    'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
                    'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
                    'disabledListItemSubTagOptions' => [
                        'tag' => 'a', 
                        'class' => 'disabled'
                    ],
                ]);
            ?>
        
    </div><!-- /.pagination-container -->		
</div><!-- /.col -->
	</div><!-- /.row -->
</div>
<div class="search-result-container">
    <div class="category-product inner-top-vs">
        <?php if (!empty($resultSearch)): ?>
        <?php foreach ($resultSearch as $productUnit): ?>
        <div class="category-product-inner wow fadeInUp">
        <div class="products">				
            <div class="product-list product">
                <div class="row product-list-row">
                    <div class="col col-sm-4 col-lg-4">
                        <div class="product-image">
                                <div class="image">
                                    <?php 
                                        //$mainImg = $productUnit->getImage(); 
                                        $mainImg = $productUnit->image;
                                    ?>
                                    <?= Html::img("/images/blank.gif", [
                                    'data-echo' =>$mainImg->getUrl('270x347'), 
                                    'alt' => $productUnit->title,
                                    //'width' => 195,
                                    //'height' => 243,
                                    ]);
                            ?>
                                </div>
                        </div><!-- /.product-image -->
                    </div><!-- /.col -->
                    <div class="col col-sm-8 col-lg-8">
                        <div class="product-info">
                            <h3 class="name"><a href="<?= Url::to(['main/detail', 'productId' => $productUnit->_productId, 'id' => $productUnit->id] ); ?>"><?= $productUnit->title; ?></a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price">	
                                <span class="price"><?= $productUnit->price; ?></span>
                                <?php if ($productUnit->discount): ?>
                                    <span class="price-before-discount">$ 800</span>
                                <?php endif; ?>
                            </div><!-- /.product-price -->
                            <div class="description m-t-10"><?= $productUnit->description; ?></div>
                                                <div class="cart clearfix animate-effect">
                                        <div class="action">
                                                <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                                        <i class="fa fa-shopping-cart"></i>													
                                                                </button>
                                                                <button class="btn btn-primary" type="button">В корзину</button>

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

                        </div><!-- /.product-info -->	
                    </div><!-- /.col -->
                </div><!-- /.product-list-row -->
                <div class="tag new"><span>new</span></div>        
            </div><!-- /.product-list -->
        </div><!-- /.products -->
    </div><!-- /.category-product-inner -->
        <?php endforeach; ?>
    
    </div><!-- /.category-product -->


    
    <div class="clearfix filters-container">
						
        <div class="text-right">
            <div class="pagination-container">

            <?php 
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                    'options' =>[
                        'class' => 'list-inline list-unstyled',//задаем ul нужный стиль
                    ],
                    'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
                    'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
                    'disabledListItemSubTagOptions' => [
                        'tag' => 'a', 
                        'class' => 'disabled'
                    ],
                ]);
            ?>
                
            </div><!-- /.pagination-container -->
            
        </div><!-- /.text-right -->
						
    </div><!-- /.filters-container -->

    </div><!-- /.search-result-container -->
  <?php else: ?>
    <div class="col col-sm-12 col-md-12">
    <p>Поиск не дал результатов.</p>
    </div>
    <?php endif; ?>
<?php endif; ?>
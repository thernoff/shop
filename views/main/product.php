<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- ========================================== SECTION – HERO ========================================= -->
<?php //echo \app\components\BannerSaleInnerWidget::widget();?>
<!-- ========================================= SECTION – HERO : END ========================================= -->
<div class="clearfix filters-container m-t-10">
	<div class="row">
		<div class="col col-sm-6 col-md-3">
			<div class="filter-tabs">
				<ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
					<li class="active">
						<a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-list"></i>Сетка</a>
					</li>
					<li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th"></i>Список</a></li>
				</ul>
			</div><!-- /.filter-tabs -->
		</div><!-- /.col -->
		<div class="col col-sm-12 col-md-7">
			<div class="col col-sm-3 col-md-6 no-padding">
				<div class="lbl-cnt">
                                    <!--<span class="lbl">Сортировать по</span>-->
                                    <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                    <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                            Сортировать по<span class="caret"></span>
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
		<div class="col col-sm-6 col-md-2 text-right">
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
<?php if (count($productUnits) > 0): ?>   
<div class="search-result-container">
    <div id="myTabContent" class="tab-content">
<div class="tab-pane active " id="grid-container">
<div class="category-product  inner-top-vs">
<div class="row">
 
<?php foreach ($productUnits as $productUnit): ?>
    <?php
        //Т.к. метод getImage() вызывается дважды для одного и того же объекта (вызывается в 2 табах), тем самым увеличивая количество запросов в 2 раза, выполним следующее:
        $productUnit->image = $productUnit->getImage();
    ?>
    <div class="col-sm-6 col-md-4 wow fadeInUp">
        <div class="products">
				
	<div class="product">		
            <div class="product-image">
                    <div class="image">
                            <a href="<?= Url::to(['main/detail', 'productId' => $productId, 'id' => $productUnit->id] ); ?>">
                                
                                <?= Html::img("/images/blank.gif", [
                                                'data-echo' =>$productUnit->image->getUrl('270x347'), 
                                                'alt' => $game->title,
                                                //'width' => 270,
                                                //'height' => 347,
                                                ]);
                                ?>
                            </a>
                    </div><!-- /.image -->			
                    <?php if ($productUnit->is_new):?>
                        <div class="tag new"><span>new</span></div>
                    <?php endif; ?>
            </div><!-- /.product-image -->	
		
            <div class="product-info text-left">
                <h3 class="name"><a href="<?= Url::to(['main/detail', 'productId' => $productId, 'id' => $productUnit->id] ); ?>"><?= $productUnit->title; ?></a></h3>
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
                                            href="<?= \yii\helpers\Url::to(['cart/add', 'productUnitId' => $productUnit->id, 'productId' => $productId]); ?>" 
                                            data-product-unit-id="<?= $productUnit->id;?>"
                                            data-product-id="<?= $productId;?>"
                                        >

                                                <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <!--<button class="btn btn-primary" type="button">В корзину</button>-->
                                        <a class="btn btn-primary add-to-cart" 
                                            href="<?= \yii\helpers\Url::to(['cart/add', 'productUnitId' => $productUnit->id, 'productId' => $productId]); ?>" 
                                            data-product-unit-id="<?= $productUnit->id;?>"
                                            data-product-id="<?= $productId;?>"
                                        >
                                            В корзину
                                        </a>
                                    </li>

                    <li class="lnk wishlist">
                                            <a class="add-to-cart" href="#" title="Wishlist">
                                                     <i class="icon fa fa-heart"></i>
                                            </a>
                                    </li>

                                    <li class="lnk">
                                            <a class="add-to-cart" href="#" title="Compare">
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

</div><!-- /.row -->
</div><!-- /.category-product -->
</div><!-- /.tab-pane -->
            
<div class="tab-pane "  id="list-container">
        <div class="category-product  inner-top-vs">
            <?php foreach ($productUnits as $productUnit): ?>
            <div class="category-product-inner wow fadeInUp">
                <div class="products">				
                <div class="product-list product">
                    <div class="row product-list-row">
                        <div class="col col-sm-4 col-lg-4">
                                <div class="product-image">
                                        <div class="image">
                                                
                                <?= Html::img("/images/blank.gif", [
                                                'data-echo' =>$productUnit->image->getUrl('270x347'), 
                                                'alt' => $game->title,
                                                //'width' => 270,
                                                //'height' => 347,
                                                ]);
                                ?>
                                        </div>
                                </div><!-- /.product-image -->
                        </div><!-- /.col -->
                        <div class="col col-sm-8 col-lg-8">
                            <div class="product-info">
                                <h3 class="name">
                                    <a href="<?= Url::to(['main/detail', 'productId' => $productId, 'id' => $productUnit->id] ); ?>">
                                        <?= $productUnit->title; ?>
                                    </a>
                                </h3>
                                <div class="rating rateit-small"></div>
                                <div class="product-price">	
                                            <span class="price">
                                                    <?= $productUnit->price; ?>
                                            </span>
                                            <span class="price-before-discount">$ 800</span>

                                </div><!-- /.product-price -->
                                    <div class="description m-t-10"><?= $productUnit->short_description; ?></div>
                                                    <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                    <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                                            <i class="fa fa-shopping-cart"></i>													
                                                                    </button>
                                                                    <button class="btn btn-primary" type="button">В корзинуt</button>

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
                    
                    <?php if ($productUnit->is_new):?>
                        <div class="tag new"><span>new</span></div>
                    <?php endif; ?>
                </div><!-- /.product-list -->
                    </div><!-- /.products -->
            </div><!-- /.category-product-inner -->
            <?php endforeach;?>
    </div><!-- /.category-product -->
</div><!-- /.tab-pane #list-container -->
    </div><!-- /.tab-content -->
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
    <h3>Товары в данной категории отсутствуют.</h3>
<?php endif;?>
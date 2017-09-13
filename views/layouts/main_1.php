<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\LtAppAsset;
use yii\helpers\Url;

AppAsset::register($this);
LtAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <!-- Meta -->
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <meta name="author" content="">
        <meta name="robots" content="all">

        <title><?= Html::encode($this->title) ?></title>
        <!-- Fonts --> 
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <!-- Favicon -->
        <link rel="shortcut icon" href="/images/favicon.ico">

        <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
        <?php $this->head(); ?>
    </head>
    <body class="cnt-home">
	<?php $this->beginBody() ?>
		
	
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

<!-- ============================================== TOP MENU ============================================== -->
<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account">
                <ul class="list-unstyled">
                    <?php if (!Yii::$app->user->isGuest):?>
                        <li><a href="<?= Url::to(['/site/logout']); ?>"><i class="icon fa fa-sign-out"></i><?= Yii::$app->user->identity['username']?> [ Выйти ] </a></li>
                        <li><a href="<?= Url::to(['/cabinet']); ?>"><i class="icon fa fa-user"></i>Мой профиль</a></li>
                    <?php else: ?>
                        <li><a href="<?= Url::to(['/site/login']); ?>"><i class="icon fa fa-sign-in"></i>Войти</a></li>
                    <?php endif; ?>
                    <li><a href="#"><i class="icon fa fa-heart"></i>Списки желаемого</a></li>
                    <li><a href="#"><i class="icon fa fa-shopping-cart"></i>Моя корзина</a></li>
                    <li><a href="#"><i class="icon fa fa-key"></i>Checkout</a></li>
                </ul>
            </div><!-- /.cnt-account -->

            <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    <li class="dropdown dropdown-small">
                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">USD</a></li>
                            <li><a href="#">INR</a></li>
                            <li><a href="#">GBP</a></li>
                        </ul>
                    </li>

                    <li class="dropdown dropdown-small">
                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">German</a></li>
                        </ul>
                    </li>
                </ul><!-- /.list-unstyled -->
            </div><!-- /.cnt-cart -->
            <div class="clearfix"></div>
        </div><!-- /.header-top-inner -->
    </div><!-- /.container -->
</div><!-- /.header-top -->
<!-- ============================================== TOP MENU : END ============================================== -->
<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
<!-- ============================================================= LOGO ============================================================= -->
                <div class="logo">
                    <a href="<?= yii\helpers\Url::home(); ?>">
                        <img src="/images/logo.png" alt="">
                    </a>
                </div><!-- /.logo -->
<!-- ============================================================= LOGO : END ============================================================= -->				
            </div><!-- /.logo-holder -->

<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
					<div class="contact-row">
    <div class="phone inline">
        <i class="icon fa fa-phone"></i> (400) 888 888 868
    </div>
    <div class="contact inline">
        <i class="icon fa fa-envelope"></i> saler@unicase.com
    </div>
</div><!-- /.contact-row -->
<!-- ============================================================= SEARCH AREA ============================================================= -->
<div class="search-area">
    <form method="get" action="<?= yii\helpers\Url::to(['genre/search']); ?>">
        <div class="control-group">

            <ul class="categories-filter animate-dropdown">
                <li class="dropdown">

                    <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>

                    <ul class="dropdown-menu" role="menu" >
                        <li class="menu-header">Computer</li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Laptops</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Tv & audio</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Gadgets</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Cameras</a></li>

                    </ul>
                </li>
            </ul>

            <input name="search" class="search-field" placeholder="Введите название игры..." />
            <button class="search-button"/></button>
        </div>
    </form>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->				
</div><!-- /.top-search-holder -->

<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
<div class="list-cart">
    <?= app\components\ShoppingCartDropdownWidget::widget(); ?>
</div>
<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				
</div><!-- /.top-cart-row -->

		</div><!-- /.container -->

	</div><!-- /.main-header -->

	<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
		<ul class="nav navbar-nav">
			<li class="active dropdown yamm-fw">
				<a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a>
				<ul class="dropdown-menu">
					<li>
						<div class="yamm-content">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <div class="row">
                <div class='col-md-12'>
                
                   <div class="col-xs-12 col-sm-6 col-md-3">
                        <h2 class="title">Computer</h2>
                        <ul class="links">
                            <li><a href="#">Lenovo</a></li>
                            <li><a href="#">Microsoft </a></li>
                            <li><a href="#">Fuhlen</a></li>
                            <li><a href="#">Longsleeves</a></li>
                        </ul>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <h2 class="title">Camera</h2>
                        <ul class="links">
                            <li><a href="#">Fuhlen</a></li>
                            <li><a href="#">Lenovo</a></li>
                            <li><a href="#">Microsoft </a></li>                   
                            <li><a href="#">Longsleeves</a></li>
                        </ul>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <h2 class="title">Apple Store</h2>
                        <ul class="links">
                            <li><a href="#">Longsleeves</a></li>
                            <li><a href="#">Fuhlen</a></li>
                            <li><a href="#">Lenovo</a></li>
                            <li><a href="#">Microsoft </a></li>                                       
                        </ul>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <h2 class="title">Smart Phone</h2>
                        <ul class="links">
                            <li><a href="#">Microsoft </a></li> 
                            <li><a href="#">Longsleeves</a></li>
                            <li><a href="#">Fuhlen</a></li>
                            <li><a href="#">Lenovo</a></li>
                                   
                        </ul>
                    </div><!-- /.col -->

                    </div>
                
            </div>
        </div>
        <div class="col-sm-4">
        </div>
    </div><!-- /.row -->
   
        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <div class="wide-banners megamenu-banner">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="col-sm-6 col-md-6">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" data-echo="/images/banners/4.jpg" src="/images/blank.gif" alt="">
                                </div>  
                                <div class="strip">
                                    <div class="strip-inner text-right">
                                        <h3 class="white">new trend</h3>
                                        <h2 class="white">apple product</h2>
                                    </div>  
                                </div>
                            </div><!-- /.wide-banner -->
                        </div><!-- /.col -->

                        <div class="col-sm-6 col-md-6">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" data-echo="/images/banners/5.jpg" src="/images/blank.gif" alt="">
                                </div>  
                                <div class="strip">
                                    <div class="strip-inner text-left">
                                         <h3 class="white">camera collection</h3>
                                        <h2 class="white">new arrivals</h2>
                                    </div>  
                                </div>
                            </div><!-- /.wide-banner -->
                        </div><!-- /.col -->
                    </div>

                    </div><!-- /.row -->
                </div>
                <div class="col-sm-12 col-md-4 hidden-xs hidden-sm">
                  <p class="text ">LenovoProin gravida nibh vel velit auctor aliquet es  Aenean sollicitudin,lorem quis bibendu auctor,nisi elit consequat ipsum auctor.</p>
                </div>
            </div>
        </div><!-- /.wide-banners -->

<!-- ============================================== WIDE PRODUCTS : END ============================================== -->
 
</div><!-- /.yamm-content -->					</li>
				</ul>
			</li>
			<li class="dropdown yamm">
				<a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Desktop</a>
				<ul class="dropdown-menu">
					<li>
						<div class="yamm-content">
    <div class="row">
        <div class='col-sm-12'>
           <div class="col-xs-12 col-sm-12 col-md-4">
                <h2 class="title">Laptops &amp; Notebooks</h2>
                <ul class="links">
                    <li><a href="#">Power Supplies Power</a></li>
                    <li><a href="#">Power Supply Testers Sound </a></li>
                    <li><a href="#">Sound Cards (Internal)</a></li>
                    <li><a href="#">Video Capture &amp; TV Tuner Cards</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-12 col-md-4">
                <h2 class="title">Computers &amp; Laptops</h2>
                <ul class="links">
                    <li><a href="#">Computer Cases &amp; Accessories</a></li>
                    <li><a href="#">CPUs, Processors</a></li>
                    <li><a href="#">Fans, Heatsinks &amp; Cooling</a></li>
                    <li><a href="#">Graphics, Video Cards</a></li>
                    <li><a href="#">Interface, Add-On Cards</a></li>
                    <li><a href="#">Laptop Replacement Parts</a></li>
                    <li><a href="#">Memory (RAM)</a></li>
                    <li><a href="#">Motherboards</a></li>
                    <li><a href="#">Motherboard &amp; CPU Combos</a></li>
                    <li><a href="#">Motherboard Components &amp; Accs</a></li>
                </ul>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-12 col-md-4">
                <h2 class="title">Dekstop Parts</h2>
                <ul class="links">
                    <li><a href="#">Power Supplies Power</a></li>
                    <li><a href="#">Power Supply Testers Sound</a></li>
                    <li><a href="#">Sound Cards (Internal)</a></li>
                    <li><a href="#">Video Capture &amp; TV Tuner Cards</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </div><!-- /.col -->
        </div>
    </div><!-- /.row -->
</div><!-- /.yamm-content -->					</li>
				</ul>
			</li>

			<li class="dropdown">
				
				<a href="category.html">Electronics
				   <span class="menu-label hot-menu hidden-xs">hot</span>
				</a>
			</li>
			<li class="dropdown hidden-sm">
				
				<a href="category.html">Television
				    <span class="menu-label new-menu hidden-xs">new</span>
				</a>
			</li>

			<li class="dropdown hidden-sm">
				<a href="category.html">Smart Phone</a>
			</li>

			<li class="dropdown">
				<a href="contact.html">Contact</a>
			</li>
			
			<li class="dropdown navbar-right">
				<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
				<ul class="dropdown-menu pages">
					<li>
						<div class="yamm-content">
							<div class="row">
								
									<div class='col-xs-12 col-sm-4 col-md-4'>
	                                  <ul class='links'>
		                                  	<li><a href="home.html">Home I</a></li>
											<li><a href="home2.html">Home II</a></li>
											<li><a href="category.html">Category</a></li>
											<li><a href="category-2.html">Category II</a></li>
											<li><a href="detail.html">Detail</a></li>
											<li><a href="detail2.html">Detail II</a></li>
											<li><a href="shopping-cart.html">Shopping Cart Summary</a></li>
											
	                                  </ul>
									</div>
									<div class='col-xs-12 col-sm-4 col-md-4'>
	                                  <ul class='links'>
		                                  	<li><a href="checkout.html">Checkout</a></li>
											<li><a href="blog.html">Blog</a></li>
											<li><a href="blog-details.html">Blog Detail</a></li>
											<li><a href="contact.html">Contact</a></li>
											<li><a href="homepage1.html">Homepage 1</a></li>
											<li><a href="homepage2.html">Homepage 2</a></li>
											<li><a href="home-furniture.html">Home Furniture</a></li>
	                                  </ul>
									</div>
									<div class='col-xs-12 col-sm-4 col-md-4'>
										<ul class='links'>
											<li><a href="sign-in.html">Sign In</a></li>
											<li><a href="my-wishlist.html">Wishlist</a></li>
											<li><a href="terms-conditions.html">Terms and Condition</a></li>
											<li><a href="track-orders.html">Track Orders</a></li>
											<li><a href="product-comparison.html">Product-Comparison</a></li>
		                                  	<li><a href="faq.html">FAQ</a></li>
											<li><a href="404.html">404</a></li>
	                                  </ul>

									</div>
								
							</div>
						</div>
					</li>
					
					
				</ul>
			</li>
			
		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div><!-- /.nav-outer -->
</div><!-- /.navbar-collapse -->


            </div><!-- /.nav-bg-class -->
        </div><!-- /.navbar-default -->
    </div><!-- /.container-class -->

</div><!-- /.header-nav -->
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->


<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
	<div class="row">
<!-- ============================================== SIDEBAR ============================================== -->	
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
			
<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> По жанру</div>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            <?php echo app\components\MenuWidget::widget(['tpl' => 'menu']); ?>
        </ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->

<!-- ============================================== SPECIAL OFFER ============================================== -->

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	<h3 class="section-title">Special Offer</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
	        	        <div class="item">
	        	<div class="products special-product">
<div class="product">
<div class="product-micro">
    <div class="row product-micro-row">
        <div class="col col-xs-5">
            <div class="product-image">
                <div class="image">
                        <a href="/images/products/sm1.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
                                <img data-echo="/images/products/sm1.jpg" src="/images/blank.gif" alt="">
                                <div class="zoom-overlay"></div>
                        </a>					
                </div><!-- /.image -->
                <div class="tag tag-micro hot">
                    <span>hot</span>
                </div>
            </div><!-- /.product-image -->
        </div><!-- /.col -->
        <div class="col col-xs-7">
                <div class="product-info">
                        <h3 class="name"><a href="#">Simple Product</a></h3>
                        <div class="rating rateit-small"></div>
                        <div class="product-price">	
                        <span class="price">
                                $650.99				</span>

                </div><!-- /.product-price -->
                        <div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
                </div>
        </div><!-- /.col -->
    </div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
</div>
<div class="product">
    <div class="product-micro">
	<div class="row product-micro-row">
            <div class="col col-xs-5">
                <div class="product-image">
                    <div class="image">
                        <a href="/images/products/sm2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
                            <img data-echo="/images/products/sm2.jpg" src="/images/blank.gif" alt="">
                            <div class="zoom-overlay"></div>
                        </a>					
                    </div><!-- /.image -->
                </div><!-- /.product-image -->
            </div><!-- /.col -->
		<div class="col col-xs-7">
                    <div class="product-info">
                        <h3 class="name"><a href="#">Canon EOS 60D</a></h3>
                        <div class="rating rateit-small"></div>
                        <div class="product-price">	
                        <span class="price">
                            $650.99
                        </span>
                        </div><!-- /.product-price -->
                        <div class="action">
                            <a href="#" class="lnk btn btn-primary">Add To Cart</a>
                        </div>
                    </div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
    </div><!-- /.product-micro -->
      
</div>
<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm3.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm3.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
											<div class="tag tag-micro new">
							<span>new</span>
						</div>
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Camera X30</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
</div>
</div>
	        </div>
	    		        <div class="item">
	        	<div class="products special-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm1.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm1.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Simple Product</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm2.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
											<div class="tag tag-micro sale">
							<span>sale</span>
						</div>
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Canon EOS 60D</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm3.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm3.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Camera X30</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products special-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm1.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm1.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
											<div class="tag tag-micro new">
							<span>new</span>
						</div>
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Simple Product</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm2.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
											<div class="tag tag-micro hot">
							<span>hot</span>
						</div>
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Canon EOS 60D</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm3.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm3.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Camera X30</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL OFFER : END ============================================== -->
			<!-- ============================================== PRODUCT TAGS ============================================== -->
<div class="sidebar-widget product-tag wow fadeInUp">
	<h3 class="section-title">Product tags</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="tag-list">					
			<a class="item" title="Phone" href="category.html">Phone</a>
			<a class="item active" title="Vest" href="category.html">Vest</a>
			<a class="item" title="Smartphone" href="category.html">Smartphone</a>
			<a class="item" title="Furniture" href="category.html">Furniture</a>
			<a class="item" title="T-shirt" href="category.html">T-shirt</a>
			<a class="item" title="Sweatpants" href="category.html">Sweatpants</a>
			<a class="item" title="Sneaker" href="category.html">Sneaker</a>
			<a class="item" title="Toys" href="category.html">Toys</a>
			<a class="item" title="Rose" href="category.html">Rose</a>
		</div><!-- /.tag-list -->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== PRODUCT TAGS : END ============================================== -->
			<!-- ============================================== SPECIAL DEALS ============================================== -->

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	<h3 class="section-title">Special Deals</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
	        	        <div class="item">
	        	<div class="products special-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm4.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm4.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
											<div class="tag tag-micro hot">
							<span>hot</span>
						</div>
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Simple Product</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm5.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm5.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Simple Product</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm6.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm6.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
											<div class="tag tag-micro new">
							<span>new</span>
						</div>
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Camera X30</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products special-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm1.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm1.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Ericson Vaga</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm2.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
											<div class="tag tag-micro sale">
							<span>sale</span>
						</div>
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Ericson Vaga</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm3.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm3.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Ericson Vaga</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products special-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm5.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm5.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
											<div class="tag tag-micro new">
							<span>new</span>
						</div>
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Ericson Vaga</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm2.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm2.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
											<div class="tag tag-micro hot">
							<span>hot</span>
						</div>
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Ericson Vaga</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="/images/products/sm1.jpg" data-lightbox="image-1" data-title="Nunc ullamcors">
						<img data-echo="/images/products/sm1.jpg" src="/images/blank.gif" alt="">
						<div class="zoom-overlay"></div>
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Sony Ericson Vaga</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$650.99				</span>
				
			</div><!-- /.product-price -->
				<div class="action"><a href="#" class="lnk btn btn-primary">Add To Cart</a></div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL DEALS : END ============================================== -->
			<!-- ============================================== NEWSLETTER ============================================== -->
<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
	<h3 class="section-title">Newsletters</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<p>Sign Up for Our Newsletter!</p>
        <form role="form">
        	 <div class="form-group">
			    <label class="sr-only" for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
			  </div>
			<button class="btn btn-primary">Subscribe</button>
		</form>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== NEWSLETTER: END ============================================== -->
			<!-- ============================================== HOT DEALS ============================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp">
	<h3 class="section-title">hot deals</h3>
	<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
		
														<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								<img src="/images/hot-deals/1.jpg" alt="">
							</div>
							<div class="sale-offer-tag"><span>35%<br>off</span></div>
							<div class="timing-wrapper">
								<div class="box-wrapper">
									<div class="date box">
										<span class="key">120</span>
										<span class="value">Days</span>
									</div>
								</div>
				                
				                <div class="box-wrapper">
									<div class="hour box">
										<span class="key">20</span>
										<span class="value">HRS</span>
									</div>
								</div>

				                <div class="box-wrapper">
									<div class="minutes box">
										<span class="key">36</span>
										<span class="value">MINS</span>
									</div>
								</div>

				                <div class="box-wrapper hidden-md">
									<div class="seconds box">
										<span class="key">60</span>
										<span class="value">SEC</span>
									</div>
								</div>
							</div>
						</div><!-- /.hot-deal-wrapper -->

						<div class="product-info text-left m-t-20">
							<h3 class="name"><a href="detail.html">Apple Iphone 5s 32GB Gold</a></h3>
							<div class="rating rateit-small"></div>

							<div class="product-price">	
								<span class="price">
									$600.00
								</span>
									
							    <span class="price-before-discount">$800.00</span>					
							
							</div><!-- /.product-price -->
							
						</div><!-- /.product-info -->

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
										<i class="fa fa-shopping-cart"></i>													
									</button>
									<button class="btn btn-primary" type="button">Add to cart</button>
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
					</div>		        
													<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								<img src="/images/hot-deals/2.jpg" alt="">
							</div>
							<div class="sale-offer-tag"><span>35%<br>off</span></div>
							<div class="timing-wrapper">
								<div class="box-wrapper">
									<div class="date box">
										<span class="key">120</span>
										<span class="value">Days</span>
									</div>
								</div>
				                
				                <div class="box-wrapper">
									<div class="hour box">
										<span class="key">20</span>
										<span class="value">HRS</span>
									</div>
								</div>

				                <div class="box-wrapper">
									<div class="minutes box">
										<span class="key">36</span>
										<span class="value">MINS</span>
									</div>
								</div>

				                <div class="box-wrapper hidden-md">
									<div class="seconds box">
										<span class="key">60</span>
										<span class="value">SEC</span>
									</div>
								</div>
							</div>
						</div><!-- /.hot-deal-wrapper -->

						<div class="product-info text-left m-t-20">
							<h3 class="name"><a href="detail.html">Apple Iphone 5s 32GB Gold</a></h3>
							<div class="rating rateit-small"></div>

							<div class="product-price">	
								<span class="price">
									$600.00
								</span>
									
							    <span class="price-before-discount">$800.00</span>					
							
							</div><!-- /.product-price -->
							
						</div><!-- /.product-info -->

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
										<i class="fa fa-shopping-cart"></i>													
									</button>
									<button class="btn btn-primary" type="button">Add to cart</button>
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
					</div>		        
													<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								<img src="/images/hot-deals/3.jpg" alt="">
							</div>
							<div class="sale-offer-tag"><span>35%<br>off</span></div>
							<div class="timing-wrapper">
								<div class="box-wrapper">
									<div class="date box">
										<span class="key">120</span>
										<span class="value">Days</span>
									</div>
								</div>
				                
				                <div class="box-wrapper">
									<div class="hour box">
										<span class="key">20</span>
										<span class="value">HRS</span>
									</div>
								</div>

				                <div class="box-wrapper">
									<div class="minutes box">
										<span class="key">36</span>
										<span class="value">MINS</span>
									</div>
								</div>

				                <div class="box-wrapper hidden-md">
									<div class="seconds box">
										<span class="key">60</span>
										<span class="value">SEC</span>
									</div>
								</div>
							</div>
						</div><!-- /.hot-deal-wrapper -->

						<div class="product-info text-left m-t-20">
							<h3 class="name"><a href="detail.html">Apple Iphone 5s 32GB Gold</a></h3>
							<div class="rating rateit-small"></div>

							<div class="product-price">	
								<span class="price">
									$600.00
								</span>
									
							    <span class="price-before-discount">$800.00</span>					
							
							</div><!-- /.product-price -->
							
						</div><!-- /.product-info -->

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
										<i class="fa fa-shopping-cart"></i>													
									</button>
									<button class="btn btn-primary" type="button">Add to cart</button>
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
					</div>		        
						
	    
    </div><!-- /.sidebar-widget -->
</div>
<!-- ============================================== HOT DEALS: END ============================================== -->
<!-- ============================================== COLOR============================================== -->
<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
	<div id="advertisement" class="advertisement">
        <div class="item bg-color">
            <div class="container-fluid">
                <div class="caption vertical-top text-left">
                    <div class="big-text">
                        Save<span class="big">50%</span>
                    </div>
                        

                    <div class="excerpt">
                        on selected items
                    </div>
                </div><!-- /.caption -->
            </div><!-- /.container-fluid -->
        </div><!-- /.item -->

        <div class="item" style="background-image: url('/images/advertisement/1.jpg');">
            
        </div><!-- /.item -->

        <div class="item bg-color">
            <div class="container-fluid">
                <div class="caption vertical-top text-left">
                    <div class="big-text">
                        Save<span class="big">50%</span>
                    </div>
                        

                    <div class="excerpt fadeInDown-2">
                        on selected items
                    </div>
                </div><!-- /.caption -->
            </div><!-- /.container-fluid -->
        </div><!-- /.item -->

    </div><!-- /.owl-carousel -->
</div>
    
<!-- ============================================== COLOR: END ============================================== -->


</div><!-- /.sidemenu-holder -->
<!-- ============================================== SIDEBAR : END ============================================== -->
<div class='col-xs-12 col-sm-12 col-md-9'>
<?php  if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=Yii::$app->session->getFlash('success');?>
    </div>
<?php endif; ?>
    <?= $content; ?>
</div>
</div><!-- /.row -->
	<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

		<h3 class="section-title">Our Brands</h3>
		<div class="logo-slider-inner">	
			<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
				<div class="item m-t-15">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand1.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item m-t-10">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand2.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand3.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand4.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand5.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand6.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand2.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand4.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand1.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="/images/brands/brand5.png" src="/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->
		    </div><!-- /.owl-carousel #logo-slider -->
		</div><!-- /.logo-slider-inner -->
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->


<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">
	  <div class="links-social inner-top-sm">
        <div class="container">
            <div class="row">
            	<div class="col-xs-12 col-sm-6 col-md-3">
<!-- ============================================================= CONTACT INFO ============================================================= -->
<div class="contact-info">
    <div class="footer-logo">
        <div class="logo">
            <a href="home.html">
                
                <img src="/images/logo.png" alt="">

            </a>
        </div><!-- /.logo -->
    
    </div><!-- /.footer-logo -->

     <div class="module-body m-t-20">
        <p class="about-us"> Nam libero tempore, cum soluta nobis est ses  eligendi optio cumque cum soluta nobis est ses  eligendi optio cumque.</p>
    
        <div class="social-icons">
            
        <a href="http://facebook.com/transvelo" class='active'><i class="icon fa fa-facebook"></i></a>
        <a href="#"><i class="icon fa fa-twitter"></i></a>
        <a href="#"><i class="icon fa fa-linkedin"></i></a>
        <a href="#"><i class="icon fa fa-rss"></i></a>
        <a href="#"><i class="icon fa fa-pinterest"></i></a>

        </div><!-- /.social-icons -->
    </div><!-- /.module-body -->

</div><!-- /.contact-info -->
<!-- ============================================================= CONTACT INFO : END ============================================================= -->            	</div><!-- /.col -->

<div class="col-xs-12 col-sm-6 col-md-3">
<!-- ============================================================= CONTACT TIMING============================================================= -->
<div class="contact-timing">
	<div class="module-heading">
		<h4 class="module-title">opening time</h4>
	</div><!-- /.module-heading -->

	<div class="module-body outer-top-xs">
		<div class="table-responsive">
			<table class="table">
				<tbody>
					<tr><td>Monday-Friday:</td><td class="pull-right">08.00 To 18.00</td></tr>
					<tr><td>Saturday:</td><td class="pull-right">09.00 To 20.00</td></tr>
					<tr><td>Sunday:</td><td class="pull-right">10.00 To 20.00</td></tr>
				</tbody>
			</table>
		</div><!-- /.table-responsive -->
		<p class='contact-number'>Hot Line:(400)888 868 848</p>
	</div><!-- /.module-body -->
</div><!-- /.contact-timing -->
<!-- ============================================================= CONTACT TIMING : END ============================================================= -->            	</div><!-- /.col -->

<div class="col-xs-12 col-sm-6 col-md-3">
<!-- ============================================================= LATEST TWEET============================================================= -->
<div class="latest-tweet">
	<div class="module-heading">
		<h4 class="module-title">latest tweet</h4>
	</div><!-- /.module-heading -->

	<div class="module-body outer-top-xs">
       <div class="re-twitter">
            <div class="comment media">
                <div class='pull-left'>
                    <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <a href="#">@laurakalbag</a> As a result of your previous recommendation :) 
                    <span class="time">
                        12 hours ago
                    </span>
                </div>
            </div>
           
        </div>
        <div class="re-twitter">
            <div class="comment media">
                <div class='pull-left'>
                    <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <a href="#">@laurakalbag</a> As a result of your previous recommendation :) 
                    <span class="time">
                        12 hours ago
                    </span>
                </div>
            </div>
        </div>
    </div><!-- /.module-body -->
</div><!-- /.contact-timing -->
<!-- ============================================================= LATEST TWEET : END ============================================================= -->            	</div><!-- /.col -->

<div class="col-xs-12 col-sm-6 col-md-3">
            		 <!-- ============================================================= INFORMATION============================================================= -->
<div class="contact-information">
	<div class="module-heading">
		<h4 class="module-title">information</h4>
	</div><!-- /.module-heading -->

	<div class="module-body outer-top-xs">
        <ul class="toggle-footer" style="">
            <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p>868 Any Stress,Burala Casi,Picasa USA.</p>
                </div>
            </li>

              <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p>(400) 0888 888 888<br>(400) 888 888 888</p>
                </div>
            </li>

              <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <span><a href="#">Contact @Unicase.com</a></span><br>
                    <span><a href="#">Sale @Unicase.com</a></span>
                </div>
            </li>
              
            </ul>
    </div><!-- /.module-body -->
</div><!-- /.contact-timing -->
<!-- ============================================================= INFORMATION : END ============================================================= -->            	</div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.links-social -->

    <div class="footer-bottom inner-bottom-sm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title">category</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Libero Sed rhoncus</a></li>
                            <li><a href="#">Venenatis augue tellus</a></li>
                            <li><a href="#">My Vouchers</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title">my account</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Site Map</a></li>
                            <li><a href="#">Search Terms</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title">our services</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Libero Sed rhoncus</a></li>
                            <li><a href="#">Venenatis augue tellus</a></li>
                            <li><a href="#">My Vouchers</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title">help & support</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li><a href="#">Knowledgebase</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Contact Support</a></li>
                            <li><a href="#">Marketplace Blog</a></li>
                            <li><a href="#">About Unicase</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="copyright">
                   Copyright © 2014
                    <a href="home.html">Unicase Shop.</a>
                    - All rights Reserved
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods">
                    <ul>
                        <li><img src="/images/payments/1.png" alt=""></li>
                        <li><img src="/images/payments/2.png" alt=""></li>
                        <li><img src="/images/payments/3.png" alt=""></li>
                        <li><img src="/images/payments/4.png" alt=""></li>
                        <li><img src="/images/payments/5.png" alt=""></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div>
    </div>
</footer>
<!-- ============================================================= FOOTER : END============================================================= -->


	<!-- For demo purposes – can be removed on production -->
	
	<!--<div class="config open">
		<div class="config-options">
			<h4>Pages</h4>
			<ul class="list-unstyled animate-dropdown">
				<li class="dropdown">
					<button class="dropdown-toggle btn btn-primary btn-block" data-toggle="dropdown">View Pages</button>
					<ul class="dropdown-menu" role="menu">
						<li role="presentation" class="dropdown-header">Home Pages</li>
						<li><a href="home.html">Home</a></li>
						<li><a href="home2.html">Home II</a></li>
						<li><a href="home-furniture.html">Home Furniture</a></li>
						<li><a href="homepage1.html">Home Page I</a></li>
						<li><a href="homepage2.html">Home Page II</a></li>
					  	<li class="divider"></li>
					  	<li role="presentation" class="dropdown-header">Other Pages</li>
						<li><a href="blog.html">Blog</a></li>
						<li><a href="blog-details.html">Blog Details</a></li>
						<li><a href="category.html">Category</a></li>
						<li><a href="category-2.html">Category II</a></li>
						<li><a href="checkout.html">Checkout</a></li>
						<li><a href="contact.html">Contact</a></li>
						<li><a href="detail.html">Detail</a></li>
						<li><a href="detail2.html">Detail II</a></li>
						<li><a href="shopping-cart.html">Shopping Cart Summary</a></li>						
						
					</ul>
				</li>
			</ul>
			<h4>Header Styles</h4>
			<ul class="list-unstyled">
				<li><a href="home.html">Header 1</a></li>
				<li><a href="homepage1.html">Header 2</a></li>
				<li><a href="home-furniture.html">Header 3</a></li>
			</ul>
			<h4>Layouts</h4>
			<ul class="list-unstyled">
				<li><a href="homepage1.html">Full Width</a></li>
				<li><a href="homepage2.html">Boxed</a></li>
			</ul>
			<h4>Colors</h4>
			<ul>
				<li><a class="changecolor green-text" href="#" title="Green color">Green</a></li>
                <li><a class="changecolor blue-text" href="#" title="Blue color">Blue</a></li>
                <li><a class="changecolor red-text" href="#" title="Red color">Red</a></li>
                <li><a class="changecolor orange-text" href="#" title="Orange color">Orange</a></li>
                <li><a class="changecolor dark-green-text" href="#" title="Darkgreen color">Dark Green</a></li>
			</ul>
		</div>
		<a class="show-theme-options" href="#"><i class="fa fa-wrench"></i></a>
	</div>-->
<?php
$js =<<<JS
$(document).ready(function(){ 
            $(".changecolor").switchstylesheet( { seperator:"color"} );
            $('.show-theme-options').click(function(){
                    $(this).parent().toggleClass('open');
                    return false;
            });
    });

    $(window).bind("load", function() {
       $('.show-theme-options').delay(2000).trigger('click');
});
JS;
?>
<!-- ============================================================= WIDGET MODAL : BEGIN============================================================= -->
<?php/*
\yii\bootstrap\Modal::begin([
    'header' => '<h2>Корзина</h2>',
    'id' => 'cart',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
                <button type="button" class="btn btn-primary">Оформить заказ</button>
                <button type="button" id="clearCart" class="btn btn-danger" >Очистить корзину</button>'
]);
\yii\bootstrap\Modal::end();
*/
?>
<!-- ============================================================= WIDGET MODAL : END============================================================= -->

<?php $this->endBody();?>

<?php //$this->registerJs($js);?>
</body>
</html>
<?php $this->endPage() ?>
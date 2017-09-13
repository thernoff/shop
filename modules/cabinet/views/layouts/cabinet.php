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
<header class="header-style-1 header-style-3">

<!-- ============================================== TOP MENU ============================================== -->
<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">
                                     <?php if (!Yii::$app->user->isGuest):?>
                                        <li>
                                            <a href="<?= Url::to(['/site/logout']); ?>">
                                                <i class="icon fa fa-sign-out"></i><?= Yii::$app->user->identity['username']?> [ Выйти ] 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['/cabinet']); ?>">
                                                <i class="icon fa fa-user"></i>Мой профиль
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <a href="<?= Url::to(['/site/login']); ?>">
                                                <i class="icon fa fa-sign-in"></i>Войти
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <!--<li><a href="#"><i class="icon fa fa-heart"></i>Списки желаемого</a></li>-->
                                    <li><a href="<?= Url::to(['/cart/view']); ?>"><i class="icon fa fa-shopping-cart"></i>Моя корзина</a></li>
                                    <!--<li><a href="#"><i class="icon fa fa-key"></i>Checkout</a></li>-->
				</ul>
			</div><!-- /.cnt-account -->

			<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
						<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                                    <span class="key">Валюта :</span><span class="value">руб </span><b class="caret"></b>
                                                </a>
						<ul class="dropdown-menu">
							<li><a href="#">руб</a></li>
						</ul>
					</li>

					<li class="dropdown dropdown-small">
						<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                                    <span class="key">Язык :</span><span class="value">Русский </span><b class="caret"></b>
                                                </a>
						<ul class="dropdown-menu">
							<li><a href="#">English</a></li>
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
<!-- ============================================================= LOGO : END ============================================================= -->				</div><!-- /.logo-holder -->

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
     <?= app\components\MainSearchProductWidget::widget(); ?>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
<div class="list-cart">
    <?= app\components\ShoppingCartDropdownWidget::widget(); ?>
</div>
<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div><!-- /.main-header -->

	<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">
    <div class="container">
        <?php
            NavBar::begin(['brandLabel' => 'Главная']);
            echo Nav::widget([
                'items' => [
                    ['label' => 'Игры', 'url' => ['/main/product', 'productId' => '2']],
                    ['label' => 'Фильмы', 'url' => ['/main/product', 'productId' => '3']],
                ],
                'options' => ['class' => 'navbar-nav'],
            ]);
            NavBar::end();
        ?>
    </div><!-- /.container-class -->

</div><!-- /.header-nav -->


<!-- ============================================== NAVBAR : END ============================================== -->

</header>
<!-- ============================================== HEADER : END ============================================== -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
            <?= $content; ?>
        </div>
    </div>
</div>		

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
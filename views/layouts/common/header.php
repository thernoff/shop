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
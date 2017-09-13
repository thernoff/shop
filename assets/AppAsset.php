<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        /* Bootstrap Core CSS */
	    'css/bootstrap.min.css',
	    
	    /* Customizable CSS */
	    '/css/main.css',
	    'css/green.css',
	    'css/owl.carousel.css',
            'css/owl.transitions.css',
            /*<link rel="stylesheet" href="/css/owl.theme.css">*/
            'css/lightbox.css',
            'css/animate.min.css',
            'css/rateit.css',
            'css/bootstrap-select.min.css',

            /* Demo Purpose Only. Should be removed in production */
            'css/config.css',
            //'css/green.css',
            'css/blue.css',
            //'css/red.css',
            //'css/orange.css',
            //'css/dark-green.css',
            /* Icons/Glyphs */
            'css/font-awesome.min.css',
            'css/style-add.css',
    ];
    public $js = [
        //'js/jquery-1.11.1.min.js',
	'js/bootstrap.min.js',
	'js/bootstrap-hover-dropdown.min.js',
	'js/owl.carousel.min.js',
	'js/echo.min.js',
	'js/jquery.easing-1.3.min.js',
	'js/bootstrap-slider.min.js',
        'js/jquery.rateit.min.js',
        'js/lightbox.min.js',
        'js/bootstrap-select.min.js',
        'js/wow.min.js',
	'js/scripts.js',
        'js/switchstylesheet/switchstylesheet.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
}

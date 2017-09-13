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
class AdminAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'admin/css/AdminLTE.css',
        'assets-admin/css/AdminLTE.min.css',
        'assets-admin/css/skins/skin-blue.min.css',
        'assets-admin/css/admin-style-add.css'
    ];
    public $js = [
	'assets-admin/js/app.min.js',
        'assets-admin/js/admin-scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}

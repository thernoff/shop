<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class MainSearchProductWidget extends Widget
{


    public function init() {
        parent::init();
    }


    public function run()
    {
        $products = Product::find()->all();
        return $this->render('main-search-product', compact('products, productUnits', 'productId'));
    }
}

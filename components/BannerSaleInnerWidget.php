<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class BannerSaleInnerWidget extends Widget
{


    public function init() {
        parent::init();
    }


    public function run()
    {
        //$productId = (int)Yii::$app->request->get('productId');
        //$product = Product::findOne($productId);
        //$productUnits = $product->getProductUnitsFind()->where(['>', 'discount_id',  '0'])->with('discount')->limit(5)->all();
        //$productUnit->discount->isDiscount();
        return $this->render('banner-sale-inner');
    }
}

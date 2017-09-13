<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class MainDiscountProductWidget extends Widget
{


    public function init() {
        parent::init();
    }


    public function run()
    {
        $dataCache = Yii::$app->cache->get('MainDiscountProductWidget');
        if ($dataCache){
            return $dataCache;
        }
        
        $arrProducts = [];
        $products = Product::find()->all();
        foreach ($products as $product){
            
            $productUnits = $product->getProductUnitsFind()->where(['>', 'discount_id',  '0'])->with('discount')->limit(5)->all();
            if (count($productUnits) > 0){
                //Т.к. $productAlias необходимый для costa-rico/yii2-images/Module является статическим, из-за чего возникает проблема с определением $productAlias для объектов
                foreach ($productUnits as $productUnit){
                    $productUnit->image = $productUnit->getImage();
                    $productUnit->_productId = $product->id;
                }
                
                if (count($arrProducts) > 0){
                    $arrProducts = array_merge($arrProducts, $productUnits);

                }else{
                    $arrProducts = $productUnits;
                }
            }
            
        }
        shuffle($arrProducts);
        $productUnits = $arrProducts;
        ob_start();
            //return $this->render('main-new-product', compact('arrNewProducts', 'productId', 'arrTabLabels'));
            include('views/main-discount-product.php');
        $dataCache = ob_get_clean();
        
        //Устанавливаем кэш
        Yii::$app->cache->set('MainDiscountProductWidget', $dataCache, 60);

        return $dataCache;
    }
}

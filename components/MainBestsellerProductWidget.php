<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class MainBestsellerProductWidget extends Widget
{


    public function init() {
        parent::init();
    }


    public function run()
    {
        $dataCache = Yii::$app->cache->get('MainBestsellerProductWidget');
        if (!empty($dataCache)){
            return $dataCache;
        }
        
        $arrProducts = [];
        $products = Product::find()->all();
        foreach ($products as $product){
            
            $productUnits = $product->getProductUnitsFind()->where(['is_popular' => '1'])->with('discount')->limit(5)->all();
            if (count($productUnits) > 0){
                //Т.к. $productAlias необходимый для costa-rico/yii2-images/Module является статическим для ProductUnit, из-за чего возникает проблема с определением $productAlias для объектов
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
        array_splice($arrProducts, 9);
        $productUnits = $arrProducts;
        ob_start();
            //return $this->render('main-new-product', compact('arrNewProducts', 'productId', 'arrTabLabels'));
            include('views/main-bestseller-product.php');
        $dataCache = ob_get_clean();
        
        //Устанавливаем кэш
        Yii::$app->cache->set('MainBestsellerProductWidget', $dataCache, 60);

        return $dataCache;
    }
}

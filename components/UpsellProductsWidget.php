<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class UpsellProductsWidget extends Widget
{

    public function init() {
        parent::init();
    }


    public function run()
    {
        //Yii::$app->cache->flush();die;
        $dataCache = Yii::$app->cache->get('UpsellProductWidget');
        if ($dataCache){
            return $dataCache;
        }
        
        $productId = (int)Yii::$app->request->get('productId');
        $productUnitId = (int)Yii::$app->request->get('id');
        $product = Product::findOne($productId);
        
        if ($product){
            $currentProductUnit = $product->getProductUnit($productUnitId);
            $categoryId = $currentProductUnit->parent_id;
            $productUnits = $product->getProductUnitsByCategoryFind($categoryId)->all();
            if (count($productUnits) > 1){
                ob_start();
                //return $this->render('main-new-product', compact('arrNewProducts', 'productId', 'arrTabLabels'));
                include('views/upsell-products.php');
                $dataCache = ob_get_clean();

                //Устанавливаем кэш
                Yii::$app->cache->set('UpsellProductWidget', $dataCache, 10);

                return $dataCache;
            }
        }
        return '';
    }
}

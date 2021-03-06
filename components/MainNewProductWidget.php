<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class MainNewProductWidget extends Widget
{


    public function init() {
        parent::init();
    }


    public function run()
    {
        $dataCache = Yii::$app->cache->get('MainNewProductWidget');
        if ($dataCache){
            return $dataCache;
            //return $this->render('main-new-product', $dataCache);
        }
        
        $arrNewProducts = [];
        $arrTabLabels['all'] = 'Все';
        $products = Product::find()->all();
        //debug($products);die;
        foreach ($products as $product){
            
            $productUnits = $product->getProductUnitsFind()->where(['is_new' => '1'])->with('discount')->limit(5)->all();
            if (count($productUnits) > 0){
                //Т.к. $productAlias необходимый для costa-rico/yii2-images/Module является статическим, из-за чего возникает проблема с определением $productAlias для объектов
                foreach ($productUnits as $productUnit){
                    $productUnit->image = $productUnit->getImage();
                    $productUnit->_productId = $product->id;
                }
                
                if (count($arrNewProducts['all']) > 0){
                    $arrNewProducts['all'] = array_merge($arrNewProducts['all'], $productUnits);

                }else{
                    $arrNewProducts['all'] = $productUnits;
                }

                if ($arrNewProducts[$product->alias]){
                    $arrNewProducts[$product->alias] = array_merge ($arrNewProducts[$product->alias], $productUnits);
                }else{
                    $arrNewProducts[$product->alias] = $productUnits;
                    $arrTabLabels[$product->alias] = $product->name;
                }
            }
            
        }

        shuffle($arrNewProducts['all']);
        
        ob_start();
            //return $this->render('main-new-product', compact('arrNewProducts', 'productId', 'arrTabLabels'));
            include('views/main-new-product.php');
        $dataCache = ob_get_clean();
        
        //Устанавливаем кэш
        Yii::$app->cache->set('MainNewProductWidget', $dataCache, 60);

        //return $this->render('main-new-product', $dataCache);
        return $dataCache;
    }
}

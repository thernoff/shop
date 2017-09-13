<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class ProductCatalogWidget extends Widget
{
    public $catalogId;

    public function init() {
        parent::init();
    }


    public function run()
    {
        $dataCache = '';
        $productId = (int)Yii::$app->request->get('productId');
        $product = Product::findOne($productId);
        if ($product){
            $properties = $product->getPropertiesFind()->where(['type_id' => '4', 'value' => $this->catalogId])->all();
        
            if (!empty($properties)){
                $dataCache = Yii::$app->cache->get('ProductCatalog_' . $productId . $this->catalogId);
                if (!empty($dataCache)){
                    return $dataCache;
                }
                $catalog = \app\modules\admin\models\Catalog::findOne($this->catalogId);
                //Получим массив продуктов, у которых в качестве одного из свойств есть данный Каталог
                //$arrCatalogs = $catalog->getProducts();
                //Если среди данных продуктов существуют каталог с id равным $productId, то можно отображать данный виджет

                $catalogElements = $catalog->getElementsFind()->all();
                //return $this->render('product-catalog', ['productId' => $productId, 'catalog' => $catalog, 'catalogElements' => $catalogElements]);
                ob_start();
                    include('views/product-catalog.php');
                $dataCache = ob_get_clean();

                //if ($arrCatalogs[$productId]){
                    //Устанавливаем кэш
                    Yii::$app->cache->set('ProductCatalog_' . $productId . $this->catalogId, $dataCache, 600);
                    return $dataCache;
                //}
            }
        }
        
        
        
        
        return $dataCache;
        
        
    }
}

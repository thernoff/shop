<?php

namespace app\controllers;

use Yii;
use app\models\Genre;
use app\models\Game;
use yii\data\Pagination;
use app\models\Product;
use app\modules\admin\models\Catalog;

class MainController extends AppController
{
    public function actionIndex()
    {
        //debug($_SESSION['cart']);die;
        $this->layout = 'main';
        $this->setMetaTags('GameShop');
        return $this->render('index');
    }
    
    public function actionSearch()
    {
        $this->layout = 'blank';
        $search = trim(Yii::$app->request->get('search'));
        $productId = (int)(Yii::$app->request->get('productId'));
        if (!$search){
            return $this->render('search');
        }
        $arrProducts = [];
        if ($productId){
            $products = Product::find()->where(['id' => $productId])->all();
        }else{
            $products = Product::find()->all();
        }
        
        $countProductUnits = 0;
        foreach ($products as $product){
            $productUnits = $product->getProductUnitsFind()->where(['like', 'title', $search])->with('discount')->all();
            if (count($productUnits) > 0){
                foreach ($productUnits as $productUnit){
                    $productUnit->image = $productUnit->getImage();
                    $productUnit->_productId = $product->id;
                }
                $arrProducts = array_merge($arrProducts, $productUnits);
                $countProductUnits += count($productUnits);
            }
        }
        //Создаем объект класса Pagination
        $pages = new Pagination([
            'totalCount' => $countProductUnits, 
            'pageSize' => 5,
            //'forcePageParam' => false,//?
            'pageSizeParam' => false,//убираем per-page из url
        ]);
        //
        //$games = $query->offset($pages->offset)->limit($pages->limit)->all();
        $resultSearch = array_slice($arrProducts, $pages->offset, $pages->limit);
        //debug($resultSearch);die;
        $this->setMetaTags('GameShop :: ' . $search);
        return $this->render('search', compact('resultSearch', 'pages', 'search'));
    }
    
    public function actionProduct($productId)
    {
        //$product = Product::findOne($productId);
        
        $product = Yii::$app->db->cache(function ($db) use ($productId) {
            return Product::findOne($productId);
        }, 60);
        
        if (empty($product)){
            throw new \yii\web\HttpException(404, "Данный вид продукта отсутствует.");
        }
        
        $queryProductUnits = $product->getProductUnitsFind();

        //Создаем объект класса Pagination
        $pages = new Pagination([
            'totalCount' => $queryProductUnits->count(), 
            'pageSize' => 9,
            //'forcePageParam' => false,//?
            'pageSizeParam' => false,//убираем per-page из url
        ]);

        $productUnits = Yii::$app->db->cache(function ($db) use ($queryProductUnits, $pages) {
            return $queryProductUnits->with(['discount'])->offset($pages->offset)->limit($pages->limit)->all();
        }, 60);
        
        //$productUnits = $queryProductUnits->with(['discount'])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('product', 
                [
                    'productUnits' => $productUnits,
                    'productId' => $productId,
                    'pages' => $pages
                ]);
    }
    
    public function actionCategory($productId, $categoryId)
    {
        $productId = (int)$productId;
        $categoryId = (int)$categoryId;
        
        //$product = Product::findOne($productId);
        $product = Yii::$app->db->cache(function ($db) use ($productId) {
            return Product::findOne($productId);
        }, 60);
        
        if (empty($product)){
            throw new \yii\web\HttpException(404, "Данный вид продукта отсутствует.");
        }
        //$productUnits = $product->getProductUnitsByCategoryFind($categoryId)->all();
        $queryProductUnits = $product->getProductUnitsByCategoryFind($categoryId);
        
        //Создаем объект класса Pagination
        $pages = new Pagination([
            'totalCount' => $queryProductUnits->count(), 
            'pageSize' => 9,
            //'forcePageParam' => false,//?
            'pageSizeParam' => false,//убираем per-page из url
        ]);
        
        //$productUnits = $queryProductUnits->offset($pages->offset)->limit($pages->limit)->all();
        $productUnits = Yii::$app->db->cache(function ($db) use ($queryProductUnits, $pages) {
            return $queryProductUnits->with(['discount'])->offset($pages->offset)->limit($pages->limit)->all();
        }, 60);
        return $this->render('product', 
                [
                    'productUnits' => $productUnits,
                    'productId' => $productId,
                    'pages' => $pages
                ]);
    }
    
    public function actionTag($productId, $catalogId, $catalogElementId)
    {
        $productId = (int)$productId;
        $catalogId = (int)$catalogId;
        $catalogElementId = (int)$catalogElementId;

        $product = Product::findOne($productId);
        if (empty($product)){
            throw new \yii\web\HttpException(404, "Данный вид продукта отсутствует.");
        }
        
        $catalog = Catalog::findOne($catalogId);
        
        if (empty($catalog)){
            throw new \yii\web\HttpException(404, "Данный вид свойства отсутствует.");
        }
        $property = $product->getPropertiesFind()->where(['type_id' => '4', 'value' => $catalog->id])->one();
        if (empty($property)){
            throw new \yii\web\HttpException(404, "Данный вид свойства отсутствует.");
        }
        $queryProductUnits = $product->getProductUnitsFind()->where([$property->alias => $catalogElementId]);
        
        //Создаем объект класса Pagination
        $pages = new Pagination([
            'totalCount' => $queryProductUnits->count(), 
            'pageSize' => 9,
            //'forcePageParam' => false,//?
            'pageSizeParam' => false,//убираем per-page из url
        ]);
        
        $productUnits = $queryProductUnits->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('product', 
                [
                    'productUnits' => $productUnits,
                    'productId' => $productId,
                    'pages' => $pages
                ]);
    }
    
    public function actionDetail($productId=0, $id=0)
    {
        $this->layout = 'detail';
        $productId = (int)$productId;
        $id = (int)$id;
        $product = Product::findOne($productId);
        if (empty($product)){
            throw new \yii\web\HttpException(404, "Данный вид продукта отсутствует.");
        }
        
        $productUnit = $product->getProductUnitWith($id);//10 запросов к БД!!!

        if (empty($productUnit)){
            throw new \yii\web\HttpException(404, "Данный вид товара отсутствует.");
        }
        return $this->render('detail', ['productUnit' => $productUnit, 'productId' => $productId]);
    }
}
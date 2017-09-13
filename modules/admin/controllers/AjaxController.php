<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\Product;
use yii\helpers\Html;
class AjaxController extends Controller
{
    public function actionTranslate()
    {
        $name = Yii::$app->request->get('name');
        //Если данные пришли не через AJAX, то
        if (!Yii::$app->request->isAjax){
            //return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        
        //debug(Yii::$app->translate->translate('ru', 'en', $name));
        echo Yii::$app->translate->translate('ru', 'en', $name)['text'][0];
    }
    
    public function actionGetFieldCategory()
    {
        $productId = Yii::$app->request->get('productId');
        if ($productId){
            $product = Product::findOne($productId);
            $categories = $product->getCategoriesFind()->all();
            //debug($categories);
            //Если данные пришли не через AJAX, то
            if (!Yii::$app->request->isAjax){
                //return $this->redirect(Yii::$app->request->referrer);
            }
            $this->layout = false;
            echo '<div class="form-group field-discountproduct-category_id">';
            echo Html::label('Выберите категорию', null, ['class' => 'control-label']);
            echo Html::dropDownList('DiscountProduct[category_id]', 'fff', yii\helpers\ArrayHelper::map(
                    $categories,
                    'id',
                    'name'
                ),
                [
                    'id' => 'discountproduct-category_id',
                    'prompt' => ['text' => 'Все категории', 'options' => ['value' => 0]],
                    'class' => 'form-control field-discountproduct-category_id required'
                ]);
            echo '<div class="help-block">';
            echo '</div>';
            echo '</div>';
        }else{
            echo '';
        }
    }
    
    public function actionGetFieldProductUnit()
    {
        $productId = Yii::$app->request->get('productId');
        $parentId = Yii::$app->request->get('parentId');
        if ($parentId){
            $product = Product::findOne($productId);
            $productUnits = $product->getProductUnitsFind()->where(['parent_id' => $parentId, 'discount_id' => '0'])->all();
            //debug($productUnits);
            //Если данные пришли не через AJAX, то
            if (!Yii::$app->request->isAjax){
                //return $this->redirect(Yii::$app->request->referrer);
            }
            $this->layout = false;
            echo '<div class="form-group field-discountproduct-product_unit_id">';
            echo Html::label('Выберите товар', null, ['class' => 'control-label']);
            //echo Html::hiddenInput('ProductUnitProperty[value]');
            //echo '<div id="productunitproperty-value" aria-value="true">';
            echo Html::dropDownList('DiscountProduct[product_unit_id]', 'fff', yii\helpers\ArrayHelper::map(
                    $productUnits,
                    'id',
                    'title'
                ),
                [
                    'id' => 'discountproduct-product_unit_id',
                    'prompt' => ['text' => 'Все товары', 'options' => ['value' => 0]],
                    'class' => 'form-control field-discountproduct-product_unit_id required'
                ]);
            echo '<div class="help-block">';
            echo '</div>';
            //echo '</div>';
            echo '</div>';
        }else{
            echo '';
        }
        
    }
    
    public function actionDeleteImage()
    {
        $productId = Yii::$app->request->post('productId');
        $productUnitId = Yii::$app->request->post('productUnitId');
        $imageId = Yii::$app->request->post('imageId');
        
        $product = Product::findOne($productId);
        $productUnit = $product->getProductUnit($productUnitId);
        $image = $productUnit->getImage($imageId);
        
        if ($productUnit->removeImage($image)){
            echo $image->id;
        }
        echo '';
    }
    
    
}
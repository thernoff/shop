<?php

namespace app\models;

use Yii;
use app\models\ProductUnit;
/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $table_name
 */
class Product extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    
    public $productUnit;
    
    public static function tableName()
    {
        return 'product';
    }
    
    public function setProductUnit(){
        $productUnit = new ProductUnit();
        $this->productUnit = $productUnit->setTableName($this->alias);
        ProductUnit::$productId = $this->id;
    }
    
    public function getProductUnit($id)
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnit = ProductUnit::findOne($id);
        return $productUnit;
    }
    
    public function getProductUnitWith($id)
    {
        //Устанавливаем имя таблицы для ProductUnit
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnit = ProductUnit::find()->where(['id' => $id])->with('discount')->limit(1)->one();
        return $productUnit;
    }
    
    //Метод для получения запроса на нахождение всех единиц товара данного продукта
    public function getProductUnitsFind()
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnits = ProductUnit::find();
        return $productUnits;
    }
    //Метод для получения всех единиц товара данного продукта
    public function getProductUnitsFindAll()
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnits = ProductUnit::find()->all();
        return $productUnits;
    }
    
    public function getProductUnitsByCategoryFind($parentId)
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnits = ProductUnit::find()->where(['parent_id' => $parentId]);
        return $productUnits;
    }
    
    public function getProductUnitsByCategoryFindAll($categoryId)
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnits = ProductUnit::find()->where(['category_id' => $categoryId])->all();
        return $productUnits;
    }
    
    public function getCategoriesFind()
    {
        ProductUnitCategory::setTableName($this->alias);
        ProductUnitCategory::$productId = $this->id;
        $categories = ProductUnitCategory::find();
        return $categories;
    }
    
    public function getCategory($id)
    {
        ProductUnitCategory::setTableName($this->alias);
        ProductUnitCategory::$productId = $this->id;
        //Получаем массив свойств
        $category = ProductUnitCategory::findOne($id);
        //$property = ProductUnitProperty::find()->where(['id' => $id])->with('type')->limit(1)->one();
        return $category;
    }
}

<?php

namespace app\models;

use Yii;
use app\modules\admin\models\ProductUnitProperty;
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
    
    public static function tableName()
    {
        return 'product';
    }

    public function getPropertiesFind()
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnitProperty::setTableName($this->alias);
        ProductUnitProperty::$productId = $this->id;
        //Получаем массив свойств
        $properties = ProductUnitProperty::find();
        return $properties;
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
        $productUnits = ProductUnit::find()->where(['status' => '1']);
        return $productUnits;
    }
    //Метод для получения всех единиц товара данного продукта
    public function getProductUnitsFindAll()
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnits = ProductUnit::find()->where(['status' => '1'])->all();
        return $productUnits;
    }
    
    public function getProductUnitsByCategoryFind($parentId)
    {
        
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        
        $productUnits = ProductUnit::find()->where(['parent_id' => $parentId, 'status' => '1']);
        return $productUnits;
    }
    
    public function getProductUnitsByCategoryFindAll($categoryId)
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnits = ProductUnit::find()->where(['category_id' => $categoryId, 'status' => '1'])->all();
        return $productUnits;
    }
    
    public function getCategoriesFind()
    {
        ProductUnitCategory::setTableName($this->alias);
        ProductUnitCategory::$productId = $this->id;
        $categories = ProductUnitCategory::find()->where(['status' => '1']);
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

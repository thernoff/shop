<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\NotFoundHttpException;
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
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['name', 'alias'], 'string', 'max' => 255],
            [['name', 'alias'], 'trim'],
            ['alias', 'unique'],
            ['alias', 'validateEnglishLanguage'],
        ];
    }
    public function validateEnglishLanguage($attribute, $params)
    {
        if (!$this->hasErrors()) {
            
            $pattern = '/^[a-zA-Z0-9_-]*$/';
            if (!preg_match($pattern, $this->alias)) {
                $this->addError($attribute, 'Alias может состоять только из букв английского алфавита, цифр, дефиса и символа подчеркивания _.');
            }
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'name' => 'Название продукта',
            'alias' => 'Alias',
        ];
    }
    
    public function getProperties()
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnitProperty::setTableName($this->alias);
        //Получаем массив свойств
        $properties = ProductUnitProperty::find()->all();
        return $properties;
    }
    
    
    public function getNewProperty()
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnitProperty::setTableName($this->alias);
        ProductUnitProperty::$productId = $this->id;
        //Получаем массив свойств
        $property = new ProductUnitProperty($id);
        return $property;
    }
    
    public function getProperty($id)
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnitProperty::setTableName($this->alias);
        ProductUnitProperty::$productId = $this->id;
        if (($property = ProductUnitProperty::find()->where(['id' => $id])->with('type')->limit(1)->one()) !== null) {
            return $property;
        } else {
            throw new NotFoundHttpException('Данная свойство товара не существует.');
        }
        return $property;
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
    
    public function getAdditionalPropertiesFind($basic = '0')
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnitProperty::setTableName($this->alias);
        ProductUnitProperty::$productId = $this->id;
        //Получаем массив свойств
        $properties = ProductUnitProperty::find()->where(['basic' => $basic]);
        return $properties;
    }
    
    public function getNewProductUnit()
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        //Получаем массив свойств
        $productUnit = new ProductUnit($id);
        return $productUnit;
    }
    
    public function getProductUnit($id)
    {
        //Устанавливаем имя таблицы для ProductUnitProperty (свойства продукта)
        ProductUnit::setTableName($this->alias);
        ProductUnit::$productId = $this->id;
        if (($productUnit = ProductUnit::findOne($id)) !== null) {
            return $productUnit;
        } else {
            throw new NotFoundHttpException('Данная единица товара не существует.');
        }
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
        if (($productUnits = ProductUnit::find()->where(['category_id' => $categoryId])->all()) !== null) {
            return $productUnits;
        } else {
            throw new NotFoundHttpException('Данные единицы товара не существуют.');
        }
        return $productUnits;
    }
    
    public function getNewCategory()
    {
        ProductUnitCategory::setTableName($this->alias);
        ProductUnitCategory::$productId = $this->id;
        //Получаем массив свойств
        $category = new ProductUnitCategory();
        return $category;
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
        if (($category = ProductUnitCategory::findOne($id)) !== null) {
            return $category;
        } else {
            throw new NotFoundHttpException('Данная категория отсутствует.');
        }
    }
}

<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $product_id
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'product'], 'required'],
            [['name', 'alias'], 'trim'],
            ['alias', 'validateEnglishLanguage'],
            [['alias', 'product'], 'unique', 'targetAttribute' => ['alias', 'product']],
            [['name', 'alias', 'product'], 'string', 'max' => 50],
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
            'id' => 'ID',
            'name' => 'Имя справочника',
            'alias' => 'Alias',
            'product' => 'Продукт',
        ];
    }
    //Возвращает массив объектов Каталог по алиасу продукта
    public static function findByProductName($productName)
    {
        return self::find()->where(['product' => $productName])->all();
    }
    //Возвращает массив объектов Каталог по ID продукта (находит все каталоги указанного продукта)
    public static function findByProductId($productId)
    {
        $product = Product::findOne($productId);
        return self::find()->where(['product' => [$product->alias, 'all']])->all();
    }
    
    //Возвращает массив объектов Продукт по ID каталога (находит все продукты, у которых одно из свойств данный Каталог)
    public function getProducts()
    {
        $arrProducts = [];
        $products = Product::find()->all();
        foreach ($products as $product){
            $properties = $product->getPropertiesFind()->where(['type_id' => '4', 'value' => $this->id])->all();
            if (count($properties) > 0){
                $arrProducts[$product->id] = $product;
            }
        }
        return $arrProducts;
    }
    
    public function getNewElement()
    {
        //Устанавливаем имя таблицы для CatalogUnitProduct
        CatalogUnitProduct::setTableName($this->product, $this->alias);
        CatalogUnitProduct::$catalogId = $this->id;
        //Получаем массив свойств
        $element = new CatalogUnitProduct();
        return $element;
    }
    
    public function getElement($id)
    {
        //Устанавливаем имя таблицы для CatalogUnitProduct
        CatalogUnitProduct::setTableName($this->product, $this->alias);
        CatalogUnitProduct::$catalogId = $this->id;
        //Получаем массив свойств
        $element = CatalogUnitProduct::findOne($id);
        return $element;
    }
    
    public function getElementsFind()
    {
        //Устанавливаем имя таблицы для CatalogUnitProduct
        CatalogUnitProduct::setTableName($this->product, $this->alias);
        CatalogUnitProduct::$catalogId = $this->id;
        //Получаем массив свойств
        $elements = CatalogUnitProduct::find();
        return $elements;
    }
}

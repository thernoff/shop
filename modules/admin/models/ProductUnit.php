<?php

namespace app\modules\admin\models;

use Yii;

class ProductUnit extends \yii\db\ActiveRecord
{
    public static $productAlias;
    public static $tableName;
    public static $tableProductProperty;
    public static $productId;
    public static $arrRules = [];
    public static $arrLabels = [];
    
    public $image;
    public $gallery;
    
    public function __construct() {
       
    }

     public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    public static function setTableName($productAlias)
    {
        if ($productAlias){
            //Устанавливаем Alias продукта (Product), к которму относится данная единица продукта (ProductUnit)
            self::$productAlias = $productAlias;
            //Устанавливаем имя таблицы продукта (Product), к которму относится данная единица продукта (ProductUnit)
            self::$tableName = 'product_' . $productAlias;
            //Устанавливаем имя таблицы, содержащей список свойств продукта (Product) и их типов, к которму относится данная единица продукта (ProductUnit)
            self::$tableProductProperty = 'product_' . $productAlias . '_property';
            //Устанавливаем набор правил валидации
            self::$arrRules = self::getArrRules();
            //Устанавливаем значения атрибутов полей
            self::$arrLabels = self::getArrLabels($productAlias);
        }
    }

    public static function tableName()
    {
        return self::$tableName;
    }
    
    //Данный метод возвращает имя единицы продукта для модуля Costa-Rico
    public static function getProductUnitName()
    {
        return self::$productAlias;
    }
    //Данный метод возвращает категорию, к которой относится единица продукта (ProductUnit)
    public function getCategory(){
        ProductUnitCategory::setTableName(self::$productAlias);
        return $this->hasOne(ProductUnitCategory::className(), ['id' => 'parent_id']);
    }
    //Данный метод устанавливает связь с таблицей discount
    public function getDiscount(){
            return $this->hasOne(Discount::className(), ['id' => 'discount_id']);
    }
    //Данный метод возвращает цену на единицу продукта (ProductUnit) с учетом скидки
    public function getRealPrice(){
        if ($this->discount_id){
            return (int)($this->price * (1 - ($this->discount->procent/100)));
        }else{
            return $this->price;
        }
    }
    //Данный метод возвращает массив названий атрибутов полей () единицы товара (ProductUnit)
    //например: ['name' => 'Имя', 'parent_id' => 'Родительская категория']
    public static function getArrLabels($productAlias)
    {
        $labels = [];
        ProductUnitProperty::setTableName($productAlias);
        $properties = ProductUnitProperty::find()->all();
        foreach ($properties as $property){
            $labels[$property->alias] = $property->name;
        }
        return $labels;
    }
    
    //Данный метод возвращает массив дополнительных свойств единицы товара (ProductUnit), созданных пользователем
    public function getAdditionalProperties()
    {
        ProductUnitProperty::setTableName(self::$productAlias);
        $properties = ProductUnitProperty::find()->where(['basic' => '0'])->all();
        $arrAdditionalProperties = [];
        foreach ($properties as $property){
            if ($property->type->alias == 'catalog'){
                $catalog = Catalog::findOne($property['value']);
                $element = $catalog->getElement($this->$property['alias']);
                //debug($element);die;
                $arrAdditionalProperties[] = [
                    'attribute' => $property['alias'],
                    'value' => $element->title
                ];
            }else{
                $arrAdditionalProperties[] = [
                    'attribute' => $property['alias'],
                    'value' => $this->$property['alias']
                ];
            }
            
        }
        return $arrAdditionalProperties;
    }
    //Данный метод возвращает массив правил для атрибутов единицы товара (ProductUnit)
    public static function getArrRules()
    {
        $arrReqiered = [];
        $arrSafe = [];
        $arrString = [];
        $arrNumber = [];
        $arrBoolean = [];
        $arrTime = [];
        $rules = [];
        ProductUnitProperty::setTableName(self::$productAlias);
        $properties = ProductUnitProperty::find()->with(['type'])->all();
        //debug($properties);die;
        $i = 0;
        foreach ($properties as $property){
            
            if ($property->required){
                $arrReqiered[] = $property->alias;
            }
            switch($property->type->alias):
                case "string": $arrString[] = $property->alias; break;
                case "number": $arrNumber[] = $property->alias; break;
                case "catalog": $arrNumber[] = $property->alias; break;
                case "boolean": $arrBoolean[] = $property->alias; break;
                case "time": $rules[] = [$property->alias, 'datetime', 'format' => 'php: d-m-Y', 'timestampAttribute' => $property->alias, 'timestampAttributeFormat' => 'php: Y-m-d'];
                        ; break;
                default : $arrSafe[] = $property->alias;
            endswitch;
            
            if (!$property->required){
                //$arrNotReqiered[] = $property->alias;
            }
        }
        //debug(['start', 'date', 'format' => 'php: d-m-Y', 'timestampAttribute' => 'start', 'timestampAttributeFormat' => 'php: Y-m-d']);
        if(!empty($arrReqiered)){
            $rules[] = [$arrReqiered, 'required'];
        };
        if(!empty($arrString)){
            $rules[] = [$arrString, 'string'];
            $rules[] = [$arrString, 'trim'];
        };
        if(!empty($arrNumber)){
            $rules[] = [$arrNumber, 'number'];
        };
        if(!empty($arrBoolean)){
            $rules[] = [$arrBoolean, 'boolean'];
        };
        if(!empty($arrTime)){
            //debug($arrTime);die;
            //$rules[] = $arrTime;
        };
        if(!empty($arrSafe)){
            $rules[] = [$arrSafe, 'safe'];
        };
        return $rules;
    }
    
    


    public function rules()
    {
        return self::$arrRules;
    }
    
    public function attributeLabels()
    {
        return self::$arrLabels;
    }

    public function upload()
    {
        if ($this->validate()){
            //debug($this->image);die;
            //Получаем путь по которому будет сохранено изображение (например: upload/store/4VgSceVlofU.jpg)
            $path = "upload/store/" . $this->image->baseName . "." . $this->image->extension;
            //Сохраняем изображение по ранее созданному пути
            $this->image->saveAs($path);
            //Привязываем изображение к данной модели в качестве главного
            //Дополнительно будет созданы папки ProductUnits -> ProductUnit1 для данного товара
            $this->attachImage($path, true);
            //Удаляем исходное изображение
            @unlink($path);
            return true;
        }else{
            return false;
        }
    }
    
    public function uploadGallery(){
        if ($this->validate()){
            foreach ($this->gallery as $image){
                $path = "upload/store/" . $image->baseName . "." . $image->extension;
                $image->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        }else{
            return false;
        }
    }
    
}
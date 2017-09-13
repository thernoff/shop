<?php

namespace app\models;

use Yii;

class ProductUnit extends \yii\db\ActiveRecord
{
    public static $productAlias;
    public static $tableName;
    public static $tableProductProperty;
    public static $productId;
    public $productName;//введено для решения проблемы с Costa-Rico
    public $image;
    public $gallery;

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
            self::$productAlias = $productAlias;
            self::$tableName = 'product_' . $productAlias;
            self::$tableProductProperty = 'product_' . $productAlias . '_property';
        }
    }

    public static function tableName()
    {
        return self::$tableName;
    }
    //Данная функция возвращает имя Экземпляра товара для модуля Costa-Rico
    public static function getProductUnitName()
    {
        return self::$productAlias;
    }


    public function getCategory(){
        ProductUnitCategory::setTableName(self::$productAlias);
        return $this->hasOne(ProductUnitCategory::className(), ['id' => 'category_id']);
    }
    
    public function getDiscount(){
            return $this->hasOne(Discount::className(), ['id' => 'discount_id']);
    }
    
    public function getRealPrice(){
        if ($this->discount_id){
            return (int)($this->price * (1 - ($this->discount->procent/100)));
        }else{
            return $this->price;
        }
    }

}
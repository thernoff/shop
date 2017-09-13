<?php

namespace app\models;

use Yii;

class ProductUnitCategory extends \yii\db\ActiveRecord
{
    public static $tableName;
    public static $productAlias;
    public static $productId;


    public static function setTableName($productAlias)
    {
        if ($productAlias){
            self::$productAlias = $productAlias;
            self::$tableName = 'product_' . $productAlias . '_category';

        }
    }
    
    public function getParentId()
    {
        return $this->hasOne(ProductUnitCategory::className(), ['id' => 'parent_id']);
    }
    
    public static function tableName()
    {
        return self::$tableName;
    }
    
    /*
     * Данный метод проверяет, является ли текущий элемент родительским по отношению к переданному
     */
    public function isParent($id_item)
    {
        $parent = $this->getParent($id_item);
        while ($parent){
            if ($this->id === $parent){
                return true;
                break;
            }
            $parent = $this->getParent($parent);
        }
        return false;
    }
    
    private function getParent($id_item)
    {
        $item = self::findOne($id_item);
        if ($item['parent_id']){
            return $item['parent_id'];
        }
        return false;
    }
}
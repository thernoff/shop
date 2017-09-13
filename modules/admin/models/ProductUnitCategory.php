<?php

namespace app\modules\admin\models;

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
    
     public function rules()
    {
        return [
            [['name', 'alias', 'status'], 'required'],
            [['name', 'alias'], 'trim'],
            [['name', 'alias', 'keywords', 'description'], 'string', 'max' => 255],
            ['alias', 'validateEnglishLanguage'],
            [['status', 'parent_id'], 'integer'],
            //[['keywords', 'description'], 'safe']
        ];
    }
    
    public function validateEnglishLanguage($attribute, $params)
    {
        if (!$this->hasErrors()) {
            
            $pattern = '/^[a-zA-Z0-9_-]*$/';
            if (!preg_match($pattern, $this->alias)) {
                $this->addError($attribute, 'Alias может состоять только из букв английского алфавита, цифр, дефиса и символа подчеркивания _..');
            }
        }
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Категория',
            'alias' => 'Alias',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание',
            'status' => 'Статус',
        ];
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
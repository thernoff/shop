<?php

namespace app\modules\admin\models;

use Yii;

class ProductUnitProperty extends \yii\db\ActiveRecord
{
    public static $tableName;
    public static $productId;
    public static $tableProduct;

    public function __construct() {
       
    }

    public function getType(){
        return $this->hasOne(TypeProperty::className(), ['id' => 'type_id']);
    }
    
    public function getDefaultValue()
    {
        $type = $this->type->alias;
        switch ($type){
            case 'string': return $this->value;
            case 'number': return $this->value;
            case 'catalog':
                $catalog = Catalog::findOne($this->value);
                return $catalog->name;
            case 'boolean': 
                if ($this->value){
                    return 'Да';
                }else{
                    return 'Нет';
                }
        }
    }
    
    public static function setTableName($productAlias)
    {
        if ($productAlias){
            self::$tableName = 'product_' . $productAlias . '_property';
            self::$tableProduct = 'product_' . $productAlias;
        }
    }

    public static function tableName()
    {
        return self::$tableName;
    }
    
    public function rules()
    {
        return [
            [['name', 'alias', 'type_id', 'required', 'visible'], 'required'],
            ['alias', 'unique'],
            ['alias', 'validateEnglishLanguage'],
            ['value', 'number', 'when' => function($model) {
                return ($model->type->alias === 'string' || $model->type->alias === 'number');
            }],
            ['value', 'boolean', 'when' => function($model) {
                return ($model->type->alias === 'boolean');
            }],
            ['value', 'default', 'value' => 255, 'when' => function($model) {
                return ($model->type->alias == 'string');
            }],
            ['value', 'default', 'value' => 0, 'when' => function($model) {
                return ($model->type->alias == 'number');
            }],
            
            ['basic', 'default', 'value' => 0],
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
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя свойства',
            'alias' => 'Alias',
            'type_id' => 'Тип свойства',
            'value' => 'Значение по умолчанию',
            'required' => 'Обязательно к заполнению',
            'visible' => 'Отображать в админ-панели',
            'basic' => 'Базовое',
        ];
    }

}
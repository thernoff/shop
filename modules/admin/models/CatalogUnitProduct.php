<?php

namespace app\modules\admin\models;

use Yii;
/*
 * Класс для работы с записями таблицам справочников
 */
class CatalogUnitProduct extends \yii\db\ActiveRecord
{
    public static $tableName;
    public static $catalogId;
    
    public function __construct() {
       
    }

    public static function setTableName($productAlias, $catalogAlias)
    {
        if ($productAlias && $catalogAlias){
            self::$tableName = 'catalog_' . $productAlias . '_' . $catalogAlias;
        }
    }

    public static function tableName()
    {
        return self::$tableName;
        //return 'product_book_property';
    }
    
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'trim'],
            /*['value', 'string', 'max' => $this->value, 'when' => function($model) {
                return $model->type->alias == 'string';
            }],*/
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Значение',
        ];
    }

}
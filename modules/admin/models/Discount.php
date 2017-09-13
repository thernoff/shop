<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "discount".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $procent
 * @property string $start
 * @property string $end
 * @property string $status
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'procent', 'start', 'end'], 'required'],
            [['procent'], 'integer','min' => 0, 'max' => 100],
            //Для атрибутов start и end указываем формат 'php: d-m-Y', 
            //а также выполняем перевод в 'php: Y-m-d' для сохранения в базу данных, где соответствующие колонки имеют тип данных DATE
            ['start', 'datetime', 'format' => 'php: d-m-Y', 'timestampAttribute' => 'start', 'timestampAttributeFormat' => 'php: Y-m-d'],
            ['end', 'date', 'format' => 'php: d-m-Y', 'timestampAttribute' => 'end', 'timestampAttributeFormat' => 'php: Y-m-d'],
            [['status'], 'boolean'],
            [['name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название скидки',
            'procent' => 'Процент скидки',
            'start' => 'Начало',
            'end' => 'Конец',
            'status' => 'Статус',
        ];
    }
    
    public function isDiscount(){
        $start = strtotime($this->start);
        $now = strtotime(date('Y-m-d'));
        $end = strtotime($this->end);
        if (($start < $now) && ($now < $end)){
            return true;
        }
        
        return false;
    }
}

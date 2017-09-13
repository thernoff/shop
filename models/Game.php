<?php

namespace app\models;

use yii\db\ActiveRecord;

class Game extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    public static function tableName() {
        return 'game';
    }
    
    //Данная функция возвращает имя Экземпляра товара для модуля Costa-Rico
    public static function getProductUnitName()
    {
        return self::className();
    }
    
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['id' => 'genre_id']);
    }
}
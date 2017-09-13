<?php

namespace app\models;

use yii\db\ActiveRecord;

class Genre extends ActiveRecord
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
        return 'genre';
    }
    
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['genre_id' => 'id']);
    }
}
<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $keywords
 * @property string $description
 * @property integer $status
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genre';
    }
    
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['id' => 'parent_id']);
    }

        /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'status'], 'integer'],
            [['name', 'keywords', 'description', 'status'], 'required'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Жанр',
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
        $item = Genre::findOne($id_item);
        if ($item['parent_id']){
            return $item['parent_id'];
        }
        return false;
    }
}

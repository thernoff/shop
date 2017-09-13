<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "page_category".
 *
 * @property integer $id
 * @property integer $id_parent
 * @property string $name
 * @property string $alias
 */
class PageCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent', 'name', 'alias'], 'required'],
            [['id_parent'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Родительская категория',
            'name' => 'Имя категории',
            'alias' => 'Alias',
        ];
    }
}

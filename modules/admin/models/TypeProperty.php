<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "type_property".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 */
class TypeProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'status'], 'required'],
            [['name', 'alias'], 'string', 'max' => 50],
            ['status', 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'alias' => 'Alias',
            'status' => 'Статус'
        ];
    }
}

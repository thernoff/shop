<?php

namespace app\common\models;

use Yii;
use app\modules\admin\models\PageCategory;
/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property integer $id_parent
 * @property string $title
 * @property string $alias
 * @property string $path
 * @property string $content
 * @property string $keywords
 * @property string $description
 * @property string $status
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent'], 'integer'],
            [['title', 'alias', 'content', 'keywords', 'description'], 'required'],
            [['content', 'status'], 'string'],
            [['title', 'alias', 'keywords', 'description'], 'string', 'max' => 256],
            [['path'], 'string', 'max' => 512],
            [['path'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Категория',
            'title' => 'Заголовок',
            'alias' => 'Alias',
            'path' => 'Путь',
            'content' => 'Контент',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание',
            'status' => 'Статус',
        ];
    }
    
    public function getCategory()
    {
        return $this->hasOne(PageCategory::className(), ['id' => 'id_parent']);
    }
}

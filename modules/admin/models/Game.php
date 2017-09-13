<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property string $title
 * @property integer $genre_id
 * @property integer $publisher_id
 * @property integer $pub_data
 * @property integer $multipleer
 * @property integer $coop
 * @property integer $is_new
 * @property integer $is_popular
 * @property integer $is_recomend
 * @property integer $discount
 * @property integer $price
 * @property integer $status
 * @property string $title_image
 * @property string $description
 * @property string $keywords
 * @property string $short_description
 */
class Game extends \yii\db\ActiveRecord
{
    public $image;
    public $gallery;
    
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }
    
    public function getGenre(){
        return $this->hasOne(Genre::className(), ['id' => 'genre_id']);
    }
    
    public function getPublisher(){
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }
        /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'genre_id', 'publisher_id', 'pub_data', 'multipleer', 'coop',  'discount', 'price', 'status', 'description', 'keywords', 'short_description'], 'required'],
            [['genre_id', 'publisher_id', 'pub_data', 'multipleer', 'coop', 'is_new', 'is_popular', 'is_recomend', 'discount', 'price', 'status'], 'integer'],
            [['is_new', 'is_popular', 'is_recomend', 'image'], 'safe'],
            [['description'], 'string'],
            [['title', 'title_image', 'keywords'], 'string', 'max' => 255],
            [['short_description'], 'string', 'max' => 512],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'genre_id' => 'Жанр',
            'publisher_id' => 'Издатель',
            'pub_data' => 'Дата публикации',
            'multipleer' => 'Мультиплеер',
            'coop' => 'Кооператив',
            'is_new' => 'Новинка',
            'is_popular' => 'Популярный',
            'is_recomend' => 'Рекомендуемый',
            'discount' => 'Скидка',
            'price' => 'Цена',
            'status' => 'Статус',
            'image' => 'Главное изображение',
            'gallery' => 'Галерея',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'short_description' => 'Краткое описание',
        ];
    }
    
    public function upload()
    {
        if ($this->validate()){
            $path = "upload/store/" . $this->image->baseName . "." . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        }else{
            return false;
        }
    }
    
    public function uploadGallery(){
        if ($this->validate()){
            foreach ($this->gallery as $image){
                $path = "upload/store/" . $image->baseName . "." . $image->extension;
                $image->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        }else{
            return false;
        }
    }
}

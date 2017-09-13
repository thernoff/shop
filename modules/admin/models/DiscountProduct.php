<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "discount_product".
 *
 * @property string $name
 * @property integer $discount_id
 * @property integer $product_id
 * @property integer $category_id
 * @property integer $product_unit_id
 */
class DiscountProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_product';
    }

    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'discount_id']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'discount_id', 'product_id', 'category_id', 'product_unit_id'], 'required'],
            [['discount_id', 'product_id', 'category_id', 'product_unit_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['product_id', 'category_id', 'product_unit_id'], 'unique', 'targetAttribute' => ['product_id', 'category_id', 'product_unit_id'], 'message' => 'The combination of Product ID, Category ID and Product Unit ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'discount_id' => 'Скидка',
            'product_id' => 'Продукт',
            'category_id' => 'Категория',
            'product_unit_id' => 'Экземпляр товара',
        ];
    }
}

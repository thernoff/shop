<?php

namespace app\models;

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
}

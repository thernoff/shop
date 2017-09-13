<?php

namespace app\models;

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

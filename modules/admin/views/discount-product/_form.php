<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DiscountProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discount-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['value' => $discount->name,'maxlength' => true, 'readonly' => tru]) ?>

    <?= $form->field($model, 'discount_id')->hiddenInput(['value' => $discount->id])->label(false) ?>
    
    <?php echo $form->field($model, 'product_id')->dropDownList(
                yii\helpers\ArrayHelper::map(
                        \app\modules\admin\models\Product::find()->all(),
                    'id',
                    'name'
                ),
            [
                //'prompt' => 'Без категории', 
                'prompt' => ['text' => 'Все продукты', 'options' => ['value' => 0]]
            ]
            ) 
        ?>
    
    <?= $form->field($model, 'category_id')->hiddenInput(['value' => 0])->label(false) ?>
    
    <?= $form->field($model, 'product_unit_id')->hiddenInput(['value' => 0])->label(false) ?>

    <div class="form-group">
        <?= Html::a('Отмена', ['index', 'discountId' => $discountId], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

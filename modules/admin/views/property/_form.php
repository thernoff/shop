<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        <?php
        echo Html::label('Укажите способ перевода для поля Alias:', null, ['class' => 'control-label']);
        echo '<div class="form-group">';
            
            echo Html::radioList('translateMethod', null, 
                    $items = [
                        'translit' => 'Транслитерация', 'yandex' => 'Яндекс.Переводчик'
                    ],
                    $options = [
                        'item' => function ($index, $label, $name, $checked, $value){
                            //return '<label><input type="radio" name="' . $name . '" value="' . $value .'" data-method="' . $value .'"> ' . $label . '</label>';
                            return '<label><input type="radio" name="' . $name . '" value="' . $value . '"> ' . $label . '</label>';
                        }
                    ]
            );
            echo '<div class="help-block"></div>';
        echo '</div>';
    ?>
    
    <?php if ($model->isNewRecord):?>
        <?php 
            echo $form->field($model, 'type_id')->dropDownList(
                yii\helpers\ArrayHelper::map(
                    \app\modules\admin\models\TypeProperty::find()->where(['status' => '1'])->all(),
                    'id',
                    'name'
                )
            );
            echo $form->field($model, 'value',  ['enableClientValidation' => false])->textInput(['value' => 255,'maxlength' => true])
                    ->label('Значение по умолчанию (максимальное количество символов)');
        ?>

    <?php else: ?>
        <?php //echo $form->field($model, 'type_id')->textInput(['value' => $model->type->name, 'maxlength' => true, 'readonly' => true]) ?>
    
        <?php 
            $type = "Тип свойства: " . $model->type->name;
            echo $form->field($model, 'type_id')->hiddenInput()->label($type);
            if ($model->type->alias == 'string'){
                echo $form->field($model, 'value', ['enableClientValidation' => false])->textInput(['maxlength' => true])->label('Значение по умолчанию (максимальное количество символов)');
            }
        ?>
    <?php endif; ?>
    
    <?php 
        if ($model->isNewRecord){
            $model->required = 0;
        }
        echo $form->field($model, 'required')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>
    
    <?php 
        if ($model->isNewRecord){
            $model->visible = 0;
        }
        echo $form->field($model, 'visible')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>
    
    <?php //echo $form->field($model, 'basic')->hiddenInput(['value' => 0])->label(false) ?>
    <?= $form->field($model, 'productId')->hiddenInput(['value' => $model::$productId])->label(false) ?>
    <div class="form-group">
        <?= Html::a('Отмена', ['index', 'productId' => $productId], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

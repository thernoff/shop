<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Discount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discount-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'procent')->textInput() ?>
    
    <?= $form->field($model, 'start')->widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'dd-MM-yyyy',
        'clientOptions' =>  [
            'changeMonth' => true,
            'changeYear' => true
        ]
    ]) ?>
    
    <?= $form->field($model, 'end')->widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'dd-MM-yyyy',
        'clientOptions' =>  [
            'changeMonth' => true,
            'changeYear' => true,
        ]
    ]) ?>
    
    <?php
        if ($model->isNewRecord){
            $model->status = 1;
            echo $form->field($model, 'status')->radioList([
                '1' => 'Да',    
                '0' => 'Нет',
            ]);
        }
    ?>

    <div class="form-group">
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

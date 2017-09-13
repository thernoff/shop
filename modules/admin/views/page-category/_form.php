<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PageCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_parent')->textInput() ?>

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
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

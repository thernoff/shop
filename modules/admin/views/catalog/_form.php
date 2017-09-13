<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Catalog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $model->isNewRecord ? $form->field($model, 'alias')->textInput(['maxlength' => true]) :  $form->field($model, 'alias')->textInput(['maxlength' => true, 'readonly' => true])?>
    
    <?php
    if ($model->isNewRecord){
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
    }
    ?>
    
    <?php echo $form->field($model, 'product')->dropDownList(
            yii\helpers\ArrayHelper::map(
                    \app\modules\admin\models\Product::find()->all(),
                'alias',
                'name'
            ),
            [
                //'prompt' => 'Выберите продукт'
                'prompt' => ['text' => 'Общий', 'options' => ['value' => 'all']]
            ]
        )->label('Укажите продукт для данного справочника');
    ?>
    
    <div class="form-group">
        <?= Html::a('Назад', ['catalog/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

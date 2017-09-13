<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Genre */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genre-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'parent_id')->textInput() ?>
    
    <?php/* echo $form->field($model, 'parent_id')->dropDownList(

            yii\helpers\ArrayHelper::map(
                $parentCategories,
                'id',
                'name'
            ),
            [
                //'prompt' => 'Без категории', 
                'prompt' => ['text' => 'Без категории', 'options' => ['value' => 0]]
            ]
    )*/?>
    
    <div class="form-group field-category-parent_id">
        <label class="control-label" for="productunitcategory-parent_id">Родительская категория</label>
        <select id="productunitcategory-parent_id" class="form-control" name="ProductUnitCategory[parent_id]">
            <option value="0">Корневая категория</option>
            <?= \app\components\MenuWidget::widget(['tpl' => 'select_category', 'model' => $model, 'data' => $parentCategories]) ?>
        </select>
        <div class="help-block"></div>
    </div>
    
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

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea() ?>
    <?php
        if ($model->isNewRecord){
            $model->status = 1;
        }
        echo $form->field($model, 'status')->radioList([
            '1' => 'Да',
            '0' => 'Нет',
        ]);
    ?>

    <div class="form-group">
        <?= Html::a('Назад', ['category/index', 'productId' => $productId], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

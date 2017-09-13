<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Game */
/* @var $form yii\widgets\ActiveForm */

mihaildev\elfinder\Assets::noConflict($this);
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'category_id')->textInput() ?>
    
    <?php /*echo $form->field($model, 'parent_id')->dropDownList(
            yii\helpers\ArrayHelper::map(
                $parentCategories1,
                'id',
                'name'
            ),
            [
                //'prompt' => 'Без категории', 
                'prompt' => ['text' => 'Без категории', 'options' => ['value' => 0]]
            ]
    )*/?>
    
    <div class="form-group field-category-parent_id">
        <label class="control-label" for="productunit-parent_id">Родительская категория</label>
        <select id="productunit-parent_id" class="form-control" name="ProductUnit[parent_id]">
            <option value="0">Корневая категория</option>
            <?= \app\components\MenuWidget::widget(['tpl' => 'select_product-unit', 'model' => $model, 'data' => $parentCategories]) ?>
        </select>
        <div class="help-block"></div>
    </div>
    
    <?php 
        if ($model->isNewRecord){
            $model->is_new = 0;
        }
        echo $form->field($model, 'is_new')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>
    <?php //echo $form->field($model, 'is_popular')->textInput() ?>
    
    <?php
        if ($model->isNewRecord){
            $model->is_popular = 0;
        }
        echo $form->field($model, 'is_popular')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>
    
    <?php //echo $form->field($model, 'is_recomend')->textInput() ?>
    
    <?php
        if ($model->isNewRecord){
            $model->is_recomend = 0;
        }
        echo $form->field($model, 'is_recomend')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>

    <?php /*echo $form->field($model, 'discount_id')->textInput([
        'value' => $model->discount_id ? $model->discount->procent . '%' : $model->discount_id . '%',
        'readonly' => true
    ])*/
    ?>

    <?php
    if ($model->isNewRecord){
            $model->discount_id = 0;
    }
    $discount = $model->discount_id ? $model->discount->procent . '%' : $model->discount_id . '%';
    $discount = 'Скидка на товар составляет: ' . $discount;
    
    echo $form->field($model, 'discount_id')->hiddenInput()->label($discount);
    ?>
    
    <?= $form->field($model, 'price')->textInput() ?>
    
    <?= $form->field($model, 'count')->textInput(['value' => 10]) ?>
    
    <?php 
        if ($model->isNewRecord){
            $model->status = 1;
        }
        echo $form->field($model, 'status')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>
    <?php $mainImg = $model->getImage();?>
    <?php if ($mainImg->id): ?>
        
        <?= $form->field($model, 'image')->fileInput()->label('Главное изображение') ?>
        <?php
            echo '<div class="row">';
            echo '<div class="productunit-main-image-delete">';
            echo '<button type="button" class="btn btn-danger delete-image" data-product-id="' . $productId .'" data-product-unit-id="' . $model->id .'" data-image-id="' . $mainImg->id .'">X</button>';
            echo Html::img($mainImg->getUrl('150x'), ['alt' => 'Удалить', 'title' => 'Удалить']);
            echo '</div>';
            echo '</div>';
        ?>

    <?php else: ?>
        <?= $form->field($model, 'image')->fileInput()->label('Главное изображение') ?>
    <?php endif; ?>
    
    
    <?php echo $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Галерея') ?>
    <?php
        $gallery = $model->getImages();
        if (count($gallery)>0){
            echo '<div class="row">';
            foreach ($gallery as $image){
                if (!$image->isMain){
                    echo '<div class="productunit-gallery-image-delete">';
                    echo '<button type="button" class="btn btn-danger delete-image" data-product-id="' . $productId .'" data-product-unit-id="' . $model->id .'" data-image-id="' . $image->id .'">X</button>';
                    echo Html::img($image->getUrl('150x100'), ['alt' => 'Удалить', 'title' => 'Удалить']);
                    echo '</div>';
                }
            }
            echo '</div>';
        }
    ?>
    <?php echo $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[
            /* Some CKEditor Options */
            'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),
    ]);?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'short_description')->textArea() ?>
    <?php
        //debug($fieldsAdditionalProperties);
       
        if ($fieldsAdditionalProperties){
            echo '<h3>Дополнительные свойства</h3>';
            
            foreach ($fieldsAdditionalProperties as $field){
                if ($field->type->alias == 'string' || $field->type->alias == 'number'){
                    echo $form->field($model, $field->alias)->textInput();
                }
                
                if ($field->type->alias == 'boolean'){
                    echo $form->field($model, $field->alias)->radioList([
                        '0' => 'Нет',
                        '1' => 'Да',
                    ]);
                }
                
                if ($field->type->alias == 'catalog'){
                    echo $form->field($model, $field->alias)->dropDownList(
                        yii\helpers\ArrayHelper::map(
                        \app\modules\admin\models\Catalog::findOne($field->value)->getElementsFind()->all(),
                            'id',
                            'title'
                        ),
                        ['prompt'=>'Выберите ' . strtolower($field->name)]
                    );
                }
                
                if ($field->type->alias == 'time'){
                    echo $form->field($model, $field->alias)->widget(DatePicker::classname(), [
                        'language' => 'ru',
                        'dateFormat' => 'dd-MM-yyyy',
                    ]);
                }
            }
        }
    ?>
    
    <div class="form-group">
        <?= Html::a('Отмена', ['index', 'id' => $model->id, 'productId' => $model::$productId], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
/* @var $this yii\web\View */
/* @var $model app\common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>
    
     <?php echo $form->field($model, 'id_parent')->dropDownList(
            yii\helpers\ArrayHelper::map(
                $categories,
                'id',
                'name'
            ),
            [
                //'prompt' => 'Без категории', 
                'prompt' => ['text' => 'Без категории', 'options' => ['value' => 0]]
            ]
    )?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>
    
    <?php echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[
            /* Some CKEditor Options */
            'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),
    ]);?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
    
     <?= $form->field($model, 'description')->textArea() ?>
    <?php
        if ($model->isNewRecord){
            $model->status = 1;
            $form->field($model, 'status')->radioList([
                '0' => 'Нет',
                '1' => 'Да',
            ]);
        }else{
            $form->field($model, 'status')->radioList([
                '0' => 'Нет',
                '1' => 'Да',
            ]);
        }
    ?>

    <div class="form-group">
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

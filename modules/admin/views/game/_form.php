<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Game */
/* @var $form yii\widgets\ActiveForm */

mihaildev\elfinder\Assets::noConflict($this);
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'genre_id')->textInput() ?>
    <div class="form-group field-game-parent_id has-success">
        <label class="control-label" for="game-parent_id">Родительская категория</label>
        <select id="game-parent_id" class="form-control" name="Game[genre_id]">
            <?= \app\components\MenuWidget::widget(['tpl' => 'select_genre', 'model' => $model]) ?>
        </select>
        <div class="help-block"></div>
    </div>
    <?php //echo $form->field($model, 'publisher_id')->textInput() ?>
    
    <?php echo $form->field($model, 'publisher_id')->dropDownList(
            yii\helpers\ArrayHelper::map(
                    \app\modules\admin\models\Publisher::find()->all(),
                'id',
                'name'
            )
        ) 
    ?>

    <?= $form->field($model, 'pub_data')->textInput() ?>

    <?php //echo $form->field($model, 'multipleer')->textInput() ?>
    
    <?= $form->field($model, 'multipleer')->checkbox(['0', '1',]);
    ?>

    <?php //echo $form->field($model, 'coop')->textInput() ?>
    
    <?= $form->field($model, 'coop')->checkbox(['0', '1',]);?>

    <?php //echo $form->field($model, 'is_new')->textInput() ?>
    
    <?= $form->field($model, 'is_new')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>
    <?php //echo $form->field($model, 'is_popular')->textInput() ?>
    
    <?= $form->field($model, 'is_popular')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>
    
    <?php //echo $form->field($model, 'is_recomend')->textInput() ?>
    
    <?= $form->field($model, 'is_recomend')->radioList([
            '0' => 'Нет',
            '1' => 'Да',
        ]);
    ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    
    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?php echo $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[
            /* Some CKEditor Options */
            'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),
    ]);?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

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
    
    <?php /*echo $form->field($model, 'parent_id')->dropDownList(
            yii\helpers\ArrayHelper::map(
                \app\modules\admin\models\Genre::find()->all(),
                'id',
                'name'
            )
        ) */?>
    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="category-parent_id">Родительская категория</label>
        <select id="category-parent_id" class="form-control" name="Genre[parent_id]">
            <option value="0">Корневая категория</option>
            <?= \app\components\MenuWidget::widget(['tpl' => 'select', 'model' => $model]) ?>
        </select>
        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

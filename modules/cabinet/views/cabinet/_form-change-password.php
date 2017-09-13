<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\User */
/* @var $form ActiveForm */
?>
<div class="form-cabinet">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'oldPassword') ?>
        <?= $form->field($model, 'newPassword') ?>
        <?= $form->field($model, 'reNewPassword') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form-cabinet -->

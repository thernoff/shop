<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\User */
/* @var $form ActiveForm */
?>
<div class="form-cabinet">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'login') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'lastname') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'phone') ?>
        
        <div class="form-group">
            <?= Html::a('Сменить пароль', ['cabinet/change-password'], ['class' => 'btn btn-primary']); ?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form-cabinet -->

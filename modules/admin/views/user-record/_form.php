<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Role;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true])->label('Логин (должен состоять из букв латинского алфавита, цифр и символа подчеркивания).') ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    
    <?php echo $form->field($model, 'role_id')->dropDownList(

            yii\helpers\ArrayHelper::map(
                Role::find()->all(),
                'id',
                'name'
            ),
            [
                'prompt' => 'Укажите роль', 
                //'prompt' => ['text' => 'Укажите роль', 'options' => ['value' => 0]],
            ]
    )?>
    
    <?php
        $model->password = '';
        echo $form->field($model, 'password')->textInput(['maxlength' => true]) 
    ?>

    <?php //echo $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'role')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

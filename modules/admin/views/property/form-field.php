<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
    
if ($type->alias == 'string'){
    //echo '<div class="form-group field-productunitproperty-name required">';
        echo Html::label('Значение по умолчанию (максимальное количество символов)', 'productunitproperty-value', ['class' => 'control-label']);
        echo Html::hiddenInput('ProductUnitProperty[value]');
        echo Html::input('text', 'ProductUnitProperty[value]', '', ['id' => 'productunitproperty-value','class' => 'form-control']);
        echo '<div class="help-block"></div>';
    //echo '</div>';
}

if ($type->alias == 'number'){
    //echo '<div class="form-group field-productunitproperty-name required">';
        echo Html::label('Значение по умолчанию', 'productunitproperty-value', ['class' => 'control-label']);
        echo Html::hiddenInput('ProductUnitProperty[value]');
        echo Html::input('text', 'ProductUnitProperty[value]', '', ['id' => 'productunitproperty-value','class' => 'form-control']);
        echo '<div class="help-block"></div>';
    //echo '</div>';
}

if ($type->alias == 'time'){
    echo '';
}

if ($type->alias == 'boolean'){
    //echo Html::radio('ProductUnitProperty[value]', true, ['label' => 'Да/нет']);
    
    echo Html::label('Значение по умолчанию', null, ['class' => 'control-label']);
    echo Html::hiddenInput('ProductUnitProperty[value]');
    echo '<div id="productunitproperty-value" aria-value="true">';
        echo Html::radio('ProductUnitProperty[value]', true, ['label' => 'Да', value => 1]);
        echo Html::radio('ProductUnitProperty[value]', false, ['label' => 'Нет', value => 0]);
        echo '<div class="help-block"></div>';
    echo '</div>';
    //echo Html::activeRadio($type, 'agree', ['class' => 'ProductUnitProperty[value]']);
}

if ($type->alias == 'catalog'){
    //echo Html::radio('ProductUnitProperty[value]', true, ['label' => 'Да/нет']);
   
    echo Html::label('Значение по умолчанию', null, ['class' => 'control-label']);
    echo Html::hiddenInput('ProductUnitProperty[value]');
    echo '<div id="productunitproperty-value" aria-value="true">';
         echo Html::dropDownList('ProductUnitProperty[value]', 'fff', yii\helpers\ArrayHelper::map(
                $catalogs,
                'id',
                'name'
            ),  ['class' => 'form-control']);
        echo '<div class="help-block"></div>';
    echo '</div>';
    //echo Html::activeRadio($type, 'agree', ['class' => 'ProductUnitProperty[value]']);
}
?>


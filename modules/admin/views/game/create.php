<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Game */

$this->title = 'Добавить игру';
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

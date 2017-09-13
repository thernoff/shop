<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PageCategory */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Page Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

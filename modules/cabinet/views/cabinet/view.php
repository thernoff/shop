<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Genre */

$this->title = 'Просмотр профиля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'login',
            'username',
            'lastname',
            'email',
            'phone'
        ],
    ]) ?>
<?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserRecord */

$this->title = 'Пользователь: ' . $model->login;
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'username',
            'lastname',
            'email:email',
            'phone',
            //'password',
            //'role_id',
            [
                'attribute' => 'role_id',
                'value' => $model->role->name
            ],
            //'auth_key',
        ],
    ]) ?>
    
    <div class="panel panel-default">
        <div class="panel-body">
            <h3 class="text-center">Список покупок</h3>
        </div>
    </div>
        
    <?php 
    
    foreach ($orders as $order){
        echo '<div class="panel panel-default">
                
                    <div class="panel-heading">
                    
                    <h4 class="panel-title">Номер заказа: ' . $order->id . '</h4></div><div class="panel-body">';
        echo '<table class="table table-striped table-bordered detail-view">';
        foreach ($order['items'] as $item){
            
            echo '<tr>';
            echo '<td>Наименование товара: </td><td>' . $item['name'] . '</td>';
            echo '</tr>';
            
        }
        echo '</table></div></div>';
    }
    ?>

</div>

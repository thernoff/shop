<?php
use yii\helpers\Html;
?>

<form method="get" action="<?= yii\helpers\Url::to(['main/search']); ?>">
        <div class="control-group">
            
            <ul class="categories-filter animate-dropdown">
                <?php
                echo Html::dropDownList('productId', 'fff', yii\helpers\ArrayHelper::map(
                $products = app\models\Product::find()->all(),
                'id',
                'name'
            ),  [
                    'class' => 'form-control',
                    'prompt' => ['text' => 'Все продукты', 'options' => ['value' => 0]],
                ]);
            ?>
            </ul>

            <input name="search" class="search-field" placeholder="Введите название продукта..." />
            <button class="search-button"/></button>
        </div>
    </form>
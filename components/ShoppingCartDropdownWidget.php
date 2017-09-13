<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Genre;
use app\models\Game;

class ShoppingCartDropdownWidget extends Widget
{


    public function init() {
        parent::init();
    }


    public function run()
    {
        $session = Yii::$app->session;
        $session->open();
        if (isset($_SESSION['cart'])){
            $data['cart'] = $_SESSION['cart'];
            $data['qty'] = $_SESSION['cart.qty'];
            $data['sum'] = $_SESSION['cart.sum'];
        }else{
            $data['qty'] = 0;
            $data['sum'] = 0;
        }
        return $this->render('shopping-cart-dropdown', compact('session'));
    }
}

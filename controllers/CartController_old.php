<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Game;
use app\models\Order;
use app\models\OrderItems;

class CartController extends AppController
{ 
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $game = Game::findOne($id);
        if (empty($game)){
            return false;
        }
        
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($game, $qty);
        //Если данные пришли не через AJAX, то
        if (!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        $data['cart'] = $_SESSION['cart'];
        $data['qty'] = $_SESSION['cart.qty'];
        $data['sum'] = $_SESSION['cart.sum'];
        
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
        //echo app\components\ShoppingCartDropdownWidget::widget();
    }
    
    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionDeleteItem(){
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMetaTags('GameShop :: Список покупок');
        $order = new Order();
        if ($order->load(Yii::$app->request->post())){
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()){
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер скоро свяжется с вами.');
                Yii::$app->mailer->compose('order', compact('session'))
                    ->setFrom(['ivdm76@mail.ru' => "Администратор магазина ShopGame"])
                    ->setTo($order->email)
                    ->setSubject('Заказ товаров')
                    ->send();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка в оформлении заказа.');
            }
        }
        return $this->render('view', compact('session', 'order'));
    }
    
    protected function saveOrderItems($items, $order_id){
        foreach ($items as $id => $item){
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['title'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['price'] * $item['qty'];
            $order_items->save();
        }
    }
}
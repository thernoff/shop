<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Game;
use app\models\Order;
use app\models\OrderItems;
use app\modules\admin\models\Product;
use app\components\ShoppingCartDropdownWidget;

class CartController extends AppController
{ 
    public function actionAdd()
    {
        $productId = Yii::$app->request->get('productId');
        $productUnitId = Yii::$app->request->get('productUnitId');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($productId);
        $productUnit = $product->getProductUnit($productUnitId);
        
        if (empty($productUnit)){
            return false;
        }
        
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        //debug($productUnit);die;
        $cart->addToCart($productId, $productUnit, $qty);
        //Если данные пришли не через AJAX, то
        if (!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        $data['cart'] = $_SESSION['cart'];
        $data['qty'] = $_SESSION['cart.qty'];
        $data['sum'] = $_SESSION['cart.sum'];
        
        $this->layout = false;
        //debug($_SESSION);die;
        //return $this->render('cart-modal', compact('session'));
        echo ShoppingCartDropdownWidget::widget();
    }
    
    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        //$this->layout = false;
        //return $this->render('cart-modal', compact('session'));
        echo ShoppingCartDropdownWidget::widget();
    }
    
    public function actionDeleteItem(){
        $productId = Yii::$app->request->get('productId');
        $productUnitId = Yii::$app->request->get('productUnitId');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($productId, $productUnitId);
        $this->layout = false;
        //return $this->render('cart-modal', compact('session'));
        echo ShoppingCartDropdownWidget::widget();
    }
    
    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        //return $this->render('cart-modal', compact('session'));
        echo ShoppingCartDropdownWidget::widget();
    }
    
    public function actionView()
    {
        $this->layout = 'blank';
        $session = Yii::$app->session;
        $session->open();
        $this->setMetaTags('GameShop :: Список покупок');
        $order = new Order();
        
         if (!Yii::$app->user->isGuest){
            $user_id = \app\models\User::findOne(Yii::$app->user->identity->getId());
         }else{
			 $user_id = 0;
		 }
         
        if ($order->load(Yii::$app->request->post())){
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            $order->user_id = $user_id;
            //debug($session['cart']);die;
            if ($order->save()){
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер скоро свяжется с вами.');
                /*Yii::$app->mailer->compose('order', compact('session'))
                    ->setFrom(['ivdm76@mail.ru' => "Администратор магазина ShopGame"])
                    ->setTo($order->email)
                    ->setSubject('Заказ товаров')
                    ->send();*/
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
    
    protected function saveOrderItems($products, $order_id){
        foreach($products as $product){
            foreach ($product as $id => $item){
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
}
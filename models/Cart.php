<?php

namespace app\models;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    public function addToCart($productId, $productUnit, $qty = 1)
    {   
        $realPrice = $productUnit->getRealPrice();
        $mainImg = $productUnit->getImage();
        if (isset($_SESSION['cart'][$productId][$productUnit->id])){
            $_SESSION['cart'][$productId][$productUnit->id]['qty'] += $qty;
        }else{
            $_SESSION['cart'][$productId][$productUnit->id] = [
                'qty' => $qty,
                'title' => $productUnit->title,
                'price' => $realPrice,
                'img' => $mainImg->getUrl('100x150'),
            ];
        }
        
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? 
                $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? 
                $_SESSION['cart.sum'] + $qty * $realPrice : $qty * $realPrice;
    }
    
    public function recalc($productId, $productUnitId)
    {
        if (!isset($_SESSION['cart'][$productId][$productUnitId])){
            return false;
        }
        $qtyMinus = $_SESSION['cart'][$productId][$productUnitId]['qty'];
        $sumMinus = $_SESSION['cart'][$productId][$productUnitId]['qty'] * $_SESSION['cart'][$productId][$productUnitId]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$productId][$productUnitId]);
    }
}

<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Genre;
use app\models\Game;

class FeaturedProductsWidget extends Widget
{


    public function init() {
        parent::init();
    }


    public function run()
    {
        $featuredGame = Game::find()->where(['is_popular' => 1])->limit(12)->all();
        return $this->render('featured-products', compact('featuredGame'));
    }
}

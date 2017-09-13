<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Genre;
use app\models\Game;

class MainTopSliderWidget extends Widget
{


    public function init() {
        parent::init();
    }


    public function run()
    {
        return $this->render('main-top-slider');
    }
}

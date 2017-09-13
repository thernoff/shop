<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class MenuProductLeftWidget extends Widget
{
    public $productId;
    public $data;
    public $tree;
    public $tpl;
    public $menuHtml;//будет хранить готовый html-код в зависимости от шаблона
    
    public function init() {
        parent::init();
        if ($this->tpl === null){
            $this->tpl = 'menu-product-left-tpl';
        }
        $this->tpl .= '.php';
    }


    public function run()
    {
        $productId = Yii::$app->request->get('productId');
        $dataCache = Yii::$app->cache->get('MenuProductLeftWidget' . $productId);
        
        if (!empty($dataCache)){
            return $dataCache;
        }
        
        if ($productId){
            $product = Product::findOne($productId);
            //$categories = $product->getCategoriesFind()->where(['parent_id' => '0'])->all();
            $categories  = $product->getCategoriesFind()->indexBy('id')->asArray()->all();
            $this->tree = $this->getTree($categories);
            //debug($this->tree);die;

            //return $this->render('menu-product-left', ['productId' => $productId, 'categories' => $this->tree]);
            //return $this->menuHtml;

            ob_start();
            include('views/menu-product-left.php');
            $dataCache = ob_get_clean();

            //Устанавливаем кэш
            Yii::$app->cache->set('MenuProductLeftWidget' . $productId, $dataCache, 600);
            return $dataCache;
        }
        return '';
        
        
    }
    
    protected function getTree($data)
    {
        $tree = [];
        //Идем по записям массива, причем в данном случае в качестве значения выступает ссылка
        foreach ($data as $id => &$node)
        {
            if (!$node['parent_id'])
            {
                //Если у узла нет родителя, то в массив $tree добавляем ссылку на данный узел
                $tree[$id] = &$node;
            }else{
                //Если же у узла есть родитель, то в этом случае у "родителя" создаем дополнительный подмассив 'childs', в который заносим ссылки на "дочерние" узлы
                //debug($node['parent_id']);
                $data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        //Данный массив содержит в себе родительские узлы, у которых могут быть дополнительный подмассив 'childs' с ссылками на на "дочерние" узлы
        return $tree;
    }
    
    protected function getMenuHtml($tree, $tab='')
    {
        include __DIR__.'/menu_tpl/'.$this->tpl;
    }
    
    protected function getMenuHtml1($tree, $tab='')
    {
        $str='<div class="side-menu animate-dropdown outer-bottom-xs">
            <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Категории</div>        
            <nav class="yamm megamenu-horizontal" role="navigation">
            <ul class="nav">';
        foreach($tree as $category){
            $str .= $this->catToTemplate($category, $tab);
        }
        $str .= '</ul><!-- /.nav -->
            </nav><!-- /.megamenu-horizontal -->
            </div><!-- /.side-menu -->';
        return $str;
    }
    
    protected function catToTemplate($category, $tab)
    {
        ob_start();
        include __DIR__.'/menu_tpl/'.$this->tpl;        
        return ob_get_clean();
    }
}

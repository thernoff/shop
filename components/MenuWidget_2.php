<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\modules\admin\models\Product;

class MenuWidget extends Widget
{
    public $tpl;
    public $model;//Приходит из _form.php, когда создаем выпадающий список в админке
    public $data;//будет хранить все записи категорий из БД
    public $tree;//будет хранить результат работы функции
    public $menuHtml;//будет хранить готовый html-код в зависимости от шаблона
    
    public function init() {
        parent::init();
        if ($this->tpl === null){
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }


    public function run()
    {
        //Пытаемся получить кэш для пользовательской части
        /*if ($this->tpl == 'menu.php'){
            $menu = Yii::$app->cache->get('menu');
            if ($menu) return $menu;
        }*/
        //Если в кэше (по ключу 'menu') пусто то выполняем следующие операции
        //asArray() - получаем результат в виде массива
        //indexBy() - позволяет указать какое поле таблицы использовать для индексирования массива (в нашем случае ключи будут совпадать с идентификаторами)
        
        ////$product = Product::findOne($this->productId);
        //$this->data = $product->getCategoriesFind()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        
        //Устанавливаем кэш для меню пользовательской части
        /*if ($this->tpl == 'menu.php'){
            Yii::$app->cache->set('menu', $this->menuHtml, 60);
        }*/
        
        return $this->menuHtml;
    }
    
    protected function getTree()
    {
        $tree = [];
        //Идем по записям массива, причем в данном случае в качестве значения выступает ссылка
        foreach ($this->data as $id => &$node)
        {
            if (!$node['parent_id'])
            {
                //Если у узла нет родителя, то в массив $tree добавляем ссылку на данный узел
                $tree[$id] = &$node;
            }else{
                //Если же у узла есть родитель, то в этом случае у "родителя" создаем дополнительный подмассив 'childs', в который заносим ссылки на "дочерние" узлы
                //debug($node['parent_id']);
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        //Данный массив содержит в себе только ссылки на родительские узлы, у которых могут быть дополнительный подмассив 'childs' с ссылками на на "дочерние" узлы
        return $tree;
    }
    
    protected function getMenuHtml($tree, $tab='')
    {
        $str='';
        foreach($tree as $item){
            $str .= $this->catToTemplate($item, $tab);
        }
        return $str;
    }
    
    protected function catToTemplate($item, $tab)
    {
        ob_start();
        include __DIR__.'/menu_tpl/'.$this->tpl;        
        return ob_get_clean();
    }
}

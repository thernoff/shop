<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;

class BaseObject extends \yii\db\ActiveRecord
{
    //private $arrProperties = [];
    //private $productName;
    //private $productAlias;
    //private $labels = [];
    
    public static function tableName()
    {
        //return 'product_' . $this->productAlias;
        return 'product_book_property';
    }
    
    /*public function __construct($productName, $productAlias) {
        parent::__construct();
        //$this->productName = $productName;
        //$this->productAlias = $productAlias;
        
        $productPropertyTable = 'product_' . $productAlias . '_property';
        $rows = (new \yii\db\Query())
            ->select([])
            ->from($productPropertyTable)
            ->all();
        //$this->arrProperties = $rows;
        
        //$this->labels['name'] = 'Имя';
        
        foreach ($this->arrProperties as $property){
            //$this->$property['alias'] = '';
            //$this->labels[$property['alias']] = $property['name'];
        }
    }


    public function rules()
    {
        $rules = [];
        $arrRequired = [];
        $arrString = [];
        $arrNumber = [];
        foreach ($this->arrProperties as $property){
            if ($property['required']){
                $arrRequired[] = $property['alias'];
            }
        }
        
        foreach ($this->arrProperties as $property){
            if ($property['type'] == 1){
                $arrString[] = $property['alias'];
            }
        }
        
        foreach ($this->arrProperties as $property){
            if ($property['type'] == 2){
                $arrNumber[] = $property['alias'];
            }
        }
        
        return [
            [$arrRequired, 'required'],
            [$arrString, 'string'],
            [$arrNumber, 'number'],
        ];
    }

    public function attributeLabels()
    {
        //echo '1<br>';
        //$arrLabels = [];
        //debug($this->arrProperties[0]['name']); die;
        //foreach ($this->arrProperties as $property){
            //debug($property) . "<br>";
            //$arrLabels['alias'] = $property['name'];
            
        //}
        //debug($this->labels);die;
        return $this->labels;
    }
    
   
    
    public function __set($key, $value) {
        $this->arrProperties[$key] = $value;
        $this->$key = $value;
    }
    
    public function __get($key) {
        return $this->arrProperties[$key];
    }
     */
}

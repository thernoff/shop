<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Catalog;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class PropertyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET','POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex($productId)
            
    {
        //debug($this->layout);die;
        $productId = (int)$productId;
        
        $product = $this->findProduct($productId);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $product->getAdditionalPropertiesFind(),
        ]);

        return $this->render('index', [
            'productId' => $productId,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id, $productId)
    {
        $product = $this->findProduct($productId);
        $property = $product->getProperty($id);
        
        //debug($property);die;
        
        return $this->render('view', [
            'model' => $property,
            'productId' => $productId
        ]);
    }

    public function actionCreate($productId)
    {
        $product = $this->findProduct($productId);
        //debug($product);die;
        $property = $product->getNewProperty();//Получаем новый объект класса ProductUnitProperty
        //$catalogs = Catalog::findByProductName($product->alias);
        //debug(Yii::$app->request->post());
        //debug($property);die;
        if ($property->load(Yii::$app->request->post()) && $property->save()) {  
            
            Yii::$app->db
                ->createCommand()
                ->addColumn($property::$tableProduct, $property->alias, 'string')
                ->execute();
            
            return $this->redirect(['index', 'productId' => $productId]);
        } else {
            return $this->render('create', [
                'model' => $property,
                //'catalogs' => $catalogs,
                'productId' => $productId,
            ]);
        }
    }

    public function actionUpdate($id, $productId)
    {
        $product = $this->findProduct($productId);
        $property = $product->getProperty($id);
        //$catalogs = Catalog::findByProductName($product->alias);
        if ($property->load(Yii::$app->request->post()) && $property->save()) {
            return $this->redirect(['index', 'id' => $property->id, 'productId' => $productId]);
        } else {
            return $this->render('update', [
                'model' => $property,
                //'catalogs' => $catalogs,
                'productId' => $productId,
            ]);
        }
    }
    
    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $productId)
    {
        $product = $this->findProduct($productId);
        $property = $product->getProperty($id);
        
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        try {
            /*
            if ($property->type_id == 4){
                //$property->value хранит id из таблицы Catalog
                $catalog = Catalog::findOne($property->value);
                //debug($catalog);die;
                //Получаем имя таблицы соответствующей каталогу
                $catalogName = 'catalog_' . $product->alias . '_' . $catalog->alias;
                //debug($catalogName);die;
                //Удаляем таблицу каталога
                $db->createCommand()
                    ->dropTable($catalogName)
                    ->execute();
                //Удаляем запись соотвтствующую каталогу из таблицы Catalog
                $catalog->delete();
            }
            */
            
            //Удаляем столбец, соответствующий данному свойству из таблицы продукта product_{имя_продукта}
            $db->createCommand()
                ->dropColumn($property::$tableProduct, $property->alias)
                ->execute();

            //Удаляем свойство
            $property->delete();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
        }
        return $this->redirect(['index',  'productId' => $productId]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProduct($productId)
    {
        if (($product = Product::findOne($productId)) !== null) {
            return $product;
        } else {
            throw new NotFoundHttpException('Данный товар не сущестует.');
        }
    }
    //Данный метод выполняется через ajax запрос (на property/create), для отображения поля "Значение по умолчанию"
    public function actionGetFormField()
    {
        $typeId = Yii::$app->request->get('type');
        $productId = Yii::$app->request->get('productId');
        $type = \app\modules\admin\models\TypeProperty::findOne($typeId);
        $catalogs = Catalog::findByProductId($productId);
        //Если данные пришли не через AJAX, то
        if (!Yii::$app->request->isAjax){
            //return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('form-field', [
            'type' => $type,
            'catalogs' => $catalogs,
        ]);
    }
}

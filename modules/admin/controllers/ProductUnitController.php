<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductUnitController extends Controller
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
        $visibleColumns = (new \yii\db\Query())
                ->select(['alias'])
                ->from('product_game_property')
                ->where(['visible' => 1])
                ->all();
        $arr = [];
        foreach ($visibleColumns as $column){
            $arr[] = $column['alias'];
        }
        $product = $this->findProduct($productId);
        $productUnits = $product->getProductUnitsFindAll();
        //debug($productUnits);die;
        $dataProvider = new ActiveDataProvider([
            'query' => $product->getProductUnitsFind(),
        ]);
        //debug($dataProvider);
        return $this->render('index', [
            'productId' => $productId,
            'dataProvider' => $dataProvider,
            'arrVisibleColumns' => $arr,
        ]);
    }

    public function actionView($id, $productId)
    {
        $product = $this->findProduct($productId);
        $productUnit = $product->getProductUnit($id);
        //$additionalProperties = $product->getPropertiesFind()->all();
        //debug($additionalProperties);die;
        $additionalProperties = $productUnit->getAdditionalProperties();
        //debug($additionalProperties);die;
        return $this->render('view', [
            'model' => $productUnit,
            'productId' => $productId,
            'additionalProperties' => $additionalProperties,
        ]);
    }

    public function actionCreate($productId)
    {
        $product = $this->findProduct($productId);
        
        $productUnit = $product->getNewProductUnit();
        $parentCategories = $product->getCategoriesFind()->indexBy('id')->asArray()->all();
        
        $additionalProperties = $productUnit->getAdditionalProperties();
        $fieldsAdditionalProperties = $product->getAdditionalPropertiesFind()->with('type')->all();
        if ($productUnit->load(Yii::$app->request->post()) && $productUnit->save()) {
            //return $this->redirect(['view', 'id' => $element->id, 'catalogId' => $catalogId]);
            $productUnit->image = UploadedFile::getInstance($productUnit, 'image');
            if ($productUnit->image){
                $productUnit->upload();
            }
            unset ($productUnit->image);
            $productUnit->gallery = UploadedFile::getInstances($productUnit, 'gallery');
            if ($productUnit->gallery){
                $productUnit->uploadGallery();
            }
            Yii::$app->session->setFlash('success', 'Продукт успешно добавлен.');
            return $this->redirect(['index',  'productId' => $productId]);
        } else {
            return $this->render('create', [
                'model' => $productUnit,
                'additionalProperties' => $additionalProperties,
                'fieldsAdditionalProperties' => $fieldsAdditionalProperties,
                'parentCategories' => $parentCategories,
            ]);
        }
    }

    public function actionUpdate($id, $productId)
    {
        $product = $this->findProduct($productId);
        $productUnit = $product->getProductUnit($id);
        $parentCategories = $product->getCategoriesFind()->indexBy('id')->asArray()->all();
        $additionalProperties = $productUnit->getAdditionalProperties();
        $fieldsAdditionalProperties = $product->getAdditionalPropertiesFind()->with('type')->all();
        //debug($additionalProperties);die;
        if ($productUnit->load(Yii::$app->request->post()) && $productUnit->save()) {
            //return $this->redirect(['view', 'id' => $element->id, 'catalogId' => $catalogId]);
            $productUnit->image = UploadedFile::getInstance($productUnit, 'image');
            if ($productUnit->image){
                $productUnit->upload();
            }
            unset ($productUnit->image);
            $productUnit->gallery = UploadedFile::getInstances($productUnit, 'gallery');
            if ($productUnit->gallery){
                $productUnit->uploadGallery();
            }
            Yii::$app->session->setFlash('success', 'Продукт успешно изменен.');
            return $this->redirect(['index',  'productId' => $productId]);
        } else {
            return $this->render('update', [
                'model' => $productUnit,
                'additionalProperties' => $additionalProperties,
                'fieldsAdditionalProperties' => $fieldsAdditionalProperties,
                'parentCategories' => $parentCategories,
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
        $productUnit = $product->getProductUnit($id);
        $productUnit->removeImages();
        $productUnit->delete();
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
            throw new NotFoundHttpException('Данный товар не существует.');
        }
    }
}

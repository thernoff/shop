<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use app\modules\admin\models\ProductUnitCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GenreController implements the CRUD actions for Genre model.
 */
class CategoryController extends Controller
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
                    'delete' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Genre models.
     * @return mixed
     */
    public function actionIndex($productId)
    {
        $product = $this->findProduct($productId);
        $dataProvider = new ActiveDataProvider([
            'query' => $product->getCategoriesFind(),
        ]);

        return $this->render('index', [
            'productId' => $productId,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Genre model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $productId)
    {
        $product = $this->findProduct($productId);
        $category = $product->getCategory($id);
        return $this->render('view', [
            'model' => $category,
        ]);
    }

    /**
     * Creates a new Genre model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($productId)
    {
        $product = $this->findProduct($productId);
        //debug($product);die;
        $category = $product->getNewCategory();
        //$parentCategories = $product->getCategoriesFind()->all();
        $parentCategories = $product->getCategoriesFind()->indexBy('id')->asArray()->all();
        //debug($parentCategories);die;
        if ($category->load(Yii::$app->request->post()) && $category->save()) {  

            return $this->redirect(['index', 'productId' => $productId]);
        } else {
            return $this->render('create', [
                'model' => $category,
                'parentCategories' => $parentCategories,
                'productId' => $productId,
            ]);
        }
    }

    /**
     * Updates an existing Genre model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $productId)
    {
        $product = $this->findProduct($productId);
        $category = $product->getCategory($id);
        //$parentCategories = $product->getCategoriesFind()->all();
        $parentCategories = $product->getCategoriesFind()->indexBy('id')->asArray()->all();
        if ($category->load(Yii::$app->request->post()) && $category->save()) {
            return $this->redirect(['index', 'productId' => $productId]);
        } else {
            return $this->render('update', [
                'model' => $category,
                'parentCategories' => $parentCategories,
                'productId' => $productId,
            ]);
        }
    }

    /**
     * Deletes an existing Genre model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $productId)
    {
        $product = $this->findProduct($productId);
        $category = $product->getCategory($id);
        
        
        $category->delete();

        return $this->redirect(['index',  'productId' => $productId]);
    }

    /**
     * Finds the Genre model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Genre the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProduct($productId)
    {
        if (($product = Product::findOne($productId)) !== null) {
            return $product;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

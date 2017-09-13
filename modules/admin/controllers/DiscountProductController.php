<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\DiscountProduct;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Discount;
use app\modules\admin\models\Product;
/**
 * DiscountProductController implements the CRUD actions for DiscountProduct model.
 */
class DiscountProductController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DiscountProduct models.
     * @return mixed
     */
    public function actionIndex($discountId)
    {
        $discountProducts = DiscountProduct::find()->where(['discount_id' => $discountId])->all();
        //debug($discountProducts);die;
        $dataProvider = new ActiveDataProvider([
            'query' => DiscountProduct::find()->where(['discount_id' => $discountId]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'discountId' => $discountId,
        ]);
    }

    /**
     * Displays a single DiscountProduct model.
     * @param integer $product_id
     * @param integer $category_id
     * @param integer $product_unit_id
     * @return mixed
     */
    public function actionView($product_id, $category_id, $product_unit_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($product_id, $category_id, $product_unit_id),
        ]);
    }

    /**
     * Creates a new DiscountProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($discountId)
    {
        $model = new DiscountProduct();
        $discount = $this->findDiscount($discountId);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->product_unit_id && $model->category_id && $model->product_id){
                $product = Product::findOne($model->product_id);
                $productUnit = $product->getProductUnit($model->product_unit_id);
                $productUnit->discount_id = $model->discount_id;
                $productUnit->save();
                $model->save();
            }elseif ($model->category_id && $model->product_id) {
                $product = Product::findOne($model->product_id);
                //Получаем экземпляры продукта по заданной категории, у которых нет скидки
                $productUnits = $product->getProductUnitsFind()->where(['parent_id' => $model->category_id, 'discount_id' => '0'])->all();
                //debug($productUnits);die;
                foreach ($productUnits as $productUnit){
                    $modelA = new DiscountProduct();
                    $modelA->load(Yii::$app->request->post());
                    $productUnit->discount_id = $modelA->discount_id;
                    $productUnit->save();
                    $modelA->product_unit_id = $productUnit->id;
                    $modelA->save();
                }
                //debug($productUnits);die;
            }elseif($model->product_id){
                $product = Product::findOne($model->product_id);
                $productUnits = $product->getProductUnitsFind()->where(['discount_id' => '0'])->all();;
                foreach ($productUnits as $productUnit){
                    $modelB = new DiscountProduct();
                    $modelB->load(Yii::$app->request->post());
                    $productUnit->discount_id = $modelB->discount_id;
                    $productUnit->save();
                    $modelB->product_unit_id = $productUnit->id;
                    $modelB->category_id = $productUnit->parent_id;
                    $modelB->save();
                }
            }else{
                
            }
            return $this->redirect(['index', 'discountId' => $discountId]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'discount' => $discount,
                'discountId' => $discountId
            ]);
        }
    }

    /**
     * Updates an existing DiscountProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $product_id
     * @param integer $category_id
     * @param integer $product_unit_id
     * @return mixed
     */
    public function actionUpdate($product_id, $category_id, $product_unit_id)
    {
        $model = $this->findModel($product_id, $category_id, $product_unit_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'product_id' => $model->product_id, 'category_id' => $model->category_id, 'product_unit_id' => $model->product_unit_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DiscountProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $product_id
     * @param integer $category_id
     * @param integer $product_unit_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $discontProduct = DiscountProduct::findOne($id);
        $discountId = $discontProduct->discount_id;
        $productId = $discontProduct->product_id;
        $productUnitId = $discontProduct->product_unit_id;
        $product = Product::findOne($productId);
        $productUnit = $product->getProductUnit($productUnitId);
        $productUnit->discount_id = 0;
        $productUnit->save();
        $discontProduct->delete();
        return $this->redirect(['index', 'discountId' => $discountId]);
    }

    /**
     * Finds the DiscountProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $product_id
     * @param integer $category_id
     * @param integer $product_unit_id
     * @return DiscountProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id, $category_id, $product_unit_id)
    {
        if (($model = DiscountProduct::findOne(['product_id' => $product_id, 'category_id' => $category_id, 'product_unit_id' => $product_unit_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findDiscount($id)
    {
        if (($model = Discount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Данной скидки не существует.');
        }
    }
}

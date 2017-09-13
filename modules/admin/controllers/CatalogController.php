<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Catalog;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Product;
/**
 * CatalogController implements the CRUD actions for Catalog model.
 */
class CatalogController extends Controller
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
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Catalog::find()->orderBy('name'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catalog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Catalog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $catalogNameTable = 'catalog_' . $model->product . '_' . $model->alias;
            Yii::$app->db
                    ->createCommand(
                        'CREATE TABLE IF NOT EXISTS `' . $catalogNameTable . '` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(50) NOT NULL,
                            PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;')
                    ->execute();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Catalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Catalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //Получаем список Продуктов
        $products = Product::find()->all();
        $result = '';
        //Для каждого Продукта находим свойства связанные с данным Справочником
        foreach ($products as $product){
            $properties = $product->getPropertiesFind()->where(['type_id' => '4', 'value' => $id])->all();
            
            if (count($properties) > 0){
                $result .= '<b>Продукт:</b> ' . $product->name . '<br/>';
                foreach ($properties as $property){
                    $result .= '<b>    - Свойство:</b> ' . $property->name . '<br/>';
                }
            }
        }

        if ($result){
            $result = 'Удаление данного справочника не возможно, т.к. с ним связаны следующие продукты и свойства: <br/>' . $result;
            Yii::$app->session->setFlash('danger', $result);
            return $this->redirect(['index']);
        }
        
        $model = $this->findModel($id);
        
        $catalogNameTable = 'catalog_' . $model->product . '_' . $model->alias;
        $model->delete();
        Yii::$app->db->createCommand()->dropTable($catalogNameTable)->execute();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }
}

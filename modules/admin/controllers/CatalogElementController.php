<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Catalog;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class CatalogElementController extends Controller
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
    public function actionIndex()
    {
        //$properties = Product::findOne($id)->getProperties();
        $catalogId = Yii::$app->request->get('catalogId');
        $catalog = $this->findCatalog($catalogId);
        $dataProvider = new ActiveDataProvider([
            'query' => $catalog->getElementsFind()->orderBy('title'),
        ]);
        return $this->render('index', [
            'catalogId' => $catalogId,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id, $catalogId)
    {
        $catalog = $this->findCatalog($catalogId);
        $element = $this->getElement($id, $catalog);

        return $this->render('view', [
            'model' => $element,
            'catalogId' => $catalogId
        ]);
    }

    public function actionCreate($catalogId)
    {
        $catalog = $this->findCatalog($catalogId);
        
        $element = $catalog->getNewElement();

        if ($element->load(Yii::$app->request->post()) && $element->save()) {
            //return $this->redirect(['view', 'id' => $element->id, 'catalogId' => $catalogId]);
            return $this->redirect(['index',  'catalogId' => $catalogId]);
        } else {
            return $this->render('create', [
                'model' => $element,
                'catalogId' => $catalogId
            ]);
        }
    }

    public function actionUpdate($id, $catalogId)
    {
        $catalog = $this->findCatalog($catalogId);
        $element = $this->getElement($id, $catalog);
        
        if ($element->load(Yii::$app->request->post()) && $element->save()) {
            //return $this->redirect(['view', 'id' => $element->id, 'catalogId' => $catalogId]);
            return $this->redirect(['index',  'catalogId' => $catalogId]);
        } else {
            return $this->render('update', [
                'model' => $element,
                'catalogId' => $catalogId
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $catalogId)
    {
        $catalog = $this->findCatalog($catalogId);
        $element = $catalog->getElement($id);
        
        
        $element->delete();

        return $this->redirect(['index',  'id' => $catalogId]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCatalog($catalogId)
    {
        if (($catalog = Catalog::findOne($catalogId)) !== null) {
            return $catalog;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }
    
    protected function getElement($elementId, $catalog)
    {
        if (($element = $catalog->getElement($elementId)) !== null) {
            return $element;
        } else {
            throw new NotFoundHttpException('Данного элемента не существует.');
        }
    }
}

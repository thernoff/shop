<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use app\modules\admin\models\ProductUnit;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $product = $this->findModel($id);
        return $this->render('view', [
            'model' => $product,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $productNameTable = 'product_' . $model->alias;
            Yii::$app->db
                    ->createCommand(
                        'CREATE TABLE IF NOT EXISTS `' . $productNameTable . '` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `title` varchar(255) NOT NULL,
                        `parent_id` int(11) NOT NULL DEFAULT \'0\',
                        `is_new` tinyint(4) NOT NULL DEFAULT \'1\',
                        `is_popular` tinyint(4) NOT NULL DEFAULT \'0\',
                        `is_recomend` int(11) NOT NULL DEFAULT \'0\',
                        `discount_id` int(11) NOT NULL DEFAULT \'0\',
                        `price` int(11) NOT NULL,
                        `status` tinyint(4) NOT NULL DEFAULT \'1\',
                        `title_image` varchar(255) NOT NULL DEFAULT \'no_image.jpg\',
                        `description` text DEFAULT NULL,
                        `keywords` varchar(255) DEFAULT NULL,
                        `short_description` varchar(512) DEFAULT NULL,
                        `count` int(11) NOT NULL,
                        PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;')
                    ->execute();
            
            $productCategoryTable = 'product_' . $model->alias . '_category';
            Yii::$app->db
                    ->createCommand('CREATE TABLE IF NOT EXISTS `' . $productCategoryTable . '` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `parent_id` int(11) NOT NULL DEFAULT \'0\',
                        `name` varchar(255) NOT NULL,
                        `alias` varchar(255) DEFAULT NULL,
                        `keywords` varchar(255) DEFAULT NULL,
                        `description` varchar(255) DEFAULT NULL,
                        `status` tinyint(4) NOT NULL,
                        PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;')
                    ->execute();
            
            $productPropertyTable = 'product_' . $model->alias . '_property';

            
            Yii::$app->db
                    ->createCommand()
                    ->createTable($productPropertyTable, [
                        'id' => 'pk',
                        'name' => 'string NOT NULL',
                        'alias' => 'string NOT NULL',
                        'type_id' => 'int(5) NOT NULL DEFAULT \'1\'',
                        'value' => 'string(25) NOT NULL',
                        'required' => 'enum("1","0") NOT NULL DEFAULT \'1\'',
                        'visible' => 'enum("1","0") NOT NULL DEFAULT \'1\'',
                        'basic' => 'enum("1","0") NOT NULL DEFAULT \'1\'',
                        ])
                    ->execute();
            
            Yii::$app->db
                    ->createCommand("INSERT INTO `" . $productPropertyTable . "` (`id`, `name`, `alias`, `type_id`, `value`, `required`, `visible`, `basic`) VALUES
                        (1, 'Название', 'title', '1', '255', '1', '1', '1'),
                        (2, 'Категория', 'parent_id', '7', '" . $productCategoryTable . "', '0', '1', '1'),
                        (3, 'Новинка', 'is_new', '3', '1', '0', '1', '1'),
                        (4, 'Популярное', 'is_popular', '3', '0', '0', '1', '1'),
                        (5, 'Рекомендуемое', 'is_recomend', '3', '0', '0', '1', '1'),
                        (6, 'Скидка', 'discount_id', '2', '0', '0', '1', '1'),
                        (7, 'Цена', 'price', '2', '0', '1', '1', '1'),
                        (8, 'Статус', 'status', '3', '1', '0', '1', '1'),
                        (9, 'Главное изображение', 'title_image', '6', 'no_image.jpg', '0', '1', '1'),
                        (10, 'Описание', 'description', '1', '512', '0', '1', '1'),
                        (11, 'Ключевые слова', 'keywords', '1', '100', '0', '1', '1'),
                        (12, 'Краткое описание', 'short_description', '1', '255', '0', '1', '1'),
                        (13, 'Количество товара', 'count', '2', '10', '0', '1', '1');")
                    ->execute();
            
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
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
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $product = $this->findModel($id);
        $productNameTable = 'product_' . $product->alias;
        $productCategoryTable = 'product_' . $product->alias . '_category';
        $productPropertyTable = 'product_' . $product->alias . '_property';
        
        Yii::$app->db->createCommand()->dropTable($productNameTable)->execute();
        Yii::$app->db->createCommand()->dropTable($productCategoryTable)->execute();
        Yii::$app->db->createCommand()->dropTable($productPropertyTable)->execute();
        
        $product->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Данный товар не сущестует.');
        }
    }
}

<?php

namespace app\modules\order\controllers;

use Yii;
use app\modules\order\models\Order;
use app\modules\order\models\OrderSearch;
use app\modules\product\models\Products;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionUser()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['user_id' => Yii::$app->user->id]);

        return $this->render('user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) //todo check access
    {
        $model = $this->findModel($id);
        $productModels = [];
        $quantity = [];
        $separatedOrders = explode("+", $model->order);
        foreach ($separatedOrders as $order) {
            $orderDetails = explode("-", $order);
            if ($orderDetails[0] <= 0) break;
//            echo '<p>INFO: id ' . $orderDetails[0] . '</p>';
//            echo '<p>INFO: count ' . $orderDetails[1] . '</p>';
//            echo '<p>---------</p>';
            $productModels[] = $this->findProductsModel($orderDetails[0]);
            $quantity[$orderDetails[0]] = $orderDetails[1];
        }

        return $this->render('view', [
            'model' => $model,
            'productModels' => $productModels,
            'quantity' => $quantity,
        ]);
    }

    public function actionChangeStatus($id, $status) //todo check access
    {
        $model = $this->findModel($id);
        $model->status = $status;
        if ($model->save()) {
            $this->redirect('admin');
        }
    }

    /*public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findProductsModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

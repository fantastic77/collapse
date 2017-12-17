<?php

namespace app\modules\order\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\product\models\Products;
use app\modules\user\models\UserDB;
use app\modules\order\models\Order;
use yii\web\ServerErrorHttpException;

/**
 * Default controller for the `Order` module
 */
class CartController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->cart->getCount() == 0) {
            if ( Yii::$app->request->referrer == 'http://flower-tree/web/cart') { // TODO: amend
                return $this->redirect(Yii::$app->homeUrl);
            } else {
                return $this->redirect(Yii::$app->request->referrer);
            }
//
        }

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/login']);
        }

        $positions = [];
        $photos = [];
        $models = [];
        foreach (Yii::$app->cart->positions as $position) {
            $model = Products::findOne($position->id);
            $models[$position->id] = $model;
            if (file_exists('img/products/id-' . $position->id . '-1.png')) {
                $photo = Html::img('@web/img/products/id-' . $position->id . '-1.png', ['class' => 'thumbnail img-responsive']);
            } else {
                $photo = Html::img('@web/img/products/no-image.png', ['class' => 'thumbnail img-responsive']);
            }
            $positions[] = $position;
            $photos[$position->id] = $photo;
        }

        $userModel = $this->findUser();

        return $this->render('index', [
            'positions' => $positions,
            'photos' => $photos,
            'models' => $models,
            'userModel' => $userModel,
        ]);
    }

    public function actionAddToCart($id)
    {
        $cart = Yii::$app->cart;;

        $model = Products::findOne($id);
        if ($model) {
            $cart->put($model, 1);
            return $this->redirect(Yii::$app->request->referrer);
        }
        throw new NotFoundHttpException();
    }

    public function actionChangeQuantity($id, $value)
    {
        $position = Yii::$app->cart->getPositionById($id);
        $quantity = $position->quantity + $value;
        Yii::$app->cart->update($position, $quantity);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteFromCart($id)
    {
        Yii::$app->cart->removeById($id);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMakeOrder()
    {
        // TODO: add notes
        $userModel = $this->findUser();
        $orderName = '';
        $order = '';
        if ($userModel->load(Yii::$app->request->post()) && $userModel->save()) {
            foreach (Yii::$app->cart->positions as $position) { // TODO: add transactions
                $order .= $position->id . '-' . $position->quantity . '+';
            }
            $orderModel = new Order();
            $orderModel->user_id = $userModel->id;
            $orderModel->order = $order;
            $orderModel->time = time();
            $orderModel->status = 0;
            if ($orderModel->save()) {
                Yii::$app->cart->removeAll();
                return $this->render('success', [
                    'orderId' => $orderModel->id,
                ]);
            } else {
                throw new ServerErrorHttpException(\Yii::t('app', 'server error'));
            }
        }
    }

    protected function findUser()
    {
        if (($userModel = UserDB::findOne(Yii::$app->user->id)) !== null) {
            return $userModel;
        } else {
            throw new ServerErrorHttpException('');
        }
    }


}

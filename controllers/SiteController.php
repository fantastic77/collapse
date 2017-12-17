<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\ContactForm;
use app\modules\product\models\Products;
use app\modules\product\models\ProductsSearch;
use app\modules\product\models\Category;
use yii\web\NotFoundHttpException;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $language = \Yii::$app->language;
        $loc = '';
        if ($language == 'uk') {
            $loc = 'ukr';
        } else if ($language == 'ru') {
            $loc = 'rus';
        } else if ($language == 'en') {
            $loc = 'eng';
        }

        $categories = [];
        $categoriesName = [];
        foreach (Category::find()->asArray()->indexBy('id')->all() as $item) {
            $categories[$item['id']] = $item[$loc];
            $categoriesName[$item[$loc]] = $item[$loc];
        }

        $pages = new Pagination(['totalCount' => $dataProvider->getTotalCount(), 'pageSize' => 16]);

        $models = $dataProvider->setPagination($pages);
        $models = $dataProvider->getModels();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,

            'searchModel' => $searchModel,
            'categories' => $categories,
            'categoriesName' => $categoriesName,
        ]);
    }

    /**
     * Displays a single Product.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findProduct($id);
        $images = $model->getAllPhotos();

        return $this->render('view', [
            'model' => $model,
            'images' => $images,
        ]);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProduct($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

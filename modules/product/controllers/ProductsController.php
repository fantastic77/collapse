<?php

namespace app\modules\product\controllers;

use Yii;
use app\modules\product\models\Products;
use app\modules\product\models\Category;
use app\modules\product\models\Description;
use app\modules\product\models\ProductsSearch;
use app\modules\product\models\ImageUploader;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
     * Lists all Products models.
     * @return mixed
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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'categoriesName' => $categoriesName,
            'loc' => $loc,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->redirect('/web/site/'. $id);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        $uploadModel = new ImageUploader();
        $modelDescription = new Description();
        $request = Yii::$app->request->post('Products');

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadModel->uploadedFiles = UploadedFile::getInstances($uploadModel, 'uploadedFiles');
            $modelDescription->productId = $model->id;
            $modelDescription->ukr_Name = $request['descriptionUkr_Name'];
            $modelDescription->rus_Name = $request['descriptionRus_Name'];
            $modelDescription->eng_Name = $request['descriptionEng_Name'];
            $modelDescription->ukr_Description = $request['descriptionUkr_Description'];
            $modelDescription->rus_Description = $request['descriptionRus_Description'];
            $modelDescription->eng_Description = $request['descriptionEng_Description'];

            if ($uploadModel->upload($model->id) && $modelDescription->save()) {
                return $this->redirect('index');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'uploadModel' => $uploadModel,
                'categories' => $categories
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadModel = new ImageUploader();
        $request = Yii::$app->request->post('Products');
        $modelDescription = $this->findDescriptionModel($model->descriptionId);

        if ($modelDescription == null) {
            $modelDescription = new Description();
        }

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

        $images = $uploadModel->getProductImages($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadModel->uploadedFiles = UploadedFile::getInstances($uploadModel, 'uploadedFiles');
            $modelDescription->productId = $model->id;
            $modelDescription->ukr_Name = $request['descriptionUkr_Name'];
            $modelDescription->rus_Name = $request['descriptionRus_Name'];
            $modelDescription->eng_Name = $request['descriptionEng_Name'];
            $modelDescription->ukr_Description = $request['descriptionUkr_Description'];
            $modelDescription->rus_Description = $request['descriptionRus_Description'];
            $modelDescription->eng_Description = $request['descriptionEng_Description'];
            if ($uploadModel->upload($id) && $modelDescription->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'uploadModel' => $uploadModel,
                'categories' => $categories,
                'images'=> $images,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $modelDescription = $this->findDescriptionModel($model->descriptionId);
        if ($modelDescription != null) $modelDescription->delete();
        $model->delete();
        $modelImage = new ImageUploader();
        $modelImage->deleteAllImages($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findDescriptionModel($id)
    {
        if (($model = Description::findOne($id)) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    public function actionDeleteimg()
    {
        $imageName = Yii::$app->request->post('imageName');
        $model = new ImageUploader();
        $model->deleteImage($imageName);
    }

    public function actionSetimg()
    {
        $imageName = Yii::$app->request->post('imageName');
        $model = new ImageUploader();
        $model->setMain($imageName);
    }
}

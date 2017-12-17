<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\product\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
Yii::setAlias('@category', '/product/category');

$language = \Yii::$app->language;
if ($language == 'uk') {
    $categoryNameLoc = 'categoryUkr';
    $productNameLoc = 'descriptionUkr_Name';
} else if ($language == 'ru') {
    $categoryName = 'categoryRus';
    $productNameLoc = 'descriptionRus_Name';
} else if ($language == 'en') {
    $categoryName = 'categoryEng';
    $productNameLoc = 'descriptionEng_Name';
}
?>
<div class="products-index">
    <div class="form-group">
        <?= Html::a(\Yii::t('product', 'Add new Products'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(\Yii::t('product', 'Edit categories'), ['@category'], ['class' => 'btn btn-success']) ?>
    </div>

    <p>
        <?= $this->render('_search', ['model' => $searchModel, 'categories' => $categories]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => \Yii::t('product', 'Photo'),
                'attribute' => 'mainPhoto',
                'format' => 'raw',
                'contentOptions' => ['style' => 'max-width: 100px;']
            ],
            [
                'label' => \Yii::t('product', 'Name'),
                'attribute' => $productNameLoc,
            ],
            [
                'label' => 'ID',
                'attribute' => 'id',
                'format' => 'raw',
                'contentOptions' => ['style' => 'max-width: 30px;']
            ],
            [
                'label' => \Yii::t('product', 'Category name'),
                'attribute' => 'categoryName',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

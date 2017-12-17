<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\product\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
Yii::setAlias('@products', '/product/products');

?>
<div class="category-index">

    <p>
        <?= Html::a(\Yii::t('product', 'Add new Category'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(\Yii::t('product', 'Edit products'), ['@products'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => \Yii::t('product', 'Name'),
                'attribute' => 'name',
            ],
            [
                'label' => \Yii::t('product', 'Name in Ukrainian'),
                'attribute' => 'ukr',
            ],
            [
                'label' => \Yii::t('product', 'Name in Russian'),
                'attribute' => 'rus',
            ],
            [
                'label' => \Yii::t('product', 'Name in English'),
                'attribute' => 'eng',
            ],


            [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>

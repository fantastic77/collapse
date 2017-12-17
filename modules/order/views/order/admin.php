<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\order\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('order', 'orders');
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php // echo Html::a('Create Order', ['create'], ['class' => 'btn btn-success']); ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => \Yii::t('user', 'username'),
                'attribute' => 'userName',
            ],
            'time:datetime', // TODO: localisation
            [
                'attribute'=>'status',
                'label' => \Yii::t('order', 'status'),
                'filter'=>["0"=>\Yii::t('order', 'status pending'),
                    "1"=>\Yii::t('order', 'status in progress'),
                    "2"=>\Yii::t('order', 'status ready'),
                    "3"=>\Yii::t('order', 'status closed')],
                'value' => 'statusName',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {delete}',
//                'buttons' => [
//                    'details' => function ($url) {
//                        return Html::a(\Yii::t('order', 'open'), $url);
//                    },
//                ],
            ],
        ],
    ]); ?>
</div>

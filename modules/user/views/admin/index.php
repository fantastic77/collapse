<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UserDBSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('user', 'Users');

?>
<div class="user-db-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'label' => \Yii::t('user', 'username'),
                'attribute' => 'username',
            ],
            [
                'label' => \Yii::t('user', 'email'),
                'attribute' => 'email',
                'format' => 'email'
            ],
            [
                'label' => \Yii::t('user', 'full name'),
                'attribute' => 'fullname',
            ],
            [
                'label' => \Yii::t('user', 'address'),
                'attribute' => 'address',
                'format' => 'ntext'
            ],
            [
                'label' => \Yii::t('user', 'phone'),
                'attribute' => 'phone',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

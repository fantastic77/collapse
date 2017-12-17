<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Products */

$this->title = \Yii::t('product', 'Update');
?>
<div class="products-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_formEdit', [
        'model' => $model,
        'uploadModel' => $uploadModel,
        'categories' => $categories,
        'images'=> $images,
    ]) ?>

</div>

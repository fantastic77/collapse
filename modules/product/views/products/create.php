<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Products */

$this->title = \Yii::t('product', 'Add');
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'uploadModel' => $uploadModel,
        'categories' => $categories
    ]) ?>

</div>

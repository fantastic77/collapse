<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserDB */

$this->title = 'Create User Db';
?>
<div class="user-db-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

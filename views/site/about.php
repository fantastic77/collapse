<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = \Yii::t('app', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="well">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
    </div>
</div>

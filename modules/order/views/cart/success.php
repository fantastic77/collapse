<?php
/**
 * Created by PhpStorm.
 * User: Delvi-U
 * Date: 12.03.2017
 * Time: 21:26
 */
// TODO: improve style
use yii\helpers\Html;

$this->title = \Yii::t('order', 'order no') . $orderId;
?>

<div class="well">
    <h1 style="text-align: center">
        <?= \Yii::t('order', 'order success') ?>
    </h1>
    <h2 style="text-align: center">
        <?= \Yii::t('order', 'order no') . $orderId ?>
    </h2>
    <h3 style="text-align: center">
        <?= Html::a(\Yii::t('app', 'Home'), ['/site/index']); ?>
    </h3>
</div>

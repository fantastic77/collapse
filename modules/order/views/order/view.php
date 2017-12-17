<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$language = \Yii::$app->language;
$totalPrice = 0;

/* @var $this yii\web\View */
/* @var $model app\modules\order\models\Order */

$this->title = \Yii::t('order', 'order no') . $model->id;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="wall">
        <table class="table">
            <tr>
                <td><?= \Yii::t('user', 'username') ?></td>
                <td><?= $model->userName ?></td>
            </tr>
            <tr>
                <td><?= \Yii::t('user', 'fullname') ?></td>
                <td><?= $model->userFullname ?></td>
            </tr>
            <tr>
                <td><?= \Yii::t('user', 'email') ?></td>
                <td><?= $model->userEmail ?></td>
            </tr>
            <tr>
                <td><?= \Yii::t('user', 'phone') ?></td>
                <td>+380<?= $model->userPhone ?></td>
            </tr>
            <tr>
                <td><?= \Yii::t('user', 'address') ?></td>
                <td><?= $model->userAddress ?></td>
            </tr>
            <tr>
                <td><?= \Yii::t('order', 'time') ?></td>
                <td><?= Yii::$app->formatter->asDatetime($model->time) ?>
                    (<?= Yii::$app->formatter->asRelativeTime($model->time) ?>)
                </td>
            </tr>
            <tr>
                <td>
                    <hr/>
                </td>
                <td>
                    <hr/>
                </td>
            </tr>

            <?php foreach ($productModels as $product):
                $totalPrice += $product->price * $quantity[$product->id];?>
                <tr>
                    <td> <?= \Yii::t('order', 'product name') ?></td>
                    <td><?php
                        if ($language == 'uk') {
                            echo $product->descriptionUkr_Name;
                        } else if ($language == 'ru') {
                            echo $product->descriptionRus_Name;
                        } else if ($language == 'en') {
                            echo $product->descriptionEng_Name;
                        }
                        ?>
                    </td>
                <tr>
                <tr>
                    <td> <?= \Yii::t('order', 'price') ?></td>
                    <td> <?= $product->price ?> </td>
                <tr>
                <tr>
                    <td> <?= \Yii::t('order', 'quantity') ?></td>
                    <td> <?= $quantity[$product->id] ?> </td>
                <tr>
                    <td>
                        <hr/>
                    </td>
                    <td>
                        <hr/>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>
                    <?= \Yii::t('order', 'total price') ?>
                </td>
                <td>
                    <?= $totalPrice ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= \Yii::t('order', 'status') ?>
                </td>
                <td>
                    <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action' => ['/order/order/change-status'], 'method' => 'get',]); // TODO: Check if secure ?>
                    <?= Html::hiddenInput('id', $model->id); ?>
                    <?= Html::dropDownList('status', $model->status,
                        ["0"=>\Yii::t('order', 'status pending'),
                            "1"=>\Yii::t('order', 'status in progress'),
                            "2"=>\Yii::t('order', 'status ready'),
                            "3"=>\Yii::t('order', 'status closed')]) ?>
                </td>
            </tr>
        </table>
        <?= Html::submitButton(\Yii::t('user', 'Change'), ['class' => 'btn btn-info btn-block']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\PasswordResetRequest */

$this->title = \Yii::t('user', 'Request password reset');
?>
<div class="site-request-password-reset">
    <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
    <?= $form->field($model, 'email')->label(\Yii::t('user', 'email')) ?>
    <?= Html::submitButton(\Yii::t('user', 'Send'), ['class' => 'btn btn-primary btn-block']) ?>
    <?php ActiveForm::end(); ?>
</div>

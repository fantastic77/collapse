<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ResetPassword */

//TODO amend style and check

$this->title = \Yii::t('user', 'Reset password');
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= \Yii::t('user', 'Please choose your new password:') ?></p>
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
    <?= $form->field($model, 'password')->passwordInput()->label(\Yii::t('user', 'password')) ?>
    <div class="form-group">
        <?= Html::submitButton(\Yii::t('user', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

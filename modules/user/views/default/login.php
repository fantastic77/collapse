<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->title = \Yii::t('user', 'sign in');
?>
<div class="site-login">
    <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <?= $form->field($model, 'username')->label(\Yii::t('user', 'username')) ?>
    <?= $form->field($model, 'password')->passwordInput()->label(\Yii::t('user', 'password')) ?>
    <?= $form->field($model, 'rememberMe')->checkbox()->label(\Yii::t('user', 'rememberMe')) ?>
    <?= Html::submitButton(\Yii::t('user', 'login'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
    <div style="color:#999;margin:1em 0">
        <?= \Yii::t('user', 'If you forgot your password you can') ?>  <?= Html::a(\Yii::t('user', 'reset it'), ['default/request-password-reset']) ?>.
        <?= \Yii::t('user', 'For new user you can') ?>  <?= Html::a(\Yii::t('user', 'sign up'), ['/signup']) ?>.
    </div>
    <?php ActiveForm::end(); ?>
</div>

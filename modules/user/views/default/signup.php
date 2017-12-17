<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = \Yii::t('user', 'sign up');
?>
<div class="site-signup">
    <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
    <?= Html::errorSummary($model) ?>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <?= $form->field($model, 'username')->label(\Yii::t('user', 'username')) ?>
    <?= $form->field($model, 'email')->label(\Yii::t('user', 'email')) ?>
    <?= $form->field($model, 'password')->passwordInput()->label(\Yii::t('user', 'password')) ?>
    <?= Html::submitButton(\Yii::t('user', 'Create account'), ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
    <?php ActiveForm::end(); ?>
</div>

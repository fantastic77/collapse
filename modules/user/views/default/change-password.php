<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = \Yii::t('user', 'Change Password');
?>
<div class="site-signup">
    <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>

    <p><?= \Yii::t('user', 'Please fill out the following fields to change password:') ?> </p>

            <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
                <?= $form->field($model, 'oldPassword')->passwordInput()->label(\Yii::t('user', 'old Password')) ?>
                <?= $form->field($model, 'newPassword')->passwordInput()->label(\Yii::t('user', 'new Password')) ?>
                <?= $form->field($model, 'retypePassword')->passwordInput()->label(\Yii::t('user', 'retype Password')) ?>
               <?= Html::submitButton(\Yii::t('user', 'Change'), ['class' => 'btn btn-primary btn-block', 'name' => 'change-button']) ?>
            <?php ActiveForm::end(); ?>
</div>

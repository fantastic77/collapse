<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserDB */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-db-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(\Yii::t('user', 'username')) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true])->label(\Yii::t('user', 'full name')) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(\Yii::t('user', 'email')) ?>

    <?= $form->field($model, 'phone')->textInput()->label(\Yii::t('user', 'phone')) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6])->label(\Yii::t('user', 'address')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? \Yii::t('user', 'sign up') : \Yii::t('user', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

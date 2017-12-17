<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserDB */

$this->title = $model->username;
?>
<div class="user-profile-edit">

    <h2><?= Html::encode($this->title) ?></h2>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fullname')->textInput(['maxlength' => true])->label(\Yii::t('user', 'full name')) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(\Yii::t('user', 'email')) ?>
        <?= $form->field($model, 'phone',
        ['template'=>'<label for="phone">' . \Yii::t('user', 'phone') . '</label><div class="input-group"><span class="input-group-addon">+380</span>{input}</div>{error}'])->
            textInput() ?>
        <?= $form->field($model, 'address')->textarea(['rows' => 3])->label(\Yii::t('user', 'address')) ?>

    <div class="form-group">
        <?= Html::submitButton(\Yii::t('user', 'save changes'), ['class' => 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

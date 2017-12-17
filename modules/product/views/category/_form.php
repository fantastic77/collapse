<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(\Yii::t('product', 'Name')) ?>
    <?= $form->field($model, 'ukr')->textInput(['maxlength' => true])->label(\Yii::t('product', 'Name in Ukrainian')) ?>
    <?= $form->field($model, 'rus')->textInput(['maxlength' => true])->label(\Yii::t('product', 'Name in Russian')) ?>
    <?= $form->field($model, 'eng')->textInput(['maxlength' => true])->label(\Yii::t('product', 'Name in English')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? \Yii::t('product', 'Add') : \Yii::t('product', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

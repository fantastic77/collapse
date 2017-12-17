<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="products-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'categoryId')->dropDownList($categories, ['prompt' =>\Yii::t('product', 'Please select')])->label(\Yii::t('product', 'Category name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(\Yii::t('product', 'Name')) ?>
    <?= $form->field($model, 'descriptionUkr_Name')->textInput(['maxlength' => true])->label(\Yii::t('product', 'Name in Ukrainian')) ?>
    <?= $form->field($model, 'descriptionRus_Name')->textInput(['maxlength' => true])->label(\Yii::t('product', 'Name in Russian')) ?>
    <?= $form->field($model, 'descriptionEng_Name')->textInput(['maxlength' => true])->label(\Yii::t('product', 'Name in English')) ?>

    <?= $form->field($uploadModel, 'uploadedFiles[]')->fileInput(['multiple' => true, 'class' => 'image-input'])->label(\Yii::t('product', 'Photo')) ?>

    <?= $form->field($model, 'descriptionUkr_Description')->textarea(['rows' => 5])->label(\Yii::t('product', 'Description in Ukrainian')) ?>
    <?= $form->field($model, 'descriptionRus_Description')->textarea(['rows' => 5])->label(\Yii::t('product', 'Description in Russian')) ?>
    <?= $form->field($model, 'descriptionEng_Description')->textarea(['rows' => 5])->label(\Yii::t('product', 'Description in English')) ?>

    <?= $form->field($model, 'price')->textInput()->label(\Yii::t('product', 'Price')) ?>

    <div class="form-group">
        <?= Html::submitButton(\Yii::t('product', 'Add'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

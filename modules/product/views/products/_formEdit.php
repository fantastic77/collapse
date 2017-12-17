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

    <h2>Images</h2>

    <!-- Image section Start -->

    <div class="container">
        <?php
        $imgCount = 0;
        foreach ($images as $img) {
            $imgCount++;
            echo '<div class="photo-container-small"><a title="' . 'id-' . $model->id . '-' . $imgCount . '.png' . '" href="#">' . $img . '</a></div>';
        }
        ?>
    </div>
    <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">×</button>
                    <h3 class="modal-title">Heading</h3>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success main-image">Choose as main</button>
                    <button class="btn btn-danger delete-image">Delete</button>
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        $imageScript = <<< JS
        $('.img-modal').click(function(){
            $('.modal-body').empty();
  	        var title = $(this).parent('a').attr("title");
  	        $('.modal-title').html(title);
  	        $($(this).parents('div').html()).appendTo('.modal-body');
  	        $('#myModal').modal({show:true});
        });
        $('.delete-image').click(function(event){
            event.preventDefault();
  	        var image = $('.modal-title').html();
  	        $.post( "deleteimg", { imageName : image })
              .done(function( data ) {
                location.reload();
              });
        });
        $('.main-image').click(function(event){
            event.preventDefault();
  	        var image = $('.modal-title').html();
  	        $.post( "setimg", { imageName : image })
              .done(function( data ) {
                location.reload();
              });
        });
JS;
        $this->registerJs($imageScript, yii\web\View::POS_READY);
    ?>
    <!-- Image section End -->

    <?= $form->field($uploadModel, 'uploadedFiles[]')->fileInput(['multiple' => true, 'class' => 'upload, image-input'])->label(\Yii::t('product', 'Add')) ?>

    <?= $form->field($model, 'descriptionUkr_Description')->textarea(['rows' => 5])->label(\Yii::t('product', 'Description in Ukrainian')) ?>
    <?= $form->field($model, 'descriptionRus_Description')->textarea(['rows' => 5])->label(\Yii::t('product', 'Description in Russian')) ?>
    <?= $form->field($model, 'descriptionEng_Description')->textarea(['rows' => 5])->label(\Yii::t('product', 'Description in English')) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(\Yii::t('product', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

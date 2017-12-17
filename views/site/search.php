<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\slider\Slider;
$language = \Yii::$app->language;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search form-group">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    echo Html::submitButton(\Yii::t('app', 'All categories'), ['class' => 'btn btn-default btn-block']);

    foreach ($categories as $categoryId => $categoryName) {
        echo Html::submitButton($categoryName, ['name' => 'ProductsSearch[categoryId]', 'value' => $categoryId,
            'class' => 'btn btn-default btn-block']);
    }
    echo '<br/>';
    echo $form->field($model, 'name')->label(\Yii::t('app', 'search name'));;

    echo
        $form->field($model, 'priceRange')->widget(Slider::classname(), [
        'sliderColor'=>Slider::TYPE_GREY,
        'handleColor'=>Slider::TYPE_PRIMARY,
        'options' => [
            'style'=>'position: relative;'
        ],
        'pluginOptions'=>[
            'width'=>'50px',
            'min'=>10,
            'max'=>1000,
            'step'=>10,
            'range'=>true,
            'tooltip_split'=>'true',
            'precision'=>2,
        ],
    ])->label(\Yii::t('app', 'price'));

    echo Html::submitButton(\Yii::t('app', 'search'), ['class' => 'btn btn-default btn-block']);

    ActiveForm::end(); ?>

</div>

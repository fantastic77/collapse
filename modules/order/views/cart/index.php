<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$language = \Yii::$app->language;
$product_name = '';
$url = '';
$this->title = \Yii::t('order', 'cart');

// TODO: fix for mobile layout
?>
<div class="Order-default-index">
    <div class="row">
        <div class="col-xs-6">
            <?php
            foreach ($positions as $position):
                $model = $models[$position->id];
                $url = Url::to(['/site/' . $position->id]);
                ?>
                <div class="well">
                    <div class="photo-container">
                        <a href="<?= $url ?>"><?= $photos[$position->id] ?></a>
                    </div>
                    <div class="cart-description">
                        <?php
                        if ($language == 'uk') $product_name = Html::encode($model->descriptionUkr_Name);
                        else if ($language == 'ru') $product_name = Html::encode($model->descriptionRus_Name);
                        else if ($language == 'en') $product_name = Html::encode($model->descriptionEng_Name);
                        ?>

                        <a href="<?= $url ?>" style="color: #1c1c1c; text-decoration: none;"><h3><strong><?= $product_name ?></strong></h3></a>
                        <p> <h4><?= \Yii::t('order', 'price') ?> <?= $position->price ?> <?=\Yii::t('app', 'UAH') ?></h4></p>

                        <div class="btn-group count-block" role="group" aria-label="...">
                            <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action' => ['/order/cart/change-quantity'], 'method' => 'get',]); ?>
                            <?= Html::hiddenInput('id', $position->id); ?>
                            <?= Html::submitButton('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>', ['name' => 'value', 'value' => -1, 'class' => 'btn btn-default']); ?>
                            <?= Html::button(\Yii::t('order', 'quantity') . ' : ' . $position->quantity, ['class' => 'btn btn-default disabled ']) ?>
                            <?= Html::submitButton('<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', ['name' => 'value', 'value' => 1,  'class' => 'btn btn-default']); ?>
                            <?php ActiveForm::end();
                            // TODO: block btn if count is 1
                            ?>
                        </div>
                        <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action'=>Url::toRoute(['/order/cart/delete-from-cart','id'=>$position->id])]); ?>
                        <?= Html::submitButton(\Yii::t('order', 'delete'), ['class' => 'btn btn-danger btn-sm delete-btn']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>

        <div class="col-xs-6">
            <div class="well">
                <?php
                    $totalPrice = 0;
                    foreach ($positions as $position):
                        $totalPrice+= $position->price * $position->quantity;
                    endforeach;
                ?>

                <h3><?= \Yii::t('order', 'total price') ?>: <?= $totalPrice ?> <?=\Yii::t('app', 'UAH') ?></h3>

                <div class="user-profile-edit">

                    <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action' => ['/order/cart/make-order'], 'method' => 'post',]); ?>

                    <?= $form->field($userModel, 'fullname')->textInput(['maxlength' => true])->label(\Yii::t('user', 'full name')) ?>
                    <?= $form->field($userModel, 'email')->textInput(['maxlength' => true])->label(\Yii::t('user', 'email')) ?>
                    <?= $form->field($userModel, 'phone',
                        ['template'=>'<label for="phone">' . \Yii::t('user', 'phone') . '</label><div class="input-group"><span class="input-group-addon">+380</span>{input}</div>{error}'])->
                    textInput() ?>
                    <?= $form->field($userModel, 'address')->textarea(['rows' => 3])->label(\Yii::t('user', 'address')) ?>

                    <div class="form-group">
                        <?= Html::submitButton(\Yii::t('order', 'make order'), ['class' => 'btn btn-success btn-block']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

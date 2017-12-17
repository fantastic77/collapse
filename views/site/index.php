<?php

use app\modules\order\widgets\CartWidget;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
$language = \Yii::$app->language;
$this->title = 'Flowertree';
?>
<div class="site-index">
    <div class="container">
        <div class="col-sm-2">
            <?= $this->render('search', ['model' => $searchModel, 'categories' => $categories]) ?>
        </div>
        <div class="col-sm-10">
            <?php foreach ($models as $model) {
                $url = Url::to(['site/view', 'id' => $model->id]);
                ?>

                <a href="<?= $url ?>" title="<?= $model->name?>" style="color: #2A2A2A">
                    <div class="product-container">
                        <div class="product-photo"><?= $model->MainPhotoIndex ?></div>
                        <div class="product-description">
                            <h4 style="text-align: center"><?php
                                if ($language == 'uk') {
                                    echo $model->descriptionUkr_Name;
                                } else if ($language == 'ru') {
                                    echo $model->descriptionRus_Name;
                                } else if ($language == 'en') {
                                    echo $model->descriptionEng_Name;
                                }
                                ?> </h4>
                            <span class="glyphicon glyphicon-comment product-comment" aria-hidden="true"> 0 </span>
                            <span class="glyphicon glyphicon-tag product-price" aria-hidden="true"> <?= $model->price ?> <?= \Yii::t('app', 'UAH') ?> </span>
                        </div>
                    </div>
                </a>
             <?php } ?>

        </div>
        <div class="container" style="margin: auto; width: 300px">
            <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>
    </div>

</div>
<?= CartWidget::widget() ?>

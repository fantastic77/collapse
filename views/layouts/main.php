<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
Yii::setAlias('@logout', 'user/default/logout');
AppAsset::register($this);

$dropdownMenu = [];
if (\Yii::$app->user->can('adminPermission')) {
    $dropdownMenu = [
        '<li class="divider"></li>',
        '<li class="dropdown-header">'. \Yii::t('app', 'Admin') .'</li>',
        ['label' => \Yii::t('app', 'Manage Products') ,  'url' => '/web/product/products'],
        ['label' => \Yii::t('app', 'Manage Comments') ,  'url' => '/web/comments'],
        ['label' => \Yii::t('app', 'Manage Users'),      'url' => '/web/user/admin'],
        ['label' => \Yii::t('app', 'Manage Orders'),     'url' => '/web/orders'],
        ['label' => \Yii::t('app', 'Change password'),   'url' => '/web/user/default/change-password'],
        ['label' => \Yii::t('app', 'Logout'),    'url' => ['/logout'], ['data' => ['method' => 'post']]],
    ];
} else {
    $dropdownMenu = [
        ['label' => \Yii::t('app', 'Profile'),            'url' => '/web/user'],
        ['label' => \Yii::t('app', 'Orders'),             'url' => '/web/order'],
        ['label' => \Yii::t('app', 'Change password'),    'url' => '/web/user/default/change-password'],
        ['label' => \Yii::t('app', 'Logout'),             'url' => ['/logout'], ['data' => ['method' => 'post']]],
    ];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Flowertree',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-default',
        ],
    ]); ?>
    <div class="navbar-text pull-right">
        <?=
        \lajax\languagepicker\widgets\LanguagePicker::widget([
            'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
            'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_LARGE
        ]);
        ?>
    </div>
    <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => \Yii::t('app', 'Home'),    'url' => ['/site/index']],
            ['label' => \Yii::t('app', 'About'),   'url' => ['/site/about']],
            ['label' => \Yii::t('app', 'Contact'), 'url' => ['/site/contact']],

            Yii::$app->user->isGuest ? (
                ['label' => \Yii::t('app', 'Sign in'), 'url' => ['/login']]
            ) : (
            [
                'label' => Yii::$app->user->identity->username,
                'items' => $dropdownMenu,
            ]
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="padding-top: 0">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Flowertree <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

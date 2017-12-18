<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Carousel;





$carousel = [
[
'content' => '<img src="/web/img/IMG_9802.JPG"/>',
'caption' => '<h1>New Collection</h1><p></p><p><a href="http://streetwear/web/" class="btn btn-default">Take a look <span class="glyphicon glyphicon-chevron-right"></a></p>',
'options' => []
],
    [
        'content' => '<img src="/web/img/IMG_9815.JPG"/>',
        'caption' => '<h1>New Collection</h1><p></p><p><a href="http://streetwear/web/" class="btn btn-default">Take a look <span class="glyphicon glyphicon-chevron-right"></a></p>',
        'options' => []
    ],

];


echo Carousel::widget([
'items' => $carousel,
'options' => [
'style' => [
'width: 100px; height: 100%;'
],
['class' => 'carousel slide', 'data-interval' => '12000'],
],
'controls' => [
'<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
'<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
]
]);
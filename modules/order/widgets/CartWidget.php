<?php
/**
 * Created by PhpStorm.
 * User: Delvi-U
 * Date: 13.03.2017
 * Time: 23:29
 */

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class CartWidget extends Widget
{
    public $link;
    public $url;
    public $count;

    public function init()
    {
        parent::init();
        $this->url = Url::to(['/cart']);
        $this->count = Yii::$app->cart->getCount();

        if ($this->count == 0) {
            $this->link =
                '<div class="cart-widget-block" style="">
                    <a href=" ' . $this->url . '">
                        ' . Html::img("@web/img/order/shopping-cart.png", ["class" => "img-responsive"]) . '
                    </a>
                </div>';
        } else {
            $this->link =
                '<div class="cart-widget-block">
                    <a href=" ' . $this->url . '">
                        ' . Html::img("@web/img/order/shopping-cart-full.png", ["class" => "img-responsive"]) .
                        '<span class="cart-widget-count">'. $this->count .'</span>' .
                    '</a>
                </div>';
        }

    }

    public function run()
    {
        return $this->link;
//        return Html::encode($this->message);
    }
}

class HelloWidget
{
    public $message;


}
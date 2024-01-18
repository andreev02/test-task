<?php

namespace orders\components;

use yii\base\Widget;
use yii\helpers\Html;

class OrderGridWidget extends Widget
{
    public $orders;
    public $services;
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('order_grid', ['orders' => $this->orders, 'services' => $this->services]);
    }
}
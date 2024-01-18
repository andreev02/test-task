<?php

namespace orders\components;

use yii\base\Widget;
use yii\helpers\Html;

class ServiceDropdownWidget extends Widget
{
    public $services;
    public $totalCounter;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('service_dropdown', ['services' => $this->services, 'totalCounter' => $this->totalCounter]);
    }
}
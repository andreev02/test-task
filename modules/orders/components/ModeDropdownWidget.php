<?php

namespace orders\components;

use yii\base\Widget;
use yii\helpers\Html;

class ModeDropdownWidget extends Widget
{
    public $items;
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('mode_dropdown', ['items' => $this->items]);
    }
}
<?php

namespace orders\components;

use yii\base\Widget;
use yii\helpers\Html;

class NavBarWidget extends Widget
{
    public $items;
    public $searchModel;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('navbar', ['headers' => $this->items, 'searchModel' => $this->searchModel]);
    }
}
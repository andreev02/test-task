<?php

namespace app\modules\order;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        \Yii::configure($this, require __DIR__ . '/config.php');
    }
}
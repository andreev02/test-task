<?php

namespace app\modules\orders\models;

use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
    public $counter = 0;

    public static function tableName()
    {
        return '{{services}}';
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['service_id' => 'id']);
    }
}
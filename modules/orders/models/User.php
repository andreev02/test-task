<?php

namespace app\modules\orders\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{users}}';
    }

    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }
}
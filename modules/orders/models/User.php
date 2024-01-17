<?php

namespace orders\models;

use yii\db\ActiveRecord;

/**
 * User
 */
class User extends ActiveRecord
{    
    /**
     * tableName
     *
     * @return void
     */
    public static function tableName()
    {
        return '{{users}}';
    }
    
    /**
     * getOrders
     *
     * @return void
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }
    
    /**
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
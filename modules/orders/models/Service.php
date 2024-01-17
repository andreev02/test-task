<?php

namespace orders\models;

use yii\db\ActiveRecord;

/**
 * Service
 */
class Service extends ActiveRecord
{
    public $counter = 0;
    
    /**
     * tableName
     *
     * @return void
     */
    public static function tableName()
    {
        return '{{services}}';
    }
    
    /**
     * getOrders
     *
     * @return void
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['service_id' => 'id']);
    }
}
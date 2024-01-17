<?php

namespace orders\models;

use yii\db\ActiveRecord;

/**
 * Order
 */
class Order extends ActiveRecord
{
    const STATUS_PENDING    = 0;
    const STATUS_INPROGRESS = 1;
    const STATUS_COMPLETED  = 2;
    const STATUS_CANCELED   = 3;
    const STATUS_ERROR      = 4;
    
    /**
     * tableName
     *
     * @return void
     */
    public static function tableName()
    {
        return '{{orders}}';
    }
    
    /**
     * getUser
     *
     * @return void
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    
    /**
     * getService
     *
     * @return void
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }
    
    /**
     * getStatusName
     *
     * @return string
     */
    public function getStatusName()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_INPROGRESS => 'In progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELED => 'Canceled',
            default => 'Error',
        };
    }
    
    /**
     * getModeName
     *
     * @return string
     */
    public function getModeName()
    {
        return $this->mode ? 'Auto' : 'Manual';
    }
}
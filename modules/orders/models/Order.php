<?php

namespace app\modules\orders\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    const STATUS_PENDING    = 0;
    const STATUS_INPROGRESS = 1;
    const STATUS_COMPLETED  = 2;
    const STATUS_CANCELED   = 3;
    const STATUS_ERROR      = 4;

    public static function tableName()
    {
        return '{{orders}}';
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

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

    public function getModeName()
    {
        return $this->mode ? 'Auto' : 'Manual';
    }
}
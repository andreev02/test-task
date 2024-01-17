<?php

namespace orders\models;

use Yii;
use yii\db\ActiveRecord;
use orders\models\interfaces\ConvertInterface;

/**
 * Order
 */
class Order extends ActiveRecord implements ConvertInterface
{
    const STATUS_PENDING    = 0;
    const STATUS_INPROGRESS = 1;
    const STATUS_COMPLETED  = 2;
    const STATUS_CANCELED   = 3;
    const STATUS_ERROR      = 4;
   
    public $username = null;
    public $serviceName;
    
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
    
    /**
     * ConvertToCvs
     *
     * @return string
     */
    public function convertToCsv()
    {
        $username = $this->username ?? $this->user->name;
        $serviceName = $this->serviceName ?? $this->service->name;

        $date = Yii::$app->formatter->asDate($this->created_at, 'yyyy-mm-dd hh-mm-ss');

        return "{$this->id},{$username},{$this->link},{$this->quantity},{$serviceName},{$this->statusName},{$this->modeName},{$date}";
    }
}
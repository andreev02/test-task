<?php

namespace orders\services;

use yii\data\Pagination;
use orders\models\search\OrderSearch;

/**
 * OrderService
 */
class OrderService
{
    public $pageSize;
    public $pagination;
    public $searchModel;

    /**
     * getPaginatedOrders
     *
     * @param  mixed $params
     * @param  mixed $pageSize
     * @param  mixed $pages
     * @param  mixed $searchModel
     * @return array
     */
    public function getPaginatedOrders($params, $pageSize = null)
    {
        $this->searchModel = new OrderSearch([]);
        $query = $this->searchModel->search($params);
        
        $pageQuery = clone $query;

        $this->pagination = new Pagination([
            'totalCount' => $pageQuery->count(), 
            'pageSize' => $pageSize, 
            'pageSizeParam' => false
        ]);

        $orders = $query
            ->offset($this->pagination->offset)
            ->limit($this->pagination->limit)
            ->all();

        return $orders;
    }
    
    /**
     * getOrdersCsvString
     *
     * @return string
     */
    public function getOrdersCsvString($params)
    {
        $this->searchModel = new OrderSearch([]);
        $query = $this->searchModel->search($params);

        $orders = $query
            ->joinWith('user', false)
            ->joinWith('service', false)
            ->select([
                "orders.*",
                "CONCAT(users.first_name, ' ', users.last_name) as username",
                "services.name as serviceName"
            ])->each();

        $body = "";
        foreach($orders as $order)
        {
            $body .= $order->convertToCsv() . PHP_EOL;
        }

        return $body;
    }
}
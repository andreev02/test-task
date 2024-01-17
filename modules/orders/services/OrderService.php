<?php

namespace orders\services;

use yii\data\Pagination;
use orders\models\OrderSearch;

/**
 * OrderService
 */
class OrderService
{         
    /**
     * getFilteredOrders
     *
     * @param  mixed $params
     * @return array
     */
    public static function getFilteredOrders($params)
    {
        $searchModel = new OrderSearch([]);
        $dataProvider = $searchModel->search($params);

        return $dataProvider->query->all();
    }
    
    /**
     * getPaginatedOrders
     *
     * @param  mixed $params
     * @param  mixed $pageSize
     * @param  mixed $pages
     * @param  mixed $searchModel
     * @return array
     */
    public static function getPaginatedOrders($params, $pageSize = null, &$pages = null, &$searchModel = null)
    {
        $searchModel = new OrderSearch([]);
        $dataProvider = $searchModel->search($params);

        $query = $dataProvider->query;

        $pageQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $pageQuery->count(), 
            'pageSize' => $pageSize, 
            'pageSizeParam' => false
        ]);

        $orders = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $orders;
    }
    
    /**
     * getOrdersCsvString
     *
     * @return string
     */
    public static function getOrdersCsvString($params)
    {
        $orders = self::getFilteredOrders($params);

        $body = "";
        foreach($orders as $order)
        {
            $body .= $order->convertToCsv() . PHP_EOL;
        }

        return $body;
    }
}
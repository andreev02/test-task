<?php

namespace orders\controllers;

use Yii;
use yii\web\Controller;
use orders\services\FileService;
use orders\services\OrderService;
use orders\services\ServiceService;

/**
 * OrderController
 */
class OrderController extends Controller
{
    public $layout = 'main';

    /**
     * Displays index.
     *
     * @return string
     */
    public function actionIndex()
    {       
        $data = Yii::$app->request->get();

        return $this->render('index', [
            'orders' => OrderService::getPaginatedOrders($data, 100, $pages, $searchModel),
            'services' => ServiceService::getCountedServices($data),
            'pages' => $pages,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionDownload()
    {
        // dd(Yii::$app->request->get());
        $orders = OrderService::getFilteredOrders(Yii::$app->request->get());

        $body = "";
        foreach($orders as $order)
        {
            $body .= $order->convertToCsv() . PHP_EOL;
        }
        
        FileService::SendCsvFile("Orders-" . date("Y-m-d H:i:s"), $body);
    }
}
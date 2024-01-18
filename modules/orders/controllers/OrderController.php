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

        $orderService = new OrderService();
        $serviceService = new ServiceService();

        return $this->render('index', [
            'services' => $serviceService->getCountedServices($data),
            'totalCounter' => $serviceService->totalCounter,
            'orders' => $orderService->getPaginatedOrders($data, 100),
            'pages' => $orderService->pagination,
            'searchModel' => $orderService->searchModel,
        ]);
    }
    
    /**
     * Download CSV file.
     *
     * @return void
     */
    public function actionDownload()
    {
        $content = (new OrderService())->getOrdersCsvString(Yii::$app->request->get());
        
        return FileService::sendCsvFile("Orders-" . date("Y-m-d H:i:s"), $content);
    }
}
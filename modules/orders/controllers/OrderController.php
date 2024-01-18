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
            'services' => ServiceService::getCountedServices($data, $totalCounter),
            'pages' => $pages,
            'totalCounter' => $totalCounter,
            'searchModel' => $searchModel,
        ]);
    }
    
    /**
     * Download CSV file.
     *
     * @return void
     */
    public function actionDownload()
    {
        $content = OrderService::getOrdersCsvString(Yii::$app->request->get());
        
        return FileService::sendCsvFile("Orders-" . date("Y-m-d H:i:s"), $content);
    }
}
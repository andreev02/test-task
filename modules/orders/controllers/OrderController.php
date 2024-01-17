<?php

namespace orders\controllers;

use Yii;
use yii\web\Controller;
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
}
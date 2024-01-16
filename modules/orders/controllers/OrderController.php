<?php

namespace app\modules\orders\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\orders\models\Service;
use app\modules\orders\models\OrderSearch;

class OrderController extends Controller
{
    /**
     * Displays index.
     *
     * @return string
     */
    public function actionIndex()
    {    
        $data = Yii::$app->request->get();

        /**
         * Orders.
         */
        $searchModel = new OrderSearch([]);
        $dataProvider = $searchModel->search($data);

        $query = $dataProvider->query;

        $pageQuery = clone $query;
        $pages = new Pagination(['totalCount' => $pageQuery->count(), 'pageSize' => 100, 'pageSizeParam' => false]);
        // dd($pages);

        $orders = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        /**
         * Services.
         */
        $totalCounter = 0;

        unset($data['service']);
        $searchModel = new OrderSearch([]);
        $dataProvider = $searchModel->search($data);

        $allOrders = $dataProvider->query->all();

        $services = Service::find()->all();
        foreach($allOrders as $currOrder) {
            $totalCounter++;
            $services[$currOrder->service_id-1]->counter++;
        }

        $this->layout = 'main';
        return $this->render('index', [
            'orders' => $orders,
            'services' => $services,
            'totalCounter' => $totalCounter,
            'pages' => $pages,            
            'searchModel' => $searchModel,
        ]);
    }
}
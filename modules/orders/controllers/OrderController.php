<?php

namespace app\modules\orders\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\orders\models\Order;
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
        $searchModel = new OrderSearch([]);
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        $query = $dataProvider->query;

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        
        $orders = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $services = Service::find()->all();

        $counters = [];
        foreach($orders as $order) {
            if (!key_exists($order->service->id, $counters)) {
                $counters[$order->service->id] = 1;
                continue;
            }
            $counters[$order->service->id]++;
        }

        $this->layout = 'main';
        return $this->render('index', [
            'orders' => $orders,
            'services' => $services,
            'counters' => $counters,
            'pages' => $pages,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
}
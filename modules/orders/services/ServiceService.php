<?php

namespace orders\services;

use orders\models\ServiceSearch;

/**
 * ServiceService
 */
class ServiceService
{    
    /**
     * getCountedServices
     *
     * @param  mixed $params
     * @return array
     */
    public static function getCountedServices($params, &$totalCounter = null)
    {
        $searchModel = new ServiceSearch([]);
        $dataProvider = $searchModel->search($params);

        $services = $dataProvider->query
            ->select(['COUNT(*) as counter', 'services.*'])
            ->groupBy('services.id')
            ->all();

        $totalCounter = array_sum(array_column($services, 'counter'));

        return $services;
    }
}
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
    public static function getCountedServices($params)
    {
        $searchModel = new ServiceSearch([]);
        $dataProvider = $searchModel->search($params);

        $services = $dataProvider->query
            ->select(['COUNT(*) as counter', 'services.*'])
            ->groupBy('services.id')
            ->all();

        return $services;
    }
}
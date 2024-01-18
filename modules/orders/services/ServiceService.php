<?php

namespace orders\services;

use orders\models\search\ServiceSearch;

/**
 * ServiceService
 */
class ServiceService
{    
    public $searchModel;
    public $totalCounter;

    /**
     * getCountedServices
     *
     * @param  mixed $params
     * @return array
     */
    public function getCountedServices($params)
    {
        $this->searchModel = new ServiceSearch([]);
        $query = $this->searchModel->search($params);

        $services = $query
            ->select(['COUNT(*) as counter', 'services.*'])
            ->groupBy('services.id')
            ->orderBy(['counter' => SORT_DESC])
            ->all();

        $this->totalCounter = array_sum(array_column($services, 'counter'));

        return $services;
    }
}
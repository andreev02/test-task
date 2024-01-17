<?php

namespace orders\models;

use yii\data\ActiveDataProvider;

/**
 * ServiceSearch
 */
class ServiceSearch extends Service
{
    const SEARCH_TYPE_ID        = 1;
    const SEARCH_TYPE_LINK      = 2;
    const SEARCH_TYPE_USERNAME  = 3;

    public $status;
    public $mode;
    public $service;
    public $search_type;
    public $search;
    
    /**
     * rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['status', 'mode', 'service', 'search_type'], 'integer'],
            [['search'], 'string'],
        ];
    }
    
    /**
     * scenarios
     *
     * @return array
     */
    public function scenarios()
    {
        return Service::scenarios();
    }
    
    /**
     * search
     *
     * @param  mixed $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Service::find()->joinWith('orders');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params, '') && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['=', 'orders.status', $this->status]);
        $query->andFilterWhere(['=', 'orders.mode', $this->mode]);

        if ($this->search_type == self::SEARCH_TYPE_ID) {
            $query->andFilterWhere(['=', 'id', intval($this->search)]);
        }

        if ($this->search_type == self::SEARCH_TYPE_LINK) {
            $query->andFilterWhere(['like', 'orders.link', '%'.$this->search.'%', false]);
        }

        if ($this->search_type == self::SEARCH_TYPE_USERNAME) {
            $query->joinWith('user')->andFilterWhere(['like', 'CONCAT(users.first_name, users.last_name)', '%'.$this->search.'%', false]);
        }

        return $dataProvider;
    }
}
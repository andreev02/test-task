<?php

namespace app\modules\orders\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrderSearch extends Model
{
    public $status;
    public $mode;
    public $service;
    public $search_type;
    public $search;

    public function rules()
    {
        return [
            [['status', 'mode', 'service', 'search_type'], 'integer'],
            // [['search_type'], 'compare', 'compareAttribute' => 'search'],
            [['search'], 'string'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params, '') && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['=', 'status', $this->status]);
        $query->andFilterWhere(['=', 'mode', $this->mode]);
        $query->andFilterWhere(['=', 'service_id', $this->service]);

        if ($this->search_type == 1) {
            $query->andFilterWhere(['=', 'id', intval($this->search)]);
        }

        if ($this->search_type == 2) {
            $query->andFilterWhere(['like', 'link', '%'.$this->search.'%', false]);
        }

        if ($this->search_type == 3) {

        }

        return $dataProvider;
    }
}
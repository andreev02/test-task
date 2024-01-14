<?php

namespace app\modules\orders\controllers;

use yii\web\Controller;

class OrderController extends Controller
{
    /**
     * Displays index.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('index');
    }
}
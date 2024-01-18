<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use orders\Module;
use orders\components\NavBarWidget;
use orders\components\ServiceDropdownWidget;
use orders\components\ModeDropdownWidget;
use orders\components\OrderGridWidget;

const STATUS_PENDING        = '0';
const STATUS_INPROGRESS     = '1';
const STATUS_COMPLETED      = '2';
const STATUS_CANCELED       = '3';
const STATUS_ERROR          = '4';

const MODE_MANUAL           = '0';
const MODE_AUTO             = '1';

const SEARCH_TYPE_ID        = '1';
const SEARCH_TYPE_LINK      = '2';
const SEARCH_TYPE_USERNAME  = '3';

$this->title = 'My Yii application';

?>

<div class="site-index">
    <div class="container-fluid">

        <?php echo NavBarWidget::widget([
            'headers' => [
                ['name' => Module::t('header', 'All orders'),   'route' => 'order/index', 'status' => null],                 
                ['name' => Module::t('header', 'Pending'),      'route' => 'order/index', 'status' => STATUS_PENDING],     
                ['name' => Module::t('header', 'In progress'),  'route' => 'order/index', 'status' => STATUS_INPROGRESS],  
                ['name' => Module::t('header', 'Completed'),    'route' => 'order/index', 'status' => STATUS_COMPLETED],  
                ['name' => Module::t('header', 'Canceled'),     'route' => 'order/index', 'status' => STATUS_CANCELED],   
                ['name' => Module::t('header', 'Error'),        'route' => 'order/index', 'status' => STATUS_ERROR],  
            ],
            'selectors' => [
                ['name' => Module::t('body', 'Order ID'),       'search_type' => SEARCH_TYPE_ID],
                ['name' => Module::t('body', 'Link'),           'search_type' => SEARCH_TYPE_LINK],
                ['name' => Module::t('body', 'Username'),       'search_type' => SEARCH_TYPE_USERNAME],
            ],
            'searchModel' => $searchModel
        ]); ?>

        <?php
            echo Html::a(Module::t('common', 'Download'), Url::to(array_merge(['/orders/order/download'], $_GET)));
        ?>

        <table class="table order-table">
            <thead>
                <tr>
                    <th><?php echo Module::t('body', 'ID')?></th>
                    <th><?php echo Module::t('body', 'User')?></th>
                    <th><?php echo Module::t('body', 'Link')?></th>
                    <th><?php echo Module::t('body', 'Quantity')?></th>

                    <th class="dropdown-th">
                        <div class="dropdown">
                            <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?php echo Module::t('body', 'Service')?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                                <?php echo ServiceDropdownWidget::widget([
                                    'services' => $services,
                                    'totalCounter' => $totalCounter,
                                ]); ?>
                            
                            </ul>
                        </div>
                    </th>
                    
                    <th><?php echo Module::t('body', 'Status')?></th>
                    <th class="dropdown-th">
                        <div class="dropdown">
                            <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?php echo Module::t('body', 'Mode')?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                                <?php echo ModeDropdownWidget::widget([
                                    'items' => [
                                        ['name' => Module::t('mode', 'All'),    'mode' => null],                 
                                        ['name' => Module::t('mode', 'Manual'), 'mode' => MODE_MANUAL],     
                                        ['name' => Module::t('mode', 'Auto'),   'mode' => MODE_AUTO],  
                                    ]
                                ]); ?>

                            </ul>
                        </div>
                    </th>
                    
                    <th><?php echo Module::t('body', 'Created')?></th>
                </tr>
            </thead>
            <tbody>

                <?php echo OrderGridWidget::widget([
                    'orders' => $orders,
                    'services' => $services,
                ]); ?>

            </tbody>
        </table>
     
        <div class="row">
            <div class="col-sm-8">
                <?php echo LinkPager::widget([
                    'pagination' => $pages,
                ]);?>
            </div>
            <div class="col-sm-4 pagination-counters">
                <?php echo Module::t('body', '{0} to {1} of {2}', [$pages->page+1, ceil($pages->totalCount / $pages->pageSize), $pages->totalCount])?>
            </div>
        </div>
    </div>
    
</div>
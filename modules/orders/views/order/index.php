<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\modules\orders\models\Order;

// dd(Yii::$app->request->get('status'));

$this->title = 'My Yii application';
?>
<div class="site-index">

    <div class="container-fluid">
        <ul class="nav nav-tabs p-b">
            
            <li <?php if(Yii::$app->request->get('status') === null) echo "class='active'"?>><?php echo Html::a('All orders', ['order/index'])?></li>
            <li <?php if(Yii::$app->request->get('status') === strval(Order::STATUS_PENDING)) echo "class='active'"?>><?php echo Html::a('Pending', ["order/index?status=0"])?></li>
            <li <?php if(Yii::$app->request->get('status') === strval(Order::STATUS_INPROGRESS)) echo "class='active'"?>><?php echo Html::a('In progress', ["order/index?status=1"])?></li>
            <li <?php if(Yii::$app->request->get('status') === strval(Order::STATUS_COMPLETED)) echo "class='active'"?>><?php echo Html::a('Completed', ["order/index?status=2"])?></li>
            <li <?php if(Yii::$app->request->get('status') === strval(Order::STATUS_CANCELED)) echo "class='active'"?>><?php echo Html::a('Canceled', ["order/index?status=3"])?></li>
            <li <?php if(Yii::$app->request->get('status') === strval(Order::STATUS_ERROR)) echo "class='active'"?>><?php echo Html::a('Error', ["order/index?status=4"])?></li>

            <li class="pull-right custom-search">
                <form class="form-inline" action="/orders/order/index" method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="" placeholder="Search orders">
                        <span class="input-group-btn search-select-wrap">
                            <select class="form-control search-select" name="search_type">
                                <option value="1" selected="">Order ID</option>
                                <option value="2">Link</option>
                                <option value="3">Username</option>
                            </select>
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </span>
                    </div>
                </form>
            </li>
        </ul>
        <table class="table order-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Link</th>
                    <th>Quantity</th>
                    <th class="dropdown-th">
                        <div class="dropdown">
                            <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Service
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li class="active"><?php echo Html::a(Html::decode('All (' . array_sum($counters) . ')'), Url::current(['service' => null]))?></li>
                                <?php foreach($services as $service): ?>
                                    <li <?php echo $counters[$service->id] ?? "class='disabled'"?>>
                                        <?php echo Html::a(Html::decode('<span class="label-id">' . Html::encode($counters[$service->id] ?? 0) . '</span>' . $service->name), Url::current(['service' => $service->id]))?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </th>
                    <th>Status</th>
                    <th class="dropdown-th">
                        <div class="dropdown">
                            <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Mode
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li class="active"><?php echo Html::a('All', Url::current(['url' => null]))?></li>
                                <li><?php echo Html::a('Manual', Url::current(['mode' => 0]))?></li>
                                <li><?php echo Html::a('Auto', Url::current(['mode' => 1]))?></li>
                            </ul>
                        </div>
                    </th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                <tr>
                    <td><?php echo $order->id?></td>
                    <td><?php echo $order->user->name?></td>
                    <td class="link"><?php echo $order->link?></td>
                    <td><?php echo $order->quantity?></td>
                    <td class="service">
                        <span class="label-id"><?php echo $counters[$order->service->id]?></span><?php echo $order->service->name?>
                    </td>
                    <td><?php echo $order->statusName?></td>
                    <td><?php echo $order->modeName?></td>
                    <td>
                        <span class="nowrap"><?php echo Yii::$app->formatter->asDate($order->created_at, 'yyyy-mm-dd');?>
                        </span><span class="nowrap"><?php echo Yii::$app->formatter->asTime($order->created_at, 'hh:mm:ss');?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
     
        <div class="row">
            <div class="col-sm-8">
                <?php echo LinkPager::widget([
                    'pagination' => $pages,
                ]);?>
            </div>
            <div class="col-sm-4 pagination-counters">
                <?php echo $pages->page?> to 100 of <?php echo $pages->totalCount?>
            </div>
        </div>
    </div>
    
</div>
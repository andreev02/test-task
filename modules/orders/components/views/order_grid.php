<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use orders\Module;

    function getServiceCounterById($services, $id)
    {
        foreach ($services as $service)
        {
            if ($service->id == $id) {
                return $service->counter;
            }
        }
    }
?>

<?php foreach($orders as $order): ?>
<tr>
    <td><?php echo $order->id?></td>
    <td><?php echo $order->user->name?></td>
    <td class="link"><?php echo $order->link?></td>
    <td><?php echo $order->quantity?></td>
    <td class="service">
        <span class="label-id"><?php echo getServiceCounterById($services, $order->service->id)?></span><?php echo $order->service->name?>
    </td>
    <td><?php echo Module::t('body', $order->statusName)?></td>
    <td><?php echo Module::t('mode', $order->modeName)?></td>
    <td>
        <span class="nowrap"><?php echo Yii::$app->formatter->asDate($order->created_at, 'yyyy-mm-dd');?>
        </span><span class="nowrap"><?php echo Yii::$app->formatter->asTime($order->created_at, 'hh:mm:ss');?></span>
    </td>
</tr>
<?php endforeach; ?>
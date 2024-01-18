<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use orders\Module;
?>

<li <?php if(Yii::$app->request->get('service') === null) echo "class='active'"?>><?php echo Html::a(Html::decode(Module::t('body', 'All') . ' (' . $totalCounter . ')'), Url::current(['service' => null]))?></li>
<?php foreach($services as $service): ?>
    <li <?php if(Yii::$app->request->get('service') == $service->id) echo "class='active'"?>
        <?php echo $service->counter == 0 ? "class='disabled'" : ''?>>
        <?php echo Html::a(Html::decode('<span class="label-id">' . Html::encode($service->counter) . '</span>' . $service->name), Url::current(['service' => $service->id]))?>
    </li>
<?php endforeach; ?>
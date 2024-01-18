<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<?php foreach($items as $item): ?>
    <li <?php if(Yii::$app->request->get('mode') === $item['mode']) echo "class='active'"?>><?php echo Html::a($item['name'], Url::current(['mode' => $item['mode']]))?></li>
<?php endforeach; ?>
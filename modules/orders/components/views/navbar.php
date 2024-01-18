<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use orders\Module;

    $status = Yii::$app->request->get('status');
?>

<ul class="nav nav-tabs p-b">

    <?php foreach($headers as $key => $header): ?>
        <li <?php if($status === $header['status']) echo "class='active'"?>><?php echo Html::a($header['name'], Url::to([$header['route'], 'status' => $header['status']]))?></li>
    <?php endforeach; ?>

    <li class="pull-right custom-search">
        <form class="form-inline" <?php echo "action='" . Url::to(['order/index']) . "'"?> method="get">
            <div class="input-group">
                <input class='hidden' name="status" value=<?php echo $status?>></input>
                <input type="text" name="search" class="form-control" <?php echo "placeholder='" . Module::t('body', 'Search orders') . "'"?>
                    <?php echo "value='{$searchModel->search}'" ?>>
                <span class="input-group-btn search-select-wrap">
                    <select class="form-control search-select" name="search_type">
                        <?php foreach($selectors as $selector): ?>
                            <option value=<?php echo $selector['search_type']?> <?php if ($searchModel->search_type === $selector['search_type']) echo "selected=''" ?>><?php echo $selector['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </span>
            </div>
        </form>
    </li>

</ul>
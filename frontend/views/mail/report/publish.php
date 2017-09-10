<?php

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute(['report/view', 'id' => $model->id], true);

?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Ваш отчет от <?= \Yii::$app->formatter->asDatetime($model->created_at) ?> опубликован на портале
    <?= \Yii::$app->name ?>.
    <?php if ($score) { ?>
        Вам начислено <?= $score ?> баллов.
    <?php } ?>
</p>
<p>
    Просмотреть отчет: <?= Html::a($url, $url) ?>
</p>

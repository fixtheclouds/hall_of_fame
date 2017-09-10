<?php

use yii\helpers\Html;

$url = \Yii::$app->urlManagerCommon->createAbsoluteUrl(['report/view', 'id' => $model->id]);

?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Ваш отчет от <?= \Yii::$app->formatter->asDatetime($model->created_at) ?> опубликован на портале
    <?= \Yii::$app->name ?>.
    <?php if ($score) { ?>
        Вам начислено <?= $score ?> баллов.
    <?php } ?>
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Просмотреть отчет: <?= Html::a($url, $url) ?>
</p>

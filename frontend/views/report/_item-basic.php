<?php

use yii\helpers\Html;


switch($model->status) {
    case 'pending':
        $color = 'text-info';
        $icon = 'time';
        break;
    case 'dismissed':
        $color = 'text-danger';
        $icon = 'exclamation-sign';
        break;
    default:
        $color = 'text-success';
        $icon = 'ok-circle';
}
?>

<div class="col-xs-12 col-md-6">
    <div class="report-item panel panel-default">

        <p>
        <h4><?= Html::a($model->event->humanType(), ['/event/view', 'id' => $model->event_id]) ?></h4>
        </p>
        <p>
            <i class="glyphicon glyphicon-calendar"></i>
            <?= \Yii::$app->formatter->asDatetime($model->created_at)?>
        </p>
        <p class="<?= $color ?>">
            <i class="glyphicon glyphicon-<?= $icon ?>"></i> <?= \common\models\Report::HUMAN_STATUS[$model->status] ?>
        </p>
        <p>
            <?= Html::a('Подробнее', ['report/view', 'id' => $model->id], ['class' => 'btn btn-default right-10']) ?>
            <?php if ($model->isMine() && $model->status == 'pending') { ?>

                <?= Html::a('Редактировать', ['report/update', 'id' => $model->id], ['class' => 'btn btn-primary right-10']) ?>

                <?= Html::a('Удалить', ['report/delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php } ?>
        </p>
    </div>
</div>

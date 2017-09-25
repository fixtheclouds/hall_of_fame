<?php
use yii\helpers\Html;
?>


<div class="event-item panel panel-default">
    <div class="row relative">
        <div class="col-xs-12 col-sm-6 col-md-4 event-thumb">
            <?php
            if ($model->photo && file_exists($model->getPhotoPath())) { ?>
                <?= Yii::$app->thumbnail->img($model->getPhotoPath(), [
                    'thumbnail' => [
                        'width' => 150,
                        'height' => 150,
                    ]
                ], [
                    'class' => 'img img-responsive rounded'
                ]); ?>
            <?php } else { ?>
                <?= Html::img('@web/images/event_placeholder_square.png', [
                    'class' => 'img img-responsive rounded',
                    'style' => ['width' => '150px', 'height' => '150px']
                ]) ?>
            <?php } ?>

        </div>
        <div class="col-xs-12 col-sm-6 col-md-8 static">
            <h5 class="ellipsis">
                <?= $model->subtype->name ?>
            </h5>
            <p class="ellipsis">
                <i class="glyphicon glyphicon-user"
                  title="ФИО почетного гражданина, которому посвящено мероприятие"></i> <?= $model->person_name ?>
            </p>
            <p class="ellipsis">
                <i class="glyphicon glyphicon-map-marker" title="Город"></i>
                <?= $model->city ?>
            </p>
            <p class="ellipsis">
                <i class="glyphicon glyphicon-calendar" title="Дата проведения"></i>&nbsp;
                <?= Yii::$app->formatter->asDate($model->date, 'd MMMM y года, HH:mm') ?>
            </p>
            <p>
                Подано отчетов: <?= count($model->reports) ?>
            </p>
        </div>
    </div>
    <div class="row btn-row">
        <div class="col-xs-12 col-sm-5">
            <?php if (!$model->isMine() && !$model->isArchived()) {
                if (!$model->isAppliedBy(\Yii::$app->user->id)) { ?>
                    <?= Html::a('Участвовать', [
                        'event-user/apply', 'event_id' => $model->id
                    ], [
                        'class' => 'flat-button success',
                        'data-pjax' => 0
                    ]) ?>
                <?php } else { ?>
                    <?= Html::a('Не участвовать', [
                        'event-user/unapply', 'event_id' => $model->id
                    ], [
                        'class' => 'flat-button',
                        'data-pjax' => 0
                    ]) ?>
                <?php }
            } ?>
            <?php if ($model->isArchived()) { ?>
                <button type="button" class="flat-button disabled" disabled>Завершено</button>
            <?php } ?>
        </div>
        <div class="col-xs-12 col-sm-7">
            <?= Html::a('Посмотреть мероприятие', ['view', 'id' => $model->id], [
                'class' => 'flat-button pull-right',
                'data-pjax' => 0
            ]) ?>
        </div>
    </div>
</div>


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
                        'width' => 320,
                        'height' => 240,
                    ]
                ], [
                    'class' => 'img img-responsive'
                ]); ?>
            <?php } else { ?>
                <?= Html::img('@web/images/event_placeholder.png', ['class' => 'img img-responsive']) ?>
            <?php } ?>

        </div>
        <div class="col-xs-12 col-sm-6 col-md-8 static">
            <h4>
                <?= Html::a(Html::encode($model->subtype->name), ['view', 'id' => $model->id], ['data-pjax' => 0]) ?>
            </h4>
            <p><i class="glyphicon glyphicon-user"
                  title="ФИО почетного гражданина, которому посвящено мероприятие"></i> <?= $model->person_name ?></p>
            <p><i class="glyphicon glyphicon-map-marker" title="Город"></i> <?= $model->city ?></p>
            <p>
                <i class="glyphicon glyphicon-calendar" title="Дата проведения"></i>&nbsp;
                <?= Yii::$app->formatter->asDate($model->date, 'd MMMM y года, HH:mm') ?></p>

            <div class="row absolute bottom full-width">
                <?php if (!$model->hasMyReport() && !$model->isArchived()) { ?>
                    <div class="col-xs-6 col-sm-3">
                        <?= Html::a('Подать отчёт', [
                            'report/create', 'event_id' => $model->id
                        ], [
                            'class' => 'btn btn-primary',
                            'data-pjax' => 0
                        ]) ?>
                    </div>
                <?php } ?>
                <?php if (!$model->isMine() && !$model->isArchived()) {
                    if (!$model->isAppliedBy(\Yii::$app->user->id)) { ?>
                        <div class="col-xs-6 col-sm-3">
                            <?= Html::a('Участвовать', [
                                'event-user/apply', 'event_id' => $model->id
                            ], [
                                'class' => 'btn btn-success',
                                'data-pjax' => 0
                            ]) ?>
                        </div>
                    <?php } else { ?>
                        <div class="col-xs-6 col-sm-3">
                            <?= Html::a('Не участвовать', [
                                'event-user/unapply', 'event_id' => $model->id
                            ], [
                                'class' => 'btn btn-danger',
                                'data-pjax' => 0
                            ]) ?>
                        </div>
                    <?php }
                } ?>
                <?php if ($model->isArchived()) { ?>
                    <div class="col-xs-6 col-sm-3">
                        <button type="button" class="text-success btn btn-disabled" disabled>Завершено</button>
                    </div>
                <?php } ?>
                <div class="col-xs-6 col-sm-3">
                    <?= Html::a('Подробнее', ['view', 'id' => $model->id], [
                        'class' => 'btn btn-default',
                        'data-pjax' => 0
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

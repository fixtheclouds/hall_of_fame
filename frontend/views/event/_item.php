<?php
use yii\helpers\Html;
?>

<div class="event-item panel panel-default">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4">
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
        <div class="col-xs-12 col-sm-6 col-md-8">
            <h4>
                <?= Html::a(Html::encode($model->subtype->name), ['view', 'id' => $model->id]) ?>
            </h4>
            <p><i class="glyphicon glyphicon-user"></i> <?= $model->person_name ?></p>
            <p><i class="glyphicon glyphicon-map-marker"></i> <?= $model->city ?></p>
            <p><i class="glyphicon glyphicon-calendar"></i> <?= $model->date ?></p>

            <div class="row">
                <?php if (!$model->isMine()&& !$model->hasMyReport()) { ?>
                    <div class="col-xs-6">
                        <?= Html::a('Подать отчёт', [
                            'report/create', 'event_id' => $model->id
                        ], [
                            'class' => 'btn btn-primary'
                        ]) ?>
                    </div>
                <?php } ?>
                <div class="col-xs-6">
                    <?= Html::a('Подробнее', ['view', 'id' => $model->id], [
                        'class' => 'btn btn-default'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
use yii\helpers\Html;
?>

<div class="event-item panel panel-default">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <?php if (file_exists(\Yii::$app->basePath . '/web/uploads/event/' . $model->photo)) { ?>
                <img class="img img-responsive" src="<?= Yii::$app->homeUrl . '/uploads/event/' . $model->photo ?>">
            <?php } ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-8">
            <h4>
                <?= Html::a(Html::encode($model->subtype->name), ['view', 'id' => $model->id]) ?>
            </h4>
            <div><?= $model->person_name ?></div>
            <div><?= $model->city ?></div>
            <div><?= $model->date ?></div>

            <div class="row">
                <div class="col-xs-6">
                    <?php if (!$model->isMine()&& !$model->hasMyReport()) { ?>
                        <?= Html::a('Подать отчёт', [
                            'report/create', 'event_id' => $model->id
                        ], [
                            'class' => 'btn btn-primary'
                        ]) ?>
                    <?php } ?>
                    </div>
                <div class="col-xs-6">
                    <?= Html::a('Подробнее', ['view', 'id' => $model->id]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

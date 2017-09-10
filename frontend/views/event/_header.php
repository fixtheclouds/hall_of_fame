<?php
use Yii;
?>
<div class="row">
    <div class="col-sm-6 col-md-3 col-xs-12 text-center">
        <?php if (file_exists($model->getPhotoPath())) { ?>
            <?= Yii::$app->thumbnail->img($model->getPhotoPath(), [
                'thumbnail' => [
                    'width' => 300,
                    'height' => 300,
                ]
            ], [
                'class' => 'img img-responsive'
            ]); ?>
        <?php } ?>
    </div>
    <div class="col-sm-6 col-md-9 col-xs-12">
        <?= $this->render('@frontend/views/user/_user', ['user' => $model->user]) ?>
        <hr>
        <h4><i class="glyphicon glyphicon-user"
               title="ФИО почетного гражданина, которому посвящено мероприятие"></i>
            <?= $model->person_name ?>
        </h4>
        <p><i class="glyphicon glyphicon-map-marker" title="Город"></i> <?= $model->city ?></p>
        <p><i class="glyphicon glyphicon-home" title="Место"></i> <?= $model->place ?></p>
        <p><i class="glyphicon glyphicon-calendar" title="Дата проведения"></i>&nbsp;
            <?= Yii::$app->formatter->asDate($model->date, 'd MMMM y года, HH:mm') ?></p>
    </div>
</div>

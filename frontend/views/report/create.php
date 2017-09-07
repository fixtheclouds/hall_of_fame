<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Report */
/* @var $eventModel common\models\Event */

$this->title = 'Подать отчет';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2 class="text-center"><?= $eventModel->humanType() ?></h2>

    <div class="row">
        <div class="col-md-6 col-xs-12 text-center">
            <?php if (file_exists($eventModel->getPhotoPath())) { ?>
                <?= Yii::$app->thumbnail->img($eventModel->getPhotoPath(), [
                    'thumbnail' => [
                        'width' => 500,
                        'height' => 500,
                    ]
                ], [
                    'class' => 'img img-responsive'
                ]); ?>
            <?php } ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <h4><i class="glyphicon glyphicon-user"
                   title="ФИО почетного гражданина, которому посвящено мероприятие"></i>
                <?= $eventModel->person_name ?>
            </h4>
            <h4><?= $eventModel->humanType() ?></h4>
            <p><i class="glyphicon glyphicon-map-marker" title="Город"></i> <?= $eventModel->city ?></p>
            <p><i class="glyphicon glyphicon-home" title="Место"></i> <?= $eventModel->place ?></p>
            <p><i class="glyphicon glyphicon-calendar" title="Дата проведения"></i>&nbsp;
                <?= Yii::$app->formatter->asDate($eventModel->date, 'd MMMM y года, HH:mm') ?></p>
        </div>
    </div>

    <h2 class="text-center">Рассказать о проделанной работе</h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

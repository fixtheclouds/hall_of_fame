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
            <?php if (file_exists(\Yii::$app->basePath . 'web/uploads/event/' . $eventModel->photo)) { ?>
                <img class="img img-responsive" src="<?= Yii::$app->homeUrl . '/uploads/event/' . $eventModel->photo ?>">
            <?php } ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <h5><?= $eventModel->person_name ?></h5>
            <h5><?= $eventModel->humanType() ?></h5>
            <p>
                Город: <?= $eventModel->city ?>
            </p>
            <p>
                Место: <?= $eventModel->place ?>
            </p>
            <p>
                Дата проведения мероприятия: <?= $eventModel->date ?>
            </p>
        </div>
    </div>

    <h2 class="text-center">Рассказать о проделанной работе</h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

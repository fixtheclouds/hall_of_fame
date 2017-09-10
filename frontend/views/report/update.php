<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Report */

$this->title = 'Редактировать отчет #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="report-update">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <h2><?= Html::a($eventModel->humanType(), ['event/view', 'id' => $eventModel->id]) ?></h2>

    <?= $this->render('@frontend/views/event/_header', ['model' => $eventModel]) ?>

    <h2 class="text-center">Рассказать о проделанной работе</h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

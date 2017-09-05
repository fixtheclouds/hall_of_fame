<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Report */

$this->title = 'Отчет от ' . date('d-m-Y H:i:s', $model->created_at);
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default padded">
        <p>
            <label>Мероприятие:</label>&nbsp;<?= Html::a($model->event->humanType(), ['event/view', 'id' => $model->event_id]) ?>
        </p>
        <p>
            <label>Статус:</label>&nbsp;<?= $model->humanStatus() ?>
        </p>
        <p>
            <label>Создано:</label>&nbsp;<?= date('d-m-Y H:i:s', $model->created_at) ?>
        </p>
        <p>
            <label>Содержание:</label>&nbsp;<?= $model->content ?>
        </p>
    </div>
    <p>
        <?php if ($model->status == 'pending') {
            echo Html::a('Опубликовать', ['publish', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => ['method' => 'post']
            ]);
            echo Html::a('Отклонить', ['publish', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите отклонить отчет?',
                    'method' => 'post',
                ],
            ]);
        }
        else if ($model->status == 'published') {
            echo Html::a('Снять с публикации', ['publish', 'id' => $model->id, 'reverse' => true], [
                'class' => 'btn btn-default',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите скрыть отчет?',
                    'method' => 'post',
                ],
            ]);
        } ?>
    </p>

</div>

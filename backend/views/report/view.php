<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Report */

$this->title = 'Отчет от ' . \Yii::$app->formatter->asDate($model->created_at);
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
            <label>Создано:</label>&nbsp;<?= \Yii::$app->formatter->asDate($model->created_at, 'd MMMM y года, HH:mm') ?>
        </p>
        <p>
            <label>Автор:</label>&nbsp;<?= $model->user->profile->name ?>&nbsp;&lt;<?= $model->user->username ?>&gt;
        </p>
        <p>
            <label>Содержание:</label>&nbsp;<?= $model->content ?>
        </p>
        <p>
            <label>Фото:</label>
        <div>
            <?php foreach ($model->reportPhotos as $photo) {
                $absPath = \Yii::$app->urlManagerFrontend->baseUrl . '/report/' . $photo->photo;
                if (file_exists($absPath)) { ?>
                    <?= \Yii::$app->thumbnail->img($absPath, [
                        'thumbnail' => [
                            'width' => 300,
                            'height' => 300,
                            'mode' => \Imagine\Image\ImageInterface::THUMBNAIL_INSET
                        ]
                    ]);
                }
            } ?>
        </div>
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
        } ?>
    </p>

</div>

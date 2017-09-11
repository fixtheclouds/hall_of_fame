<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Event */

$this->title = $model->humanType();
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

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
        <?php
        $photoPath = Yii::$app->urlManagerFrontend->baseUrl . '/event/' . $model->photo;
        if (file_exists($photoPath)) { ?>
            <?= Yii::$app->thumbnail->img($photoPath, [
                'thumbnail' => [
                    'width' => 500,
                    'height' => 500,
                ]
            ], [
                'class' => 'img img-responsive'
            ]); ?>
        <?php } ?>
        <p>
            <label>Статус:</label>&nbsp;<?= $model->humanState() ?>
        </p>
        <p>
            <label>Создано:</label>&nbsp;
            <?= \Yii::$app->formatter->asDate($model->created_at, 'd MMMM y года, HH:mm') ?>
        </p>
        <p>
            <label>Автор:</label>&nbsp;<?= $model->user->profile->name ?>&nbsp;&lt;<?= $model->user->username ?>&gt;
        </p>
        <p>
            <label>ФИО гражданина, которому посвящено мероприятие:</label>&nbsp;
            <?= $model->person_name ?>
        </p>
        <p>
            <label>Город:</label>&nbsp;<?= $model->city ?>
        </p>
        <p>
            <label>Дата проведения:</label>&nbsp;
            <?= \Yii::$app->formatter->asDate($model->date, 'd MMMM y года, HH:mm') ?>
        </p>
        <p>
            <label>Содержание:</label> <?= $model->content ?>
        </p>
    </div>

    <p>
        <?php if ($model->status == 'pending') {
            echo Html::a('Опубликовать', ['publish', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => ['method' => 'post']
            ]);
            echo Html::a('Отклонить', ['dismiss', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите отклонить мероприятие?',
                    'method' => 'post',
                ],
            ]);
        } ?>
    </p>

</div>

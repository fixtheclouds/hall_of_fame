<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Report */
/* @var $eventModel common\models\Event */

$this->title = 'Отчет';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-view">

    <h2><?= Html::a($eventModel->humanType(), ['event/view', 'id' => $eventModel->id]) ?></h2>
    <?= $this->render('@frontend/views/event/_header', ['model' => $eventModel]) ?>

    <h1 class="text-center">Отчет о проделанной работе</h1>

    <?= $this->render('@frontend/views/user/_user', ['user' => $model->user]) ?>
    <hr>
    <p>
        <?= $model->content ?>
    </p>
    <div>
        <?php foreach ($model->reportPhotos as $photo) {
            $absPath = $photo->getPhotoPath();

            if (file_exists($absPath)) { ?>
                <?= \Yii::$app->thumbnail->img($absPath, [
                    'thumbnail' => [
                        'width' => 300,
                        'height' => 300,
                        'mode' => \Imagine\Image\ImageInterface::THUMBNAIL_INSET
                    ]
                ], [
                ]);
            }
        } ?>
    </div>
    <p class="top-20">
        <?php
            if ($model->status == 'pending') {
                echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            } ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>



</div>

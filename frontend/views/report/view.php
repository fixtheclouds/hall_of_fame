<?php

use yii\helpers\Html;
use branchonline\lightbox\Lightbox;

/* @var $this yii\web\View */
/* @var $model common\models\Report */
/* @var $eventModel common\models\Event */

$this->title = 'Отчет';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$files = [];
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
        <?php foreach ($model->reportPhotos as $index => $photo) {
            $absPath = $photo->getPhotoPath();

            if (file_exists($absPath)) {
                $files[] = [
                    'thumb' => \Yii::$app->thumbnail->url($absPath, [
                        'thumbnail' => [
                            'width' => 300,
                            'height' => 300
                        ]
                    ]),
                    'original' => $photo->getPhotoPath(false),
                    'group' => 'report'
                ];
            }
        }

        if (!empty($files)) {
            echo Lightbox::widget([
                'files' => $files
            ]);
        }
        ?>
    </div>
    <p class="top-20">
        <?php
        if ($model->isMine() && $model->status == 'pending') {
            echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить?',
                    'method' => 'post',
                ],
            ]);
        }?>
    </p>



</div>

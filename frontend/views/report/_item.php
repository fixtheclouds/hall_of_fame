<?php

use yii\helpers\Html;

?>

<div class="report-item panel panel-default">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <?= $this->render('@frontend/views/user/_user', ['user' => $model->user]) ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-8">
            <p>
                <i class="glyphicon glyphicon-calendar"></i>
                <?= \Yii::$app->formatter->asDatetime($model->created_at)?>
            </p>
            <p>
                <?= Html::a('Подробнее', ['report/view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?php if ($model->isMine() && $model->status == 'pending') { ?>

                    <?= Html::a('Редактировать', ['report/update', 'id' => $myReport->id], ['class' => 'btn btn-primary']) ?>

                    <?= Html::a('Удалить', ['report/delete', 'id' => $myReport->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php } ?>
            </p>
        </div>
    </div>
</div>

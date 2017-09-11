<?php

use yii\helpers\Html;

?>

<div class="report-item panel panel-default">
    <div class="row">
        <div class="col-xs-6 col-sm-3">
            <?= $this->render('@frontend/views/user/_user', ['user' => $model->user]) ?>
        </div>
        <div class="col-xs-6 col-sm-9">
            <p>
                <i class="glyphicon glyphicon-calendar"></i>
                <?= \Yii::$app->formatter->asDatetime($model->created_at)?>
            </p>
            <p>
                <?= Html::a('Подробнее', ['report/view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>
        </div>
    </div>
</div>

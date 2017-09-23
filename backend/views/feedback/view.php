<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Feedback */

$this->title = 'Сообщение обратной связи #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view">

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
            <label><?= $model->getAttributeLabel('email') ?>:</label>&nbsp;
            <?= Html::mailto($model->email, $model->email) ?>
        </p>
        <p>
            <label><?= $model->getAttributeLabel('name') ?>:</label>&nbsp;
            <?= $model->name ?>
        </p>
        <p>
            <label><?= $model->getAttributeLabel('content') ?>:</label>
        <div>
            <?= $model->content ?>
        </div>
        </p>
    </div>

</div>

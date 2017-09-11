<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = 'Сообщение от ' . \Yii::$app->formatter->asDatetime($model->created_at);
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

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
            <label>Автор:</label>&nbsp;
            <?= Html::a($model->user->profile->name, Url::to(['user/profile/show', 'id' => $model->user_id])) ?>
        </p>
        <p>
            <label>Содержание:</label>
            <div>
                <?= $model->content ?>
            </div>
        </p>
    </div>

</div>

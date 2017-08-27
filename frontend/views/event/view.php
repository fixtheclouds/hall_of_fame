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
        <?php if ($model->user_id == Yii::$app->user->id) { ?>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

    <div class="row">
        <div class="col-md-6 col-xs-12 text-center">
            <img class="img img-responsive" src="<?= Yii::$app->homeUrl . '/uploads/event/' . $model->photo ?>">
        </div>
        <div class="col-md-6 col-xs-12">
            <h5><?= $model->person_name ?></h5>
            <h5><?= $model->humanType() ?></h5>
            <p>
                Город: <?= $model->city ?>
            </p>
            <p>
                Место: <?= $model->place ?>
            </p>
            <p>
                Дата проведения мероприятия: <?= $model->date ?>
            </p>
            <?php if (!$model->isMine()&& !$model->hasMyReport()) { ?>
                <button type="button" class="btn btn-primary">
                    Подать отчет
                </button>
            <?php } ?>
        </div>
    </div>
    <p>
        <?= $model->content ?>
    </p>
    <?php if ($model->user_id != Yii::$app->user->id) { ?>
        <button type="button" class="btn btn-primary">
            Подать отчет
        </button>
    <?php } ?>
    <?php if (Yii::$app->user->identity->isAdmin) { ?>
        <?php if ($model->status == 'pending') { ?>
            <?= Html::a('Опубликовать', ['publish', 'id' => $model->id], [
                'class' => 'btn btn-success'
            ]) ?>
            <?= Html::a('Отклонить', ['dismiss', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите отклонить мероприятие?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php }
        if ($model->status == 'published') { ?>
            <?= Html::a('Снять с публикации', ['publish', 'id' => $model->id, 'reverse' => true], [
                'class' => 'btn btn-default',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите скрыть мероприятие?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    <?php }?>

</div>


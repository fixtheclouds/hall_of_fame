<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use nirvana\infinitescroll\InfiniteScrollPager;

/* @var $this yii\web\View */
/* @var $model common\models\Event */

$this->title = $model->humanType();
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::a('<i class="glyphicon glyphicon-menu-left"></i>&nbsp;Назад', Yii::$app->request->referrer) ?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($model->status == 'pending') { ?>
        <p class="text-info"><i class="glyphicon glyphicon-time"></i>&nbsp;Мероприятие находится на рассмотрении</p>
    <?php } ?>
    <p>
        <?php if ($model->isMine() && $model->status == 'pending') {
            echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить?',
                    'method' => 'post',
                ],
            ]);
        } ?>
    </p>

    <?= $this->render('_header', ['model' => $model]) ?>

    <p>
        <?= $model->content ?>
    </p>
    <div class="row">
        <div class="col-xs-6 col-sm-3">
            <?= Html::a('Подать отчёт', [
                'report/create', 'event_id' => $model->id
            ], [
                'class' => 'btn btn-primary'
            ]) ?>
        </div>
        <?php if (Yii::$app->user->identity->isAdmin) {
            if ($model->status == 'pending') { ?>
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
        }?>
    </div>
    <hr>
    <h1>Отчеты</h1>

    <div>
        <?php Pjax::begin(); ?>
        <?= ListView::widget([
            'dataProvider' => $reportsDataProvider,
            'itemView' => '@frontend/views/report/_item',
            'id' => 'events-legacy',
            'layout' => "<div class=\"items\">{items}</div>\n{pager}",
            'pager' => [
                'class' => InfiniteScrollPager::className(),
                'widgetId' => 'events-legacy',
                'itemsCssClass' => 'items',
                'nextPageLabel' => 'Показать ещё',
                'pluginOptions' => [
                    'loading' => [
                        'msgText' => "<b>Загрузка...</b>",
                        'finishedMsg' => "<b>Вы достигли конца списка</b>",
                    ],
                ]
            ],
            'emptyText' => $this->render('_empty-report-list', ['model' => $model])
        ]);?>
        <?php Pjax::end(); ?>
    </div>

</div>


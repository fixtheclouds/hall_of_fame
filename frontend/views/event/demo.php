<?php

use yii\helpers\Html;
use nirvana\infinitescroll\InfiniteScrollPager;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventSearch */
/* @var $memoryProvider yii\data\ActiveDataProvider */
/* @var $legacyProvider yii\data\ActiveDataProvider */

$this->title = \common\models\Event::HUMAN_TYPES[$type] . ' : Мероприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cover" style="background-image: url('/images/bg-sepia.jpg')">
    <div class="container">
        <p>
            <?php if ($type == 'memory') {
                echo 'Участвуйте и организовывайте мероприятия в память почетных граждан городов и районов Ростовской области, ушедших из жизни.';
            } else {
                echo 'Проводите совместные мероприятия с почетными гражданами, направленные на передачу опыта, части материальной и духовной культуры.';
            } ?>
        </p>
        <a href="/event/create">
            Участвовать в мероприятии
        </a>
    </div>
</div>
<div class="event-index">
    <div class="event-search">
        <h2 class="text-center">Мероприятия</h2>
        <?= $this->render('_demo-search', ['model' => $searchModel]) ?>
    </div>
    <div class="container">
        <?php Pjax::begin(); ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item-demo',
            'itemOptions' => [
                'class' => 'col-xs-12 col-sm-6'
            ],
            'id' => 'events-legacy',
            'layout' => "<div class=\"items row\">{items}</div>\n{pager}",
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
            'emptyText' => '<h3>Мероприятий не найдено.</h3>'
        ]);?>
        <?php Pjax::end(); ?>
    </div>
</div>

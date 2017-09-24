<?php

use yii\helpers\Html;
use nirvana\infinitescroll\InfiniteScrollPager;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventSearch */
/* @var $memoryProvider yii\data\ActiveDataProvider */
/* @var $legacyProvider yii\data\ActiveDataProvider */

$this->title = 'Мероприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cover" style="background-image: url('/images/bg-sepia.jpg')">
    <div class="container">
        <p>
            <?php if ($type == 'memory') {
                echo 'Стремящиеся вытеснить традиционное производство, нанотехнологии функционально разнесены на независимые элементы.';
            } else {
                echo 'Стремящиеся вытеснить традиционное производство, нанотехнологии функционально разнесены на независимые элементы.';
            } ?>
        </p>
        <a href="/event/create">
            Участвовать в мероприятии
        </a>
    </div>
</div>
<div class="event-index">

    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
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


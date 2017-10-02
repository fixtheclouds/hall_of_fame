<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
use nirvana\infinitescroll\InfiniteScrollPager;
?>
<div>
    <?php Pjax::begin(); ?>
    <?= ListView::widget([
        'dataProvider' => $legacyDataProvider,
        'itemView' => '_item',
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
        'emptyText' => '<h3>Ещё не создано ни одного мероприятия.</h3>'
    ]);?>
    <?php Pjax::end(); ?>
</div>



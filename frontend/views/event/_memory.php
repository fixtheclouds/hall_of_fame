<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
use nirvana\infinitescroll\InfiniteScrollPager;
?>
<div>
    <?php Pjax::begin(); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'id' => 'events-memory',
        'layout' => "{summary}\n<div class=\"items\">{items}</div>\n{pager}",
        'pager' => [
            'class' => InfiniteScrollPager::className(),
            'widgetId' => 'events-memory',
            'itemsCssClass' => 'items',
        ],
    ]);?>
    <?php Pjax::end(); ?>
</div>

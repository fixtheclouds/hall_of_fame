<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use nirvana\infinitescroll\InfiniteScrollPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventSearch */
/* @var $memoryProvider yii\data\ActiveDataProvider */
/* @var $legacyProvider yii\data\ActiveDataProvider */

$this->title = isset($pageTitle) ? $pageTitle : 'Отчеты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="report-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="container-fluid">
        <?php Pjax::begin(); ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item-basic',
            'id' => 'events-memory',
            'layout' => "<div class=\"items row\">{items}</div>\n{pager}",
            'pager' => [
                'class' => InfiniteScrollPager::className(),
                'widgetId' => 'events-memory',
                'itemsCssClass' => 'items',
                'nextPageLabel' => 'Показать ещё',
                'pluginOptions' => [
                    'loading' => [
                        'msgText' => "<b>Загрузка...</b>",
                        'finishedMsg' => "<b>Вы достигли конца списка</b>",
                    ],
                ]
            ],
            'emptyText' => '<h3>Ещё не подано ни одного отчёта..</h3>'
        ]);?>
        <?php Pjax::end(); ?>
    </div>
</div>

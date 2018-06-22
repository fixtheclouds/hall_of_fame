<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use common\models\Message;
use yii\web\View;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventSearch */
/* @var $memoryProvider yii\data\ActiveDataProvider */
/* @var $legacyProvider yii\data\ActiveDataProvider */

$this->title = isset($pageTitle) ? $pageTitle : 'Мероприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="event-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

<?= Collapse::widget([
    'items' => [
        [
            'label' => 'Фильтры',
            'content' => $this->render('_search', [
                'model' => $searchModel
            ]),
            'contentOptions' => []
        ]
    ]
]) ?>
<?= Tabs::widget([
    'items' => [
        [
            'label' => 'Память',
            'content' => $this->render('_memory', [
                'memoryDataProvider' => $memoryDataProvider
            ]),
            'active' => true,
            'linkOptions' => [
                'class' => 'tab',
                'data-type' => 'memory'
            ]
        ],
        [
            'label' => 'Наследие',
            'content' => $this->render('_legacy', [
                'legacyDataProvider' => $legacyDataProvider
            ]),
            'linkOptions' => [
                'class' => 'tab',
                'data-type' => 'legacy'
            ]
        ],
        [
            'label' => 'Гордость',
            'content' => $this->render('@frontend/views/message/_form', [
                'model' => new Message()
            ])
        ]
    ],
    'options' => [
        'class' => 'categories top-20'
    ]
])
?>

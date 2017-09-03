<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use common\models\Message;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = isset($pageTitle) ? $pageTitle : 'Мероприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="event-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


<?= Tabs::widget([
    'items' => [
        [
            'label' => 'Память',
            'content' => $this->render('_memory', ['dataProvider' => $dataProvider]),
            'active' => true,
            'linkOptions' => [
                'class' => 'tab',
                'data-type' => 'memory'
            ]
        ],
        [
            'label' => 'Наследие',
            'content' => $this->render('_legacy', ['dataProvider' => $dataProvider]),
            'linkOptions' => [
                'class' => 'tab',
                'data-type' => 'legacy'
            ]
        ],
        [
            'label' => 'Гордость',
            'content' => $this->render('@frontend/views/message/_form', ['model' => new Message()])
        ]
    ]
])
?>

<?php
$this->registerJsFile('@web/js/event/index.js', [
    'position' => View::POS_END,
    'depends' => [\yii\web\JqueryAsset::className()]
]);

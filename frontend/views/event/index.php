<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use common\models\Message;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мероприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Память',
                'content' => $this->render('_memory', ['dataProvider' => $dataProvider]),
                'active' => true
            ],
            [
                'label' => 'Наследие',
                'content' => $this->render('_legacy', ['dataProvider' => $dataProvider]),
            ],
            [
                'label' => 'Гордость',
                'content' => $this->render('@frontend/views/message/_form', ['model' => new Message()])
            ]
        ]
    ])
    ?>

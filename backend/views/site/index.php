<?php

use common\models\Event;
use common\models\Report;
use common\models\User;

/* @var $this yii\web\View */

$this->title = 'Галерея славы';

$counts = [
    'events' => Event::find()->count(),
    'reports' => Report::find()->count(),
    'users' => User::find()->count()
]
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= $this->title ?></h1>
    </div>
    <hr>
    <div class="container-fluid counters">
        <div class="row text-center">
            <div class="col-xs-12 col-sm-4">
                <div>
                    <i class="fa fa-calendar-o"></i> Всего мероприятий
                </div>
                <h2><b><?= $counts['events'] ?></b></h2>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div>
                    <i class="fa fa-file-text"></i> Всего отчетов
                </div>
                <h2><b><?= $counts['reports'] ?></b></h2>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div>
                    <i class="fa fa-user"></i> Пользователей зарегистрировано
                </div>
                <h2><b><?= $counts['users'] ?></b></h2>
            </div>
        </div>
    </div>
</div>

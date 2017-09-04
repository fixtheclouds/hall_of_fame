<?php

/**
 * @todo move to partial views
 */

use yii\helpers\Html;
use yii\web\View;
use kartik\dialog\Dialog;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use common\models\Event;
use common\models\User;
use bupy7\cropbox\CropboxWidget;

$counts = [
    'active' => Event::find()->published()->active()->count(),
    'own' => Event::find()->published()->byUserId(Yii::$app->user->id)->count(),
    'applied' => Event::find()->published()->withReportFromUser(Yii::$app->user->id)->distinct()->count(),
    'archived' => Event::find()->published()->active(false)->count()
];

$profileModel = \Yii::$app->user->identity->profile;

$customBtn = '<button type="button" class="btn btn-default" title="Add picture tags"' .
    '<i class="glyphicon glyphicon-tag"></i>' .
    '</button>';

$this->beginContent('@frontend/views/layouts/main.php');
if (!Yii::$app->user->isGuest) {
    ?>
    <div class="profile-header clearfix">
        <div class="col-sm-5">
            <div class="row">
                <div class="col-xs-4">
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype'=>'multipart/form-data'],
                        'action' => '/profile/upload_avatar'
                    ]); ?>
                    <?= Html::img(Yii::$app->user->identity->profile->getAvatarUrl(), ['class' => 'img img-responsive']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-xs-8">
                    <h4>
                        <?= Html::encode(Yii::$app->user->identity->profile->name) ?>
                    </h4>
                    <p>
                        <strong>Email: <?= Yii::$app->user->identity->email ?></strong>
                    </p>
                    <p>
                        <strong>Город: <?= Yii::$app->user->identity->profile->city ?></strong>
                    </p>
                    <p>
                        <strong>Телефон: <?= Yii::$app->user->identity->profile->phone ?></strong>
                    </p>
                    <p>
                        <?= Html::a('Изменить информацию о себе', ['/user/settings/profile'], ['class' => 'profile-link']) ?>
                        <br>
                        <?= Html::a('Изменить фотографию', ['#']) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="col-xs-6">
                <p>
                    <a href="/event/actual">
                        Предстоящие мероприятия: <?= $counts['active'] ?>
                    </a>
                </p>
                <p>
                    <a href="/event/own">
                        Мероприятия, которые я запланировал: <?= $counts['own'] ?>
                    </a>
                </p>
                <p>
                    <a href="/event/applied">
                        Мероприятия, в которых я участвую: <?= $counts['applied'] ?>
                    </a>
                </p>
                <p>
                    <a href="/event/archived">
                        Завершенные мероприятия: <?= $counts['archived'] ?>
                    </a>
                </p>
                <p>
                    <span>
                        Баллы, которые я заработал:
                        <?=User::findIdentity(\Yii::$app->user->id)->getScore() ?>&nbsp;<i class="glyphicon glyphicon-star-empty"></i>
                    </span>
                </p>
                <p>
                    <?= Html::a('Запланировать новое мероприятие', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
            <div class="col-xs-6">
                <?= Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="glyphicon glyphicon-log-out"></i>&nbsp;Выйти',
                    ['class' => 'btn btn-default logout col-xs-12']
                )
                . Html::endForm()
                ?>
                <?= Html::a('<i class="glyphicon glyphicon-lock"></i>&nbsp;Запросить новый пароль', ['/user/recovery/resend-password'], [
                    'data' => [
                        'confirm' => 'На ваш адрес E-mail будет отправлен новый автоматически сгенерированный пароль.' .
                            'Ваш текущий пароль станет недейтвителен. Вы уверены?',
                        'method' => 'post',
                    ],
                    'class' => 'btn btn-default top-20 col-xs-12'
                ]) ?>
            </div>
        </div>
    </div>
    <hr>
    <?= Dialog::widget([
        'options' => [
            'title' => 'Подтвердите действие'
        ]
    ]); ?>

    <?= $content ?>
    <?php
}
$this->endContent(); ?>


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
use common\models\Report;
use common\models\User;

$counts = [
    'active' => Event::find()->published()->active()->count(),
    'own' => Event::find()->byUserId(Yii::$app->user->id)->count(),
    'applied' => Event::find()->published()->withReportFromUser(Yii::$app->user->id)->distinct()->count(),
    'archived' => Event::find()->published()->active(false)->count(),
    'events-pending' => Event::find()->pending()->byUserId(Yii::$app->user->id)->count(),
    'reports-pending' => Report::find()->pending()->byUserId(Yii::$app->user->id)->count()
];
$profileModel = \Yii::$app->user->identity->profile;
$this->beginContent('@frontend/views/layouts/main.php');
if (!Yii::$app->user->isGuest) {
    ?>
    <div class="profile-header clearfix top-20">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype'=>'multipart/form-data'],
                'action' => '/profile/upload-avatar'
            ]);

            $avatarUrl = Yii::$app->user->identity->profile->getPhotoPath();
            $thumbUrl = ($avatarUrl && file_exists($avatarUrl)) ? Yii::$app->thumbnail->url($avatarUrl, [
                'thumbnail' => [
                    'width' => 200,
                    'height' => 200,
                ]
            ]) : '/images/default_avatar.jpg'; ?>

            <?= Html::img($thumbUrl, ['class' => 'img img-responsive avatar-thumb rounded']) ?>

            <?= $form->field($profileModel, 'image', ['options' => ['style' => 'display: none']])->widget(FileInput::className(), [
                'pluginOptions' => [
                    'initialPreview'=>[
                        $thumbUrl
                    ],
                    'initialPreviewAsData' => true,
                    'overwriteInitial' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showCaption' => false,
                    'uploadUrl' => '/user/profile/upload-avatar',
                    'browseLabel' => 'Выбрать файл'
                ]
            ])->label(false) ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
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
            </p>
            <p>
                <?= Html::a('Изменить фотографию', '#', ['class' => 'profile-link', 'id' => 'upload-mode']) ?>
            </p>
        </div>

        <div class="col-md-5 col-sm-12">
            <div class="row">
                <div class="col-xs-12">
                    <?= Html::a('<i class="glyphicon glyphicon-lock"></i>&nbsp;Запросить новый пароль', ['/user/recovery/resend-password'], [
                        'data' => [
                            'confirm' => 'На ваш адрес E-mail будет отправлен новый автоматически сгенерированный пароль.' .
                                'Ваш текущий пароль станет недейтвителен. Вы уверены?',
                            'method' => 'post',
                        ],
                        'class' => 'btn btn-default pull-left right-10'
                    ]) ?>
            <?= Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<i class="glyphicon glyphicon-log-out"></i>&nbsp;Выйти',
                ['class' => 'btn btn-default logout pull-left']
            )
            . Html::endForm()
            ?>
                </div>
            </div>
            <div class="clearfix">
                <hr>
                <p>
                    <a href="/event/actual" class="btn btn-default">
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
                    <div class="text-muted">
                        Мероприятий на рассмотрении: <?= $counts['events-pending'] ?>
                    </div>
                    <div class="text-muted">
                        Отчетов на рассмотрении: <?= $counts['reports-pending'] ?>
                    </div>
                </p>
                <p>
                    <span>
                        Баллы, которые я заработал:
                        <?= User::findIdentity(\Yii::$app->user->id)->getScore() ?>&nbsp;<i class="glyphicon glyphicon-star-empty"></i>
                    </span>
                </p>
                <p>
                    <?= Html::a('Запланировать новое мероприятие', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
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


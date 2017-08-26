<?php

/**
 * @todo move to partial views
 */

use yii\helpers\Html;
use yii\web\View;
use kartik\dialog\Dialog;

$this->beginContent('@frontend/views/layouts/main.php'); ?>
<div class="profile-header clearfix">
    <div class="col-sm-5">
        <div class="row">
            <div class="col-xs-4">

            </div>
            <div class="col-xs-8">
                <h5>
                    <?= Html::encode(Yii::$app->user->identity->profile->name) ?>
                </h5>
                Email: <?= Yii::$app->user->identity->email ?>
                <div>
                    <?= Html::a('Изменить информацию о себе', ['/user/settings/profile'], ['class' => 'profile-link']) ?>
                </div>
                <div>
                    <?= Html::a('Изменить фотографию', ['#']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="col-xs-6">
            <div>
                <a href="/event/own">
                    Мероприятия, которые я запланировал: <?= $counts['own'] ?>
                </a>
            </div>
            <div>
                <a href="/event/applied">
                    Мероприятия, в которых я участвую: <?= $counts['applied'] ?>
                </a>
            </div>
            <div>
                <a href="/event/archived">
                    Завершенные мероприятия: <?= $counts['archived'] ?>
                </a>
            </div>
            <div>
                    <span>
                        Баллы, которые я заработал: 0
                    </span>
            </div>
        </div>
        <div class="col-xs-6">
            <?php
            echo Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти',
                    ['class' => 'btn btn-default logout']
                )
                . Html::endForm()
            ?>
            <a href="javascript://" id="password-reset-btn">
                Запросить новый пароль
            </a>
        </div>
    </div>
</div>
<hr>
<?= Dialog::widget([
    'options' => [
        'title' => 'Подтвердите действие'
    ]
]); ?>

<?php
$js = <<< JS
    $("#password-reset-btn").on("click", function() {
        krajeeDialog.confirm("На ваш адрес E-mail будет отправлен новый автоматически сгенерированный пароль. " +
         "Ваш текущей пароль станет недейтвителен. Вы уверены?", function (result) {
            if (result) {
                $.post('/user/generate_password', function() {
                  
                });
            }
        });
    });
JS;

$this->registerJs($js, View::POS_END); ?>

<?= $content ?>
<?php $this->endContent(); ?>

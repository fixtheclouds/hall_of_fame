<?php

use yii\helpers\Html;

$this->beginContent('@frontend/views/layouts/main.php'); ?>
    <div class="profile-header panel panel-default clearfix">
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
                    <a href="#">
                        Мероприятия, которые я запланировал: 0
                    </a>
                </div>
                <div>
                    <a href="#">
                        Мероприятия, в которых я участвую: 0
                    </a>
                </div>
                <div>
                    <a href="#">
                        Завершенные мероприятия: 0
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
                <a href="#">
                    Запросить новый пароль
                </a>
            </div>
        </div>
    </div>
    <?= $content ?>
<?php $this->endContent(); ?>

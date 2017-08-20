<?php

use yii\helpers\Html;

$this->beginContent('@frontend/views/layouts/main.php'); ?>
    <div class="profile-header panel panel-default clearfix">
        <div class="col-sm-6">
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
        <div class="col-sm-6">
            <div class="col-xs-8">

            </div>
            <div class="col-xs-4">

            </div>
        </div>
    </div>
    <?= $content ?>
<?php $this->endContent(); ?>

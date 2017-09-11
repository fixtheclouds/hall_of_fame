<?php

/*
 * Override dektrium user registration view
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\ulogin\ULogin;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'email') ?>

                <?php if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                <?php endif ?>

                <div class="text-center top-20 bottom-20">
                    <?= ULogin::widget([
                        'display' => ULogin::D_PANEL,
                        'fields' => [ULogin::F_FIRST_NAME, ULogin::F_LAST_NAME, ULogin::F_EMAIL, ULogin::F_CITY, ULogin::F_PHONE],
                        'optional' => [],
                        'providers' => [ULogin::P_VKONTAKTE, ULogin::P_FACEBOOK, ULogin::P_GOOGLE],
                        'hidden' => [],
                        'redirectUri' => ['user/registration/ulogin'],
                        'language' => ULogin::L_RU,
                        'sortProviders' => ULogin::S_DEFAULT,
                        'mobileButtons' => '1',
                    ]) ?>
                </div>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>

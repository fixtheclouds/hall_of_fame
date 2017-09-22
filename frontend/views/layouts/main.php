<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="<?= \Yii::$app->settings->get('Settings.metaKeywords') ?>">
    <meta name="description" content="<?= \Yii::$app->settings->get('Settings.metaDescription') ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Галерея славы',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/user/registration/register']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/user/login']];
    } else {
        $menuItems[] = ['label' => 'Личный кабинет', 'url' => ['/account']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <p class="pull-left">&copy; Ассоциация почётных граждан, наставников и талантливой молодёжи<br>
                    <?= Html::a('Политика обработки персональных данных', ['pages/policy']) ?>
                </p>
            </div>
            <div class="col-xs-12 col-md-6 text-right">
                <?php if (Yii::$app->user->isGuest) {
                    echo Html::a('Войти', ['/user/login/'], ['class' => 'right-10']);
                    echo Html::a('Зарегистрироваться', ['/user/registration/register']);
                } else {
                    echo Html::a('Мероприятия', ['/event/actual']);
                } ?>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

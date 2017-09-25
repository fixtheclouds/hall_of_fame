<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use frontend\assets\StaticPageAsset;

AppAsset::register($this);
StaticPageAsset::register($this);
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
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => [
            ['label' => 'Память', 'url' => ['/event/memory-demo']],
            ['label' => 'Наследие', 'url' => ['/event/legacy-demo']]
        ]
    ]);

    $menuItems = [
        ['label' => '<i class="glyphicon glyphicon-envelope" title="Обратная связь"></i>', 'url' => ['/feedback/create']]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/user/registration/register']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/user/login']];
    } else {
        $menuItems[] = ['label' => 'Личный кабинет', 'url' => ['/account']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <?= $content ?>
</div>

<footer class="footer">
    <div class="container">
        <div class="clearfix">
            <div class="t-col t-col_6">
                <p class="pull-left">&copy; Ассоциация почётных граждан, наставников и талантливой молодёжи<br>
                    <?= Html::a('Политика обработки персональных данных', ['page/policy']) ?>
                </p>
            </div>
            <div class="t-col t-col_6 text-right">
                <?php
                echo Html::a('Обратная связь', ['/feedback/create'], ['class' => 'right-10']);
                if (Yii::$app->user->isGuest) {
                    echo Html::a('Войти', ['/user/login/'], ['class' => 'right-10']);
                    echo Html::a('Зарегистрироваться', ['/user/registration/register']);
                } ?>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

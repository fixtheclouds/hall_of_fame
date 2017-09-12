<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;

AppAsset::register($this);

$avatarUrl = Yii::$app->user->identity->profile->getPhotoPath();
$thumbUrl = ($avatarUrl && file_exists($avatarUrl)) ? Yii::$app->thumbnail->url($photo, [
    'thumbnail' => [
        'width' => 50,
        'height' => 50,
    ]
]) : '/images/default_avatar.jpg';

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>" >
<?php $this->beginBody(); ?>
<div class="container body">

    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="/admin" class="site_title"><i class="fa fa-star"></i> <span>Галерея славы</span></a>
                </div>
                <div class="clearfix"></div>

                <!-- menu prile quick info -->
                <?php if (!Yii::$app->user->isGuest) { ?>
                    <div class="profile">
                        <div class="profile_pic">
                            <?= Html::img($thumbUrl, ['class' => 'img img-responsive rounded']) ?>
                        </div>
                        <div class="profile_info">
                            <span>Добро пожаловать,</span>
                            <h2><?= Yii::$app->user->identity->profile->name ?></h2>
                        </div>
                    </div>
                <?php } ?>
                <!-- /menu prile quick info -->
                <div class="row"></div>
                <br />
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => [
                                    ["label" => "На сайт", "url" => "/", "icon" => "home"],
                                    ["label" => "Сообщения", "url" => ["/message/index"], "icon" => "envelope"],
                                    ["label" => "Мероприятия", "url" => ["/event/index"], "icon" => "calendar-o"],
                                    ["label" => "Отчеты", "url" => ["/report/index"], "icon" => "file-text"],
                                    ["label" => "Пользователи", "url" => ["/user/admin/index"], "icon" => "users"],
                                    ["label" => "Баллы", "url" => ["/score-system/index"], "icon" => "star-half-o"],
                                    [
                                        "label" => "Рубрикаторы",
                                        "icon" => "list",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Подтипы мероприятий", "url" => ["/subtype/index"], "icon" => "list-ol"],
                                            ["label" => "Города", "url" => ["/city/index"], "icon" => "globe"]
                                        ]
                                    ]
                                ],
                            ]
                        )
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">

                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <?= Html::img($thumbUrl, ['class' => '']) ?>
                                    <span><?= Yii::$app->user->identity->profile->name ?></span>
                                    <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li>
                                        <a href="javascript:;">
                                            <span>Настройки профиля</span>
                                        </a>
                                    </li>
                                    <li>
                                        <?= Html::a('Выйти <i class="fa fa-sign-out"></i>', ['/site/logout'],  [
                                            'data' => [
                                                'confirm' => 'Вы уверены, что хотите выйти?',
                                                'method' => 'post',
                                            ]
                                        ])?>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green"><?= common\models\Message::getUnreadCount() ?></span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    <?php foreach (common\models\Message::fresh()->all() as $msg) { ?>
                                        <li>
                                            <a href="<?= Url::to(['message/view', 'id' => $msg->id]) ?>">
                                                <span><?= $msg->user->profile->name ?></span>
                                                <span class="time"><?= date('d-m-Y H:i:s', $msg->created_at) ?></span>
                                                <span class="message">
                                            <?= $msg->content ?>
                                        </span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <div class="text-center">
                                            <a href="/admin/message/index">
                                                <strong>Смотреть все сообщения</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    <?php } ?>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <?= $content ?>
        </div>
        <!-- /page content -->
    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>

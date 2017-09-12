<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $profile
 */

$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->params['breadcrumbs'][] = $this->title;

$photo = $profile->getPhotoPath();
if (!$profile->photo || !file_exists($photo)) {
    $photo = \Yii::getAlias('@backend') . '/web/images/default_avatar.jpg';
}
$thumbUrl = Yii::$app->thumbnail->url($photo, [
    'thumbnail' => [
        'width' => 200,
        'height' => 200,
    ]
]);
?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <?= Html::img($thumbUrl, ['class' => 'img img-responsive avatar-thumb rounded']) ?>
            </div>
            <div class="col-sm-6 col-md-8 font-15">
                <h4><?= $this->title ?></h4>
                <ul style="padding: 0; list-style: none outside none;">
                    <li>
                        <p>
                            <i class="glyphicon glyphicon-envelope" title="E-mail"></i> <?= Html::a(Html::encode($profile->user->email), 'mailto:' . Html::encode($profile->user->email)) ?>
                        </p>
                    </li>
                    <?php if (!empty($profile->city)): ?>
                        <li>
                            <p>
                                <i class="glyphicon glyphicon-map-marker" title="Город"></i> <?= Html::encode($profile->city) ?>
                            </p>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile->phone)): ?>
                        <li>
                            <p>
                                <i class="glyphicon glyphicon-phone" title="Телефон"></i> <?= Html::encode($profile->phone) ?>
                            </p>
                        </li>
                    <?php endif; ?>
                    <li>
                        <p>
                            <i class="glyphicon glyphicon-star" title="Баллов заработано"></i> <?= $profile->user->getScore() ?>
                        </p>
                    </li>
                    <li>
                        <p>
                            <i class="glyphicon glyphicon-time"></i> <?= Yii::t('user', 'Joined on {0, date}', $profile->user->created_at) ?>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

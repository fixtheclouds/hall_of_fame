<?php
use yii\helpers\Html;

$thumbUrl = Yii::$app->thumbnail->url($user->profile->getAvatarUrl(true), [
    'thumbnail' => [
        'width' => 50,
        'height' => 50,
    ]
]);
?>
<div class="row bottom-20">
    <div class="col-xs-12">
        <div class="pull-left right-10">
            <?= Html::img($thumbUrl, ['class' => 'img img-responsive avatar-thumb rounded']) ?>
        </div>
        <div class="pull-left user-name">
            <?= Html::mailto($user->profile->name, $user->email) ?>
        </div>
    </div>
</div>

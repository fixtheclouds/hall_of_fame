<?php
use yii\helpers\Html;

$photo = $user->profile->getPhotoPath();
$thumbUrl = ($photo && file_exists($photo)) ? Yii::$app->thumbnail->url($photo, [
    'thumbnail' => [
        'width' => 50,
        'height' => 50,
    ]
]) : '/images/default_avatar.jpg';
?>
<div class="row bottom-20 user-row">
    <div class="col-xs-12">
        <div class="pull-left right-10">
            <?= Html::img($thumbUrl, ['class' => 'img img-responsive avatar-thumb rounded']) ?>
        </div>
        <div class="pull-left user-name">
            <?= Html::encode($user->profile->name) ?> <<?= Html::mailto($user->email, $user->email) ?>>
        </div>
    </div>
</div>

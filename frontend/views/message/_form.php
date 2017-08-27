<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <h2>Напишите нам</h2>

    <?php $form = ActiveForm::begin();
    $form->action = ['message/create'];
    ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form event-item panel panel-default">

    <h2>Напишите нам</h2>
    <p class="text-muted">
        Товарищи! реализация намеченных плановых заданий в значительной степени обуславливает создание соответствующий условий активизации.
        Таким образом рамки и место обучения кадров позволяет оценить значение дальнейших направлений развития.
        Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач.
        Равным образом реализация намеченных плановых заданий представляет собой интересный эксперимент проверки соответствующий условий активизации.
    </p>
    <?php $form = ActiveForm::begin();
    $form->action = ['message/create'];
    ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field( $model, 'accept' )->checkbox([
        'label' => 'Я согласен с ' . Html::a('политикой обработки персональных данных', ['page/policy'], [
                'target' => '_blank'
            ])
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

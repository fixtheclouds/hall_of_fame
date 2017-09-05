<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Event;

/* @var $this yii\web\View */
/* @var $model common\models\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

     <?= $form->field($model, 'type')->dropDownList(Event::HUMAN_TYPES, ['prompt' => 'Выбрать...']) ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'status')->dropDownList(Event::HUMAN_STATES, ['prompt' => 'Выбрать...'])?>


    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Event;

/* @var $this yii\web\View */
/* @var $model common\models\Subtype */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subtype-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->radioList(Event::$types) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

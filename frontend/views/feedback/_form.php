<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'accept')->checkbox([
        'label' => 'Я согласен с ' . Html::a('политикой обработки персональных данных', ['page/policy'], [
                'target' => '_blank'
            ])
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Отправить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

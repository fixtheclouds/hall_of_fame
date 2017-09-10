<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ScoreSystem;

/* @var $this yii\web\View */
/* @var $model common\models\ScoreSystem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="score-system-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module')->dropDownList(ScoreSystem::MODULES) ?>

    <?= $form->field($model, 'action')->dropDownList(ScoreSystem::ACTIONS) ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'min' => 0]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

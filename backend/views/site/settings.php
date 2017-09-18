<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Настройки сайта';
?>

<h1>Настройки сайта</h1>
<?php $form = ActiveForm::begin(['id' => 'site-settings-form']); ?>
<?= $form->field($model, 'metaKeywords') ?>
<?= $form->field($model, 'metaDescription') ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end() ?>

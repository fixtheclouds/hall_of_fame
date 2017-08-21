<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use common\models\Event;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(Event::$types); ?>

    <label class="control-label" for="date">
        <?= $model->attributeLabels()['date'] ?>
    </label>
    <?= DateTimePicker::widget([
        'name' => 'date',
        'type' => DateTimePicker::TYPE_INPUT,
        'value' => date('d-m-Y H:i'),
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy hh:ii'
        ]
    ]); ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'subtype_id')->dropDownList([]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

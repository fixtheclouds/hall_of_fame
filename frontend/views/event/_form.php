<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use common\models\Event;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;
use kartik\typeahead\Typeahead;
use common\models\Subtype;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(Event::$types); ?>


    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        'type' => DateTimePicker::TYPE_INPUT,
        'value' => date('d-m-Y H:i'),
        'pluginOptions' => [
            'autoclose'=>true,
            //'format' => 'dd-mm-yyyy hh:ii'
        ]
    ]); ?>

    <?= $form->field($model, 'city')->widget(Typeahead::classname(), [
        'options' => [
            'placeholder' => 'Введите название'
        ],
        'pluginOptions' => [
            'highlight' => true,
            'minLength' => 2
        ],
        'dataset' => [
            [
                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('label')",
                'display' => 'label',
                'remote' => [
                    'url' => Url::to(['/city/autocomplete']) . '?query=%QUERY',
                    'wildcard' => '%QUERY'
                ],
                'limit' => 10,
                'templates' => [
                    'notFound' => '<div class="text-danger" style="padding:0 8px">Ничего не найдено.</div>',
                ]
            ]
        ],
    ]);
    ?>

    <?php reset(Event::$types);
    $subtypes = Subtype::find()->getNamesByType(key(Event::$types))->column();
    echo $form->field($model, 'subtype_id')->dropDownList($subtypes);
    ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' => [
                'allowedFileExtensions' => ['jpg', 'gif', 'png']
            ]
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

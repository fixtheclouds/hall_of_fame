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

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
$thumb = false;

if ($model->photo && file_exists($model->getPhotoPath())) {
    $thumb = Yii::$app->thumbnail->url($model->getPhotoPath(), [
        'thumbnail' => [
            'width' => 300,
            'height' => 300,
            'mode' => \Imagine\Image\ImageInterface::THUMBNAIL_INSET
        ]
    ]);
}
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->radioList(Event::$types, [
        'prompt' => 'Выбрать...',
        'onchange'=>'
                    var type = $("input[name=\"Event[type]\"]:checked").val();
                    $.get( "'.Yii::$app->urlManager->createUrl('subtype/list?type=').'" + type, function( data ) {
                      $( "select#subtype" ).html( data );
                    });
                    ',
    ])->label('Какое мероприятие вы хотите запланировать?'); ?>


    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
        'layout' => '{input}{picker}',
        'value' => date('d-m-Y H:i'),
        'pluginOptions' => [
            'autoclose'=>true
        ]
    ]); ?>

    <?= $form->field($model, 'city')->widget(Typeahead::classname(), [
        'options' => [
            'placeholder' => 'Введите название'
        ],
        'pluginOptions' => [
            'highlight' => true
        ],
        'dataset' => [
            [
                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('name')",
                'display' => 'name',
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
    echo $form->field($model, 'subtype_id')->dropDownList([], [
        'prompt' => 'Выбрать...',
        'id' => 'subtype'
    ]);
    ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'initialPreview' => $thumb,
            'initialPreviewAsData' => true,
            'allowedFileExtensions' => ['jpg', 'gif', 'png'],
            'browseClass' => 'btn btn-success',
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
            'showUpload' => false
        ]
    ]) ?>

    <?php if ($model->isNewRecord) {
        echo $form->field($model, 'accept')->checkbox([
            'label' => 'Я согласен с ' . Html::a('политикой обработки конфиденциальных данных', ['page/policy'], [
                    'target' => '_blank'
                ])
        ]);
    } ?>


    <div class="form-group">
        <?php $createMessage = Yii::$app->user->identity->isAdmin ? 'Создать мероприятие' : 'Отправить мероприятие администратору сайта';?>
        <?= Html::submitButton($model->isNewRecord ? $createMessage : 'Обновить мероприятие', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

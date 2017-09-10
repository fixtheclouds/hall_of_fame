<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Report */
/* @var $form yii\widgets\ActiveForm */

$thumbs = [];

if ($model->getReportPhotos()) {
    foreach ($model->getReportPhotos()->all() as $photo) {
        if (file_exists($photo->getPhotoPath())) {
            $thumbs[] = \Yii::$app->thumbnail->url($photo->getPhotoPath(), [
                'thumbnail' => [
                    'width' => 300,
                    'height' => 300,
                    'mode' => \Imagine\Image\ImageInterface::THUMBNAIL_INSET
                ]
            ]);
        }
    }
}

?>

<div class="report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ])->label(false) ?>

    <?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'multiple' => true
        ],
        'pluginOptions' => [
            'initialPreview' => $thumbs,
            'initialPreviewAsData' => true,
            'allowedFileExtensions' => ['jpg', 'gif', 'png']
        ]
    ])->label('Добавить фотографии к отчету    <p class="text-muted">
        <small>Для загрузки нескольких файлов удерживайте клавишу CTRL в окне выбора файлов</small>
    </p>') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Отправить отчет модератору' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

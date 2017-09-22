<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\Event;
use kartik\typeahead\Typeahead;

/* @var $this yii\web\View */
/* @var $model common\models\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => [$this->context->action->id],
        'method' => 'get',
        'layout' => 'horizontal'
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

    <div class="form-group">
        <div class="col-xs-12">
            <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Сбросить', [$this->context->action->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

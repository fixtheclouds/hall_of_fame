<?php

/*
 * Override dektrium view
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\typeahead\Typeahead;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('user', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'profile-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ]); ?>

                <?= $form->field($model, 'name') ?>

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

                <?= $form->field($userModel, 'email') ?>

                <?= $form->field($model, 'phone') ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
                        <br>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

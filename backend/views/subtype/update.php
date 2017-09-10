<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subtype */

$this->title = 'Обновить подтип: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subtype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

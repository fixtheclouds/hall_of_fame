<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subtype */

$this->title = 'Create Subtype';
$this->params['breadcrumbs'][] = ['label' => 'Subtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subtype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

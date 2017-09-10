<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ScoreSystem */

$this->title = 'Обновить правило системы начисления баллов : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Score Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="score-system-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

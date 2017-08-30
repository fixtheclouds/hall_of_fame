<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ScoreSystem */

$this->title = 'Добавить правило системы начисления баллов';
$this->params['breadcrumbs'][] = ['label' => 'Score Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="score-system-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

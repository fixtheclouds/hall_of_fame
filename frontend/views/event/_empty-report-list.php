<?php
use yii\helpers\Html;
?>

<h3>Ещё не подано ни одного отчёта.</h3>

<?php if (!$model->isArchived()) {
    echo Html::a('Подать отчёт', [
        'report/create', 'event_id' => $model->id
    ], [
        'class' => 'btn btn-primary',
        'data-pjax' => 0
    ]);
}
?>

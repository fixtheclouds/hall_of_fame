<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчеты о проделанной работе';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'event_id',
            'content:ntext',
            [
                'attribute' => 'status',
                'label' => 'Статус',
                'content' => function($data) {
                    return $data->humanStatus();
                }
            ],
            'user.profile.name',
            // 'deleted_at',
            // 'created_at',
            // 'updated_at',

            ['class' => ActionColumn::className(), 'template' => '{view} {delete}' ],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
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
            [
              'attribute' => 'content',
                'label' => 'Содержание',
                'content' => function($data) {
                    return StringHelper::truncate(strip_tags($data->content), 50, '...');
                }
            ],
            [
                'attribute' => 'status',
                'label' => 'Статус',
                'content' => function($data) {
                    return $data->humanStatus();
                }
            ],
            [
                'attribute' => 'user',
                'label' => 'Автор',
                'content' => function($data){
                    return $data->user->profile->name;
                },
            ],

            ['class' => ActionColumn::className(), 'template' => '{view} {delete}' ],
        ],
    ]); ?>
</div>

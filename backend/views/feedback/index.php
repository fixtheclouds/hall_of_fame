<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email',
            [
                'attribute' => 'content',
                'content' => function($data){
                    return \yii\helpers\StringHelper::truncate($data->content, 30);
                },
            ],
            [
                'attribute' => 'state',
                'content' => function($data){
                    return $data->humanState();
                },
            ],
            'created_at:datetime',

            ['class' => ActionColumn::className(), 'template' => '{view} {delete}' ],
        ],
    ]); ?>
</div>

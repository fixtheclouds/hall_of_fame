<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Гордость';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user',
                'label' => 'Автор',
                'content' => function($data){
                    return $data->user->profile->name;
                },
            ],
            'created_at:datetime',
            [
                    'attribute' => 'state',
                    'content' => function($data){
                        return $data->humanState();
                    },
            ],
            [
                'attribute' => 'content',
                'content' => function($data){
                    return \yii\helpers\StringHelper::truncate($data->content, 30);
                },
            ],

            ['class' => ActionColumn::className(), 'template' => '{view} {delete}' ],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ScoreSystemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Система начисления баллов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="score-system-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить правило', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'module',
                'content' => function($data) {
                    return $data->humanModule();
                }
            ],
            [
                'attribute' => 'action',
                'content' => function($data) {
                    return $data->humanAction();
                }
            ],
            'amount',

            ['class' => ActionColumn::className(), 'template' => '{update} {delete}' ],
        ],
    ]); ?>
</div>

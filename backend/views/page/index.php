<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',

            'title',
            'alias',
            [
                'attribute' => 'content',
                'content' => function($data) {
                    return StringHelper::truncate(strip_tags($data->content), 50, '...');
                }
            ],
            [
                'attribute' => 'user',
                'label' => 'Автор',
                'content' => function($data){
                    return $data->user->profile->name;
                },
            ],
            [
                'class' => ActionColumn::className(),
            ]
        ],
    ]); ?>
</div>

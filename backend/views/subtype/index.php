<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubtypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подтипы мероприятий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subtype-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать подтип', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'type',
                'content' => function($data) {
                    return $data->humanType();
                }
            ],
            ['class' => ActionColumn::className(), 'template' => '{update} {delete}' ],
        ],
    ]); ?>
</div>

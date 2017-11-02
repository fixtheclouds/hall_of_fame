<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form event-item panel panel-default">

    <h2>Напишите нам</h2>
    <blockquote>
        Участвуйте в создании третьего тома книги, в которую войдут биографии почетных граждан
        <a href="/static/Prilozhenie_1_Spisok_Pg.xlsx" download="">19 муниципальных образований Ростовской области</a>.
        Эта книга - наша гордость. Память о тех, кто делает знаменитой нашу малую
        Родину. <br>Напишите историю своего товарища, отца, дедушки или любого другого почетного гражданина и мы опубликуем
        ее в новом томе книги. Вы можете сами формировать летопись нашей истории.
    </blockquote>
    <?php $form = ActiveForm::begin();
    $form->action = ['message/create'];
    ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>

    <?= $form->field( $model, 'accept' )->checkbox([
        'label' => 'Я согласен с ' . Html::a('политикой обработки персональных данных', ['page/policy'], [
                'target' => '_blank'
            ])
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

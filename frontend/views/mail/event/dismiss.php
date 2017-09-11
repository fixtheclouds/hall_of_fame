<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Ваше мероприятие от <?= \Yii::$app->formatter->asDatetime($model->created_at) ?> отклонено администратором портала
    <?= \Yii::$app->name ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Возможные причины:
</p>
<ul style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; padding: 0;">
    <li>Информационный спам, содержание рекламного характера</li>
    <li>Повтор уже опубликованных на портале материалов</li>
    <li>Нецензурная лексика и запрещенный контент</li>
    <li>Нарушение прав и интересов граждан и юридических лиц или требований законодательства РФ</li>
</ul>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Пожалуйста, пересмотрите содержание публикации и попробуйте создать её заново.
</p>

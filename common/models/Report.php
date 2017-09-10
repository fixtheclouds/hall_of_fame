<?php

namespace common\models;

use frontend\traits\TrackScore;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;


/**
 * This is the model class for table "report".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $content
 * @property string $status
 * @property integer $user_id
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property Event $event
 * @property ReportPhoto[] $reportPhotos
 */
class Report extends \yii\db\ActiveRecord
{
    use \common\traits\TrackScore;

    const HUMAN_STATUS = [
        'pending' => 'На рассмотрении',
        'published' => 'Опубликован',
        'dismissed' => 'Отклонен'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @return string
     */
    public static function moduleName() {
        return 'отчет';
    }

    /**
     * @var UploadedFile
     */
    public $images;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['images'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 10],
            [['event_id', 'user_id'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'ID мероприятия',
            'content' => 'Содержание',
            'status' => 'Статус',
            'user_id' => 'ID пользователя',
            'deleted_at' => 'Удалено',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'images' => 'Изображения'
        ];
    }

    /**
     * Получить данные пользователя
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Получить связанное мероприятие
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * Получить фото мероприятия
     * @return \yii\db\ActiveQuery
     */
    public function getReportPhotos()
    {
        return $this->hasMany(ReportPhoto::className(), ['report_id' => 'id']);
    }

    public function humanStatus() {
        return static::HUMAN_STATUS[$this->status];
    }
}

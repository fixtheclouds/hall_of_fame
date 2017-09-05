<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $type
 * @property string $date
 * @property integer $city
 * @property integer $subtype_id
 * @property string $content
 * @property string $place
 * @property string $person_name
 * @property string $photo
 * @property string $status
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * Служебное поле для изображения
     * @var
     */
    public $image;

    const HUMAN_STATES = [
        'pending' => 'На рассмотрении',
        'dismissed' => 'Отклонено',
        'published' => 'Опубликовано'
    ];

    const HUMAN_TYPES = [
        'memory' => 'Память',
        'legacy' => 'Наследие'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * Типы
     * @var array
     */
    public static $types = ['memory' => 'Память', 'legacy' => 'Наследие'];

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }

    /**
     * Получить связанный отчет
     * @return \yii\db\ActiveQuery
     */
    public function getReports() {
        return $this->hasMany(Report::className(), ['event_id' => 'id']);
    }

    /**
     * Получить подптип
     * @return \yii\db\ActiveQuery
     */
    public function getSubtype() {
        return $this->hasOne(Subtype::className(), ['id' => 'subtype_id']);
    }

    /**
     * Отобразить тип на русском
     * @return string
     */
    public function humanType() {
        return self::HUMAN_TYPES[$this->type];
    }

    /**
     * Отобразить состояние на русском
     * @return string
     */
    public function humanState() {
        return self::HUMAN_STATES[$this->status];
    }

    public function isArchived() {
        return strtotime($this->date) < time();
    }

    /**
     * Возвращает true, если мероприятие создано
     * текущим пользователем
     * @return bool
     */
    public function isMine() {
        return $this->user_id === Yii::$app->user->id;
    }

    /**
     * Возвращает true, если мероприятие имеет
     * отчет от текущего пользователя
     * @return bool
     */
    public function hasMyReport() {
        return $this->getReports()->andWhere(['user_id' => Yii::$app->user->id])->exists();
    }

    /**
     * @return $this
     */
    public function getMyReport() {
        return $this->getReports()->andWhere(['user_id' => Yii::$app->user->id])->one();
    }

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
            [['type', 'date', 'place', 'city', 'subtype_id', 'person_name', 'content'], 'required'],
            [['date'], 'safe'],
            [['subtype_id'], 'integer'],
            [['content', 'photo'], 'string'],
            [['type', 'person_name', 'city'], 'string', 'max' => 256],
            [['place'], 'string', 'max' => 512],
            [['status'], 'string', 'max' => 255],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png'],
            [['image'], 'file', 'maxSize' => 1024 * 1024 * 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип мероприятия',
            'date' => 'Дата проведения',
            'city' => 'Город',
            'subtype_id' => 'Подтип мероприятия',
            'content' => 'Подробное описание вашего мероприятия',
            'place' => 'Место',
            'person_name' => 'ФИО гражданина, которому посвящено мероприятие',
            'photo' => 'Фотография мероприятия',
            'status' => 'Статус',
            'image' => 'Фотография мероприятия'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return string
     */
    public function getPhotoPath() {
        return \Yii::$app->basePath . '/web/uploads/event/' . $this->photo;
    }
}

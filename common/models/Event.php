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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * Types
     * @var array
     */
    public static $types = ['memory' => 'Память', 'legacy' => 'Наследие'];

    public static function find()
    {
        return new EventQuery(get_called_class());
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
            'type' => 'Тип',
            'date' => 'Дата проведения',
            'city' => 'Город',
            'subtype_id' => 'Тип мероприятия',
            'content' => 'Содержание',
            'place' => 'Место',
            'person_name' => 'ФИО гражданина',
            'photo' => 'Фотография мероприятия',
            'status' => 'Статус'
        ];
    }
}

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
 * @property integer $city_id
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
            [['type', 'date', 'place', 'city_id', 'subtype_id', 'person_name', 'content', 'photo'], 'required'],
            [['date'], 'safe'],
            [['city_id', 'subtype_id'], 'integer'],
            [['content', 'photo'], 'string'],
            [['type', 'person_name'], 'string', 'max' => 256],
            [['place'], 'string', 'max' => 512],
            [['status'], 'string', 'max' => 255],
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
            'city_id' => 'Город',
            'subtype_id' => 'Тип мероприятия',
            'content' => 'Содержание',
            'place' => 'Место',
            'person_name' => 'ФИО гражданина',
            'photo' => 'Фото',
            'status' => 'Статус'
        ];
    }
}

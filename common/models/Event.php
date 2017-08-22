<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
    public static $types = ['Память', 'Встреча'];

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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
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

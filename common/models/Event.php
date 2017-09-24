<?php

namespace common\models;

use rmrevin\yii\ulogin\Exception;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\AttributeBehavior;

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
class Event extends ActiveRecord
{
    use \common\traits\Trackable;
    use \common\traits\Imageable;
    /**
     * Служебное поле для изображения
     * @var
     */
    public $image;

    /**
     * Служебное поле для подтверждения
     * @var
     */
    public $accept;

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
     * @return string
     */
    public static function moduleName() {
        return 'мероприятие';
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
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date'],
                ],
                'value' => function () {
                    return date('Y-m-d H:i:s', strtotime($this->date));
                },
            ],
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
            [['image'], 'file', 'extensions' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 10],
            [
                'accept',
                'compare',
                'operator' => '==',
                'compareValue' => true,
                'message' => 'Вы должны принять соглашение.',
                'on' => 'create'
            ],
            [['image'], 'required', 'when' => function($model) {
                return empty($model->photo);
            }]
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
            'image' => 'Фотография мероприятия',
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
     * @return \yii\db\ActiveQuery
     */
    public function getEventUsers() {
        return $this->hasMany(EventUser::className(), ['event_id' => 'id']);
    }

    /**
     * @param $user_id
     * @return bool
     */
    public function isAppliedBy($user_id) {
        return $this->getEventUsers()->andWhere(['user_id' => $user_id])->exists();
    }
}

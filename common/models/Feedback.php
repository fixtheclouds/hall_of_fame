<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $content
 * @property string $state
 * @property integer $created_at
 */
class Feedback extends \yii\db\ActiveRecord
{

    /**
     * Служебное поле для подтверждения
     * @var
     */
    public $accept;

    const HUMAN_STATES = [
        'pending' => 'Новое',
        'read' => 'Прочитано'
    ];

    public function humanState()
    {
        return static::HUMAN_STATES[$this->state];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['created_at'], 'integer'],
            [['email', 'name', 'state'], 'string', 'max' => 255],
            [['content', 'email', 'name'], 'required'],
            [['email'], 'email'],
            [
                'accept',
                'compare',
                'operator' => '==',
                'compareValue' => true,
                'message' => 'Вы должны принять соглашение.'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'ФИО',
            'content' => 'Текст сообщения',
            'state' => 'Статус',
            'created_at' => 'Создано',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new FeedbackQuery(get_called_class());
    }

    /**
     * @return $this
     */
    public static function fresh()
    {
        return static::find()->unread()->orderBy('created_at DESC')->limit(5);
    }

    /**
     * @return int|string
     */
    public static function getUnreadCount() {
        return static::find()->unread()->count();
    }
}

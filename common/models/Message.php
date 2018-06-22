<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $deleted_at
 * @property string $state
 * @property string $content
 *
 * @property User $user
 */
class Message extends \yii\db\ActiveRecord
{
    use \common\traits\Trackable;

    /**
     * Acceptance field
     * @var
     */
    public $accept;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @return string
     */
    public static function moduleName() {
        return 'сообщение';
    }

    const HUMAN_STATES = [
        'pending' => 'Новое',
        'read' => 'Прочитано'
    ];

    /**
     * Retrieve human readable state for current record
     * @return mixed
     */
    public function humanState()
    {
        return static::HUMAN_STATES[$this->state];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }

    /**
     * Get latest unread records
     * @return $this
     */
    public static function fresh()
    {
        return static::find()->unread()->orderBy('created_at DESC')->limit(5);
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
            ],
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
            [['content'], 'required'],
            [['user_id'], 'integer'],
            [['content'], 'string'],
            [['state'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [
                'accept',
                'compare',
                'operator' => '==',
                'compareValue' => true,
                'message' => 'Вы должны принять соглашение.'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'created_at' => 'Создано',
            'state' => 'Статус',
            'content' => 'Текст',
        ];
    }

    /**
     * Get associated user
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Get unread messages count
     * @return int|string
     */
    public static function getUnreadCount() {
        return static::find()->unread()->count();
    }
}

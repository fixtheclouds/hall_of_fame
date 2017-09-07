<?php

namespace common\models;

use frontend\traits\TrackScore;
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
    use \common\traits\TrackScore;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

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
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }

    /**
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
            'content' => 'Текст сообщения',
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
     * @return int|string
     */
    public static function getUnreadCount() {
        return static::find()->unread()->count();
    }
}

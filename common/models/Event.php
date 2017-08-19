<?php

namespace common\models;

use Yii;

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
 * @property integer $image_id
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['date', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['city_id', 'subtype_id', 'image_id'], 'integer'],
            [['content'], 'string'],
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
            'type' => 'Type',
            'date' => 'Date',
            'city_id' => 'City ID',
            'subtype_id' => 'Subtype ID',
            'content' => 'Content',
            'place' => 'Place',
            'person_name' => 'Person Name',
            'image_id' => 'Image ID',
            'status' => 'Status',
            'deleted_at' => 'Deleted At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

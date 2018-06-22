<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subtype".
 *
 * @property integer $id
 * @property string $name
 */
class Subtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subtype';
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new SubtypeQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'type' => 'Тип'
        ];
    }

    /**
     * Get human readable type
     * @return mixed
     */
    public function humanType() {
        return Event::HUMAN_TYPES[$this->type];
    }
}

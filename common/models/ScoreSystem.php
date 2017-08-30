<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "score_system".
 *
 * @property integer $id
 * @property string $module
 * @property string $action
 * @property integer $amount
 */
class ScoreSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'score_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'integer'],
            [['module', 'action'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Модуль',
            'action' => 'Действие',
            'amount' => 'Количество',
        ];
    }
}

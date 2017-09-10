<?php

namespace common\models;

use Yii;
use common\models\Score;

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

    const MODULES = [
        'event' => 'Мероприятия',
        'report' => 'Отчеты',
        'message' => 'Сообщения'
    ];

    const ACTIONS = [
        'create' => 'Создание',
        'publish' => 'Публикация'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'score_system';
    }

    public function humanModule()
    {
        return static::MODULES[$this->module];
    }

    public function humanAction()
    {
        return static::ACTIONS[$this->action];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'integer'],
            [['module', 'action'], 'string', 'max' => 255],
            [['module', 'action'], 'unique', 'targetAttribute' => ['module', 'action']]
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
            'amount' => 'Количество баллов',
        ];
    }

    /**
     * @param $module
     * @param $action
     * @return bool
     */
    public static function hasModuleAction($module, $action) {
        return static::find()->andWhere(['module' => $module, 'action' => $action])->exists();
    }

    /**
     * @param $module
     * @param $action
     * @param $userId
     * @return bool|int|mixed
     */
    public static function createScore($module, $action, $userId) {
        $rule = static::find()->andWhere(['module' => $module, 'action' => $action])->one();
        $amount = $rule->amount;
        $score = new Score();
        $score->user_id = $userId;
        $score->amount = $amount;
        if ($score->save()) {
            return $score->amount;
        };

        return false;
    }
}

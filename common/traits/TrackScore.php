<?php
/**
 * Created by PhpStorm.
 * User: ekz
 * Date: 9/6/17
 * Time: 11:01 PM
 */

namespace common\traits;

use common\models\ScoreSystem;


trait TrackScore
{
    /**
     * @param $action
     * @return bool
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            if (ScoreSystem::hasModuleAction(static::tableName(), 'create')) {
                $userId = $this->user_id ? $this->user_id : \Yii::$app->user->id;
                ScoreSystem::createScore(static::tableName(), 'create', $userId);
                return true;
            }
        } else if (isset($changedAttributes['status']) && $this->hasProperty('status') && $this->status == 'published') {
            if (ScoreSystem::hasModuleAction(static::tableName(), 'publish') && $this->hasProperty('user_id')) {
                ScoreSystem::createScore(static::tableName(), 'publish', $this->user_id);
                return true;
            }
        }

        return false;
    }
}

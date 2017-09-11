<?php
/**
 * Created by PhpStorm.
 * User: ekz
 * Date: 9/6/17
 * Time: 11:01 PM
 */

namespace common\traits;

use common\models\ScoreSystem;

trait Trackable
{

    /**
     * @param $action
     * @return bool
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $score = NULL;
        if ($insert) {
            if (ScoreSystem::hasModuleAction(static::tableName(), 'create')) {
                $userId = $this->user_id ? $this->user_id : \Yii::$app->user->id;
                $score = ScoreSystem::createScore(static::tableName(), 'create', $userId);
            }
            return $this->sendMail('create', $score);
        } else if (isset($changedAttributes['status']) && $this->hasProperty('status')) {
            if ($this->status == 'published') {
                if (ScoreSystem::hasModuleAction(static::tableName(), 'publish') && $this->hasProperty('user_id')) {
                    $score = ScoreSystem::createScore(static::tableName(), 'publish', $this->user_id);
                }
                return $this->sendMail('publish', $score);
            } else if ($this->status == 'dismissed') {
                return $this->sendMail('dismiss');
            }
        }

        return false;
    }

    /**
     * @param $action
     * @param null $score
     * @return bool
     */
    protected function sendMail($action, $score = NULL) {
        $view = '@frontend/views/mail/' . static::tableName() . '/' . $action;
        $user = $this->user ? $this->user : \Yii::$app->user->identity;
        $subject = $this->composeSubject($action);
        $params = [
            'score' => $score,
            'user' => $user,
            'model' => $this
        ];
        \Yii::$app->mailer->htmlLayout = '@dektrium/user/views/mail/layouts/html';
        return \Yii::$app->mailer->compose([
            'html' => $view,
        ], $params)
            ->setTo($user->email)
            ->setFrom(\Yii::$app->params['adminEmail'])
            ->setSubject($subject)
            ->send();
    }

    protected function composeSubject($action) {
        $module = static::moduleName();
        $verb = '';
        switch ($action) {
            case 'create': $verb = 'создан';
                break;
            case 'publish': $verb = 'опубликован';
                break;
            case 'dismiss': $verb = 'отклонен';
                break;
            default: break;
        }
        switch ($module) {
            case 'мероприятие':
            case 'сообщение':
                $verb .= 'о';
                break;
            default: break;
        }
        return \Yii::$app->name . ': Ваше ' . $module . ' ' . $verb;
    }
}

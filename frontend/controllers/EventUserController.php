<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use common\models\EventUser;
use yii\filters\VerbFilter;

class EventUserController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['apply', 'unapply'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Apply to event
     * @param $event_id
     * @return \yii\web\Response
     */
    public function actionApply($event_id)
    {
        $eventUser = \Yii::createObject(EventUser::className());
        $eventUser->event_id = $event_id;
        if ($eventUser->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Вы приняли участие в мероприятиии');
        } else {
            \Yii::$app->getSession()->setFlash('error', 'Возникла ошибка при создании привязки');
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Dismiss event participation
     * @param $event_id
     * @return false|int
     */
    public function actionUnapply($event_id) {
        $result = EventUser::find()->andWhere(['event_id' => $event_id])
            ->andWhere(['user_id' => \Yii::$app->user->id])->one()->delete();

        if ($result) {
            \Yii::$app->getSession()->setFlash('success', 'Вы отказались участвовать в мероприятиии');
        } else {
            \Yii::$app->getSession()->setFlash('error', 'Возникла ошибка при удалении привязки');
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

}

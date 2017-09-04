<?php

namespace frontend\controllers;

use dektrium\user\controllers\RecoveryController as BaseController;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;

class RecoveryController extends BaseController
{
    /** @inheritdoc */
    public function behaviors()
    {
        $behaviors = [
            'access' => [
                'rules' => [
                    ['allow' => true, 'actions' => ['resend-password'], 'roles' => ['@']]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'resend-password' => ['post'],
                ],
            ],
        ];
        return ArrayHelper::merge($behaviors, parent::behaviors());
    }

    /**
     * @return \yii\web\Response
     */
    public function actionResendPassword() {
        $model = $this->finder->findUserById(\Yii::$app->user->id);
        if ($model->resendPassword()) {
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Новый пароль отправлен на ваш E-mail'));
        } else {
            \Yii::$app->getSession()->setFlash('error', \Yii::t('user', 'Произошла ошибка при создании нового пароля. 
            Обратитесь к администратору.'));
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }
}
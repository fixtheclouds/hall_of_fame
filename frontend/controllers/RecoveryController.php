<?php

namespace frontend\controllers;

use dektrium\user\controllers\RecoveryController as BaseController;
use dektrium\user\models\Token;
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

    /**
     * Сброс пароля
     * @param int $id
     * @param string $code
     * @return string
     */
    public function actionReset($id, $code)
    {
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var Token $token */
        $token = $this->finder->findToken(['user_id' => $id, 'code' => $code, 'type' => Token::TYPE_RECOVERY])->one();
        $event = $this->getResetPasswordEvent($token);

        $this->trigger(self::EVENT_BEFORE_TOKEN_VALIDATE, $event);

        if ($token === null || $token->isExpired || $token->user === null) {
            $this->trigger(self::EVENT_AFTER_TOKEN_VALIDATE, $event);
            \Yii::$app->session->setFlash(
                'danger',
                \Yii::t('user', 'Recovery link is invalid or expired. Please try requesting a new one.')
            );
            return $this->render('@dektrium/user/views/message', [
                'title'  => \Yii::t('user', 'Invalid or expired link'),
                'module' => $this->module,
            ]);
        }

        if ($token->user->resendPassword()) {
            $this->trigger(self::EVENT_AFTER_RESET, $event);
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Новый пароль отправлен на ваш E-mail'));
        } else {
            \Yii::$app->getSession()->setFlash('error', \Yii::t('user', 'Произошла ошибка при создании нового пароля. 
            Обратитесь к администратору.'));
        }
        return $this->render('@dektrium/user/views/message', [
            'title'  => 'Пароль успешно сброшен',
            'module' => $this->module,
        ]);
    }
}

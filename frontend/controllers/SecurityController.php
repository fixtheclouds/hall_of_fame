<?php
namespace frontend\controllers;

use dektrium\user\controllers\SecurityController as BaseController;
use dektrium\user\models\LoginForm;

class SecurityController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
            return $this->goBack('/account');
        }

        return $this->render('@dektrium/user/views/security/login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }
}

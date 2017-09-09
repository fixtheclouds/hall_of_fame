<?php

namespace frontend\controllers;

use dektrium\user\controllers\RegistrationController as BaseController;
use rmrevin\yii\ulogin\AuthAction;
use frontend\models\RegistrationForm;
use frontend\models\SocialAccount;
use yii\helpers\ArrayHelper;

/**
 * Class RegistrationController
 * @package frontend\controllers\RegistrationController
 */
class RegistrationController extends BaseController
{

    public $enableCsrfValidation = false;

    /** @inheritdoc */
    public function behaviors()
    {
        $behaviors = [
            'access' => [
                'rules' => [
                    ['allow' => true, 'actions' => ['ulogin'], 'roles' => ['?']]
                ]
            ]
        ];
        return ArrayHelper::merge($behaviors, parent::behaviors());
    }

    /**
     * @return array
     */
    public function actions() {
        return [
            'ulogin' => [
                'class' => AuthAction::className(),
                'successCallback' => [$this, 'uloginSuccessCallback'],
                'errorCallback' => function($data){
                    \Yii::error($data['error']);
                },
            ]
        ];
    }

    public function uloginSuccessCallback($attributes)
    {
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        $authKey = SocialAccount::findOne([
            'provider' => $attributes['network'],
            'client_id' => $attributes['uid']
        ]);

        if ($authKey) {
            // Авторизация
            if (\Yii::$app->user->isGuest) {
                \Yii::$app->user->login($authKey->user,  $this->module->rememberFor);
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Вы уже авторизованы на портале.');
            }
            return $this->redirect(['/my_account']);
        } else {
            // Регистрация
            $userParams = [
                'name' => implode(' ', [$attributes['first_name'], $attributes['last_name']]),
                'email' => $attributes['email'],
                'city' => isset($attributes['city']) ? $attributes['city'] : NULL,
                'phone' => isset($attributes['phone']) ? $attributes['phone'] : NULL
            ];

            /** @var RegistrationForm $regFormModel */
            $regFormModel = \Yii::createObject(RegistrationForm::className());
            $event = $this->getFormEvent($regFormModel);

            $this->trigger(self::EVENT_BEFORE_REGISTER, $event);
            $this->performAjaxValidation($regFormModel);

            $regFormModel->load($userParams, '');
            $userModel = $regFormModel->register();
            if ($userModel) {
                $this->trigger(self::EVENT_AFTER_REGISTER, $event);
                $this->createAccount($attributes, $userModel->id);
                \Yii::$app->user->login($userModel,  $this->module->rememberFor);
                \Yii::$app->getSession()->setFlash('success', 'Вы успешно зарегистрированы и авторизованы');
                return $this->redirect(['/my_account']);
            } else {
                $errors = $regFormModel->getErrors();
                if (!empty($errors['email'])) {
                    \Yii::$app->getSession()->setFlash('danger', implode(';', $errors['email']));
                } else {
                    \Yii::$app->getSession()->setFlash('danger', 'Возникли ошибки при создании профиля');
                }
            }
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * @param $attributes
     * @param $userID
     * @return mixed
     */
    protected function createAccount($attributes, $userID)
    {
        $authKey = \Yii::createObject(SocialAccount::className());
        $authKey->provider = $attributes['network'];
        $authKey->client_id = $attributes['uid'];
        $authKey->user_id = $userID;
        return $authKey->save();
    }
}

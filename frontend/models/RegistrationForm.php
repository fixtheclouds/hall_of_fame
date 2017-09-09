<?php
namespace frontend\models;

use common\models\Profile;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use common\models\User;

class RegistrationForm extends BaseRegistrationForm
{
    /**
     * Add a new field
     * @var string
     */
    public $name;

    /**
     * @var
     */
    public $city;

    /**
     * @var
     */
    public $phone;

    /**
     * @inheritdoc
     */
    public function rules() {
        $rules = parent::rules();
        unset($rules['usernameRequired']);
        $rules[] = ['name', 'required'];
        $rules[] = [['city', 'phone', 'name'], 'string'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['name'] = \Yii::t('user', 'ФИО');
        $labels['city'] = 'Город';
        $labels['phone'] = 'Телефон';
        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function loadAttributes(User $user)
    {
        $user->setAttributes([
            'email'    => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);
        /** @var Profile $profile */
        $profile = \Yii::createObject(Profile::className());
        $profile->setAttributes([
            'name' => $this->name,
            'city' => $this->city,
            'phone' => $this->phone
        ]);
        $user->setProfile($profile);
    }

    /**
     * @return bool|User
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = \Yii::createObject(User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        \Yii::$app->session->setFlash(
            'info',
            \Yii::t(
                'user',
                'Your account has been created and a message with further instructions has been sent to your email'
            )
        );

        return $user;
    }
}

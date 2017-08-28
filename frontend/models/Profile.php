<?php
/**
 * Override dektrium Profile model
 */
namespace frontend\models;

use dektrium\user\models\Profile as BaseProfile;

class Profile extends BaseProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['city', 'phone'], 'string'];
        $rules[] = [['city', 'phone'], 'required'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'           => \Yii::t('user', 'Name'),
            'phone'          => 'Номер телефона',
            'city'           => 'Город'
        ];
    }

    /**
     * Получение URL аватарки
     * @return string
     */
    public function getAvatarUrl() {
        $path = \Yii::$app->homeUrl  . 'uploads/profile/' . $this->photo;
        $basePath = \Yii::$app->basePath . 'web/uploads/profile' . $this->photo;
        if (!$this->photo || !file_exists($basePath)) {
            return \Yii::$app->homeUrl . 'images/'  . 'default_avatar.jpg';
        }
        return $path;
    }
}

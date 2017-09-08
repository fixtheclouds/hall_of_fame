<?php
/**
 * Override dektrium Profile model
 */
namespace common\models;

use dektrium\user\models\Profile as BaseProfile;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;

class Profile extends BaseProfile
{

    public $image;
    public $crop_info;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['city', 'phone'], 'string'];
        $rules[] = [['city', 'phone', 'name'], 'required'];
        $rules[] = [
            'image',
            'image',
            'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
            'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
        ];
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
    public function getAvatarUrl($full = false) {
        $path = \Yii::$app->homeUrl  . 'uploads/profile/' . $this->photo;
        $basePath = \Yii::$app->basePath . '/web/uploads/profile/' . $this->photo;
        if (!$this->photo || !file_exists($basePath)) {
            $defaultPath = '/images/default_avatar.jpg';
            return $full ? \Yii::$app->basePath . '/web/' . $defaultPath : \Yii::$app->homeUrl . $defaultPath;
        } else if ($full) {
            return $basePath;
        }
        return $path;
    }
}

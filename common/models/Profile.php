<?php
/**
 * Override dektrium Profile model
 */
namespace common\models;

use dektrium\user\models\Profile as BaseProfile;


class Profile extends BaseProfile
{
    use \common\traits\Imageable;

    public $image;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['city', 'phone'], 'string'];
        $rules[] = [['name', 'city', 'phone'], 'required'];
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
}

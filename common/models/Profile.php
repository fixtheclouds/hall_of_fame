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
        $rules[] = [['city', 'phone'], 'required'];
        $rules[] = [
            'image',
            'image',
            'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
            'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
        ];
        $rules[] = [['crop_info'], 'safe'];
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
        $basePath = \Yii::$app->basePath . '/web/uploads/profile/' . $this->photo;
        if (!$this->photo || !file_exists($basePath)) {
            return \Yii::$app->homeUrl . 'images/'  . 'default_avatar.jpg';
        }
        return $path;
    }

    public function afterSave($insert, $changedAttributes)
    {
        // open image
        $image = Image::getImagine()->open($this->image->tempName);

        // rendering information about crop of ONE option
        $cropInfo = Json::decode($this->crop_info)[0];
        $cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
        $cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
        $cropInfo['x'] = $cropInfo['x']; //begin position of frame crop by X
        $cropInfo['y'] = $cropInfo['y']; //begin position of frame crop by Y

        //delete old images
        $oldImages = FileHelper::findFiles(Yii::getAlias('@path/to/save/image'), [
            'only' => [
                $this->id . '.*',
                'thumb_' . $this->id . '.*',
            ],
        ]);
        for ($i = 0; $i != count($oldImages); $i++) {
            @unlink($oldImages[$i]);
        }

        //saving thumbnail
        $newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
        $cropSizeThumb = new Box(200, 200); //frame size of crop
        $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
        $pathThumbImage = Yii::getAlias('@path/to/save/image')
            . '/thumb_'
            . $this->id
            . '.'
            . $this->image->getExtension();

        $image->resize($newSizeThumb)
            ->crop($cropPointThumb, $cropSizeThumb)
            ->save($pathThumbImage, ['quality' => 100]);

        //saving original
        $this->image->saveAs(
            Yii::getAlias('@path/to/save/image')
            . '/'
            . $this->id
            . '.'
            . $this->image->getExtension()
        );
    }
}

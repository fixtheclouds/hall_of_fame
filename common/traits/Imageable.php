<?php
/**
 * Trait for handling images
 */

namespace common\traits;


trait Imageable
{
    /**
     * Retrieve path for image
     *
     * @param boolean $absolute use absolute path
     * @return string
     */
    public function getPhotoPath($absolute = true) {
        if ($absolute) {
            return UPLOAD_PATH . $this->photo;
        }
        return \Yii::$app->urlManagerCommon->createUrl('uploads/' . $this->photo);
    }

    /**
     * @return bool
     */
    public function afterDelete()
    {
        parent::afterDelete();


        if ($this->hasProperty('photo') && $this->photo) {
            return $this->removeImage($this->getPhotoPath());
        }
        return false;
    }

    /**
     * Physically remove file
     *
     * @param $path
     * @return bool
     */
    protected function removeImage($path) {
        try {
            unlink($path);
        } catch(Exception $e) {
            return false;
        }
    }
}

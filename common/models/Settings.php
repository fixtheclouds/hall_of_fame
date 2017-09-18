<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $type
 * @property string $section
 * @property string $key
 * @property string $value
 * @property integer $active
 * @property string $created
 * @property string $modified
 */
class Settings extends yii\db\ActiveRecord {
    public $metaKeywords, $metaDescription, $siteTitle;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['metaKeywords', 'metaDescription', 'siteTitle'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ['metaKeywords', 'metaDescription', 'siteTitle'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return ['metaKeywords', 'metaDescription', 'siteTitle'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'metaKeywords' => 'Ключевые слова',
            'metaDescription' => 'Мета-описание',
            'siteTitle' => 'Название портала'
        ];
    }
}

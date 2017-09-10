<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_photo".
 *
 * @property integer $id
 * @property integer $report_id
 * @property string $photo
 *
 * @property Report $report
 */
class ReportPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_id'], 'integer'],
            [['photo'], 'string', 'max' => 512],
            [['report_id'], 'exist', 'skipOnError' => true, 'targetClass' => Report::className(), 'targetAttribute' => ['report_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report_id' => 'Report ID',
            'photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReport()
    {
        return $this->hasOne(Report::className(), ['id' => 'report_id']);
    }

    /**
     * @return string
     */
    public function getPhotoPath() {
        return \Yii::$app->basePath . '/web/uploads/report/' . $this->photo;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: ekz
 * Date: 9/6/17
 * Time: 7:41 PM
 */

namespace frontend\controllers;

use dektrium\user\controllers\ProfileController as BaseController;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\helpers\Json;


class ProfileController extends BaseController
{

    /** @inheritdoc */
    public function behaviors()
    {
        $behaviors = [
            'access' => [
                'rules' => [
                    ['allow' => true, 'actions' => ['upload-avatar'], 'roles' => ['@']]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'upload-avatar' => ['post'],
                ],
            ],
        ];
        return ArrayHelper::merge($behaviors, parent::behaviors());
    }

    public function actionUploadAvatar()
    {
        $model = \Yii::$app->user->identity->profile;
        $image = UploadedFile::getInstance($model, 'image');
        if ($image) {
            $names = explode(".", $image->name);
            $ext = end($names);
            $model->photo = \Yii::$app->security->generateRandomString() . ".{$ext}";
            \Yii::$app->params['uploadPath'] = \Yii::$app->basePath . '/web/uploads/profile/';
            $path = \Yii::$app->params['uploadPath'] . $model->photo;
            $result = $image->saveAs($path) && $model->save(false);
        }
        $response = $result ? ['uploaded' => 'OK'] : ['uploaded' => 'ERROR'];
        echo Json::encode($response);
    }
}

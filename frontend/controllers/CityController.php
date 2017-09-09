<?php

namespace frontend\controllers;

use common\models\City;
use yii\helpers\Json;

class CityController extends \yii\web\Controller
{
    public function actionAutocomplete($query = null)
    {
        $cities = City::find()
            ->filterWhere(['like', 'name', $query])
            ->distinct()
            ->asArray()
            ->all();

        echo Json::encode($cities);
    }

}

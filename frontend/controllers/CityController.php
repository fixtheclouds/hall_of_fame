<?php

namespace frontend\controllers;

use common\models\City;
use yii\helpers\Json;

class CityController extends \yii\web\Controller
{
    public function actionAutocomplete($query = null)
    {
        $cities = City::find()
            ->select(['id as value, concat(name, ", ", region) as label'])
            ->filterWhere(['like', 'name', $query])
            ->distinct()
            ->asArray()
            ->all();

        echo Json::encode($cities);
    }

}

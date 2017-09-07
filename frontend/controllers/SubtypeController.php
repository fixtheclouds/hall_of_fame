<?php

namespace frontend\controllers;

use common\models\Subtype;

class SubtypeController extends \yii\web\Controller
{
    /**
     * @param $type
     */
    public function actionList($type) {
        $subtypes = Subtype::find()->where(['type' => $type])->all();

        return $this->renderPartial('list', ['subtypes' => $subtypes]);
    }

}

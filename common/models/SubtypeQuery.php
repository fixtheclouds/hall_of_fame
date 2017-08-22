<?php
/**
 * Created by PhpStorm.
 * User: unsai
 * Date: 22.08.2017
 * Time: 23:26
 */

namespace common\models;

use yii\db\ActiveQuery;

class SubtypeQuery extends ActiveQuery
{
    public function byType($typeName) {
        return $this->andWhere(['type' => $typeName]);
    }
}
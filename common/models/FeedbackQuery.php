<?php

namespace common\models;

use yii\db\ActiveQuery;

/**
 * Class FeedbackQuery
 * @package common\models
 */
class FeedbackQuery extends ActiveQuery
{
    /**
     * Filter only pending feedback records
     * @return mixed
     */
    public function unread() {
        return $this->andWhere(['state' => 'pending']);
    }
}

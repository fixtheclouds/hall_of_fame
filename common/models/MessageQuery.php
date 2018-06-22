<?php
/**
 * Created by PhpStorm.
 * User: ekz
 * Date: 8/30/17
 * Time: 10:17 PM
 */

namespace common\models;

use yii\db\ActiveQuery;

class MessageQuery extends ActiveQuery
{
    /**
     * Filter only unread messages
     * @return mixed
     */
    public function unread() {
        return $this->andWhere(['state' => 'pending']);
    }
}

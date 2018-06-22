<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[SocialAccount]].
 *
 * @see SocialAccount
 */
class SocialAccountQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return SocialAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SocialAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

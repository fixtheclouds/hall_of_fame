<?php

namespace common\models;

use yii\db\ActiveQuery;


class EventQuery extends ActiveQuery
{
    /**
     * Default scope
     * Exclude deleted events
     */
    public function init()
    {
        $this->andFilterWhere(['is', 'deleted_at', null]);
        parent::init();
    }

    /**
     * Get only active events
     * @param bool $state
     * @return $this
     */
    public function active($state = true)
    {
        $operator = $state ? '>=' : '<';
        return $this->andWhere([$operator, 'DATE(date)', date('Y-m-d')]);
    }

    /**
     * Get events created by specific user
     * @param $id
     * @return $this
     */
    public function byUserId($id)
    {
        return $this->andWhere(['user_id' => $id]);
    }

    /**
     * Get events with report created by specific user
     * @param $id
     * @return $this
     */
    public function withReportFromUser($id)
    {
        return $this->innerJoin('report', 'report.event_id = event.id')
            ->andWhere(['report.user_id' => $id]);
    }
}

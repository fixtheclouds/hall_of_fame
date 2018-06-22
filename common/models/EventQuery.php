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
        $this->andWhere(['is', 'event.deleted_at', null]);
        parent::init();
    }

    /**
     * Filter only published events
     * @return $this
     */
    public function published() {
        return $this->andWhere(['event.status' => 'published']);
    }

    /**
     * Filter only pending events
     * @return $this
     */
    public function pending() {
        return $this->andWhere(['event.status' => 'pending']);
    }

    /**
     * Get only active events
     * @param bool $state
     * @return $this
     */
    public function active($state = true)
    {
        $operator = $state ? '>=' : '<';
        return $this->andWhere([$operator, 'date', date('Y-m-d H:i:s')]);
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

    /**
     * Filter events by type
     * @param $type
     * @return $this
     */
    public function byType($type) {
        return $this->andFilterWhere(['event.type' => $type]);
    }


    /**
     * Get all events to which a specific user applied
     * @param $id
     * @return $this
     */
    public function appliedByUser($id) {
        return $this->innerJoin('event_user', 'event_user.event_id = event.id')
            ->andWhere(['event_user.user_id' => $id]);
    }
}

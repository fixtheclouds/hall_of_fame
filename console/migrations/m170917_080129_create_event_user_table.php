<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event_user`.
 */
class m170917_080129_create_event_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('event_user', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(11)
        ]);

        $this->addForeignKey('fk_event_user_user_id', 'event_user', 'user_id', 'user', 'id');
        $this->addForeignKey('fk_event_user_event_id', 'event_user', 'event_id', 'event', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_event_user_user_id');
        $this->dropForeignKey('fk_event_user_event_id');
        $this->dropTable('event_user');
    }
}

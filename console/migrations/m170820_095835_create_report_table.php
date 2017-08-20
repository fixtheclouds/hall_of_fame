<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reports`.
 */
class m170820_095835_create_report_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('report', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'content' => $this->text(),
            'status' => $this->string()->defaultValue('pending'),
            'user_id' => $this->integer(),
            'deleted_at' => $this->dateTime(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        $this->addForeignKey('fk_event_id', 'report', 'event_id', 'event', 'id');
        $this->addForeignKey('fk_report_user_id', 'report', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_event_id', 'report');
        $this->dropForeignKey('fk_report_user_id', 'event');
        $this->dropTable('report');
    }
}

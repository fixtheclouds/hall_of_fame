<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m170820_141315_create_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
            'state' => $this->string()->defaultValue('pending'),
            'content' => $this->text()
        ]);

        $this->addForeignKey('fk_message_user_id', 'message', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_message_user_id', 'message');
        $this->dropTable('message');
    }
}

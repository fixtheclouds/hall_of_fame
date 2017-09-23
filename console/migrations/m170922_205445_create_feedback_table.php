<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feedback`.
 */
class m170922_205445_create_feedback_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feedback', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'state' => $this->string()->defaultValue('pending'),
            'created_at' => $this->integer(11)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('feedback');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `score_action`.
 */
class m170821_182639_create_score_action_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('score_action', [
            'id' => $this->primaryKey(),
            'module' => $this->string()->notNull(),
            'action' => $this->string()->notNull(),
            'label' => $this->string(),
            'amount' => $this->bigInteger()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('score_action');
    }
}

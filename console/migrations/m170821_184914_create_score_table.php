<?php

use yii\db\Migration;

/**
 * Handles the creation of table `score`.
 */
class m170821_184914_create_score_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('score', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'score_action_id' => $this->integer(),
            'user_id' => $this->integer()
        ]);

        $this->addForeignKey('fk_score_action_id', 'score', 'score_action_id', 'score_action', 'id');
        $this->addForeignKey('fk_score_user_id', 'score', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_score_action_id', 'score');
        $this->dropForeignKey('fk_score_user_id', 'score');
        $this->dropTable('score');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `score`.
 */
class m170829_192814_create_score_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('score', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(11),
            'amount' => $this->bigInteger(),
            'user_id' => $this->integer()
        ]);

        $this->addForeignKey('fk_score_user_id', 'score', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_score_user_id', 'score');
        $this->dropTable('score');
    }
}

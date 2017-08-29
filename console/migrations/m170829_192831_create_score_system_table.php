<?php

use yii\db\Migration;

/**
 * Handles the creation of table `score_system`.
 */
class m170829_192831_create_score_system_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('score_system', [
            'id' => $this->primaryKey(),
            'module' => $this->string(),
            'action' => $this->string(),
            'amount' => $this->bigInteger()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('score_system');
    }
}

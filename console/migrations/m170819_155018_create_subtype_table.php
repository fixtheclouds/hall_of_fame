<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subtype`.
 */
class m170819_155018_create_subtype_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subtype', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subtype');
    }
}

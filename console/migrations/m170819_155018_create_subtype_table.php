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

        $this->addForeignKey('fk_subtype_id', 'event', 'subtype_id', 'subtype', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_subtype_id', 'event');
        $this->dropTable('subtype');
    }
}

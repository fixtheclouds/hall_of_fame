<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 */
class m170819_154256_create_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'type' => $this->string(256)->notNull(),
            'date' => $this->date(),
            'city_id' => $this->integer(),
            'subtype_id' => $this->integer(),
            'content' => $this->text(),
            'place' => $this->string(512),
            'person_name' => $this->string(256),
            'image_id' => $this->integer(),
            'status' => $this->string()->defaultValue('pending'),
            'deleted_at' => $this->dateTime(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('event');
    }
}

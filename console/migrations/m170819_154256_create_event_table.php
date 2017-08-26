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
            'date' => $this->dateTime(),
            'city_id' => $this->integer(),
            'subtype_id' => $this->integer(),
            'content' => $this->text(),
            'place' => $this->string(512),
            'person_name' => $this->string(256),
            'photo' => $this->string(512),
            'status' => $this->string()->defaultValue('pending'),
            'user_id' => $this->integer(),
            'deleted_at' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)
        ]);

        $this->addForeignKey('fk_user_id', 'event', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_user_id', 'event');
        $this->dropTable('event');
    }
}

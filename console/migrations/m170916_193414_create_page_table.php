<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m170916_193414_create_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'title' => $this->string(512)->notNull(),
            'alias' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)
        ]);

        $this->addForeignKey('fk_page_user_id', 'page', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_page_user_id', 'page');
        $this->dropTable('page');
    }
}

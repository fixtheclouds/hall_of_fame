<?php

use yii\db\Migration;

/**
 * Handles the creation of table `report_photo`.
 */
class m170820_100356_create_report_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('report_photo', [
            'id' => $this->primaryKey(),
            'report_id' => $this->integer(),
            'photo' => $this->string(512)
        ]);

        $this->addForeignKey('fk_report_id', 'report_photo', 'report_id', 'report', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_report_id', 'report_photo');
        $this->dropTable('report_photo');
    }
}

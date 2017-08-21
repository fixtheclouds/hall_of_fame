<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Seeds data to Subtype table
 */
class m170820_195306_seed_subtypes extends Migration
{

    public function up()
    {
        $this->addColumn('subtype', 'type', Schema::TYPE_STRING);

        $this->insert('subtype', [
            'name' => 'Вечер памяти',
            'type' => 'Память'
        ]);
        $this->insert('subtype', [
            'name' => 'Классный час',
            'type' => 'Память'
        ]);
        $this->insert('subtype', [
            'name' => 'Встреча с родственниками',
            'type' => 'Память'
        ]);
        $this->insert('subtype', [
            'name' => 'Размещение памятного знака',
            'type' => 'Память'
        ]);
        $this->insert('subtype', [
            'name' => 'Высадка растений',
            'type' => 'Память'
        ]);
        $this->insert('subtype', [
            'name' => 'Благоустройство места захоронения',
            'type' => 'Память'
        ]);
        $this->insert('subtype', [
            'name' => 'Встреча',
            'type' => 'Наследие'
        ]);
        $this->insert('subtype', [
            'name' => 'Совместное мероприятие',
            'type' => 'Наследие'
        ]);
        $this->insert('subtype', [
            'name' => 'Интервью',
            'type' => 'Наследие'
        ]);
    }

    public function down()
    {
        $this->truncateTable('subtype');
        $this->dropColumn('subtype', 'type');
    }
}

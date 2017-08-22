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
            'type' => 'memory'
        ]);
        $this->insert('subtype', [
            'name' => 'Классный час',
            'type' => 'memory'
        ]);
        $this->insert('subtype', [
            'name' => 'Встреча с родственниками',
            'type' => 'memory'
        ]);
        $this->insert('subtype', [
            'name' => 'Размещение памятного знака',
            'type' => 'memory'
        ]);
        $this->insert('subtype', [
            'name' => 'Высадка растений',
            'type' => 'memory'
        ]);
        $this->insert('subtype', [
            'name' => 'Благоустройство места захоронения',
            'type' => 'memory'
        ]);
        $this->insert('subtype', [
            'name' => 'Встреча',
            'type' => 'legacy'
        ]);
        $this->insert('subtype', [
            'name' => 'Совместное мероприятие',
            'type' => 'legacy'
        ]);
        $this->insert('subtype', [
            'name' => 'Интервью',
            'type' => 'legacy'
        ]);
    }

    public function down()
    {
        $this->dropColumn('subtype', 'type');
    }
}

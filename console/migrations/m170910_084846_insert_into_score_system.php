<?php

use yii\db\Migration;

class m170910_084846_insert_into_score_system extends Migration
{
    public function up()
    {
        $this->insert('score_system', [
            'module' => 'event',
            'action' => 'publish',
            'amount' => '30'
        ]);
        $this->insert('score_system', [
            'module' => 'event',
            'action' => 'create',
            'amount' => '10'
        ]);
        $this->insert('score_system', [
            'module' => 'report',
            'action' => 'publish',
            'amount' => '20'
        ]);
        $this->insert('score_system', [
            'module' => 'report',
            'action' => 'create',
            'amount' => '5'
        ]);
        $this->insert('score_system', [
            'module' => 'message',
            'action' => 'create',
            'amount' => '5'
        ]);
    }

    public function down()
    {
        $this->truncateTable('score_system');
    }
}

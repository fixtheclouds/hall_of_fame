<?php

use yii\db\Migration;

class m170824_055356_alter_column_city_id_in_profile extends Migration
{
    public function up()
    {
        $this->alterColumn('profile', 'city_id', 'string');
        $this->renameColumn('profile', 'city_id', 'city');
    }

    public function down()
    {
        $this->alterColumn('profile', 'city', 'string');
        $this->renameColumn('profile', 'city', 'city_id');
    }
}

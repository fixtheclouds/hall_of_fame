<?php

use yii\db\Migration;

class m170823_172541_alter_column_city_id_in_events extends Migration
{
    public function up()
    {
        $this->alterColumn('event', 'city_id', 'string');
        $this->renameColumn('event', 'city_id', 'city');
    }

    public function down()
    {
        $this->alterColumn('event', 'city', 'string');
        $this->renameColumn('event', 'city', 'city_id');
    }
}

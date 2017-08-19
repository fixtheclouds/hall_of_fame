<?php

use yii\db\Migration;
use yii\db\Schema;

class m170819_160043_add_city_id_to_profile extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'city_id', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->dropColumn('profile', 'city_id');
    }
}

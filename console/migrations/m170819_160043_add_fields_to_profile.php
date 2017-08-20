<?php

use yii\db\Migration;
use yii\db\Schema;

class m170819_160043_add_fields_to_profile extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'city_id', Schema::TYPE_INTEGER);
        $this->addColumn('profile', 'phone', Schema::TYPE_STRING);
        $this->addColumn('profile', 'photo', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('profile', 'city_id');
        $this->dropColumn('profile', 'phone');
        $this->dropColumn('profile', 'photo');
    }
}

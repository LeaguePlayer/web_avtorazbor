<?php
/**
 * Миграция m140407_094147_update_usedCars
 *
 * @property string $prefix
 */
 
class m140407_094147_update_usedCars extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{UsedCars}}', 'buyer_id', "int COMMENT 'Покупатель'");
    }

    public function down()
    {
        $this->dropColumn('{{UsedCars}}', 'buyer_id');
    }
}
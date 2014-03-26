<?php
/**
 * Миграция m140326_075540_update_used_cars
 *
 * @property string $prefix
 */
 
class m140326_075540_update_used_cars extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{UsedCars}}', 'name', 'string COMMENT "Марка, модель (как в ПТС)"');
    }

    public function down()
    {
        $this->dropColumn('{{UsedCars}}', 'name');
    }
}
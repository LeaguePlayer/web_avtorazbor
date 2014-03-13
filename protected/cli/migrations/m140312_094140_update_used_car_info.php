<?php
/**
 * Миграция m140312_094140_update_used_car_info
 *
 * @property string $prefix
 */
 
class m140312_094140_update_used_car_info extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{UsedCar_Info}}', 'dt_of_issue', 'date COMMENT "Дата выдачи"');
    }

    public function down()
    {
        $this->dropColumn('{{UsedCar_Info}}', 'dt_of_issue');
    }
}
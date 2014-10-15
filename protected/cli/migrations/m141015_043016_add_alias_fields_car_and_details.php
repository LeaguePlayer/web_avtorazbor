<?php
/**
 * Миграция m141015_043016_add_alias_fields_car_and_details
 *
 * @property string $prefix
 */
 
class m141015_043016_add_alias_fields_car_and_details extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up(){
        $this->addColumn('{{UsedCars}}','alias','string');
        $this->addColumn('{{Parts}}','alias','string');
    }

    public function down(){
        $this->dropColumn('{{UsedCars}}','alias');
        $this->dropColumn('{{Parts}}','alias');
    }
}
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
        $this->addColumn('{{usedCars}}','alias','string');
        $this->addColumn('{{parts}}','alias','string');
    }

    public function down(){
        $this->dropColumn('{{usedCars}}','alias');
        $this->dropColumn('{{parts}}','alias');
    }
}
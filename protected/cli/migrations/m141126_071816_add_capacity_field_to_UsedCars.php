<?php
/**
 * Миграция m141126_071816_add_capacity_field_to_UsedCars
 *
 * @property string $prefix
 */
 
class m141126_071816_add_capacity_field_to_UsedCars extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function Up(){
        
        $this->addColumn('{{UsedCars}}','capacity','string');
    }
    public function Down(){

        $this->dropColumn('{{UsedCars}}','capacity');
    }
}
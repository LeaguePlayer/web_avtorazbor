<?php
/**
 * Миграция m141119_105737_add_fields_to_UsedCars
 *
 * @property string $prefix
 */
 
class m141119_105737_add_fields_to_UsedCars extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function Up(){
        $this->addColumn('{{UsedCar_Info}}','engine','int');
    }

    public function Down(){
        $this->dropColumn('{{UsedCar_Info}}','engine');
    }
}
<?php
/**
 * Миграция m141121_122721_add_more_info_field_to_cars
 *
 * @property string $prefix
 */
 
class m141121_122721_add_more_info_field_to_cars extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function Up(){
        $this->addColumn('{{UsedCars}}','more_info','text');
    }

    public function Down(){
        $this->dropColumn('{{UsedCars}}','more_info');
    }

}
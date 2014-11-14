<?php
/**
 * Миграция m141114_045404_add_gallerty_toUsedCars
 *
 * @property string $prefix
 */
 
class m141114_045404_add_gallerty_toUsedCars extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function Up(){
        $this->addColumn('{{UsedCars}}','gallery_id','int');
    }
    public function Down(){
        $this->dropColumn('{{UsedCars}}','gallery_id');
    }
}
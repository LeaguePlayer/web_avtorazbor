<?php
/**
 * Миграция m140903_130207_add_field_to_ownprice
 *
 * @property string $prefix
 */
 
class m140903_130207_add_field_to_ownprice extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{ownPrice}}', 'car_id', 'int');
    }
    
    public function down()
    {
        $this->dropColumn('{{ownPrice}}', 'car_id');
    }
}
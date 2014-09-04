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
        $this->addColumn('{{ownprice}}', 'car_id', 'int');
    }
    
    public function down()
    {
        $this->dropColumn('{{ownprice}}', 'car_id');
    }
}
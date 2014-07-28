<?php
/**
 * Миграция m140727_170058_usedcars_drop_type_car_field
 *
 * @property string $prefix
 */
 
class m140727_170058_usedcars_drop_type_car_field extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->dropColumn('{{usedcars}}', 'type');
    }

}
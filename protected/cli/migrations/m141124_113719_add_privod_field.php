<?php
/**
 * Миграция m141124_113719_add_privod_field
 *
 * @property string $prefix
 */
 
class m141124_113719_add_privod_field extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up(){
        $this->addColumn('{{UsedCar_Info}}','privod','int');
    }

    public function down(){
        $this->dropColumn('{{UsedCar_Info}}','privod');
    }

}
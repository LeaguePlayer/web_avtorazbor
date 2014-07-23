<?php
/**
 * Миграция m140722_081247_add_usedCars_force_field
 *
 * @property string $prefix
 */
 
class m140722_081247_add_usedCars_force_field extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{UsedCars}}', 'force', 'float COMMENT "Мощность двигателя"');
    }

    public function down()
    {
        $this->dropColumn('{{UsedCars}}', 'force');
    }
}
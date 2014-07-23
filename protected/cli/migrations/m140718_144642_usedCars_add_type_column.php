<?php
/**
 * Миграция m140718_144642_usedCars_add_type_column
 *
 * @property string $prefix
 */
 
class m140718_144642_usedCars_add_type_column extends CDbMigration
{

	public function up()
    {
        $this->addColumn('{{UsedCars}}', 'type', 'int COMMENT "Тип авто"');
    }

    public function down()
    {
        $this->dropColumn('{{UsedCars}}', 'type');
    }

}
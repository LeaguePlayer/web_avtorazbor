<?php
/**
 * Миграция m140724_120755_carmodels_add_type_field
 *
 * @property string $prefix
 */
 
class m140724_120755_carmodels_add_type_field extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{carmodels}}', 'car_type', 'int COMMENT "Тип машины (Грузовая/Лековая)"');
    }

    public function down()
    {
        $this->dropColumn('{{carmodels}}', 'car_type');
    }
}
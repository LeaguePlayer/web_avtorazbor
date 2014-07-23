<?php
/**
 * Миграция m140721_090114_add_usedcars_basced_field
 *
 * @property string $prefix
 */
 
class m140721_090114_add_usedcars_basced_field extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{usedcars}}', 'bascet', 'int COMMENT "Кузов"');
    }

    public function down()
    {
        $this->dropColumn('{{usedcars}}', 'bascet');
    }
}
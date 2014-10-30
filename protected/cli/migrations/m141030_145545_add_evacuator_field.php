<?php
/**
 * Миграция m141030_145545_add_evacuator_field
 *
 * @property string $prefix
 */
 
class m141030_145545_add_evacuator_field extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{evackuator}}','modelName','string');
    }

    public function down()
    {
        $this->dropColumn('{{evackuator}}','modelName');
    }
}
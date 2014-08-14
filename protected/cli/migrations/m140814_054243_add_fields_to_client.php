<?php
/**
 * Миграция m140814_054243_add_fields_to_client
 *
 * @property string $prefix
 */
 
class m140814_054243_add_fields_to_client extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{clients}}', 'password', 'string');
        $this->addColumn('{{clients}}', 'token', 'string');
    }

    public function down()
    {
        $this->dropColumn('{{clients}}', 'password', 'string');
        $this->dropColumn('{{clients}}', 'token', 'string');
    }
}
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
        $this->addColumn('{{Clients}}', 'password', 'string');
        $this->addColumn('{{Clients}}', 'token', 'string');
    }

    public function down()
    {
        $this->dropColumn('{{Clients}}', 'password', 'string');
        $this->dropColumn('{{Clients}}', 'token', 'string');
    }
}
<?php
/**
 * Миграция m140814_063122_add_subscribe_To_clients
 *
 * @property string $prefix
 */
 
class m140814_063122_add_subscribe_To_clients extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{Clients}}', 'subscribe_sms', 'boolean');
        $this->addColumn('{{Clients}}', 'subscribe_mail', 'boolean');
    }

    public function down()
    {
        $this->dropColumn('{{Clients}}', 'subscribe_sms', 'boolean');
        $this->dropColumn('{{Clients}}', 'subscribe_mail', 'boolean');
    }
}
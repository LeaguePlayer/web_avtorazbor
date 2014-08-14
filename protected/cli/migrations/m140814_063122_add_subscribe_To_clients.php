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
        $this->addColumn('{{clients}}', 'subscribe_sms', 'boolean');
        $this->addColumn('{{clients}}', 'subscribe_mail', 'boolean');
    }

    public function down()
    {
        $this->dropColumn('{{clients}}', 'subscribe_sms', 'boolean');
        $this->dropColumn('{{clients}}', 'subscribe_mail', 'boolean');
    }
}
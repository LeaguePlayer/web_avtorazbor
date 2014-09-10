<?php
/**
 * Миграция m140905_032149_drop_mail_sms_subscribe
 *
 * @property string $prefix
 */
 
class m140905_032149_drop_mail_sms_subscribe extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->dropColumn('{{Clients}}','subscribe_mail');
        $this->dropColumn('{{Clients}}','subscribe_sms');
    }
}
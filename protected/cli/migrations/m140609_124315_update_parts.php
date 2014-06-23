<?php
/**
 * Миграция m140609_124315_update_parts
 *
 * @property string $prefix
 */
 
class m140609_124315_update_parts extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{Parts}}', 'user_id', 'int COMMENT "Пользователь"');
    }

    public function down()
    {
        $this->dropColumn('{{Parts}}', 'user_id');
    }
}
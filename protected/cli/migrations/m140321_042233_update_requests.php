<?php
/**
 * Миграция m140321_042233_update_requests
 *
 * @property string $prefix
 */
 
class m140321_042233_update_requests extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{Requests}}', 'user_id', 'int COMMENT "Пользователь"');
    }

    public function down()
    {
        $this->rdropColumn('{{Requests}}', 'user_id');
    }
}
<?php
/**
 * Миграция m140327_101614_update_requests
 *
 * @property string $prefix
 */
 
class m140327_101614_update_requests extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{Requests}}', 'date_life', 'datetime COMMENT "Время жизни заявки"');
    }

    public function down()
    {
        $this->dropColumn('{{Requests}}', 'date_life');
    }
}
<?php
/**
 * Миграция m140331_112445_update_request_logs
 *
 * @property string $prefix
 */
 
class m140331_112445_update_request_logs extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{RequestLogs}}', 'type', 'int COMMENT "Тип события"');
    }

    public function down()
    {
        $this->dropColumn('{{RequestLogs}}', 'type');
    }
}
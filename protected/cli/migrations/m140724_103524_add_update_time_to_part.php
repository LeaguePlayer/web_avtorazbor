<?php
/**
 * Миграция m140724_103524_add_update_time_to_part
 *
 * @property string $prefix
 */
 
class m140724_103524_add_update_time_to_part extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{Parts}}', 'update_time', 'datetime COMMENT "Дата обновления"');
    }

    public function down()
    {
        $this->dropColumn('{{Parts}}', 'update_time');
    }
}
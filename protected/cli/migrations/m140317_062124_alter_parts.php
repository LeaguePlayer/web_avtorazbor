<?php
/**
 * Миграция m140317_062124_alter_parts
 *
 * @property string $prefix
 */
 
class m140317_062124_alter_parts extends CDbMigration
{
    public function up()
    {
        $this->renameColumn('{{Parts}}', 'client_id', 'supplier_id');
    }

    public function down()
    {
        $this->renameColumn('{{Parts}}', 'supplier_id', 'client_id');
    }
}
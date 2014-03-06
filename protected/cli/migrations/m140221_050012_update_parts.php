<?php
/**
 * Миграция m140221_050012_update_parts
 *
 * @property string $prefix
 */
 
class m140221_050012_update_parts extends CDbMigration
{
    private $_tableName = '{{Parts}}';

    public function up()
    {
        $this->addColumn($this->_tableName, 'gallery_id', 'int COMMENT "Галерея"');
        $this->addColumn($this->_tableName, 'artId', 'string COMMENT "Артикул"');
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'gallery_id');
        $this->dropColumn($this->_tableName, 'artId');
    }
}
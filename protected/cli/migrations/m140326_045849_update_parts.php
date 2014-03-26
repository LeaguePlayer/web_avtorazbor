<?php
/**
 * Миграция m140326_045849_update_parts
 *
 * @property string $prefix
 */
 
class m140326_045849_update_parts extends CDbMigration
{
    public function up()
    {
        $this->alterColumn('{{Parts}}', 'id', 'int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT');
        $this->dropColumn('{{Parts}}', 'artId');
    }

    public function down()
    {
        $this->alterColumn('{{Parts}}', 'id', 'int(11) NOT NULL AUTO_INCREMENT');
        $this->addColumn('{{Parts}}', 'artId', 'string COMMENT "Артикул"');
    }
}
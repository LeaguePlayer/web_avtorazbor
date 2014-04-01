<?php
/**
 * Миграция m140401_063928_update_article_parts
 *
 * @property string $prefix
 */
 
class m140401_063928_update_article_parts extends CDbMigration
{
    public function up()
    {
        $this->alterColumn('{{Parts}}', 'id', 'int(11) NOT NULL AUTO_INCREMENT');
    }

    public function down()
    {
        $this->alterColumn('{{Parts}}', 'id', 'int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT');
    }
}
<?php
/**
 * Миграция m140411_044915_update_documents
 *
 * @property string $prefix
 */
 
class m140411_044915_update_documents extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{Documents}}', 'request_id', 'int COMMENT "Заявка"');
    }

    public function down()
    {
        $this->dropColumn('{{Documents}}', 'request_id');
    }
}
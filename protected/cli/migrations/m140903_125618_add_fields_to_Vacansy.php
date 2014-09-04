<?php
/**
 * Миграция m140903_125618_add_fields_to_Vacansy
 *
 * @property string $prefix
 */
 
class m140903_125618_add_fields_to_Vacansy extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {

        $this->addColumn('{{vacansy}}', 'alias', 'string');
        $this->addColumn('{{vacansy}}', 'seo_id', 'int');
    }
    
    public function down()
    {
        $this->dropColumn('{{vacansy}}', 'alias');
        $this->dropColumn('{{vacansy}}', 'seo_id');
    }
}
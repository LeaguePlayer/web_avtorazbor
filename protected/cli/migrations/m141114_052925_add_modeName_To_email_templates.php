<?php
/**
 * Миграция m141114_052925_add_modeName_To_email_templates
 *
 * @property string $prefix
 */
 
class m141114_052925_add_modeName_To_email_templates extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function Up(){
        $this->addColumn('{{email_templates}}','model_name','int');
    }
    public function Down(){
        $this->dropColumn('{{email_templates}}','model_name');   
    }
}
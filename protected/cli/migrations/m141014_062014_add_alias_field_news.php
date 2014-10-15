<?php
/**
 * Миграция m141014_062014_add_alias_field_news
 *
 * @property string $prefix
 */
 
class m141014_062014_add_alias_field_news extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up(){
        $this->addColumn('{{News}}','alias','string');
    }

    public function down(){
        $this->dropColumn('{{News}}','alias');           
    }
}
<?php
/**
 * Миграция m141112_165222_add_hash_to_Client
 *
 * @property string $prefix
 */
 
class m141112_165222_add_hash_to_Client extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up(){
        $this->addColumn('{{Clients}}','hash','string');
    }
    public function down(){
        $this->dropColumn('{{Clients}}','hash');   
    }
}
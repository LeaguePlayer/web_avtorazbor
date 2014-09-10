<?php
/**
 * Миграция m140905_032130_add_subscribe_to_clients
 *
 * @property string $prefix
 */
 
class m140905_032130_add_subscribe_to_clients extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{Clients}}', 'subscribe_news', 'boolean');
        $this->addColumn('{{Clients}}', 'subscribe_new', 'boolean');
    }
    
    public function down()
    {
        $this->addColumn('{{Clients}}', 'subscribe_news');
        $this->addColumn('{{Clients}}', 'subscribe_new');
    }
}
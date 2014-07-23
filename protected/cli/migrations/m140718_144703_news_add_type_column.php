<?php
/**
 * Миграция m140718_144703_news_add_type_column
 *
 * @property string $prefix
 */
 
class m140718_144703_news_add_type_column extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{news}}', 'type', 'int COMMENT "Тип новости"');
    }

    public function down()
    {
        $this->dropColumn('{{news}}', 'type');
    }
}
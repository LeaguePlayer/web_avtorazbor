<?php
/**
 * Миграция m141029_160527_vacansyCallBack_add_comment
 *
 * @property string $prefix
 */
 
class m141029_160527_vacansyCallBack_add_comment extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{vacansyCallBack}}','comment','text');
    }

    public function down()
    {
        $this->addColumn('{{vacansyCallBack}}','comment');
    }
}
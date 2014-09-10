<?php
/**
 * Миграция m140905_040434_add_fields_vacansy
 *
 * @property string $prefix
 */
 
class m140905_040434_add_fields_vacansy extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{vacansy}}', 'skill', 'text');
        $this->addColumn('{{vacansy}}', 'conditions_work', 'text');
        $this->addColumn('{{vacansy}}', 'condition_our', 'text');
    }
    
    public function down()
    {
        $this->addColumn('{{vacansy}}', 'skill');
        $this->addColumn('{{vacansy}}', 'conditions_work');
        $this->addColumn('{{vacansy}}', 'condition_our');
    }
}
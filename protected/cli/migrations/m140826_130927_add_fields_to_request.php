<?php
/**
 * Миграция m140826_130927_add_fields_to_request
 *
 * @property string $prefix
 */
 
class m140826_130927_add_fields_to_request extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {

        $this->addColumn('{{Requests}}', 'fio', 'string');
        $this->addColumn('{{Requests}}', 'delivery', 'int');
        $this->addColumn('{{Requests}}', 'city', 'string');
        $this->addColumn('{{Requests}}', 'adress', 'string');
        $this->addColumn('{{Requests}}', 'email', 'string');
        $this->addColumn('{{Requests}}', 'phone', 'string');
        $this->addColumn('{{Requests}}', 'company_name', 'string');
        $this->addColumn('{{Requests}}', 'kpp', 'string');
        $this->addColumn('{{Requests}}', 'inn', 'string');
        $this->addColumn('{{Requests}}', 'okpo', 'string');
        $this->addColumn('{{Requests}}', 'ur_adress', 'string');
        $this->addColumn('{{Requests}}', 'piz_adress', 'string');
    }
    
    public function down()
    {
        $this->dropColumn('{{Requests}}', 'fio');
        $this->dropColumn('{{Requests}}', 'delivery');
        $this->dropColumn('{{Requests}}', 'city');
        $this->dropColumn('{{Requests}}', 'adress');
        $this->dropColumn('{{Requests}}', 'email');
        $this->dropColumn('{{Requests}}', 'phone');
        $this->dropColumn('{{Requests}}', 'company_name');
        $this->dropColumn('{{Requests}}', 'kpp');
        $this->dropColumn('{{Requests}}', 'inn');
        $this->dropColumn('{{Requests}}', 'okpo');
        $this->dropColumn('{{Requests}}', 'ur_adress');
        $this->dropColumn('{{Requests}}', 'piz_adress');
    }
}
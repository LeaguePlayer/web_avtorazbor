<?php
/**
 * Миграция m140401_142453_update_location
 *
 * @property string $prefix
 */
 
class m140401_142453_update_location extends CDbMigration
{
    public function up(){
        $this->addColumn('{{Locations}}', 'fio', 'string COMMENT "Контактное лицо"');
        $this->addColumn('{{Locations}}', 'phone', 'string COMMENT "Телефон"');
        $this->addColumn('{{Locations}}', 'address', 'text COMMENT "Адрес"');
    }

    public function down(){
        $this->dropColumn('{{Locations}}', 'fio');
        $this->dropColumn('{{Locations}}', 'phone');
        $this->dropColumn('{{Locations}}', 'address');
    }
}
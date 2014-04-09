<?php
/**
 * Миграция m140409_161525_update_some_tables
 *
 * @property string $prefix
 */
 
class m140409_161525_update_some_tables extends CDbMigration
{
    public function up(){
        $this->addColumn('{{Locations}}', 'email', 'string COMMENT "E-mail"');
        $this->addColumn('{{Employees}}', 'post', 'string COMMENT "Должность"');

        $this->addColumn('{{ClientsInfo}}', 'ur_address', 'text COMMENT "Юридический адрес"');
    }

    public function down(){
        $this->dropColumn('{{Locations}}', 'email');
        $this->dropColumn('{{Employees}}', 'post');
        
        $this->dropColumn('{{ClientsInfo}}', 'ur_address');
    }
}
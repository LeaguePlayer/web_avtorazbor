<?php
/**
 * Миграция m140604_042702_add_fio_rod_clients
 *
 * @property string $prefix
 */
 
class m140604_042702_add_fio_rod_clients extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{ClientsInfo}}', 'fio_rod', 'string COMMENT "ФИО в родительном падеже"');
    }

    public function down()
    {
        $this->dropColumn('{{ClientsInfo}}', 'fio_rod');
    }
}
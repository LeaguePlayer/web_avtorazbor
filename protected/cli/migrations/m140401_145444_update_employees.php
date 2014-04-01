<?php
/**
 * Миграция m140401_145444_update_eployees
 *
 * @property string $prefix
 */
 
class m140401_145444_update_employees extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{Employees}}', 'phone', "varchar(30) COMMENT 'Телефон'");
        $this->addColumn('{{Employees}}', 'email', "string COMMENT 'E-mail'");

        $this->addColumn('{{Employees}}', 'dt_birthday', "date COMMENT 'Дата рождения'");
        $this->addColumn('{{Employees}}', 'passport_num', "string COMMENT 'Номер паспорта'");
        $this->addColumn('{{Employees}}', 'issued_by', "text COMMENT 'Кем выдан'");
        $this->addColumn('{{Employees}}', 'address', "text COMMENT 'Адрес регистрации'");
        $this->addColumn('{{Employees}}', 'dt_of_issue', "date COMMENT 'Дата выдачи'");
    }

    public function down()
    {
        $this->dropColumn('{{Employees}}', 'phone');
        $this->dropColumn('{{Employees}}', 'email');

        $this->dropColumn('{{Employees}}', 'dt_birthday');
        $this->dropColumn('{{Employees}}', 'passport_num');
        $this->dropColumn('{{Employees}}', 'issued_by');
        $this->dropColumn('{{Employees}}', 'address');
        $this->dropColumn('{{Employees}}', 'dt_of_issue');
    }
}
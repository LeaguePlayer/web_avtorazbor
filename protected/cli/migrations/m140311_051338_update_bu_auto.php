<?php
/**
 * Миграция m140311_051338_update_bu_auto
 *
 * @property string $prefix
 */
 
class m140311_051338_update_bu_auto extends CDbMigration
{
    // private $_tableName = '{{ClientsInfo}}';

    public function up()
    {
        $this->dropTable('{{Owners}}');

        $this->addColumn('{{Clients}}', 'dt_birthday', "date COMMENT 'Дата рождения'");
        $this->addColumn('{{Clients}}', 'passport_num', "string COMMENT 'Номер паспорта'");
        $this->addColumn('{{Clients}}', 'issued_by', "text COMMENT 'Кем выдан'");
        $this->addColumn('{{Clients}}', 'address', "text COMMENT 'Адрес регистрации'");
        $this->addColumn('{{Clients}}', 'dt_of_issue', "date COMMENT 'Дата выдачи'");
        $this->addColumn('{{Clients}}', 'used_car_id', "int COMMENT 'Бу автомобиль'");
    }

    public function down()
    {
        $this->dropColumn('{{Clients}}', 'dt_birthday');
        $this->dropColumn('{{Clients}}', 'passport_num');
        $this->dropColumn('{{Clients}}', 'issued_by');
        $this->dropColumn('{{Clients}}', 'address');
        $this->dropColumn('{{Clients}}', 'dt_of_issue');
        $this->dropColumn('{{Clients}}', 'used_car_id');

        $this->createTable('{{Owners}}', array(
            'id' => 'pk', // auto increment

            'fio' => "string NOT NULL COMMENT 'ФИО'",
            'dt_birthday' => "date NOT NULL COMMENT 'Дата рождения'",
            'passport_num' => "int NOT NULL COMMENT 'Номер паспорта'",
            'issued_by' => "text NOT NULL COMMENT 'Кем выдан'",
            'address' => "text NOT NULL COMMENT 'Адрес регистрации'",
            'dt_of_issue' => "date NOT NULL COMMENT 'Дата выдачи'",
            'phone' => "string COMMENT 'Контактный телефон'",
            'used_car_id' => "int COMMENT 'Бу автомобиль'",
            
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
}
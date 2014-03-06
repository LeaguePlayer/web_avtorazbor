<?php
/**
 * Миграция m140303_112638_update_clients_info
 *
 * @property string $prefix
 */
 
class m140303_112638_update_clients_info extends CDbMigration
{
    private $_tableName = '{{ClientsInfo}}';

    public function up()
    {
        $this->dropColumn($this->_tableName, 'bank');
        $this->dropColumn($this->_tableName, 'num_account');

        $this->createTable('{{BankAccounts}}', array(
            'id' => 'pk', // auto increment
            'bank' => "string NOT NULL COMMENT 'Банк'",
            'num_account' => "string NOT NULL COMMENT '№ счета'",
            'bik' => "string NOT NULL COMMENT 'БИК банка'",
            'korr' => "string COMMENT 'Корр. счет'",
            'city' => "string COMMENT 'Город'",
            'client_id' => 'int COMMENT "Клиент"'
        ));

        //many_many tables
       /* $this->createTable('{{ClientAccounts}}', array(
            'acc_id' => 'int COMMENT "Счет"',
            'client_id' => 'int COMMENT "Клиент"',
            'PRIMARY KEY (acc_id,client_id)'
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');*/
    }

    public function down()
    {
        $this->addColumn($this->_tableName, 'bank', 'string COMMENT "Банк"');
        $this->addColumn($this->_tableName, 'num_account', 'string COMMENT "№ счета"');

        $this->dropTable('{{BankAccounts}}');
        // $this->dropTable('{{ClientAccounts}}');
    }
}
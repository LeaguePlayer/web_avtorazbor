<?php
/**
 * Миграция m140116_063014_clients
 *
 * @property string $prefix
 */
 
class m140116_063014_clients extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{Clients}}', '{{ClientsInfo}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{Clients}}', array(
            'id' => 'pk', // auto increment

            'fio' => "string NOT NULL COMMENT 'ФИО'",
            'phone' => "varchar(30) COMMENT 'Телефон'",
            'email' => "string COMMENT 'E-mail'",
			'fio' => "string COMMENT 'ФИО'",
            'type' => "tinyint COMMENT 'Тип'"

        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //clients info
        $this->createTable('{{ClientsInfo}}', array(
            'id' => 'pk', // auto increment

            'inn' => "varchar(20) NOT NULL COMMENT 'ИНН'",
            'kpp' => "varchar(20) COMMENT 'КПП'",
            'bank' => "string COMMENT 'Банк'",
            'num_account' => "string COMMENT '№ счета'",
            'name_company' => "string COMMENT 'Название компании'",
            'address' => "string COMMENT 'Адрес'",
            'client_id' => "int COMMENT 'Клиент'"

        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
 
    public function safeDown()
    {
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}
<?php
/**
 * Миграция m140225_084011_owners
 *
 * @property string $prefix
 */
 
class m140225_084011_owners extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{Owners}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
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
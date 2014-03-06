<?php
/**
 * Миграция m140303_064148_Requests
 *
 * @property string $prefix
 */
 
class m140303_064148_Requests extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{Requests}}','{{RequestDocs}}','{{PartsInRequest}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{Requests}}', array(
            'id' => 'pk', // auto increment

            'client_id' => "int COMMENT 'Клиент'",
			'check_user_id' => "int COMMENT 'Сотрудник'",
            'from' => "tinyint COMMENT 'Источник'",
			
			'status' => "tinyint COMMENT 'Статус'",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //many_many tables
        $this->createTable('{{RequestDocs}}', array(
            'request_id' => 'int COMMENT "Заявка"',
            'doc_id' => 'int COMMENT "Документ"',
            'PRIMARY KEY (request_id,doc_id)'
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{PartsInRequest}}', array(
            'request_id' => 'int COMMENT "Заявка"',
            'part_id' => 'int COMMENT "Запчасть"',
            'PRIMARY KEY (request_id,part_id)'
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
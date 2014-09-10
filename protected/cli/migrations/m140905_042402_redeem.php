<?php
/**
 * Миграция m140905_042402_redeem
 *
 * @property string $prefix
 */
 
class m140905_042402_redeem extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{redeem}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{redeem}}', array(
            'id' => 'pk', // auto increment

			'fio' => "string COMMENT 'Ваше имя'",
			'phone' => "string COMMENT 'Контактный телефон'",
            'email' => "string COMMENT 'E-mail'",
            'brand' => "int COMMENT 'Марка авто'",
            'model_name' => "string COMMENT 'Модель автомобиля'",
            'year' => "int COMMENT 'Год выпуска'",
            'capacity' => "string COMMENT 'Год выпуска'",
            'transmission' => "text COMMENT 'Год выпуска'",
            'comment' => "text COMMENT 'Год выпуска'",
			'status' => "tinyint COMMENT 'Статус'",
			'sort' => "integer COMMENT 'Вес для сортировки'",
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
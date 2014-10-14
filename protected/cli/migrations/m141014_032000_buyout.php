<?php
/**
 * Миграция m141014_032000_buyout
 *
 * @property string $prefix
 */
 
class m141014_032000_buyout extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{buyout}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{buyout}}', array(
            'id' => 'pk', // auto increment

			'name' => "string COMMENT 'Ваше имя'",
			'phone' => "string COMMENT 'Контактный телефон'",
            'email' => "string COMMENT 'E-mail'",
            'brand' => "int COMMENT 'Марка авто'",
            'modelName' => "string COMMENT 'Модель авто'",
            'year' => "int COMMENT 'Год выпуска'",
            'capacity' => "string COMMENT 'Объем двигателя'",
            'transmission' => "int COMMENT 'Тип КПП'",
            'comment' => "text COMMENT 'Дополнительная ифнормация'",
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
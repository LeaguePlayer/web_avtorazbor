<?php
/**
 * Миграция m140117_051101_parts
 *
 * @property string $prefix
 */
 
class m140117_051101_parts extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{Parts}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{Parts}}', array(
            'id' => 'pk', // auto increment

            'name' => "string NOT NULL COMMENT 'Название'",
            'price_sell' => "decimal(10, 2) NOT NULL COMMENT 'Стоимость (на продажу)'",
            'price_buy' => "decimal(10, 2) COMMENT 'Стоимость (покупка)'",
            'comment' => "text COMMENT 'Комментарий'",
            'category_id' => "int COMMENT 'Категория'",
            'car_model_id' => "int COMMENT 'Модель автомобиля'",
            'location_id' => "int COMMENT 'Склад'",
            'client_id' => "int COMMENT 'Поставщик'",

            'create_time' => "datetime COMMENT 'Дата создания'",
            'status' => "tinyint COMMENT 'Статус'"

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
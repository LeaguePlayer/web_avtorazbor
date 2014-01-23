<?php
/**
 * Миграция m140122_101717_usedCars
 *
 * @property string $prefix
 */
 
class m140122_101717_usedCars extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{UsedCars}}', '{{Parts_UsedCars}}', '{{UsedCar_Info}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{UsedCars}}', array(
            'id' => 'pk', // auto increment

            'car_model_id' => "int NOT NULL COMMENT 'Модель автомобиля'",
            'vin' => "varchar(20) NOT NULL COMMENT 'VIN'",
            'price' => "DECIMAL(10,2) COMMENT 'Стоимость покупки'",
			'comment' => "text COMMENT 'Комментарий'",
			
			'status' => "tinyint COMMENT 'Назначение'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //--
        $this->createTable('{{Parts_UsedCars}}', array(
            // 'id' => 'pk', // auto increment
            'parts_id' => "int COMMENT 'Запчасть'",
            'used_car_id' => "int COMMENT 'Б/У автомобиль'",
            'PRIMARY KEY (parts_id, used_car_id)'
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //--
        $this->createTable('{{UsedCar_Info}}', array(
            'id' => 'pk', // auto increment

            'price_sell' => "DECIMAL(10,2) COMMENT 'Стоимость продажи'",
            'year' => "int COMMENT 'Год выпуска'",
            'model_num_engine' => "string COMMENT 'Модель, № двигателя'",
            'chassis_num' => "string COMMENT 'Шасси (Рама) №'",
            'carcass_num' => "string COMMENT 'Кузов №'",
            'color' => "string COMMENT 'Цвет'",
            'type_ts' => "string COMMENT 'Тип ТС'",
            'passport_ts' => "string COMMENT 'Паспорт ТС'",
            'issued_by' => "text COMMENT 'Кем выдан'",
            'used_car_id' => "int COMMENT 'Б/У автомобиль'"
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
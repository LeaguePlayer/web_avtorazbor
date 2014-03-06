<?php
/**
 * Миграция m140217_062101_change_usedCars
 *
 * @property string $prefix
 */
 
class m140217_062101_change_usedCars extends CDbMigration
{
    private $_tableName1 = '{{UsedCars}}';
    private $_tableName2 = '{{UsedCar_Info}}';

    public function up()
    {
        $this->addColumn($this->_tableName1, 'year', 'varchar(4) COMMENT "Год выпуска"');
        $this->addColumn($this->_tableName1, 'enter_date', 'date COMMENT "Дата поступления"');

        $this->addColumn($this->_tableName2, 'mileage', 'int COMMENT "Пробег"');
        $this->addColumn($this->_tableName2, 'state', 'tinyint COMMENT "Состояние"');
        $this->addColumn($this->_tableName2, 'transmission', 'tinyint COMMENT "Тип КПП"');
    }

    public function down()
    {
        $this->dropColumn($this->_tableName1, 'year');
        $this->dropColumn($this->_tableName1, 'enter_date');

        $this->dropColumn($this->_tableName2, 'mileage');
        $this->dropColumn($this->_tableName2, 'state');
        $this->dropColumn($this->_tableName2, 'transmission');
    }
}
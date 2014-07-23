<?php
/**
 * Миграция m140719_135348_UsedCars_imageField
 *
 * @property string $prefix
 */
 
class m140719_135348_UsedCars_imageField extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{UsedCars}}', 'img_preview', 'text COMMENT "Фото машины"');
    }

    public function down()
    {
        $this->dropColumn('{{UsedCars}}', 'img_preview');
    }
}
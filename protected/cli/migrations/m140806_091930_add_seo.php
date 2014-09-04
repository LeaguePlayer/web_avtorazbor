<?php
/**
 * Миграция m140806_091930_add_seo
 *
 * @property string $prefix
 */
 
class m140806_091930_add_seo extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{News}}', 'seo_id', 'int');
        $this->addColumn('{{Parts}}', 'seo_id', 'int');
        $this->addColumn('{{UsedCars}}', 'seo_id', 'int');
        $this->addColumn('{{CarBrands}}', 'seo_id', 'int');
        $this->addColumn('{{categories}}', 'seo_id', 'int');
        $this->addColumn('{{CarModels}}', 'seo_id', 'int');
    }

    public function down()
    {
        $this->dropColumn('{{News}}', 'seo_id', 'int');
        $this->dropColumn('{{Parts}}', 'seo_id', 'int');
        $this->dropColumn('{{UsedCars}}', 'seo_id', 'int');
        $this->dropColumn('{{CarBrands}}', 'seo_id', 'int');
        $this->dropColumn('{{categories}}', 'seo_id', 'int');
        $this->dropColumn('{{CarModels}}', 'seo_id', 'int');
    }
}
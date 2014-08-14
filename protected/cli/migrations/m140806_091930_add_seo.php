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
        $this->addColumn('{{news}}', 'seo_id', 'int');
        $this->addColumn('{{page}}', 'seo_id', 'int');
        $this->addColumn('{{parts}}', 'seo_id', 'int');
        $this->addColumn('{{usedCars}}', 'seo_id', 'int');
        $this->addColumn('{{carBrands}}', 'seo_id', 'int');
        $this->addColumn('{{categories}}', 'seo_id', 'int');
        $this->addColumn('{{carModels}}', 'seo_id', 'int');
    }

    public function down()
    {
        $this->dropColumn('{{news}}', 'seo_id', 'int');
        $this->dropColumn('{{page}}', 'seo_id', 'int');
        $this->dropColumn('{{parts}}', 'seo_id', 'int');
        $this->dropColumn('{{usedCars}}', 'seo_id', 'int');
        $this->dropColumn('{{carBrands}}', 'seo_id', 'int');
        $this->dropColumn('{{categories}}', 'seo_id', 'int');
        $this->dropColumn('{{carModels}}', 'seo_id', 'int');
    }
}
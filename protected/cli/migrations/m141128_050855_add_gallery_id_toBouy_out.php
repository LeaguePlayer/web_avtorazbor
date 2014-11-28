<?php
/**
 * Миграция m141128_050855_add_gallery_id_toBouy_out
 *
 * @property string $prefix
 */
 
class m141128_050855_add_gallery_id_toBouy_out extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function Up()
    {
        $this->addColumn('{{buyout}}','gallery_id','int');
    }

    public function Down()
    {
        $this->dropColumn('{{buyout}}','gallery_id');
    }
}
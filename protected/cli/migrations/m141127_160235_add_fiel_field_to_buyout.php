<?php
/**
 * Миграция m141127_160235_add_fiel_field_to_buyout
 *
 * @property string $prefix
 */
 
class m141127_160235_add_fiel_field_to_buyout extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function Up(){
        $this->addColumn( '{{buyout}}', 'images','text');
    }

    public function Down(){
        $this->dropColumn( '{{buyout}}', 'images');
    }

}
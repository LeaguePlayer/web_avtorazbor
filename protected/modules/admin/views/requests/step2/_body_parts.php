<? $sum = 0; ?>
<?foreach ($model->parts as $i => $part):
	$sum += $part->price_sell;
	$url=SiteHelper::translit($part->car_model->brand->name).'/'.SiteHelper::translit($part->car_model->name).'/'.SiteHelper::translit($part->category->name).'/id/'.$part->id;
?>
<tr>
	<td><?=$i+1?></td>
	<td><?=CHtml::link($part->name,array('/detail'.$url))?></td>
	<td><?=$part->location ? CHtml::encode($part->location->name) : ''?></td>
	<td><?=CHtml::encode(Parts::getStatusAliases($part->status))?></td>
	<td><?=CHtml::activeTextField($part, 'price_sell')?></td>
	<td><?=TbHtml::button('Удалить', array('class' => 'remove-part', 'color' => TbHtml::BUTTON_COLOR_DANGER, 'data-id' => $part->id))?></td>
	<?php //echo CHtml::activeHiddenField($part, 'id'); ?>
</tr>
<?endforeach;?>
<tr>
	<td colspan="3"></td>
	<td>Итого: <?=$sum?> руб.</td>
	<td></td>
</tr>
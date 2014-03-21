<? $sum = 0; ?>
<?foreach ($model->parts as $i => $part):
	$sum += $part->price_sell;
?>
<tr>
	<td><?=$i+1?></td>
	<td><?=CHtml::encode($part->name)?></td>
	<td><?=CHtml::encode($part->location->name)?></td>
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
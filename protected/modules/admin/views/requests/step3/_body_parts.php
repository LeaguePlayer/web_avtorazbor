<? $sum = 0; ?>
<?foreach ($model->parts as $i => $part):
	$sum += $part->price_sell;
?>
<tr>
	<td><?=$i+1?></td>
	<td><?=CHtml::encode($part->name)?></td>
	<td><?=CHtml::encode($part->location ? $part->location->name : "")?></td>
	<td><?=CHtml::encode($part->price_sell)?></td>
	<?php //echo CHtml::activeHiddenField($part, 'id'); ?>
</tr>
<?endforeach;?>
<tr>
	<td colspan="3"></td>
	<td>Итого: <?=$sum?> руб.</td>
</tr>
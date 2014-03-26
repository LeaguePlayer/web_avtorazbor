<h1>Утилизация</h1>

<p>В процессе работы с заявкой, мы обнаружили, что на стадии проверки запчастей на наличие - вы отказались от нескольких позиций. Возможно их просто больше нет? Мы предлагаем добавить запчасти в утилизацию.</p>
<br>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'requests-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="utilization">
	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>№ Позиции</th>
				<th>Название</th>
				<th>Склад</th>
				<th>Комментарий</th>
				<th>Цена</th>
			</tr>
		</thead>
		<tbody class="parts-update">
			<? $sum = 0; ?>
			<?foreach ($parts as $i => $part):
				$sum += $part->price_sell;
			?>
			<tr>	
				<td><?=TbHtml::checkBox('Parts['.$i.'][checked]', true)?></td>
				<td><?=$i+1?></td>
				<td><?=CHtml::encode($part->name)?></td>
				<td><?=CHtml::encode($part->location->name)?></td>
				<td><?=CHtml::activeTextArea($part, '['.$i.']comment')?></td>
				<td><?=CHtml::encode($part->price_sell)?></td>
				<?=CHtml::activeHiddenField($part, '['.$i.']id')?>
			</tr>
			<?endforeach;?>
			<tr>
				<td colspan="5"></td>
				<td>Итого: <?=$sum?> руб.</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="form-actions">
	<?php echo TbHtml::link('Пропустить щаг', $this->createUrl('list')); ?>
	<?php echo TbHtml::submitButton('Утилизировать', array('color' => TbHtml::BUTTON_COLOR_DANGER)); ?>
</div>
<?php $this->endWidget(); ?>
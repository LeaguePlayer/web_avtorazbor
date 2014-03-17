<h1>Парсер категорий</h1>
<?php echo TbHtml::beginFormTb(); ?>
<?php echo TbHtml::textFieldControlGroup('url', (isset($_POST['url']) ? $_POST['url'] : ''), array('class'=>'span8','maxlength'=>255, 'label' => 'Откуда парсить?')); ?>

<div class="form-actions">
	<?php echo TbHtml::submitButton('Спарсить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
    <?php echo TbHtml::linkButton('Отмена', array('url'=>$this->createUrl('list'))); ?>
</div>
<?php echo CHtml::endForm(); ?>
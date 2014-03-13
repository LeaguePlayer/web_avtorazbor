	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8 translit','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'uniqid',array('class'=>'span8 alias','maxlength'=>255)); ?>
	
	<?if($model->file) :?>
	<div class="file">
		<?=CHtml::link($model->file, $this->createUrl('download', array('file' => $model->file)))?>
		<?=TbHtml::button(TbHtml::icon(TbHtml::ICON_REMOVE),  array('color' => TbHtml::BUTTON_COLOR_DANGER, 'class' => 'remove-file', 'data-id' => $model->id))?>
	</div>
	<?endif;?>
	<?php echo $form->fileFieldControlGroup($model,'file'); ?>

<script>
		var timeID = null;
		
		jQuery('.translit').on('keyup', function(){
			var $this = jQuery(this);

			if(timeID) clearTimeout(timeID);
			
			timeID = setTimeout(function(){
				jQuery.getJSON('<?=$this->createUrl("translit")?>',{str: $this.val()})
					.done(function(s){
						jQuery('.alias').val(s);
					});
			}, 500);
		});

		jQuery('.remove-file').on('click', function(){
			var $this = jQuery(this),
				id = $this.data('id');

			jQuery.ajax({
				url: '<?=$this->createUrl("deleteFile")?>',
				data: {id: id},
				success: function(){
					$this.closest('.file').remove();
				}
			});
		});
	</script>
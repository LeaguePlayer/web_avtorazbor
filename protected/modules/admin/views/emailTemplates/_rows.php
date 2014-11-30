	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>
	<?
		$data=array(
			'Questions'=>'Задать вопрос',
			'Ownprice'=>'Предложения',
			'Bookpart'=>'Заказать деталь',
			'Evackuator'=>'Эвакуатор',
			'Buyout'=>'Выкуп авто',
			'VacansyCallBack'=>'Отклик на вакансию',
		);
	?>
	<?php echo $form->textFieldControlGroup($model,'alias',array('class'=>'span8','maxlength'=>255)); ?>
	<?php echo $form->dropDownList($model,'model_name',$data,array('empty'=>'Выберите модель','class'=>'span8','maxlength'=>255)); ?>
	<script>
		$(function(){
			$('#EmailTemplates_model_name').on("change",function(){
				if ($(this).val())
				{
					$.ajax({
						url:"/admin/emailTemplates/getAttributes",
						data:{model:$(this).val()},
						success:function(data){
							$('.labels').empty().append(data);
						}	
					})
				}
			});
		})
	</script>
	<?php echo $form->textFieldControlGroup($model,'subject',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'from',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'send_interval',array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'last_send_date',array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'send_status',array('class'=>'span8')); ?>
	<div class="labels">
		<?
			if ($model->model_name)
			{
				$data=$model->model_name;
				$labels=$data::model()->attributeLabels();
				echo "<p class=\"caption\">
						Вы можете использовать следующие марки
					</p><ul>";
				foreach ($labels as $key => $label) {
					echo "<li>{{$key}} - $label</li>";
				}
				echo "</ul>";
			}
				
		?>
	</div>
	<?//php echo $form->textFieldControlGroup($model,'content',array('class'=>'span8')); ?>
	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'content'); ?>
		<?php $this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'content',
		)); ?>
		<?php echo $form->error($model, 'content'); ?>
	</div>


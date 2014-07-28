
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>
	<div class="attrs">
	<br>
		<div style="display:inline-block;">
			<a class="add" href="#">Добавить</a>
		</div>
		<br>
		<table>
			<thead>
				<tr>
					<th>Название характеристики</th>
					<th>Обязательный/Не обязательный</th>
				</tr>
			</thead>
			<tbody>
			<?
		foreach ($model->attrs as $key => $value) {
			?>
				<tr>
					<td><input type="text" name="attr[<?$value->id?>]" value="<?=$value->attr?>" ></td>
					<td><input type="checkbox" <?=$value->type == 1 ? 'checked' : '' ?> name="required[]"></td>
					<td><a href="#" class="rm"><img src="#"></a></td>
				</tr>
			<?
				}
			?>
				<tr>
					<td><input type="text" name="attr[]"></td>
					<td><input type="checkbox" name="required[]"></td>
					<td><a href="#" class="rm"><img src="#"></a></td>
				</tr>
			</tbody>
		</table>
		<div class="template" style="display:none">
			<table>
				<tr>
					<td><input type="text" name="attr[]"></td>
					<td><input type="checkbox" name="required[]"></td>
					<td><a href="#" class="rm"><img src="#"></a></td>
				</tr>
			</table>
		</div>
		
	</div>
	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/category/list')); ?>
	</div>

<?php $this->endWidget(); ?>
<style>
	tr td{
		text-align: center;
	}
	table{
		width: 660px;
	}
</style>
<?
	Yii::app()->clientScript->registerScript('search',
	    '
	    function rm(){

	    	$(".rm").on("click",function(){
				$(this).closest("tr").empty();
				return false;
			});

	    }

	    var template=$(".template tbody").html();

		rm();

		$(".add").on("click",function(){
			$("tbody").append(template);	
			rm();
			return false;
		})
	'
	);
?>
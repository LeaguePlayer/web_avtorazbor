	<style>
	.no-float{
		float: none !important;
	}
	</style>
	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'price_sell',array('class'=>'span8','maxlength'=>6)); ?>

	<?php echo $form->textFieldControlGroup($model,'price_buy',array('class'=>'span8','maxlength'=>6)); ?>

	<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	
	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('category_id')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'category_id',
				'data'=>CHtml::listData(Categories::all(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
					// 'placeholder'=>'Категория',
				)
			)); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('car_model_id')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'car_model_id',
				'data'=>CHtml::listData(CarModels::brandModelsList(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
					// 'placeholder'=>'Категория',
				)
			)); ?>
		</div>
	</div>

	<?php echo $form->dropDownListControlGroup($model,'location_id', Chtml::listData(Locations::all(), 'id', 'name'),array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'client_id',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Parts::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	
	<?php if($model->potantialAnalogs()):?>
	<fieldset>
		<legend>Аналоги</legend>
		<div class="control-group">
		<div class="controls">
			<div class="deleted"></div>
			<?php 
			$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'asDropDownList' => true,
				'name' => 'Analogs',
				'data'=> CHtml::listData($model->potantialAnalogs(), 'id', 'name'),
				'values' => $model->analogsById($model->id),
				'pluginOptions' => array(
					'width' => '40%',
				),
				'htmlOptions' => array(
					'multiple' => 'multiple',
				)
			));

			$cs = Yii::app()->getClientScript();

			$cs->registerScript('select2-callbacks','
				jQuery("#Analogs").on("removed", function(e){
					var $deleted = jQuery(".deleted");

					$deleted.append("<input class=\'a-"+e.val+"\' type=\'hidden\' name=\'Analogs_delete[]\' value=\'"+e.val+"\' >");
				});

				jQuery("#Analogs").on("selected", function(e){
					jQuery(".a-" + e.val).remove();
				});
			',CClientScript::POS_READY);
			?>
		</div>
		<?php 

		$analogs = new Parts;

		$this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'parts-grid',
			'dataProvider'=>$analogs->search_analogs($model->id),
			//'filter'=>$analogs,
			'type'=>TbHtml::GRID_TYPE_HOVER,
		    // 'afterAjaxUpdate'=>"function() {sortGrid('parts')}",
		    // 'rowHtmlOptionsExpression'=>'array(
		    //     "id"=>"items[]_".$data->id,
		    //     "class"=>"status_".(isset($data->status) ? $data->status : ""),
		    // )',
			'columns'=>array(
				'name',
				'price_sell',
				// 'price_buy',
				'category_id',
				'car_model_id',
				// 'location_id',
				// 'client_id',
				// array(
				// 	'name'=>'create_time',
				// 	'type'=>'raw',
				// 	'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
				// ),
				// array(
				// 	'name'=>'status',
				// 	'type'=>'raw',
				// 	'value'=>'Parts::getStatusAliases($data->status)',
				// 	'filter'=>Parts::getStatusAliases()
				// ),
				array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
				),
			),
		)); ?>
	</div>
	</fieldset>
	<?php endif; ?>
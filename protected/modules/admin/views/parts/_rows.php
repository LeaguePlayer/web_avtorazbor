
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
				)
			)); ?>
		</div>
	</div>

	<?php echo $form->dropDownListControlGroup($model,'location_id', Chtml::listData(Locations::all(), 'id', 'name'),array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'client_id',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Parts::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	
	<?php //if($model->potantialAnalogs()):?>
	<fieldset id="analog-block" data-id="<?=$model->id?>">
		<legend>Аналоги</legend>
		<div class="control-group">
			<div class="controls">
				<div class="deleted"></div>
				<?php
				$analogs_model = array();
				if(!$model->isNewRecord){

					$am = CarModels::getAnalogsModels($model->car_model_id, $model->category_id);
					
					foreach ($am as $a) {
						$tmp = array();

						$tmp['id'] = (int) $a->id;
						$tmp['text'] = $a->car_brand->name." ".$a->name;
						//locked: true
						$tmp['locked'] = true;

						$analogs_model[] = CJavaScript::encode((object)$tmp);
					}
				}

				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
					'name' => 'Analogs',
					'asDropDownList' => false,
					'pluginOptions' => array(
						'width' => '40%',
						'placeholder' => 'Модель',
						'tags' => $analogs_model,
						'multiple' => true,
						'ajax' => array(
							'url' => '/admin/carModels/analogModels',
							'dataType' => 'json',
							'data' => 'js: function(term, page){ 
								var car_model = jQuery("#Parts_car_model_id").select2("val");
								return {id: car_model, q: term}; 
							}',
							'results' => 'js: function(data, page){
								return { results: data };
							}'
						)
					)
				));

				$cs = Yii::app()->getClientScript();

				$cs->registerScript('select2-Analogs-ajax','
					jQuery("#Parts_category_id, #Parts_car_model_id").on("selected", function(e){
						updateGrid();

						jQuery.ajax({
							url: "/admin/parts/getAnalogModels",
							data: {
								car_model_id: jQuery("#Parts_car_model_id").select2("val"), 
								cat_id: jQuery("#Parts_category_id").select2("val")
							},
							success: function(data){
								if(data.length) jQuery("#Analogs").select2("data", data);
								else jQuery("#Analogs").select2("data", "");
							}
						});
					});
				', CClientScript::POS_READY);

				$cs->registerScript('select2-callbacks','
					jQuery("#Analogs").on("removed", function(e){
						var $deleted = jQuery(".deleted");

						$deleted.append("<input class=\'a-"+e.val+"\' type=\'hidden\' name=\'Analogs_delete[]\' value=\'"+e.val+"\' >");
					});
					jQuery("#Analogs").select2("data", ['.implode(',', $analogs_model).']);
				',CClientScript::POS_READY);

				?>
			</div>
		</div>
		<?php $this->renderPartial('_analogs', array('model' => $model, 'analogs' => $analogs)); ?>
	</fieldset>
	<?php  //endif; ?>

	<fieldset>
		<legend>Б/У автомобиль</legend>
		<div class="control-group">
			<div class="controls">
				<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
					'asDropDownList' => true,
					'name' => 'UsedCar',
					'data'=> CHtml::listData(UsedCars::allCars(), 'id', 'name'),
					'values' => array($model->usedCar ? $model->usedCar[0]->id : 0),
					'pluginOptions' => array(
						'containerCssClass' => 'span8 no-float',
					)
				)); ?>
			</div>
		</div>
	</fieldset>
	<div>&nbsp;</div>
<?
	$cs = Yii::app()->getClientScript();

	$cs->registerScript('analogs', '

	window.updateGrid = function updateGrid(){
		var cat = jQuery("#Parts_category_id").select2("val"),
			model = jQuery("#Parts_car_model_id").select2("val");

		var part = jQuery("#analog-block").data("id");
		
		jQuery.fn.yiiGridView.update("analogs-grid", {
			url: "/admin/parts/getPartsByModelCat",
			data: {cat_id: cat, model_id: model, part_id: part}
		});

		/*jQuery.ajax({
			url: "/admin/parts/getPartsByModelCat",
			data: {cat_id: cat, model_id: model, part_id: part},
			success: function(){
				
			}
		});*/
	};

	updateGrid();

	', CClientScript::POS_READY);
?>
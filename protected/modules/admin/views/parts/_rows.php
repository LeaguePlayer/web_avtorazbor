
	<?php //echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php //echo $form->textFieldControlGroup($model,'artId',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'price_sell',array('class'=>'span8','maxlength'=>6)); ?>

	<?php echo $form->textFieldControlGroup($model,'price_buy',array('class'=>'span8','maxlength'=>6)); ?>

	<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	
	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('category_id')?></label>
		<div class="controls">
			<?php /*$this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'category_id',
				'data'=>CHtml::listData(Categories::all(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
					// 'placeholder'=>'Категория',
				)
			));*/ ?>

			<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model'=>$model,
				'attribute'=>'category_id',
				'asDropDownList' => false,
				'pluginOptions' => array(
					'width' => '40%',
					'ajax' => array(
						'url' => '/admin/categories/allJson',
						'dataType' => 'json',
						'quietMillis' => 300,
						'data' => 'js: function(term, page){return {q: term, emptyField: false};}',
						'results' => 'js: function(data, page){return { results: data };}'
					),
					'initSelection' => 'js:function (element, callback) {var id=$(element).val(); $.getJSON("/admin/categories/getOneById", {id: id}, function(data) { callback(data); }) }'
				)
			));?>
		</div>
	</div>
	<div class="catgory-attrs" data-articul="<?=$model->id?>">
		<?=$this->renderPartial('categoryAttrs',array('category'=>$model->category,'model_id'=>$model->id),true)?>
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
				),
				
			)); ?>
		</div>
	</div>
	
	<?php //echo $form->dropDownListControlGroup($model,'location_id', Chtml::listData(Locations::all(), 'id', 'name'),array('class'=>'span8')); ?>

	<div class="control-group">
		<label class="control-label" for="Catalog_alias"><?=$model->getAttributeLabel('location_id')?></label>
		<div class="controls" data-url= "<?=Yii::app()->createUrl("admin/locations/addTag")?>">
			<?php
				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'location_id',
				'asDropDownList' => false,
				'pluginOptions' => array(
					'maximumSelectionSize' => 1,
					'formatSelectionTooBig' => 'js:function(maxSize){return "Вы можете выбрать только "+maxSize+" значение.";}',
					'tags' => Locations::getListForSelect(),
				    'width' => '40%',
				),
				'htmlOptions' => array(
				)));
			?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="Catalog_alias"><?=$model->getAttributeLabel('supplier_id')?></label>
		<div class="controls" data-url= "<?=Yii::app()->createUrl("admin/suppliers/addTag")?>">
			<?php
				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'supplier_id',
				'asDropDownList' => false,
				'pluginOptions' => array(
					'maximumSelectionSize' => 1,
					'formatSelectionTooBig' => 'js:function(maxSize){return "Вы можете выбрать только "+maxSize+" значение.";}',
					'tags' => Suppliers::getListForSelect(),
				    'width' => '40%',
				),
				'htmlOptions' => array(
				)));
			?>
		</div>
	</div>
	<?php //echo $form->textFieldControlGroup($model,'client_id',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Parts::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gallery_id'); ?>
		<?php echo $form->hiddenField($model, 'gallery_id'); ?>
		<?php if ($model->galleryBehaviorGallery->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorGallery->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>
	
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

	<fieldset>
		<legend>Б/У автомобиль</legend>
		<div class="control-group">
			<div class="controls">
				<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
					'asDropDownList' => true,
					'name' => 'UsedCar',
					'data'=> CHtml::listData(UsedCars::allCarsForParts(), 'id', 'name'),
					'values' => array($model->usedCar ? $model->usedCar[0]->id : 0),
					'pluginOptions' => array(
						'containerCssClass' => 'span8 no-float',
					)
				)); ?>
				<div>&nbsp;</div>
				<div>&nbsp;</div>
			</div>
		</div>
	</fieldset>
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

	jQuery("#Parts_supplier_id, #Parts_location_id").on("selected",function(e){
		var $this = jQuery(this),
			val = parseInt(e.val, 10);

		if(isNaN(val)){
			jQuery.ajax({
				url: $this.closest(".controls").data("url"),
				data: {Tag: e.val},
				type: "POST",
				dataType: "json"
			}).done(function(res){
				if(res.id.length && res.data.length){
					var v = $this.val();
					$this.val(v.replace(e.val, res.id));
					$this.select2({
						tags: res.data, 
						width:"40%", 
						maximumSelectionSize: 1,
						formatSelectionTooBig: function(maxSize){return "Вы можете выбрать только "+maxSize+" значение.";}
					}).trigger("change");
				}
			});
		}
	});

	', CClientScript::POS_READY);
?>
<style type="text/css">
	ul{
		list-style: none;
		margin: 0;
	}

</style>


